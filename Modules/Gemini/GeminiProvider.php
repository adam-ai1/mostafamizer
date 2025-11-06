<?php

namespace Modules\Gemini;

use App\Lib\AiProvider;
use Modules\Gemini\Traits\GeminiApiTrait;

use Modules\OpenAI\Contracts\Resources\AiChatContract;
use Modules\Gemini\Resources\AiChatDataProcessor;
use Modules\Gemini\Responses\AiChat\AiChatResponse;
use Modules\OpenAI\Contracts\Resources\CodeContract;
use Modules\OpenAI\Contracts\Responses\Code\CodeResponseContract;
use Modules\Gemini\Resources\CodeDataProcessor;
use Modules\Gemini\Responses\Code\CodeResponse;

use Modules\Gemini\Resources\TemplateDataProcessor;

use Modules\OpenAI\Contracts\Resources\LongArticleContract;
use Modules\Gemini\Responses\LongArticle\StreamResponse;
use Modules\Gemini\Resources\LongArticleDataProcessor;
use Modules\Gemini\Responses\LongArticle\{
    OutlineResponse,
    TitleResponse
};
use Modules\OpenAI\Contracts\Responses\LongArticle\{
    OutlineResponseContract,
    TitleResponseContract
};

use Modules\OpenAI\Contracts\Resources\TemplateContentContract;

use Modules\OpenAI\Contracts\Resources\SpeechToTextContract;
use Modules\Gemini\Resources\SpeechToTextDataProcessor;
use Modules\Gemini\Responses\SpeechToText\SpeechToTextResponse;
use Modules\Gemini\Resources\AiEmbeddingDataProcessor;
use Modules\Gemini\Responses\AiEmbedding\EmbeddingResponse;
use Modules\OpenAI\Contracts\Resources\AiEmbeddingContract;
use Modules\OpenAI\Contracts\Responses\AiEmbedding\AiEmbeddingResponseContract;

use Modules\Gemini\Responses\Chat\ChatResponse;
use Modules\Gemini\Resources\ChatbotDataProcessor;
use Modules\OpenAI\Contracts\Resources\ChatbotContract;

use Modules\Gemini\Resources\VisionChatDataProcessor;
use Modules\OpenAI\Contracts\Resources\VisionChatContract;
use Modules\Gemini\Responses\VisionChat\ChatResponse as VisionChatResponse;

use Modules\OpenAI\Contracts\Responses\VisionChat\VisionChatResponseContract;

use Modules\Gemini\Resources\AiDocChatDataProcessor;
use Modules\OpenAI\Contracts\Resources\AiDocChatContract;
use Modules\Gemini\Responses\AiDocChat\AskQuestionResponse;

use Modules\OpenAI\Contracts\Resources\ImageMakerContract;
use Modules\Gemini\Resources\ImageDataProcessor;
use Modules\OpenAI\Contracts\Responses\ImageResponseContract;
use Modules\Gemini\Responses\Image\ImageResponse;
use Modules\Gemini\Responses\Image\ImagenResponse;

use Modules\Gemini\Resources\TextToVideoDataProcessor;
use Modules\OpenAI\Contracts\Resources\TextToVideoContract;
use Modules\OpenAI\Contracts\Responses\TextToVideo\TextToVideoResponseContract;
use Modules\OpenAI\Contracts\Responses\TextToVideo\FetchVideoResponseContact;
use Modules\Gemini\Responses\TextToVideo\TextToVideoResponse;
use Modules\Gemini\Responses\TextToVideo\FetchVideoResponse;

use Modules\Gemini\Resources\VideoDataProcessor;
use Modules\Gemini\Responses\Video\VideoResponse;
use Modules\OpenAI\Contracts\Resources\VideoMakerContract;
use Modules\OpenAI\Contracts\Responses\Video\VideoResponseContract;
use Modules\OpenAI\Contracts\Responses\Video\FetchVideoResponseContract as FetchImageToVideoResponseContract;
use Modules\Gemini\Responses\Video\FetchVideoResponse as FetchImageToVideoResponse;

