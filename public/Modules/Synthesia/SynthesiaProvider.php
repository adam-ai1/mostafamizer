<?php

namespace Modules\Synthesia;

use App\Lib\AiProvider;

use Modules\Synthesia\Traits\SynthesiaApiTrait;
use Modules\OpenAI\Contracts\Resources\AiAvatarContract;
use Modules\OpenAI\Contracts\Responses\AiAvatar\AiAvatarResponseContract;
use Modules\OpenAI\Contracts\Responses\AiAvatar\FetchVideoResponseContract;

use Modules\Synthesia\Resources\AiAvatarDataProcessor;
use Modules\Synthesia\Responses\AiAvatar\VideoResponse;
use Modules\Synthesia\Responses\AiAvatar\FetchVideoResponse;

class SynthesiaProvider extends AiProvider implements AiAvatarContract
{
    use SynthesiaApiTrait;

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
            'title' => 'Synthesia',
            'description' => __(':x is the AI Video Communications Platform. Its AI Video Generator enables everyone to create professional videos without mics, cameras, actors or studios. Using AI, we’re radically changing the process of video content creation, making it scalable and affordable while maintaining high quality.', ['x' => 'Synthesia']),
            'image' => 'Modules/Synthesia/Resources/assets/image/synthesia.png',
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
        $processorClass = "Modules\\Synthesia\\Resources\\" . $processor;

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
        $processorClass = "Modules\\Synthesia\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->customerValidationRules();
        }

        return [];
    }

    public function aiAvatarOptions(): array
    {
       return (new AiAvatarDataProcessor)->aiAvatarOptions();
    }

    public function generateAvatar(array $aiOptions): AiAvatarResponseContract
    {
        $this->processedData = (new AiAvatarDataProcessor($aiOptions))->prepareData();
        return new VideoResponse($this->makeCurlRequest(moduleConfig('synthesia.BASE_URL') . "v2/videos", "POST", json_encode($this->processedData)));
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
        $baseUrl = moduleConfig('synthesia.BASE_URL');
        $statusUrl = "{$baseUrl}v2/videos/{$id}";
        $result = $this->makeCurlRequest($statusUrl, "GET");
        
        while (isset($result['body']['status']) && ( $result['body']['status'] == 'processing' || $result['body']['status'] == 'waiting' || $result['body']['status'] == 'pending' || $result['body']['status'] == 'in_progress')) {
            sleep(1);
            $result = $this->makeCurlRequest($statusUrl, "GET");
        }
        return new FetchVideoResponse($result);
    }

    /**
     * Synchronizes data from the Synthesia API based on the provided type.
     * 
     * Makes a GET request to the Synthesia API to retrieve and dump data of the specified type.
     * 
     * @param string $type The type of data to synchronize from the API.
     * 
     * @return array The response from the API call.
     */

    public function sync($type): array
    {
        return $this->makeRequest(moduleConfig('synthesia.BASE_URL') . "v2/{$type}", "GET");   
    }
    
}
