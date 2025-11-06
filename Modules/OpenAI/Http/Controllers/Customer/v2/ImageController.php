<?php

namespace Modules\OpenAI\Http\Controllers\Customer\v2;

use Modules\OpenAI\Transformers\Api\v2\Image\{
    SingleImageResources,
    ImageReplyResources
};
use Modules\OpenAI\Http\Requests\ToggleFavoriteImageRequest;
use Modules\OpenAI\Http\Requests\v2\ImageStoreRequest;
use Modules\OpenAI\Services\v2\ImageService;
use Modules\OpenAI\Services\ContentService;
use Exception, DB, AiProviderManager;
use Modules\OpenAI\Entities\Archive;
use App\Http\Controllers\Controller;
use Illuminate\Http\{
    Response,
    Request
};

class ImageController extends Controller
{
    private $imageService;

    public function __construct()
    {
        $this->imageService = new ImageService;
    }

    public function index()
    {
        $types = apply_filters('modify_gallery_data', ['image_variant', 'video', 'text_to_video', 'ai_persona', 'productshot_variant', 'ai_avatar']);

        $data['images'] = SingleImageResources::collection(
            Archive::query()
                ->select('archives.id', 'archives.title', 'archives.created_at', 'archives.type', 'archives.provider')
                ->whereIn('archives.type', $types)
                ->with(['metas'])
                ->join('archives_meta', function ($join) {
                    $join->on('archives.id', '=', 'archives_meta.owner_id')
                        ->where(function ($query) {
                            $query->where(function ($metaQuery) {
                                $metaQuery->where('archives_meta.key', 'image_creator_id')
                                            ->where('archives_meta.value', auth()->id());
                            })->orWhere(function ($metaQuery) {
                                $metaQuery->where('archives_meta.key', 'video_creator_id')
                                            ->where('archives_meta.value', auth()->id());
                            });
                        });
                })
                ->latest('archives.created_at')
                ->paginate(preference('row_per_page'))
        );

        $data['userFavoriteImages'] = auth()->user()->image_favorites ?? [];

        return view('openai::blades.v2.images.gallery.index', $data);
    }

    public function create()
    {
        $userId = (new ContentService())->getCurrentMemberUserId(null, 'session');
        $data['userId'] = $userId; 
        $data['userSubscription'] = subscription('getUserSubscription',$userId);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
        $data['aiProviders'] = AiProviderManager::databaseOptions('imagemaker'); 

        if (request('id') || request('prompt')) {
            $imageId = Archive::where(['id' => request('id'), 'type' => 'image_variant'])->first(['id', 'parent_id'])?->parent_id;
            if ($imageId) {
                $data['parentId'] = Archive::where(['id' => $imageId, 'type' => 'image_chat'])->first(['id', 'parent_id'])->parent_id;
                $data['prompt'] = request('prompt');
            }
        }
        $data['rules'] = AiProviderManager::rules('imagemaker');
        return view('openai::blades.v2.images.create', $data);
    }

    public function store(Request $request)
    {
        $request = $request->all();
        $request['prompt'] = $request['prompt'] ?? '';
        $cleanedString = preg_replace('/[^A-Za-z0-9\s]/', '', $request['prompt']);
        $request['prompt'] = filteringBadWords($cleanedString);
        $request['parent_id'] = request('parent_id') ?? null;

        if(!isset($request['options'])) {
            throw new Exception( __('Missing advanced options. Please ensure you have provided all necessary advanced options and try again.') );
        }

        request()->merge([...$request['options']]);
        $this->imageService->validation();
        try {
            $images = new ImageReplyResources($this->imageService->store($request));
            return response()->json(['data' => $images], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function show($slug)
    {
        $data['userFavoriteImages'] = auth()->user()->image_favorites ?? [];
        $types = apply_filters('modify_gallery_data', ['image_variant', 'video', 'text_to_video', 'ai_persona', 'productshot_variant', 'ai_avatar']);
        // Current Image
        $data['currentImage'] = Archive::query()
        ->select('archives.*')
        ->join('archives_meta', function ($join) use ($slug) {
            $join->on('archives.id', '=', 'archives_meta.owner_id')
            ->where('archives_meta.key', '=', 'slug')
            ->where('archives_meta.value', '=', $slug);
        })
        ->where(function ($query) use ($types) {
            $query->whereIn('archives.type', $types);
        })
        ->first();

        if (!$data['currentImage']) {
            return response()->json([
                'data' => $data,
                'html' => ''
            ]);
        }

        // Image Variants
        $data['variants'] = $this->imageService->getImageVariants($data['currentImage']);
        $data['variants']->prepend($data['currentImage']);
        // Related Images
        $data['relatedImages'] = $this->imageService->getRelatedImages($data['currentImage']);

        $html = view('openai::blades.v2.images.gallery.variant', $data)->render();

        $data['variants'] = $this->imageService->prepareImageData($data['variants'], $data['userFavoriteImages'], 'small');
        $data['relatedImages'] = $this->imageService->prepareImageData($data['relatedImages'], $data['userFavoriteImages'], 'medium');

        return response()->json([
            'data' => $data,
            'html' => $html
        ]);
    }

    public function destory(Request $request)
    {
        DB::beginTransaction();

        try {

            $this->imageService->delete($request->except('_token'));
            DB::commit();
            return response()->json(__('The :x has been successfully deleted.', ['x' => __('Item')]), Response::HTTP_OK);

        } catch (Exception $e) {

            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
            
        }
    }

    public function toggleFavoriteImage(ToggleFavoriteImageRequest $request): mixed
    {
        try {
            $message = $this->imageService->favourite($request->except('_token'));
            return response()->json($message, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function imageShare($slug)
    {
        $data['currentImage'] = Archive::with('imageCreator')->whereHas('metas', function($q) use ($slug) {
            $q->where('key', 'slug')->where('value', $slug);
        })->where('type', 'image_variant')->first();

        $data['variants'] = Archive::with('metas')->where('parent_id', $data['currentImage']->parent_id)->where('type', 'image_variant')->get();

        return view('openai::blades.v2.images.gallery.image_view_weblink', $data);
    }
}
