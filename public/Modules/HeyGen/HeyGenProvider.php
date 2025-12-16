<?php

namespace Modules\HeyGen;

use App\Lib\AiProvider;

use Modules\HeyGen\Traits\HeyGenApiTrait;
use Modules\OpenAI\Contracts\Resources\AiPersonaContract;
use Modules\OpenAI\Contracts\Responses\AiPersona\AiPersonaResponseContract;
use Modules\OpenAI\Contracts\Responses\AiPersona\FetchVideoResponseContract;

use Modules\HeyGen\Resources\AiPersonaDataProcessor;
use Modules\HeyGen\Responses\AiPersona\VideoResponse;
use Modules\HeyGen\Responses\AiPersona\FetchVideoResponse;
use Modules\HeyGen\Responses\AiPersona\SyncDataResponse;

class HeyGenProvider extends AiProvider implements AiPersonaContract
{
    use HeyGenApiTrait;

    /**
     * Holds the processed data after it has been manipulated or transformed.
     * This property is typically used within the context of a class to store
     * data that has been modified or processed in some way.
     *
     * @var array Contains an array of data resulting from processing operations.
     */
    protected $processedData;

    protected $model;

    public function description(): array
    {
        return [
            'title' => 'HeyGen',
            'description' => __(':x is an AI-powered video generation platform that enables users to create professional spokesperson-style videos using customizable avatars and voiceovers technology. It supports multiple languages, making it ideal for marketing, training, and communication content without needing cameras or actors.', ['x' => 'HeyGen']),
            'image' => 'Modules/HeyGen/Resources/assets/image/heygen.png',
        ];
    }

    /**
     * Get the validation rules for a specific processor.
     * 
     * @param string $processor The name of the data processor class.
     * 
     * @return array Validation rules for the processor.
     */
    public function getValidationRules(string $processor): array
    {
        $processorClass = "Modules\\HeyGen\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->validationRules();
        }

        return [];
    }

    /**
     * Get the validation rules for a specific processor.
     * 
     * @param string $processor The name of the data processor class.
     * 
     * @return array Validation rules for the processor.
     */
    public function getCustomerValidationRules(string $processor): array
    {
        $processorClass = "Modules\\HeyGen\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->customerValidationRules();
        }

        return [];
    }

    public function aiPersonaOptions(): array
    {
       return (new AiPersonaDataProcessor)->aiPersonaOptions();
    }

    public function generatePersona(array $aiOptions): AiPersonaResponseContract   
    {
        $this->processedData = (new AiPersonaDataProcessor($aiOptions))->prepareData();
        return new VideoResponse($this->makeCurlRequest(moduleConfig('heygen.BASE_URL') . "v2/video/generate", "POST", json_encode($this->processedData)));
    }

    /**
     * Check the status of a video generation request.
     * 
     * Makes repeated GET requests to the API to check the status of the video generation request.
     * If the status is "processing", "waiting", or "pending", the request is repeated after a short delay.
     * Once the status changes, retrieves the generated video.
     * 
     * @param string $id The ID of the video generation request.
     * 
     * @return FetchVideoResponseContract
     */
    public function getVideo(string $id): FetchVideoResponseContract 
    {
        $baseUrl = moduleConfig('heygen.BASE_URL');
        $statusUrl = "{$baseUrl}v1/video_status.get?video_id={$id}";
        $result = $this->makeCurlRequest($statusUrl, "GET");

        while (isset($result['body']['data']['status']) && ( $result['body']['data']['status'] == 'processing' || $result['body']['data']['status'] == 'waiting' || $result['body']['data']['status'] == 'pending')) {
            sleep(1);
            $result = $this->makeCurlRequest($statusUrl, "GET");
        }
        return new FetchVideoResponse($result);
    }

    /**
     * Synchronizes data from the HeyGen API based on the provided type.
     * 
     * Makes a GET request to the HeyGen API to retrieve and dump data of the specified type.
     * 
     * @param string $type The type of data to synchronize from the API.
     * 
     * @return SyncDataResponse The response from the API call.
     */

    public function sync($type): SyncDataResponse
    {
        return new SyncDataResponse($this->makeRequest(moduleConfig('heygen.BASE_URL') . "v2/{$type}", "GET"));   
    }

    /**
     * Processes and stores data using the AiPersonaDataProcessor.
     * 
     * @param array $requestData The request data containing necessary information
     *                           for processing.
     * @param array $responseData The response data to be processed and stored.
     * 
     * @return mixed The result of the prepareStoreData method from the AiPersonaDataProcessor.
     */

    public function processStoreData(array $requestData, array $responseData)
    {
        return (new AiPersonaDataProcessor($requestData))->prepareStoreData($responseData);
    }
    
}
