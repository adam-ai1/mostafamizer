<?php

namespace Modules\AiInfluencer;

use App\Lib\AiProvider;
use Modules\AiInfluencer\Traits\TopViewApiTrait;
use Modules\AiInfluencer\Contracts\Resources\AiShortsContract;
use Modules\AiInfluencer\Responses\UrlToVideo\Topview\VideoResponse;
use Modules\AiInfluencer\Responses\UrlToVideo\Topview\FetchVideoResponse;
use Modules\AiInfluencer\Resources\Providers\Topview\UrlToVideoDataProcessor;
use Modules\AiInfluencer\Resources\Providers\Topview\InfluencerAvatarDataProcessor;

use Modules\AiInfluencer\Contracts\Resources\UrlToVideoContract;
use Modules\AiInfluencer\Contracts\Resources\InfluencerAvatarContract;
use Modules\AiInfluencer\Responses\InfluencerAvatar\Topview\VideoResponse as InfluencerAvatarVideoResponse;
use Modules\AiInfluencer\Responses\InfluencerAvatar\Topview\FetchVideoResponse as InfluencerAvatarFetchVideoResponse;
use Modules\AiInfluencer\Responses\InfluencerAvatar\Topview\SyncDataResponse;

class TopViewProvider extends AiProvider implements UrlToVideoContract, InfluencerAvatarContract
{
    use TopViewApiTrait;

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
            'title' => 'Top View',
            'description' => __(':x is an AI-powered video creation platform that generates complete marketing videos using artificial intelligence. It creates viral content including app promotions, product demonstrations, and try-on videos with AI avatars, automated scriptwriting powered by GPT-4o, lifelike voiceovers, and intelligent editing. The web-based tool requires no filming or technical skills, supports 20+ languages, and costs just 5% of professional editors.', ['x' => 'Topview.ai']),
            'image' => 'Modules/AiInfluencer/Resources/assets/image/topview.png',
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
        $processorClass = "Modules\\AiInfluencer\\Resources\\Providers\\Topview\\" . $processor;

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
        $processorClass = "Modules\\AiInfluencer\\Resources\\Providers\\Topview\\" . $processor;

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
        $baseUrl = moduleConfig('aiinfluencer.providers.topview.base_url') . '/v1/m2v/task/submit';
        return new VideoResponse($this->makeCurlRequest($baseUrl, "POST", json_encode($this->processedData)));
    }

    /**
     * Retrieves Url To Video using the provided video ID.
     *
     * @param string $videoId The ID of the video to be retrieved.
     * @return mixed The response wrapped in a FetchVideoResponse object.
     */
    public function retriveUrlToVideo(string $videoId): mixed
    {
        $baseUrl = moduleConfig('aiinfluencer.providers.topview.base_url') . '/v1/m2v/task/query?taskId=' . $videoId;
        $response = $this->makeCurlRequest($baseUrl, "GET");

        while (isset($response['body']['result']['status']) && in_array($response['body']['result']['status'], ['pending', 'processing', 'failed', 'error'])) {
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
    public function influencerAvatarRules(): array
    {
        return (new InfluencerAvatarDataProcessor)->rules();
    }

    /**
     * Retrieve the options for configuring the character chatbot.
     * 
     * @return array The configuration options for the character chatbot.
     */
    public function influencerAvatarOptions(): array
    {
        return (new InfluencerAvatarDataProcessor)->influencerAvatarOptions();
    }

    /**
     * Generate AI Shorts based on the provided options.
     *
     * This method utilizes the AI options to generate and return AI Shorts.
     *
     * @param array $aiOptions An array of options to customize the AI Shorts generation.
     * @return mixed The result of the AI Shorts generation.
     */
    public function generateInfluencerAvatar(array $aiOptions): mixed
    {
        $this->processedData = (new InfluencerAvatarDataProcessor($aiOptions))->prepareInfluencerAvatarData();
        $baseUrl = moduleConfig('aiinfluencer.providers.topview.base_url') . '/v1/video_avatar/task/submit';
        return new InfluencerAvatarVideoResponse($this->makeCurlRequest($baseUrl, "POST", json_encode($this->processedData)));
    }

    /**
     * Retrieves Url To Video using the provided video ID.
     *
     * @param string $videoId The ID of the video to be retrieved.
     * @return mixed The response wrapped in a FetchVideoResponse object.
     */
    public function retriveInfluencerAvatar(string $videoId): mixed
    {
        $baseUrl = moduleConfig('aiinfluencer.providers.topview.base_url') . '/v1/video_avatar/task/query?taskId=' . $videoId;
        $response = $this->makeCurlRequest($baseUrl, "GET");

        while (isset($response['body']['result']['status']) && in_array($response['body']['result']['status'], ['pending', 'processing', 'failed', 'error'])) {
            sleep(2);
            $response = $this->makeCurlRequest($baseUrl, "GET");
        }

        return new InfluencerAvatarFetchVideoResponse($response);
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

    public function sync(string $type, array $customParams = []): SyncDataResponse
    {
        $apiType = $type === 'avatars' ? 'aiavatar' : 'voice';
        
        $allData = [];
        $currentPage = 1;
        $hasMoreData = true;
        
        while ($hasMoreData) {
            try {
                // Build query parameters
                $queryParams = array_merge([
                    'pageSize' => 100,
                    'page' => $currentPage
                ], $customParams);
                
                $url = moduleConfig('aiinfluencer.providers.topview.base_url') . "/v1/{$apiType}/query?" . http_build_query($queryParams);
                
                // Make the API request
                $response = $this->makeCurlRequest($url, "GET");
                
                if (empty($response['body']['result']['data']) || count($response['body']['result']['data']) < 100) {
                    $hasMoreData = false;
                }
                
                // Merge data from current page
                $allData = array_merge($allData, $response['body']['result']['data'] ?? []);
                
                $currentPage++;
                
                // Optional: Add a small delay to avoid overwhelming the API
                usleep(100000); // 0.1 second delay
                
            } catch (\Exception $e) {
                throw new Exception(__("API request failed on page :x : :y ", ['x' => $currentPage, 'y' => $e->getMessage()]));
            }
        }

        return new SyncDataResponse($allData);
    }

    /**
     * Processes and stores data using the InfluencerAvatarDataProcessor.
     * 
     * @param array $requestData The request data containing necessary information
     *                           for processing.
     * @param array $responseData The response data to be processed and stored.
     * 
     * @return mixed The result of the prepareStoreData method from the InfluencerAvatarDataProcessor.
     */

    public function processStoreData(array $requestData, array $responseData)
    {
        return (new InfluencerAvatarDataProcessor($requestData))->prepareStoreData($responseData);
    }
}