use Modules\OpenAI\Contracts\Resources\VoiceoverContract;
use Modules\Gemini\Resources\VoiceoverDataProcessor;
use Modules\OpenAI\Contracts\Responses\Voiceover\VoiceoverResponseContract;
use Modules\Gemini\Responses\Voiceover\VoiceoverResponse;

use Modules\Gemini\Responses\TextToVideo\CheckVideoResponse;
use Modules\OpenAI\Contracts\Responses\TextToVideo\CheckVideoResponseContact;

use Modules\Gemini\Responses\Video\CheckVideoResponse as CheckImageToVideoResponse;
use Modules\OpenAI\Contracts\Responses\Video\CheckVideoResponseContact as CheckImageToVideoResponseContact;

class GeminiProvider extends AiProvider implements AiEmbeddingContract, ChatbotContract, VisionChatContract, SpeechToTextContract, TemplateContentContract, AiDocChatContract, LongArticleContract, CodeContract, AiChatContract, ImageMakerContract, TextToVideoContract, VideoMakerContract, VoiceoverContract
{
    use GeminiApiTrait;

    /**
     * Holds the processed data after it has been manipulated or transformed.
     * This property is typically used within the context of a class to store
     * data that has been modified or processed in some way.
     *
     * @var array Contains an array of data resulting from processing operations.
     */
    protected $processedData;

    /**
     * Returns an array containing the title, description, and image of the provider.
     *
     * @return array
     */
    public function description(): array
    {
        return [
            'title' => 'Gemini',
            'description' => __(':x leads the way in AI innovations for chat and text processing. Utilizing cutting-edge models, we excel in natural language understanding, contributing to the future of AI development.', ['x' => 'Gemini']),
            'image' => 'Modules/Gemini/Resources/assets/image/gemini.jpg',
        ];
    }

    /**
     * Retrieves the character chatbot options by instantiating a AiChatDataProcessor
     * and calling the characterChatbotOptions method.
     *
     * @return array An array of character chatbot options.
     */
    public function AiChatOptions(): array
    {
        return (new AiChatDataProcessor)->aiChatOptions();
    }

    /**
     * Generates a character chatbot chat using the provided AI options.
     *
     * @param array $aiOptions Options for AI processing.
     * @return AiChatResponse Response containing the chatbot chat.
     */
    public function aiChat(array $aiOptions): AiChatResponse
    {
        $this->processedData = (new AiChatDataProcessor($aiOptions))->aiChatDataOptions();
        $model = data_get($aiOptions, 'model', 'gemini-1.5-pro');
        return new AiChatResponse($this->chat($model));
    }

    /**
     * Retrieves a dummy chat response for the character chatbot.
     *
     * @return AiChatResponse Response object containing the dummy chat response.
     */
    public function dummyChat(): AiChatResponse
    {
        $fakeResponse = json_decode('{"candidates":[{"content":{"parts":[{"text":"How can I help you today? \n"}],"role":"model"},"finishReason":"STOP","index":0,"safetyRatings":[{"category":"HARM_CATEGORY_SEXUALLY_EXPLICIT","probability":"LOW"},{"category":"HARM_CATEGORY_HATE_SPEECH","probability":"NEGLIGIBLE"},{"category":"HARM_CATEGORY_HARASSMENT","probability":"NEGLIGIBLE"},{"category":"HARM_CATEGORY_DANGEROUS_CONTENT","probability":"NEGLIGIBLE"}]}],"usageMetadata":{"promptTokenCount":174,"candidatesTokenCount":23,"totalTokenCount":197}}', true);
        return new AiChatResponse($fakeResponse);
    }

    /**
     * Generates a CodeResponseContract object by processing the given $aiOptions using the CodeDataProcessor class.
     *
     * @param array $aiOptions The options for AI processing.
     *
     * @return CodeResponseContract The generated CodeResponseContract object.
     */
    public function code(array $aiOptions): CodeResponseContract
    {
        $this->processedData = (new CodeDataProcessor($aiOptions))->code();
        $model = data_get($aiOptions, 'model', 'gemini-1.5-pro');
        return new CodeResponse($this->chat($model));
    }

