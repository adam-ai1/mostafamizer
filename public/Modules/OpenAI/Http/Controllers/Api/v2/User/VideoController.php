<?php

namespace Modules\OpenAI\Http\Controllers\Api\v2\User;

use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Entities\Archive;
use Modules\OpenAI\Services\v2\ImageService;
use Modules\OpenAI\Services\v2\TextToVideoService;
use Modules\OpenAI\Transformers\Api\v2\AiVideo\AiVideoDetailsResource;
use Modules\OpenAI\Transformers\Api\v2\Video\SingleVideoResources;

class VideoController extends Controller
{
    /**
     * Constructor method.
     *
     * Instantiates the class and sets up the vector service.
     *
     * @param  TextToVideoService $textToVideoService
     * 
     * @return void
     */
    public function __construct(
        protected TextToVideoService $textToVideoService,
    ) {}

    /**
     * Retrieves a paginated list of text-to-video archives created by the authenticated user.
     *
     * @param  Request $request
     * 
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return SingleVideoResources::collection(
            Archive::query()
                ->select('archives.id', 'archives.title', 'archives.created_at', 'archives.type')
                ->whereIn('archives.type', ['text_to_video', 'video'])
                ->with(['metas'])
                ->join('archives_meta', function ($join) {
                    $join->on('archives.id', '=', 'archives_meta.owner_id')
                        ->where(function ($query) {
                            $query->where(function ($metaQuery) {
                                $metaQuery->where('archives_meta.key', 'video_creator_id')
                                            ->where('archives_meta.value', auth()->id());
                            });
                        });
                })
                ->join('users as creators', 'archives_meta.value', '=', 'creators.id')
                ->filter('Modules\OpenAI\Filters\v2\VideoFilter')
                ->paginate(preference('row_per_page'))
        );
    }

    /**
     * Retrieves a text-to-video archive by ID.
     * 
     * @param int|string $id The ID of the text-to-video archive to retrieve.
     * 
     * @return \Illuminate\Http\JsonResponse
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *         If the provided ID is not numeric or if the archive with the given ID does not exist.
     */
    public function show($id): JsonResponse
    {
        if (!is_numeric($id)) {
            return response()->json(['error' => __('Invalid Request.')], Response::HTTP_FORBIDDEN);
        }
    
        $history = Archive::with('metas')->where('id', $id)->whereIn('type', ['text_to_video', 'video'])
                    ->whereHas('metas', function($query) {
                        $query->where('key', 'video_creator_id')->where('value', auth('api')->id());
                    })->first();
    
        if (!$history) {
            return response()->json(['error' => __('No data found')], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['data' => new SingleVideoResources($history)], Response::HTTP_OK);
    }

    /**
     * Destroys a video archive based on the provided ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $this->textToVideoService->delete($id);
            DB::commit();
            return response()->json([
                'message' => __('The :x has been successfully deleted.', ['x' => __('Item')])
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
            
        }
    }
}
