<?php

namespace Modules\OpenAI\Http\Controllers\Customer\v2;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Entities\Archive;
use Modules\OpenAI\Services\ContentService;
use Illuminate\Contracts\Support\Renderable;
use Modules\OpenAI\Services\v2\ImageToVideoService;
use Modules\OpenAI\Transformers\Api\v2\AiVideo\AiVideoDetailsResource;

class ImageToVideoController extends Controller
{

    /**
     * Constructor method.
     *
     * Instantiates the class and sets up the vector service.
     *
     * @param  ImageToVideoService $imageToVideoService
     * 
     * @return void
     */
    public function __construct(
        protected ImageToVideoService $imageToVideoService,
    ) {}

    /**
     * Display the template view for the image-to-video feature.
     *
     * @return \Illuminate\View\View The view instance for the image-to-video template.
     */
    public function template()
    {
        $data['aiProviders'] = \AiProviderManager::databaseOptions('videomaker');
        $userId = (new ContentService())->getCurrentMemberUserId(null, 'session');
        $data['rules'] = \AiProviderManager::rules('videomaker');
        $data['userId'] = $userId; 
        $data['userSubscription'] = subscription('getUserSubscription', $userId);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
        return view('openai::blades.img-to-video.img_to_video', $data);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $checkSubscription = checkUserSubscription('video');

        if ($checkSubscription['status'] != 'success') {
            return response()->json(['error' => $checkSubscription['response']], Response::HTTP_FORBIDDEN);
        }

        request()->merge([...$request['options']]);
        
        try {
            $this->imageToVideoService->validation();

            $info = $this->imageToVideoService->generate($request->except(['_token']));
            $data['userSubscription'] = subscription('getUserSubscription',auth()->user()->id);
            $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
            $data['featureLimit']['video']['reduce'] = $info['balanceReduce'];

            return response()->json(['data' => new AiVideoDetailsResource(collect([ 'video' => $info['video'], 'balance' => $data['featureLimit']['video']]))], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Retrieves a video by ID.
     *
     * @param string $id The ID of the video to retrieve.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *         If the video with the given ID does not exist.
     */
    public function getVideo(string $id): JsonResponse
    {
        try {
            $video = $this->imageToVideoService->getVideo($id);

            if (!$video) {
                return response()->json(['message' => __('Still processing')], Response::HTTP_ACCEPTED);
            }
            
            return response()->json(['data' => new AiVideoDetailsResource(collect(['video' => $video]))], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
