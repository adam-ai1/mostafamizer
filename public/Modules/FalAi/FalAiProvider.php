<?php

namespace Modules\FalAi;

use App\Lib\AiProvider;
use Modules\FalAi\Traits\FalAiApiTrait;

use Modules\OpenAI\Contracts\Resources\TextToVideoContract;

use Modules\FalAi\Resources\TextToVideoDataProcessor;
use Modules\OpenAI\Contracts\Responses\TextToVideo\TextToVideoResponseContract;
use Modules\OpenAI\Contracts\Responses\TextToVideo\FetchVideoResponseContact;
use Modules\FalAi\Responses\TextToVideo\TextToVideoResponse;
use Modules\FalAi\Responses\TextToVideo\FetchVideoResponse;

use Modules\FalAi\Resources\ImageDataProcessor;
use Modules\OpenAI\Contracts\Responses\ImageResponseContract;
use Modules\FalAi\Responses\Image\ImageResponse;

use Modules\OpenAI\Contracts\Resources\ImageMakerContract;

use Modules\FalAi\Resources\VideoDataProcessor;
use Modules\FalAi\Responses\Video\VideoResponse;
use Modules\OpenAI\Contracts\Resources\VideoMakerContract;
use Modules\OpenAI\Contracts\Responses\Video\VideoResponseContract;
use Modules\OpenAI\Contracts\Responses\Video\FetchVideoResponseContract as FetchImageToVideoResponseContract;
use Modules\FalAi\Responses\Video\FetchVideoResponse as FetchImageToVideoResponse;

use Modules\FalAi\Responses\Video\CheckVideoResponse as CheckImageToVideoResponse;
use Modules\OpenAI\Contracts\Responses\Video\CheckVideoResponseContact as CheckImageToVideoResponseContact;

use Modules\FalAi\Responses\TextToVideo\CheckVideoResponse;
use Modules\OpenAI\Contracts\Responses\TextToVideo\CheckVideoResponseContact;

class FalAiProvider extends AiProvider implements TextToVideoContract, ImageMakerContract, VideoMakerContract
{
    use FalAiApiTrait;

    /**
     * Holds the processed data after it has been manipulated or transformed.
     * This property is typically used within the context of a class to store
     * data that has been modified or processed in some way.
     *
     * @var array Contains an array of data resulting from processing operations.
     */
    protected $processedData;

    protected $model;

    protected $production = true;

    public function description(): array
    {
        return [
            'title' => 'FalAi',
            'description' => __(':x is an AI platform that helps users generate images, text, and speech. It offers fast model inference, fine-tuning, and APIs, making AI integration easy for developers, creators, and businesses.', ['x' => 'FalAi']),
            'image' => 'Modules/FalAi/Resources/assets/image/falai.png',
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
        $processorClass = "Modules\\FalAi\\Resources\\" . $processor;

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
        $processorClass = "Modules\\FalAi\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->customerValidationRules();
        }

        return [];
    }

    public function textToVideoOptions(): array 
    {
        return (new TextToVideoDataProcessor)->textToVideoOptions();
    }

    public function generateTextToVideo(array $aiOptions): TextToVideoResponseContract
    {
        $this->processedData = (new TextToVideoDataProcessor($aiOptions))->prepareData();
        $this->model = data_get($aiOptions['options'], 'model', 'kling-video-v1-pro');
        $provider = (new TextToVideoDataProcessor())->findProviderData(moduleConfig('falai.videomaker.providers'), $this->model, false, ['service' =>'text-to-video']);

        if (!$this->production) {
            return new TextToVideoResponse($this->dummyGenerateVideo());
        }

        return new TextToVideoResponse($this->makeCurlRequest(moduleConfig('falai.BASE_URL') . $provider, "POST", json_encode($this->processedData)));
    }

