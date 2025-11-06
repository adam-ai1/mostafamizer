<?php

namespace Modules\AiInfluencer;

use App\Lib\AiProvider;
use Modules\AiInfluencer\Traits\CreatifyApiTrait;
use Modules\AiInfluencer\Contracts\Resources\AiShortsContract;
use Modules\AiInfluencer\Responses\AiShorts\Creatify\VideoResponse;
use Modules\AiInfluencer\Responses\AiShorts\Creatify\FetchVideoResponse;
use Modules\AiInfluencer\Resources\Providers\Creatify\AiShortsDataProcessor;

use Modules\AiInfluencer\Contracts\Resources\UrlToVideoContract;
use Modules\AiInfluencer\Resources\Providers\Creatify\UrlToVideoDataProcessor;
use Modules\AiInfluencer\Responses\UrlToVideo\Creatify\VideoResponse as UrlVideoResponse;
use Modules\AiInfluencer\Responses\UrlToVideo\Creatify\FetchVideoResponse as UrlFetchVideoResponse;

class CreatifyProvider extends AiProvider implements AiShortsContract, UrlToVideoContract
{
    use CreatifyApiTrait;

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
            'title' => 'Creatify',
            'description' => __(':x is an AI-powered video ad creation platform that turns product pages into winning video advertisements. It generates UGC-style ads using 900+ lifelike AI avatars by simply pasting a product URL. The platform automatically creates 5-10 ready-to-run video ads in seconds, includes cinematic product shots, and offers an all-in-one AdMax suite for competitor research, testing, and optimization with real-time performance tracking.', ['x' => 'Creatify.ai']),
            'image' => 'Modules/AiInfluencer/Resources/assets/image/creatify.png',
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
        $processorClass = "Modules\\AiInfluencer\\Resources\\Providers\\Creatify\\" . $processor;

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
        $processorClass = "Modules\\AiInfluencer\\Resources\\Providers\\Creatify\\" . $processor;

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
        $baseUrl = moduleConfig('aiinfluencer.providers.creatify.base_url') . '/ai_scripts';
        return new VideoResponse($this->makeCurlRequest($baseUrl, "POST", json_encode($this->processedData)));
    }

    /**
     * Retrieves AI Shorts using the provided video ID.
     *
     * @param string $videoId The ID of the video to be retrieved.
     * @return mixed The response wrapped in a FetchVideoResponse object.
     */
    public function retriveAiShorts(string $videoId): mixed
    {
        $baseUrl = moduleConfig('aiinfluencer.providers.creatify.base_url') . '/ai_scripts' . '/' . $videoId;
        $response = $this->makeCurlRequest($baseUrl, "GET");

        while (isset($response['body']['status']) && in_array($response['body']['status'], ['pending', 'in_queue', 'running', 'failed', 'rejected'])) {
            sleep(2);
            $response = $this->makeCurlRequest($baseUrl, "GET");
        }

        return new FetchVideoResponse($response);
    }

    /**
     * Retrieve the validation rules for the data processor for the AI Shorts feature.
     * 

     * @return array An array of validation rules.
     */
    public function urlToVideoRules(): array
    {
        return (new UrlToVideoDataProcessor)->rules();
    }

    /**
     * Retrieve the options for configuring the character chatbot.
     * 
     * @return array The configuration options for the character chatbot.
     */
    public function urlToVideoOptions(): array
    {
        return (new UrlToVideoDataProcessor)->urlToVideoOptions();
    }

    /**
     * Generate AI Shorts based on the provided options.
     *
     * This method utilizes the AI options to generate and return AI Shorts.
     *
     * @param array $aiOptions An array of options to customize the AI Shorts generation.
     * @return mixed The result of the AI Shorts generation.
     */
    public function generateUrlToVideo(array $aiOptions): mixed
    {
        $this->processedData = (new UrlToVideoDataProcessor($aiOptions))->prepareUrlToVideoData();
        $baseUrl = moduleConfig('aiinfluencer.providers.creatify.base_url') . '/link_to_videos';
        return new UrlVideoResponse($this->makeCurlRequest($baseUrl, "POST", json_encode($this->processedData)));
    }

    /**
     * Retrieves AI Shorts using the provided video ID.
     *
     * @param string $videoId The ID of the video to be retrieved.
     * @return mixed The response wrapped in a FetchVideoResponse object.
     */
    public function retriveUrlToVideo(string $videoId): mixed
    {
        $baseUrl = moduleConfig('aiinfluencer.providers.creatify.base_url') . '/link_to_videos' . '/' . $videoId;
        $response = $this->makeCurlRequest($baseUrl, "GET");

        while (isset($response['body']['status']) && in_array($response['body']['status'], ['pending', 'in_queue', 'running', 'failed', 'rejected'])) {
            sleep(2);
            $response = $this->makeCurlRequest($baseUrl, "GET");
        }

        return new UrlFetchVideoResponse($response);
    }
}