    /**
     * Generates code options by calling the codeOptions method of the CodeDataProcessor class.
     *
     * @return array The array of code options.
     */
    public function codeOptions(): array
    {
        return (new CodeDataProcessor)->codeOptions();
    }

    public function longArticleOptions(): array
    {
        return (new LongArticleDataProcessor)->longarticleOptions();
    }

    public function speechToTextOptions(): array
    {
       return (new SpeechToTextDataProcessor)->speechToTextOptions();
    }

    /**
     * Generates titles using AI options.
     *
     * @param array $aiOptions Options for AI processing.
     * @return TitleResponseContract Response containing generated titles.
     */
    public function titles(array $aiOptions): TitleResponseContract
    {
        $this->processedData = (new LongArticleDataProcessor($aiOptions))->titleOptions();
        $model = data_get($aiOptions, 'options.model', 'gemini-1.5-pro');
        return new TitleResponse($this->chat($model));
    }

    /**
     * Generates outlines using AI options.
     *
     * @param array $aiOptions Options for AI processing.
     * @return OutlineResponseContract Response containing generated titles.
     */
    public function outlines(array $aiOptions): OutlineResponseContract
    {
        $this->processedData = (new LongArticleDataProcessor($aiOptions))->outlineOptions();
        return new OutlineResponse($this->outlineChat($aiOptions));
    }

    public function fakeTitles(array $aiOptions): TitleResponseContract
    {
        $fakeResponse = json_decode('{"response":{"id":"msg_017fk76mgw1fnTEbT5J6KGoJ","type":"message","role":"assistant","content":[{"type":"text","text":"[\"Unveiling the Benefits: How AI Technology is Shaping Our Future\"]"}],"model":"claude-3-opus-20240229","stop_reason":"end_turn","stop_sequence":null,"usage":{"input_tokens":66,"output_tokens":20}}}', true);
        return new TitleResponse( $fakeResponse['response']);
    }

    public function fakeOutlines(array $aiOptions): OutlineResponseContract
    {
        $fakeResponse = json_decode('{"response":{"id":"msg_01DUcMikFXqTdc1fxWS2gabN","type":"message","role":"assistant","content":[{"type":"text","text":"[\n\"Unleashing AI Superpowers: Exploring the Future of AI Technology\",\n\"Unlocking the Potential: AI Integration Services for the Future of AI\",\n\"Intelligent Automation and Machine Learning on Demand: Powering the Future of AI\",\n\"The Future of AI: OpenAI Envisions On-Demand AI Superpowers\"\n]"}],"model":"claude-3-opus-20240229","stop_reason":"end_turn","stop_sequence":null,"usage":{"input_tokens":98,"output_tokens":133}}}', true);
        return new OutlineResponse($fakeResponse['response']);
    }

    public function article(array $aiOptions)
    {
        $this->processedData = (new LongArticleDataProcessor($aiOptions))->articleOptions();
        return $this->chatStream();
    }

    public function streamData(array|object $streamResponse): string
    {
        if (isset($streamResponse['candidates'][0]['content']['parts'][0]['text'])) {
            return ($streamResponse['candidates'][0]['content']['parts'][0]['text']);
        }
        return "";
    }

    public function speechToText(array $aiOptions)
    {
        $this->processedData = (new SpeechToTextDataProcessor($aiOptions))->audioDataOptions();
        $model = data_get($aiOptions, 'model', 'gemini-1.5-pro');
        $duration = $this->processedData['duration'];
        unset($this->processedData['duration']);
        return new SpeechToTextResponse($this->audio($model), $duration);
    }

    /**
     * Generates template options by calling the templateOptions method of the TemplateDataProcessor class.
     *
     * @return array The array of code options.
     */
    public function templateContentOptions(): array
    {
        return (new TemplateDataProcessor)->templateContentOptions();
    }

