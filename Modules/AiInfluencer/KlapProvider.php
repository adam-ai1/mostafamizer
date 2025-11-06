<?php

namespace Modules\AiInfluencer;

use App\Lib\AiProvider;
use Modules\AiInfluencer\Traits\KlapApiTrait;
use Modules\AiInfluencer\Contracts\Resources\AiShortsContract;
use Modules\AiInfluencer\Resources\Providers\Klap\AiShortsDataProcessor;
use Modules\AiInfluencer\Responses\AiShorts\Klap\VideoResponse;
use Modules\AiInfluencer\Responses\AiShorts\Klap\FetchVideoResponse;

class KlapProvider extends AiProvider implements AiShortsContract
{
    use KlapApiTrait;

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
            'title' => 'Klap',
            'description' => __(':x API converts long videos into viral-ready shorts using AI, extracting interesting moments and adding features like dynamic captions and AI reframing programmatically.', ['x' => 'Klap']),
            'image' => 'Modules/AiInfluencer/Resources/assets/image/klap.png',
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
        $processorClass = "Modules\\AiInfluencer\\Resources\\Providers\\Klap\\" . $processor;

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
        $processorClass = "Modules\\AiInfluencer\\Resources\\Providers\\Klap\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->customerValidationRules();
        }

        return [];
    }
    
    /**
     * Retrieve the validation rules for the data processor for the AI Shorts feature.
     * 

     * @return array An array of validation rules.
     */
    public function aiShortsRules(): array
    {
        return (new AiShortsDataProcessor)->rules();
    }

    /**
     * Retrieve the options for configuring the character chatbot.
     * 
     * @return array The configuration options for the character chatbot.
     */
    public function aiShortsOptions(): array
    {
        return (new AiShortsDataProcessor)->aiShortsOptions();
    }

    /**
     * Generate AI Shorts based on the provided options.
     *
     * This method utilizes the AI options to generate and return AI Shorts.
     *
     * @param array $aiOptions An array of options to customize the AI Shorts generation.
     * @return mixed The result of the AI Shorts generation.
     */
    public function generateAiShorts(array $aiOptions): mixed
    {
        $this->processedData = (new AiShortsDataProcessor($aiOptions))->prepareData();
        $baseUrl = moduleConfig('aiinfluencer.providers.klap.base_url') . '/tasks/video-to-shorts';
        $response = $this->makeCurlRequest($baseUrl, "POST", json_encode($this->processedData));
        
        if ($response['code'] != 200) {
            $message = $response['body']['message'] ?? __('Something went wrong, please try again.');
            throw new \Exception($message);
        } 

        return new VideoResponse($this->pollStatus($response['body']['projectId']));
    }

    /**
     * Retrieves AI Shorts based on the given video ID.
     *
     * This method polls the Vizard API until the video is ready to be retrieved.
     * 
     * @param string $videoId The ID of the video to retrieve.
     * @return array The response from the Vizard API.
     */
    private function pollStatus(string $videoId)
    {
        $baseUrl = moduleConfig('aiinfluencer.providers.klap.base_url') . '/tasks' . '/' . $videoId;
        $response = $this->makeCurlRequest($baseUrl, "GET");

        while (isset($response['body']['status']) && $response['body']['status'] == 'processing' && $response['body']['status'] == 'error') {
            sleep(2);
            $response = $this->makeCurlRequest($baseUrl, "GET");
        }

        return $response;
    }

    /**
     * Retrieves the generated AI shorts based on the given folder ID.
     * 
     * @param string $folderId The ID of the folder containing the generated shorts.
     * @return array The response from the Klap API containing the generated shorts.
     */
    private function retriveAiShorts(string $folderId)
    {
        $baseUrl =  moduleConfig('aiinfluencer.providers.klap.base_url') . '/projects' . '/' . $folderId;
        $response = $this->makeCurlRequest($baseUrl, "GET");
        return $this->export($folderId, $response['body'][0]['id']);
    }

    /**
     * Exports the AI-generated video content to the user's machine.
     * 
     * This method downloads the generated video content from the Klap API and serves it to the user for download.
     * 
     * @todo Implement the export() method.
     */
    private function export(string $folderId, string $projectId) 
    {
        $baseUrl =  moduleConfig('aiinfluencer.providers.klap.base_url') . '/projects' . '/' . $folderId . '/' . $projectId;
        $this->processedData = (new AiShortsDataProcessor($aiOptions))->prepareLogoDta();
        $response = $this->makeCurlRequest($baseUrl, "POST", json_encode($this->processedData));

        while (isset($response['body']['status']) && $response['body']['status'] == 'processing' && $response['body']['status'] == 'error') {
            sleep(2);
            $response = $this->makeCurlRequest($baseUrl, "GET");
        }

        return new FetchVideoResponse($response);
    }



}