    private function dummyGenerateVideo()
    {
        return [
            "code" => 200,
            "body" => [
                "status" => "IN_QUEUE",
                "request_id" => "464a10fc-a233-4c46-86ed-e8b348017778",
                "response_url" => "https://queue.fal.run/fal-ai/luma-dream-machine/requests/464a10fc-A233-4c46-86ed-e8b348017778",
                "status_url" => "https://queue.fal.run/fal-ai/luma-dream-machine/requests/464a10fc-A233-4c46-86ed-e8b348017778/status",
                "cancel_url" => "https://queue.fal.run/fal-ai/luma-dream-machine/requests/464a10fc-A233-4c46-86ed-e8b348017778/cancel",
                "logs" => null,
                "metrics" => [],
                "queue_position" => 0
            ]
        ];
    }

    /**
     * Check the status of a text-to-video request.
     * 
     * Make a GET request to the API to retrieve the status of the request.
     * If the status is "IN_QUEUE" or "IN_PROGRESS", make the request again after a short delay.
     * When the status is no longer "IN_QUEUE" or "IN_PROGRESS", return the response.
     * 
     * @param string $id The ID of the text-to-video request.
     * 
     * @return mixed The response of the API request, which will contain the status of the request.
     */
    public function checkTextToVideoStatus(string $id): CheckVideoResponseContact 
    {
        $baseUrl = moduleConfig('falai.BASE_URL');
        $model =  data_get(request()->input('options'), 'model', 'kling-video-v1-pro');
        $provider = (new TextToVideoDataProcessor())->findProviderData(moduleConfig('falai.videomaker.providers'), $model);
        
        $statusUrl = "{$baseUrl}{$provider}/requests/{$id}/status";

        if (!$this->production) {
            return new CheckVideoResponse($this->dummyVideoStatus($id));
        }

        return new CheckVideoResponse($this->makeCurlRequest($statusUrl, "GET"));
    }

    private function dummyVideoStatus(string $id): array
    {
        $cacheKey   = "video_request:{$id}:started_at";
        $startedAt  = \Cache::get($cacheKey);

        if (!$startedAt) {
            // store a timestamp; keep it around > 5 minutes so subsequent polls see it
            \Cache::put($cacheKey, now(), now()->addMinutes(15));
        }

        // recompute after potential write
        $startedAt = $startedAt ?: now();

        // use seconds to avoid off-by-one minute issues
        $elapsedSeconds = now()->diffInSeconds($startedAt);
        $status = $elapsedSeconds >= 40 ? 'COMPLETED' : 'IN_QUEUE';
        
        return [
            "code" => 200,
            "body" => [
                "status" =>  $status,
                "request_id" => "464a10fc-a233-4c46-86ed-e8b348017778",
                "response_url" => "https://queue.fal.run/fal-ai/luma-dream-machine/requests/464a10fc-A233-4c46-86ed-e8b348017778",
                "status_url" => "https://queue.fal.run/fal-ai/luma-dream-machine/requests/464a10fc-A233-4c46-86ed-e8b348017778/status",
                "cancel_url" => "https://queue.fal.run/fal-ai/luma-dream-machine/requests/464a10fc-A233-4c46-86ed-e8b348017778/cancel",
                "logs" => null,
                "metrics" => [],
                "queue_position" => 0
            ]
        ];
    }

    /**
     * Retrieves the video of a text-to-video request.
     * 
     * Makes a GET request to the API to retrieve the video of the request.
     * The response will contain the video URL.
     * 
     * @param string $id The ID of the text-to-video request.
     * 
     * @return FetchVideoResponseContact The response of the API request, which will contain the video URL.
     */
    public function getTextToVideo(string $id): FetchVideoResponseContact
    {
        $baseUrl = moduleConfig('falai.BASE_URL');
        $model =  data_get(request()->input('options'), 'model', 'kling-video-v1-pro');
        $provider = (new TextToVideoDataProcessor())->findProviderData(moduleConfig('falai.videomaker.providers'), $model);
        $statusUrl = "{$baseUrl}{$provider}/requests/{$id}";

        if (!$this->production) {
            return new FetchVideoResponse($this->dummyVideo());
        }

        return new FetchVideoResponse($this->makeCurlRequest($statusUrl, "GET"));
    }