    /**
     * Generates a template using the provided AI options.
     *
     * This method processes the given AI options through the TemplateDataProcessor
     * to generate the necessary template data. After processing, it initiates 
     * a chat stream.
     *
     * @param array $aiOptions An associative array of AI options to be used for template generation.
     * @return mixed The result of the chat stream.
     */
    public function templateGenerate(array $aiOptions): mixed
    {
        $this->processedData = (new TemplateDataProcessor($aiOptions))->template();
        return $this->chatStream();
    }

    /**
     * Processes the stream response to extract the template content.
     *
     *
     * @param mixed $streamResponse The stream response object containing choices.
     * @return string|null The extracted content from the stream response, or null if not available.
     */
    public function templateStreamData($streamResponse): string
    {
        if (isset($streamResponse['candidates'][0]['content']['parts'][0]['text'])) {
            return ($streamResponse['candidates'][0]['content']['parts'][0]['text']);
        }
        return "";
    }

    /**
     * Retrieves AI embedding options.
     *
     * @return array An array of AI embedding options.
     */
    public function aiEmbeddingOptions(): array
    {
        return (new AiEmbeddingDataProcessor)->aiEmbeddingOptions();
    }

    /**
     * Creates embeddings using the provided AI options.
     *
     * @param array $aiOptions Options for AI processing.
     * 
     * @return AiEmbeddingResponseContract  Response containing created embeddings.
     */
    public function createEmbeddings(array $aiOptions): AiEmbeddingResponseContract
    {
        $this->processedData = (new AiEmbeddingDataProcessor($aiOptions))->aiEmbeddingDataOptions();
        $model = data_get($aiOptions, 'model', 'text-embedding-004');
        return new EmbeddingResponse($this->embeddings($model), $this->processedData);
    }

    /**
     * Retrieves AI Doc Chat options.
     *
     * @return array Options for AI Doc Chat processing.
     */
    public function chatbotOptions(): array
    {
        return (new ChatbotDataProcessor)->chatbotOptions();
    }

    /**
     * Ask a question to the content based on the provided AI options.
     *
     * This method uses the ChatbotDataProcessor to process the AI options and ask a question to the content,
     * assigns the result to the processedData property, and returns a ChatResponse instance.
     *
     * @param array $aiOptions The AI options for asking a question to the content.
     * @return ChatResponse The chat response after processing the question.
     */
    public function askQuestionToContent(array $aiOptions): ChatResponse
    {
        $this->processedData = (new ChatbotDataProcessor($aiOptions))->askQuestionDataOptions();
        $model = data_get($aiOptions, 'model', 'gemini-1.5-pro');
        return new ChatResponse($this->chat($model));
    }
    
    /** Generates template options by calling the templateOptions method of the TemplateDataProcessor class.
     * Returns an array of options for the vision chat feature.
     *
     * @return array An array of options for the vision chat feature.
     */
    public function visionChatOptions(): array
    {
        return (new VisionChatDataProcessor)->visionChatOptions();
    }

    /**
     * Initiates a vision chat using the provided AI options.
     *
     *
     * @param array $aiOptions An associative array of AI options to be used for vision chat.
     * @return VisionChatResponseContract The result of the chat.
     */
    public function visionChat(array $aiOptions): VisionChatResponseContract 
    {
        $this->processedData = (new VisionChatDataProcessor($aiOptions))->visionOptions();
        $model = data_get($this->processedData, 'model', 'gemini-1.5-pro');
        return new VisionChatResponse($this->chat($model));
    }

    /**
     * Retrieves AI Doc Chat options.
     *
     * @return array Options for AI Doc Chat processing.
     */
    public function aiDocChatOptions(): array
    {
        return (new AiDocChatDataProcessor)->aiDocChatOptions();
    }

    /**
     * Method to ask a question using the provided AI options.
     *
     * @param array $aiOptions Options for AI processing.
     * @return AskQuestionResponse Response containing the asked question.
     */
    public function askQuestion(array $aiOptions): AskQuestionResponse
    {
        $this->processedData = (new AiDocChatDataProcessor($aiOptions))->askQuestionOptions();
        $model = data_get($aiOptions, 'chat_model', 'gemini-1.5-pro');
        return new AskQuestionResponse($this->chat($model));
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
        $processorClass = "Modules\\Gemini\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->validationRules();
        }

