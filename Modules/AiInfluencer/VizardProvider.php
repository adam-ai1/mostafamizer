<?php

namespace Modules\AiInfluencer;

use App\Lib\AiProvider;
use Modules\AiInfluencer\Traits\VizardApiTrait;
use Modules\AiInfluencer\Contracts\Resources\AiShortsContract;
use Modules\AiInfluencer\Resources\Providers\Vizard\AiShortsDataProcessor;
use Modules\AiInfluencer\Responses\AiShorts\Vizard\VideoResponse;
use Modules\AiInfluencer\Responses\AiShorts\Vizard\FetchVideoResponse;

class VizardProvider extends AiProvider implements AiShortsContract
{
    use VizardApiTrait;

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
            'title' => 'Vizard',
            'description' => __(':x enables users to create AI-powered video clipping, transforming long videos into engaging social media clips with automated detection, subtitles, and customization options.', ['x' => 'Vizard']),
            'image' => 'Modules/AiInfluencer/Resources/assets/image/vizard.png',
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
        $processorClass = "Modules\\AiInfluencer\\Resources\\Providers\\Vizard\\" . $processor;

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
        $processorClass = "Modules\\AiInfluencer\\Resources\\Providers\\Vizard\\" . $processor;

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
        $baseUrl = moduleConfig('aiinfluencer.providers.vizard.base_url') . 'create';
        return  new VideoResponse($this->makeCurlRequest($baseUrl, "POST", json_encode($this->processedData)));
    }

    /**
     * Retrieves AI Shorts based on the given video ID.
     *
     * This method polls the Vizard API until the video is ready to be retrieved.
     * 
     * @param string $videoId The ID of the video to retrieve.
     * @return array The response from the Vizard API.
     */
    public function retriveAiShorts(string $videoId)
    {
        $baseUrl = moduleConfig('aiinfluencer.providers.vizard.base_url') . 'query/' . $videoId;
        $response = $this->makeCurlRequest($baseUrl, "GET");

        while (isset($response['body']['code']) && $response['body']['code'] == 1000) {
            sleep(2);
            $response = $this->makeCurlRequest($baseUrl, "GET");
        }

        return  new FetchVideoResponse($response);
    }
}
