<?php

namespace Modules\OpenAI\Http\Controllers\Api\v2\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Response;
use Modules\OpenAI\Entities\Archive;
use Modules\OpenAI\Services\v2\VoiceoverService;
use Modules\OpenAI\Transformers\Api\v2\Voiceover\VoiceDetailsResource;

use Modules\OpenAI\Transformers\Api\v2\Voiceover\VoiceoverDetailsResource;

class VoiceoverController extends Controller
{

    /**
     * @param VoiceoverService $voiceoverService
     */

     public function __construct(
        protected VoiceoverService $voiceoverService
        ) {}

    /**
     * List of all contents
     * @param Request $request
     *
     * @return [type]
     */

     public function index(Request $request)
     {
        $contents = (new Archive)->voiceovers('voiceover')->filter()->paginate(preference('row_per_page'));
        return VoiceoverDetailsResource::collection($contents)->response()->getData(true);
     }

    /**
     * Audio generate from prompt
     * @param Request $request
     *
     * @return [type]
     */
    public function generate(Request $request)
    {
        $checkSubscription = checkUserSubscription('character');

        if ($checkSubscription['status'] != 'success') {
            return response()->json(['error' => $checkSubscription['response']], Response::HTTP_FORBIDDEN);
        }

        request()->merge([...$request['data']]);
        try {
            $this->voiceoverService->validation();
            $response = $this->voiceoverService->handleSpeechGenerate($request->except('_token'));
            return new VoiceoverDetailsResource($response);
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

     /**
     * Show the specified resource.
     *
     * @param  int  $id
     */
    public function show($id): mixed
    {
        if (!is_numeric($id)) {
            return response()->json(['error' => __('Invalid Request.')], Response::HTTP_FORBIDDEN);
        }

        if ($voice = $this->voiceoverService->audioById($id)) {
            return response()->json(['data' => new VoiceoverDetailsResource($voice)], Response::HTTP_OK);
        }

        return response()->json(['error' => __('No :x found.', ['x' => __('Voiceover')])], Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id): mixed
    {
        if (!is_numeric($id)) {
            return response()->json(['error' => __('Invalid Request.')], Response::HTTP_FORBIDDEN);
        }

        return $this->voiceoverService->delete($id) 
        ? response()->json(['message' => __('The :x has been successfully deleted.', ['x' => __('Voiceover')])], Response::HTTP_OK)
        : response()->json(['error' => __('No :x found.', ['x' => __('Voiceover')])], Response::HTTP_NOT_FOUND);
    }

    /**
     * Return a list of voice actors for a given AI provider.
     *
     * @param string $provider The AI provider.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function voices(string $provider, Request $request)
    {
        $allData = $this->voiceoverService->allVoice($provider)->filter('Modules\\OpenAI\\Filters\\VoiceFilter')->paginate(preference('row_per_page'));
        return VoiceDetailsResource::collection($allData);
    }
}