        return [];
    }

    /**
     * Return the options for the image maker.
     *
     * @return array Options for the image maker.
     */
    public function imageMakerOptions(): array
    {
        return (new ImageDataProcessor())->imageOptions();
    }

    /**
     * Retrieve the validation rules for the current data processor.
     *
     * @return array An array of validation rules.
     */
    public function imageMakerRules(): array
    {
        return (new ImageDataProcessor)->rules();
    }

    /**
     * Generate an image using AI options.
     *
     * @param array $aiOptions An associative array of AI options to be used for image generation.
     * @return ImageResponseContract The generated image response.
     */
    public function generateImage(array $aiOptions): ImageResponseContract
    {
        $this->processedData = (new ImageDataProcessor($aiOptions))->imageData();
        $model = data_get($this->processedData, 'model', 'imagen-3.0-generate-002');

        if (in_array($model, moduleConfig('gemini.image_models.imagen'))) {
            return new ImagenResponse($this->images($model));
        }
        return new ImageResponse($this->images($model));
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
        $processorClass = "Modules\\Gemini\\Resources\\" . $processor;

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
        $model = data_get($aiOptions['options'], 'model', 'veo-2.0-generate-001');
        $route = moduleConfig('gemini.base_url') . "models/" . $model . ":predictLongRunning?key=" . $this->aiKey();
        return new TextToVideoResponse($this->makeCurlRequest($route, "POST", json_encode($this->processedData),['Content-Type' => 'application/json']));
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
        $baseUrl = moduleConfig('gemini.base_url');
        $statusUrl = "{$baseUrl}{$id}?key=" . $this->aiKey();

        return new CheckVideoResponse($this->makeCurlRequest($statusUrl, "GET"));
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
        $baseUrl = moduleConfig('gemini.base_url');
        $statusUrl = "{$baseUrl}{$id}?key=" . $this->aiKey();

        $result = $this->makeCurlRequest($statusUrl, "GET");
        
        $response = $result['body']['response']['generateVideoResponse'] ?? null;

        if (!$response) {
            throw new \Exception(__("Video generation failed: No response received."));
        }

        if (!empty($response['raiMediaFilteredReasons'])) {
            $reason = $response['raiMediaFilteredReasons'][0] ?? __('Unknown reason');
            throw new \Exception(__("Video generation failed: ") . $reason);
        }

        $samples = $response['generatedSamples'] ?? [];
        $videoDataArray = [];

        foreach ($samples as $sample) {
            $uri = $sample['video']['uri'] ?? null;
            if ($uri) {
                $downloadUrl = "{$uri}&key=" . $this->aiKey();
                $videoData = $this->makeCurlRequest($downloadUrl, "GET", null, ['Content-Type' => 'video/mp4'], true);
                if ($videoData) {
                    $videoDataArray[] = $videoData;
                }
            }
        }

        return new FetchVideoResponse($videoDataArray);

    }

    public function textToVideoRules(): array
    {
        return (new TextToVideoDataProcessor)->rules();
    }

    public function videoMakerOptions(): array
    {
        return (new VideoDataProcessor())->videoOptions();
    }

    public function videoMakerRules(): array
    {
        return (new VideoDataProcessor)->rules();
    }

    /**
     * Generates a CodeResponseContract object by processing the given $aiOptions using the CodeDataProcessor class.
     *
     * @param array $aiOptions The options for AI processing.
     * @return CodeResponseContract The generated CodeResponseContract object.
     */
    public function generateVideo(array $aiOptions): VideoResponseContract
    {
        $this->processedData = (new VideoDataProcessor($aiOptions))->generateVideo();
        $model = data_get($aiOptions['options'], 'model', 'veo-2.0-generate-001');
        $route = moduleConfig('gemini.base_url') . "models/" . $model .":predictLongRunning?key=" . $this->aiKey();
        return new VideoResponse($this->makeCurlRequest($route, "POST", json_encode($this->processedData), ['Content-Type' => 'application/json']));
    }

    public function checkImageToVideoStatus(string $id): CheckImageToVideoResponseContact 
    {
        $baseUrl = moduleConfig('gemini.base_url');
        $statusUrl = "{$baseUrl}{$id}?key=" . $this->aiKey();

        return new CheckImageToVideoResponse($this->makeCurlRequest($statusUrl, "GET"));
    }

    public function getVideo(string $id): FetchImageToVideoResponseContract
    {
        $baseUrl = moduleConfig('gemini.base_url');
        $statusUrl = "{$baseUrl}{$id}?key=" . $this->aiKey();

        $result = $this->makeCurlRequest($statusUrl, "GET");
        
        $response = $result['body']['response']['generateVideoResponse'] ?? null;

        if (!$response) {
            throw new \Exception(__("Video generation failed: No response received."));
        }

        if (!empty($response['raiMediaFilteredReasons'])) {
            $reason = $response['raiMediaFilteredReasons'][0] ?? __('Unknown reason');
            throw new \Exception(__("Video generation failed: ") . $reason);
        }

        $samples = $response['generatedSamples'] ?? [];
        $videoDataArray = [];

        foreach ($samples as $sample) {
            $uri = $sample['video']['uri'] ?? null;
            if ($uri) {
                $downloadUrl = "{$uri}&key=" . $this->aiKey();
                $videoData = $this->makeCurlRequest($downloadUrl, "GET", null, ['Content-Type' => 'video/mp4'], true);
                if ($videoData) {
                    $videoDataArray[] = $videoData;
                }
            }
        }

        return new FetchImageToVideoResponse($videoDataArray);
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
        $processorClass = "Modules\\Gemini\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->videoValidationRules();
        }

        return [];
    }

    /**
     * Provides the options for the voiceover feature.
     *
     * @return array The options for the voiceover feature.
     */
    public function voiceoverOptions(): array
    {
        return (new VoiceoverDataProcessor)->voiceoverOptions();
    }

    /**
     * Generates speech audio based on the provided AI options.
     *
     * @param array $aiOptions The options for generating speech, including data 
     *                         and additional configurations.
     *
     * @return VoiceoverResponseContract The response containing the path to the 
     *                                   generated audio file and processed data.
     *
     * @throws \Exception If an error occurs during speech generation.
     */

    public function generateSpeech(array $aiOptions): VoiceoverResponseContract
    {
        $processor = new VoiceoverDataProcessor();

        $processData = $processor->prepareVoiceoverData($aiOptions);
        $this->processedData = $processor->speechOptions($aiOptions);

        $modelConfig = moduleConfig('openai.voiceover.gemini.model');
        $model = array_flip($modelConfig)[$aiOptions['data']['model']] ?? 'gemini-2.5-flash-preview-tts';

        if (! $model) {
            throw new \Exception( __("Invalid :x TTS model provided.", ['x' => 'Gemini']) );
        }

        $route = moduleConfig('gemini.base_url') . "models/" . $model .":generateContent?key=" . $this->aiKey();

        $responseData = $this->makeCurlRequest($route, "POST", json_encode($this->processedData), ['Content-Type' => 'application/json']);

        if (($responseData['code'] ?? 500) !== 200) {
            $message = $responseData['body']['error']['message'] ?? __('Unknown error from :x TTS API', ['x' => 'Gemini']);
            throw new \Exception($message);
        }
        
        $audioData = $responseData['body']['candidates'][0]['content']['parts'][0]['inlineData']['data'] ?? null;

        if (! $audioData) {
            throw new \Exception( __("No audio data received from :x TTS.", ['x' => 'Gemini']) );
        }

        $audioPath = $processor->prepareFile($audioData, $aiOptions['data']['target_format'] ?? 'WAV');

        return new VoiceoverResponse([
            'audioPath'   => $audioPath,
            'processData' => $processData,
        ]);

    }

    /**
     * Process options data
     *
     * @param array $content
     * @return array
     */
    public function processOptionsData(array $content)
    {
        return (new VoiceoverDataProcessor)->processOptionsData($content);
    }

}