    private function dummyVideo(): array
    {
        return [
            "code" => 200,
            "body" => [
                "video" => [
                    "url" => "https://v3.fal.media//files//zebra//3moHcWtzafbm8EJpZJVxj_output.mp4",
                    "content_type" => "video\/mp4",
                    "file_name" => "output.mp4",
                    "file_size" => 3316102
                ],
                "url" => "https://v3.fal.media//files//zebra//3moHcWtzafbm8EJpZJVxj_output.mp4"
            ]
        ];
    }

    /**
     * Retrieves the validation rules for the current data processor.
     * 
     * @return array An array of validation rules.
     */
    public function textToVideoRules(): array
    {
        return (new TextToVideoDataProcessor)->rules();
    }

    # Image Start
    
    /**
     * Return the options for the image maker.
     * 
     * @return array Options for the image maker.
     */
    public function imageMakerOptions(): array
    {
        return (new ImageDataProcessor)->imageOptions();
    }
    
    /**
     * Retrieves the validation rules for the current data processor.
     * 
     * @return array An array of validation rules.
     */
    public function imageMakerRules(): array
    {
        return (new ImageDataProcessor)->rules();
    }

    /**
     * Generates an image using AI options.
     * 
     * Makes a POST request to the API to generate an image using the AI options.
     * The response will contain the image URL.
     * 
     * @param array $aiOptions An associative array of AI options to be used for image generation.
     * 
     * @return ImageResponseContract The generated image response.
     */
    public function generateImage(array $aiOptions): ImageResponseContract
    {
        $this->processedData = (new ImageDataProcessor($aiOptions))->imageData();
        $this->model = data_get($aiOptions['options'], 'model', 'flux-pro-new');

        $modelsWithTextToImageTag = ['flux-pro-kontext', 'flux-pro-kontext-max', 'flux-kontext-lora'];
        $provider = (new ImageDataProcessor())->findProviderData(moduleConfig('falai.imagemaker.providers'), $this->model, false);
        $service = data_get($aiOptions['options'], 'service', 'text-to-image');
        $route = moduleConfig('falai.BASE_URL') . $provider;

        if (!in_array($this->model, $modelsWithTextToImageTag) && $service == 'image-to-image' || (in_array($this->model, $modelsWithTextToImageTag) && $service == 'text-to-image')) {
           $route .= "/" . $service;
        }
        
        $result = $this->makeCurlRequest($route, "POST", json_encode($this->processedData));

        $result = $this->checkImageMakerStatus($result['body']['request_id'] ?? '9959cdf7-5939-4a44-8052-f0f3b94a16c3');
        return new ImageResponse($result);
    }

    /**
     * Check the status of an image generation request.
     * 
     * Makes repeated GET requests to the API to check the status of the image generation request.
     * If the status is "IN_QUEUE" or "IN_PROGRESS", the request is repeated after a short delay.
     * Once the status changes, retrieves the generated image.
     * 
     * @param string $id The ID of the image generation request.
     * 
     * @return mixed The generated image or related response data.
     */
    public function checkImageMakerStatus(string $id): mixed 
    {
        $baseUrl = moduleConfig('falai.BASE_URL');
        
        $provider = (new ImageDataProcessor())->findProviderData(moduleConfig('falai.imagemaker.providers'), $this->model);
        $statusUrl = "{$baseUrl}{$provider}/requests/{$id}/status";
       
        $result = $this->makeCurlRequest($statusUrl, "GET");

        while (isset($result['body']['status']) && ( $result['body']['status'] == 'IN_QUEUE' || $result['body']['status'] == 'IN_PROGRESS')) {
            sleep(1);
            $result = $this->makeCurlRequest($statusUrl, "GET");
        }

        return $this->getImage($id);
    }

    /**
     * Retrieves the generated image of an image generation request.
     * 
     * Makes a GET request to the API to retrieve the generated image of the request.
     * The response will contain the image URL.
     * 
     * @param string $id The ID of the image generation request.
     * 
     * @return mixed The response of the API request, which will contain the image URL.
     */
    public function getImage(string $id): mixed
    {
        $baseUrl = moduleConfig('falai.BASE_URL');
        $provider = (new ImageDataProcessor())->findProviderData(moduleConfig('falai.imagemaker.providers'), $this->model);
        $statusUrl = "{$baseUrl}{$provider}/requests/{$id}";

        return $this->makeCurlRequest($statusUrl, "GET");
    }
    # Image End

