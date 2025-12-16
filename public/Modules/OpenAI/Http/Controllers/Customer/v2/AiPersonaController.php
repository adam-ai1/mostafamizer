<?php

namespace Modules\OpenAI\Http\Controllers\Customer\v2;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Modules\OpenAI\Services\ContentService;
use Modules\OpenAI\Services\v2\AiPersonaService;
use Modules\OpenAI\Transformers\Api\v2\AiVideo\AiVideoDetailsResource;

class AiPersonaController extends Controller
{
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
        $this->aiPersonaService = new AiPersonaService();
    }
 
    /**
     * Template method to render the ai persona page.
     *
     * Renders the ai persona page with the latest avatars, voices, and videos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function template(Request $request)
    {
        $aiProviders = \AiProviderManager::databaseOptions('aipersona');
        $data['userId'] = (new ContentService())->getCurrentMemberUserId(null, 'session'); 
        $data['userSubscription'] = subscription('getUserSubscription', $data['userId']);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
        $data['avatarOptions'] = [];
        $data['voiceOptions'] = [];
        $data['promptUrl'] = route('user.ai-persona.store');

        $data['videos'] = $this->aiPersonaService->latestVideos();
        $data['avatars'] = $this->aiPersonaService->latestAvatars()->filter('Modules\\OpenAI\\Filters\\AvatarFilter')->paginate(preference('row_per_page'), ['*'], 'avatar_page');
        $data['voices'] = $this->aiPersonaService->latestVoices()->filter('Modules\\OpenAI\\Filters\\AvatarVoiceFilter')->paginate(preference('row_per_page'), ['*'], 'voice_page');

        $data['providers'] = array_map(function ($provider) {
            return str_replace('aipersona_', '', $provider);
        }, array_keys($aiProviders));

        foreach ($aiProviders  as $options) {
            foreach ($options as $option) {

                if (!isset($option['applies_to'])) {
                    continue;
                }

                if ($option['applies_to'] === 'avatar') {
                    $data['avatarOptions'][] = $option;
                } elseif ($option['applies_to'] === 'voice') {
                    $data['voiceOptions'][] = $option;
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

        return view('openai::blades.ai_persona.index', $data);
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
            $this->aiPersonaService->validation();

            $info = $this->aiPersonaService->generate($request->except(['_token']));
            $code = $this->aiPersonaService->fetchVideo($info['video_id']);
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
