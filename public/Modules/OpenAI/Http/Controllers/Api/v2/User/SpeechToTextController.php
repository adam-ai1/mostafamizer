<?php

namespace Modules\OpenAI\Http\Controllers\Api\v2\User;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Entities\Archive;
use Modules\OpenAI\Services\v2\ArchiveService;
use Modules\OpenAI\Services\v2\SpeechToTextService;
use Modules\OpenAI\Http\Requests\SpeechUpdateRequest;
use Modules\OpenAI\Transformers\Api\v2\SpeechToText\SpeechToTextDetailsResource;

class SpeechToTextController extends Controller
{
    /**
     * @param SpeechToTextService $contentService
     */
    public function __construct(
        protected SpeechToTextService $speechToTextService
        ) {}

    /**
     * Convert speech to text.
     *
     * @param  Request  $request
     * @param  SpeechToTextService  $speechToTextService
     * @return mixed
     */
    public function generate(Request $request): mixed
    {
        $checkSubscription = checkUserSubscription('minute');

        if ($checkSubscription['status'] != 'success') {
            return response()->json(['error' => $checkSubscription['response']], Response::HTTP_FORBIDDEN);
        }

        try {
            $response = $this->speechToTextService->handleSpeechGenerate($request->except('_token'));
            return new SpeechToTextDetailsResource($response);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Retrieves and displays a paginated list of all speech records.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index() 
    {
        $speeches = $this->speechToTextService->getAllLists()->filter('Modules\\OpenAI\\Filters\\SpeechFilter')
            ->orderBy('id', 'desc')->paginate(preference('row_per_page'));
        return SpeechToTextDetailsResource::collection($speeches);
    }
    
    /**
     * Display the specified speech-to-text record.
     *
     * @param int $id The ID of the speech-to-text record to display.
     *
     * @return \Illuminate\Http\JsonResponse|SpeechToTextDetailsResource
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     *         If the record doesn't exist.
     */
    public function show($id): JsonResponse|CodeResource
    {
        if (!is_numeric($id)) {
            return response()->json(['error' => __('Invalid Request.')], Response::HTTP_FORBIDDEN);
        }
    
        $history = Archive::with('metas')->where('id', $id)->whereType('speech_to_text_chat_reply')
                    ->whereHas('metas', function($query) {
                        $query->where('key', 'speech_to_text_creator_id')->where('value', auth('api')->id());
                    })->first();
    
        if (!$history) {
            return response()->json(['error' => __('No data found')], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['data' => new SpeechToTextDetailsResource($history)], Response::HTTP_OK);
    }

    /**
     * Delete a speech-to-text record by its ID.
     *
     * @param int $id The ID of the speech-to-text record to delete.
     *
     * @return \Illuminate\Http\JsonResponse|null
     *         The JSON response indicating the success or failure of the deletion operation.
     */
    public function delete($id): JsonResponse|null
    {
        if (!is_numeric($id)) {
            return response()->json(['error' => __('Invalid Request.')], Response::HTTP_FORBIDDEN);
        }

        $history = Archive::with('metas')->where('id', $id)->whereType('speech_to_text_chat_reply')
                    ->whereHas('metas', function($query) {
                        $query->where('key', 'speech_to_text_creator_id')->where('value', auth('api')->id());
                    })->first();
    
        if (!$history) {
            return response()->json(['error' => __('No data found')], Response::HTTP_NOT_FOUND);
        }

        try {
            $jsonResponse = $this->speechToTextService->delete($id);
            $response = $jsonResponse->getData();

            if ($response->status === 'fail') {
                throw new \Exception($response->message, Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json(['message' => $response->message], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function update(SpeechUpdateRequest $request, $id): JsonResponse
    {
        if (!is_numeric($id)) {
            return response()->json(['error' => __('Invalid Request.')], Response::HTTP_FORBIDDEN);
        }
    
        $speech = Archive::with('metas')
                    ->where('id', $id)
                    ->whereType('speech_to_text_chat_reply')
                    ->whereHas('metas', function($query) {
                        $query->where('key', 'speech_to_text_creator_id')->where('value', auth('api')->id());
                    })->first();

        if (!$speech) {
            return response()->json(['error' => __('No data found')], Response::HTTP_NOT_FOUND);
        }
    
        try {
            ArchiveService::update($request->except(['_token', '_method']), $id);
            $speech->refresh();
    
            return response()->json(['data' => new SpeechToTextDetailsResource($speech)], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
