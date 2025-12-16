<?php

namespace Modules\AiInfluencer\Http\Controllers\Customer;

use Modules\OpenAI\Transformers\Api\v2\AiVideo\AiVideoDetailsResource;
use Modules\AiInfluencer\Services\UrlToVideoService;
use Illuminate\Contracts\Support\Renderable;
use Modules\OpenAI\Services\ContentService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use AiProviderManager;

class UrlToVideoController extends Controller
{

    protected $urlToVideoService; 

    /**
     * Constructor method.
     *
     * Initializes the AiPersonaService instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->urlToVideoService = new UrlToVideoService();
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function template()
    {
        $data['aiProviders'] = AiProviderManager::databaseOptions('urltovideo');
        $data['userId'] = (new ContentService())->getCurrentMemberUserId(null, 'session'); 
        $data['userSubscription'] = subscription('getUserSubscription', $data['userId']);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
        $data['videos'] = [];

        $data['providers'] = array_map(function ($provider) {
            return str_replace('urltovideo_', '', $provider);
        }, array_keys($data['aiProviders']));

        $data['rules'] = AiProviderManager::rules('urltovideo');
        $data['promptUrl'] = route('user.url-to-video.store');
        return view('aiinfluencer::url-to-video.index', $data);
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
        
        try {
            request()->merge([...$request['options']]);
            $this->urlToVideoService->validation();
            $info = $this->urlToVideoService->generate($request->except(['_token']));
            $code = $this->urlToVideoService->fetchVideo($info['video_id']);
            $data['userSubscription'] = subscription('getUserSubscription',auth()->user()->id);
            $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
            $data['featureLimit']['video']['reduce'] = $info['balanceReduce'];
            return response()->json(['data' => new AiVideoDetailsResource(collect(['video' => $code, 'balance' => $data['featureLimit']['video']]))], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