    # Image To Video Start

    /**
     * Return the options for the video maker.
     * 
     * @return array Options for the video maker.
     */
    public function videoMakerOptions(): array
    {
        return (new VideoDataProcessor())->videoOptions();
    }

    /**
     * Retrieves the validation rules for the current data processor.
     * 
     * @return array An array of validation rules.
     */
    public function videoMakerRules(): array
    {
        return (new VideoDataProcessor)->rules();
    }

    /**
     * Generates a video using AI options.
     * 
     * Makes a POST request to the API to generate a video using the AI options.
     * The response will contain the video URL.
     * 
     * @param array $aiOptions An associative array of AI options to be used for video generation.
     * 
     * @return VideoResponseContract The generated video response.
     */
    public function generateVideo(array $aiOptions): VideoResponseContract
    {
        $this->processedData = (new VideoDataProcessor($aiOptions))->generateVideo();
        $model = data_get($aiOptions['options'], 'model', 'kling-video-v1-pro');
        $provider = (new VideoDataProcessor())->findProviderData(moduleConfig('falai.videomaker.providers'), $model, false);
        $route = in_array($model, ['sora-2-pro']) ? moduleConfig('falai.BASE_URL') . $provider . '/image-to-video/pro' : moduleConfig('falai.BASE_URL') . $provider . '/image-to-video';

        if (!$this->production) {
            return new VideoResponse($this->dummyGenerateVideo());
        }
       
        return new VideoResponse($this->makeCurlRequest($route, "POST", json_encode($this->processedData)));
    }

    /**
     * Check the status of a text-to-video request.
     * 
     * Make a GET request to the API to retrieve the status of the request.
     * If the status is "IN_QUEUE" or "IN_PROGRESS", make the request again after a short delay.
     * When the status is no longer "IN_QUEUE" or "IN_PROGRESS", return the response.
     * 
     * @param string $id The ID of the text-to-video request.
     * 
     * @return mixed The response of the API request, which will contain the status of the request.
     */
    public function checkImageToVideoStatus(string $id): CheckImageToVideoResponseContact 
    {
        $baseUrl = moduleConfig('falai.BASE_URL');
        $model =  data_get(request()->input('options'), 'model', 'kling-video-v1-pro');
        $provider = (new VideoDataProcessor())->findProviderData(moduleConfig('falai.videomaker.providers'), $model);
        
        $statusUrl = "{$baseUrl}{$provider}/requests/{$id}/status";

        if (!$this->production) {
            return new CheckImageToVideoResponse($this->dummyVideoStatus($id));
        }
        return new CheckImageToVideoResponse($this->makeCurlRequest($statusUrl, "GET"));
    }

    /**
     * Retrieves the video of an image-to-video request.
     * 
     * @param string $id The ID of the image-to-video request.
     * 
     * @return FetchImageToVideoResponseContract The response of the API request, which will contain the video URL.
     */
    public function getVideo($id): FetchImageToVideoResponseContract
    {
        $baseUrl = moduleConfig('falai.BASE_URL');
        $model =  data_get(request()->input('options'), 'model', 'kling-video-v1-pro');

        $provider = (new VideoDataProcessor())->findProviderData(moduleConfig('falai.videomaker.providers'), $model);
        $statusUrl = "{$baseUrl}{$provider}/requests/{$id}";

        if (!$this->production) {
            return new FetchImageToVideoResponse($this->dummyVideo());
        }

        return new FetchImageToVideoResponse($this->makeCurlRequest($statusUrl, "GET"));
    }

    /**
     * Retrieve the validation rules for the current data processor.
     * 
     * @param string $processor The name of the data processor class.
     * 
     * @return array An array of validation rules.
     */
    public function videoValidationRules(string $processor): array
    {
        $processorClass = "Modules\\FalAi\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->videoValidationRules();
        }

        return [];
    }

    # Image To Video End
}
