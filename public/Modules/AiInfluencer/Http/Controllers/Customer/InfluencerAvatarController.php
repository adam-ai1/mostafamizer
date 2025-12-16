<?php

namespace Modules\AiInfluencer\Http\Controllers\Customer;

use Modules\OpenAI\Transformers\Api\v2\AiVideo\AiVideoDetailsResource;
use Modules\AiInfluencer\Services\InfluencerAvatarService;
use Modules\OpenAI\Services\v2\AiPersonaService;
use Modules\OpenAI\Services\ContentService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use AiProviderManager;

class InfluencerAvatarController extends Controller
{
    private $influencerAvatarService;

    private $aiPersonaService;

    /**
     * Constructor method.
     *
     * Initializes the AiPersonaService instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->influencerAvatarService = new InfluencerAvatarService();
        $this->aiPersonaService = new AiPersonaService();
    }

    public function template(Request $request)
    {
        $aiProviders = AiProviderManager::databaseOptions('influenceravatar');
        $data['userId'] = (new ContentService())->getCurrentMemberUserId(null, 'session'); 
        $data['userSubscription'] = subscription('getUserSubscription', $data['userId']);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
        $data['avatarOptions'] = [];
        $data['additionalOptions'] = [];
        $data['promptUrl'] = route('user.influencer-avatar.store');

        $data['videos'] = $this->aiPersonaService->latestVideos();

        $data['avatars'] = $this->aiPersonaService->latestAvatars('influencer_avatar', 'topview', [ 'custom' => $request->source === 'custom-avatar-list' ])->filter('Modules\\OpenAI\\Filters\\AvatarFilter')->paginate(preference('row_per_page'), ['*'], 'avatar_page');
        
        $data['voices'] = $this->aiPersonaService->latestVoices('influencer_avatar', 'topview')->filter('Modules\\OpenAI\\Filters\\AvatarVoiceFilter')->paginate(preference('row_per_page'), ['*'], 'voice_page');

        $data['providers'] = array_map(function ($provider) {
            return str_replace('influenceravatar_', '', $provider);
        }, array_keys($aiProviders));

        foreach ($aiProviders  as $options) {
            foreach ($options as $option) {

                if (!isset($option['applies_to'])) {
                    continue;
                }

                if ($option['applies_to'] === 'avatar') {
                    $data['avatarOptions'][] = $option;
                } else {
                    $data['additionalOptions'][] = $option;
                }
            }
        }

        if ($request->ajax()) {
            $newData = $request->type == 'avatar' ? $data['avatars'] : $data['voices'];
            return response()->json([
                'items' =>  $newData,
                'nextPageUrl' => $newData->nextPageUrl()
            ]);
        }

        return view('aiinfluencer::influencer-avatar.index', $data);
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

        $request['options'] = isset($request['options']) ? $request['options'] : [];
        
        try {
            request()->merge([...$request['options']]);
            $this->influencerAvatarService->validation();

            $info = $this->influencerAvatarService->generate($request->except(['_token']));
            $code = $this->influencerAvatarService->fetchVideo($info['video_id']);
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
