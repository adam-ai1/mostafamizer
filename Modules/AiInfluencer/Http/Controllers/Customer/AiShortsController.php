<?php

namespace Modules\AiInfluencer\Http\Controllers\Customer;

use Modules\OpenAI\Transformers\Api\v2\AiVideo\AiVideoDetailsResource;
use Modules\AiInfluencer\Services\AiShortsService;
use Modules\OpenAI\Services\ContentService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use AiProviderManager;

class AiShortsController extends Controller
{
    private $aiShortsService;

    /**
     * Constructor method.
     *
     * Initializes the AiPersonaService instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->aiShortsService = new AiShortsService();
    }

    public function template()
    {
        $data['aiProviders'] = AiProviderManager::databaseOptions('aishorts');
        $data['userId'] = (new ContentService())->getCurrentMemberUserId(null, 'session'); 
        $data['userSubscription'] = subscription('getUserSubscription', $data['userId']);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
        $data['videos'] = [];

        $data['providers'] = array_map(function ($provider) {
            return str_replace('aishorts_', '', $provider);
        }, array_keys($data['aiProviders']));

        $data['rules'] = AiProviderManager::rules('aishorts');
        $data['promptUrl'] = route('user.ai-shorts.store');

        return view('aiinfluencer::ai-shorts.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $checkSubscription = checkUserSubscription('video');

        if ($checkSubscription['status'] != 'success') {
            return response()->json(['error' => $checkSubscription['response']], Response::HTTP_FORBIDDEN);
        }
        
        try {
            request()->merge([...$request['options']]);
            $this->aiShortsService->validation();

            $info = $this->aiShortsService->generate($request->except(['_token']));
            $code = $this->aiShortsService->fetchVideo($info['video_id']);
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
