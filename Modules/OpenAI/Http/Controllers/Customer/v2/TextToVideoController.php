<?php

namespace Modules\OpenAI\Http\Controllers\Customer\v2;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Entities\Archive;
use Modules\OpenAI\Services\ContentService;
use Modules\OpenAI\Services\v2\TextToVideoService;
use Modules\OpenAI\Transformers\Api\v2\AiVideo\AiVideoDetailsResource;

class TextToVideoController extends Controller
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
     * Display the template view for the image-to-video feature.
     *
     * @return \Illuminate\View\View The view instance for the image-to-video template.
     */
    public function template()
    {
        $data['aiProviders'] = \AiProviderManager::databaseOptions('texttovideo');
        $userId = (new ContentService())->getCurrentMemberUserId(null, 'session');
        $data['rules'] = \AiProviderManager::rules('texttovideo');
        $data['userId'] = $userId; 
        $data['userSubscription'] = subscription('getUserSubscription', $userId);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
        $data['promptUrl'] = 'user/text-to-video';

        return view('openai::blades.v2.text_to_video.create', $data);
    }

    /**
     * Handle the POST request for generating a video from a given prompt.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        $checkSubscription = checkUserSubscription('video');

        if ($checkSubscription['status'] != 'success') {
            return response()->json(['error' => $checkSubscription['response']], Response::HTTP_FORBIDDEN);
        }
        
        $request = $request->all();

        $cleanedString = preg_replace('/[^A-Za-z0-9\s]/', '', $request['prompt']);
        $request['prompt'] = filteringBadWords($cleanedString);
        $request['parent_id'] = request('parent_id') ?? null;

        request()->merge([...$request['options']]);

        try {
            $this->textToVideoService->validation();
            
            $info = $this->textToVideoService->store($request);
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
            $video = $this->textToVideoService->getVideo($id);

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
