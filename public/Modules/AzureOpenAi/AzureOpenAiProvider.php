<?php

namespace Modules\AzureOpenAi;

use App\Lib\AiProvider;
use Modules\AzureOpenAi\Traits\AzureOpenAiApiTrait;

use Modules\OpenAI\Contracts\Resources\TemplateContentContract;
use Modules\OpenAI\Contracts\Resources\CodeContract;
use Modules\OpenAI\Contracts\Resources\LongArticleContract;
use Modules\OpenAI\Contracts\Resources\ImageMakerContract;
use Modules\OpenAI\Contracts\Resources\AiEmbeddingContract;
use Modules\OpenAI\Contracts\Resources\ChatbotContract;
use Modules\OpenAI\Contracts\Resources\AiChatContract;
use Modules\OpenAI\Contracts\Resources\VisionChatContract;
use Modules\OpenAI\Contracts\Resources\VoiceoverContract;
use Modules\OpenAI\Contracts\Resources\SpeechToTextContract;

use Modules\AzureOpenAi\Resources\TemplateDataProcessor;
use Modules\AzureOpenAi\Resources\CodeDataProcessor;
use Modules\AzureOpenAi\Resources\LongArticleDataProcessor;
use Modules\AzureOpenAi\Resources\ImageDataProcessor;
use Modules\AzureOpenAi\Resources\AiEmbeddingDataProcessor;
use Modules\AzureOpenAi\Resources\ChatbotDataProcessor;
use Modules\AzureOpenAi\Resources\AiChatDataProcessor;
use Modules\AzureOpenAi\Resources\AiDocChatDataProcessor;
use Modules\AzureOpenAi\Resources\VisionChatDataProcessor;
use Modules\AzureOpenAi\Resources\VoiceoverDataProcessor;
use Modules\AzureOpenAi\Resources\SpeechToTextDataProcessor;

use Modules\OpenAI\Contracts\Responses\LongArticle\TitleResponseContract;
use Modules\OpenAI\Contracts\Responses\LongArticle\OutlineResponseContract;
use Modules\OpenAI\Contracts\Responses\AiEmbedding\AiEmbeddingResponseContract;
use Modules\OpenAI\Contracts\Responses\AiChat\AiChatResponseContract;
use Modules\OpenAI\Contracts\Responses\ImageResponseContract;
use Modules\OpenAI\Contracts\Resources\AiDocChatContract;
use Modules\OpenAI\Contracts\Responses\VisionChat\VisionChatResponseContract;
use Modules\OpenAI\Contracts\Responses\Voiceover\VoiceoverResponseContract;
use Modules\OpenAI\Contracts\Responses\Code\CodeResponseContract;
use Modules\OpenAI\Contracts\Responses\SpeechToText\SpeechResponseContract;

use Modules\AzureOpenAi\Responses\Code\CodeResponse;
use Modules\AzureOpenAi\Responses\Image\ImageResponse;
use Modules\AzureOpenAi\Responses\AiEmbedding\EmbeddingResponse;
use Modules\AzureOpenAi\Responses\AiChat\AiChatResponse;
use Modules\AzureOpenAi\Responses\Chat\ChatResponse;
use Modules\AzureOpenAi\Responses\AiDocChat\AskQuestionResponse;
use Modules\AzureOpenAi\Responses\VisionChat\ChatResponse as VisionChatResponse;
use Modules\AzureOpenAi\Responses\SpeechToText\SpeechToTextResponse;
use Modules\AzureOpenAi\Responses\Voiceover\VoiceoverResponse;
use Modules\AzureOpenAi\Responses\LongArticle\{
    OutlineResponse,
    TitleResponse
};

class AzureOpenAiProvider extends AiProvider implements TemplateContentContract, CodeContract, LongArticleContract, ImageMakerContract, AiEmbeddingContract, ChatbotContract, AiChatContract, AiDocChatContract, VisionChatContract, VoiceoverContract, SpeechToTextContract
{
    use AzureOpenAiApiTrait;

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
            'title' => 'Azure OpenAI',
            'description' => __(':x delivers advanced AI for chat, content generation, and language processing. Powered by OpenAI models like GPT-4, it enables secure, scalable, and intelligent applications across industries, driving innovation in natural language understanding and enterprise AI solutions.', ['x' => 'Azure OpenAI']),
            'image' => 'Modules/AzureOpenAi/Resources/assets/image/azureopenai.png',
        ];
    }

    # Template Start

    /**
     * Generates template options by calling the templateOptions method of the TemplateDataProcessor class.
     *
     * @return array The array of code options.
     */
    public function templatecontentOptions(): array
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
    public function templateGenerate(array $aiOptions)
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
        if (isset($streamResponse['choices'][0]['delta']['content'])) {
            return $streamResponse['choices'][0]['delta']['content'];
        }
        return "";
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
        $processorClass = "Modules\\AzureOpenAi\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->validationRules();
        }

        return [];
    }
    # Template End

    # Code Start
    /**
     * Generates a CodeResponseContract object by processing the given $aiOptions using the CodeDataProcessor class.
     *
     * @param array $aiOptions The options for AI processing.
     * @return CodeResponseContract The generated CodeResponseContract object.
     */
    public function code(array $aiOptions): CodeResponseContract
    {
        $this->processedData = (new CodeDataProcessor($aiOptions))->code();
        return new CodeResponse($this->chat()->toArray());
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
    # Code End

    # Long Article Start
    public function longArticleOptions(): array
    {
        return (new LongArticleDataProcessor)->longarticleOptions();
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
        return new TitleResponse($this->chat());
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
        return new OutlineResponse($this->chat());

    }

    public function article(array $aiOptions)
    {
        $this->processedData = (new LongArticleDataProcessor($aiOptions))->articleOptions();
        return $this->chatStream();
    }

    public function streamData(object|array $streamResponse): ?string
    {
        if (isset($streamResponse['choices'][0]['delta']['content'])) {
            return $streamResponse['choices'][0]['delta']['content'];
        }
        return "";
    }
    # Long Article End

    # Image Start
    public function imageMakerOptions(): array
    {
        return (new ImageDataProcessor)->imageOptions();
    }
    
    public function imageMakerRules(): array
    {
        return (new ImageDataProcessor)->rules();
    }

    public function generateImage(array $aiOptions): ImageResponseContract
    {
        $this->processedData = (new ImageDataProcessor($aiOptions))->imageData();
        return new ImageResponse($this->images());
    }
    # Image End

    # Embedding Start
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
        return new EmbeddingResponse($this->embeddings());
    }
    # Embedding END

    # Chatbot Start
    public function chatbotOptions(): array
    {
        return (new ChatbotDataProcessor())->chatbotOptions();
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
        return new ChatResponse($this->chat());
    }
    # Chatbot End

    # Ai Chat Start
    /**
     * Retrieves the character chatbot options by instantiating a AiChatDataProcessor
     * and calling the AiChatOptions method.
     *
     * @return array An array of character chatbot options.
     */
    public function aiChatOptions(): array
    {
        return (new AiChatDataProcessor)->aiChatOptions();
    }

    /**
     * Generates a character chatbot chat using the provided AI options.
     *
     * @param array $aiOptions Options for AI processing.
     * @return AiChatResponse Response containing the chatbot chat.
     */
    public function aiChat(array $aiOptions): AiChatResponseContract
    {
        $this->processedData = (new AiChatDataProcessor($aiOptions))->aiChatDataOptions();
        return new AiChatResponse($this->chat());
    }
    #  Ai Chat End

    # Ai Doc Chat Start

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
        return new AskQuestionResponse($this->chat());
    }

    # Ai Doc Chat End

    # Vision Chat Start

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
        return new VisionChatResponse($this->chat());
    }

    # Vision Chat End

    # Voiceover Start
    public function voiceoverOptions(): array
    {
        return (new VoiceoverDataProcessor)->voiceoverOptions();
    }

    public function generateSpeech(array $aiOptions): VoiceoverResponseContract
    {
        $speechData = $aiOptions;
        unset($speechData['data']['additionalData']);

        $audio = "";
        foreach ($aiOptions['data']['additionalData'] as $key => $data) {
            
            $processData = (new VoiceoverDataProcessor)->prepareVoiceoverData($speechData['data'], $data, $key);

            $this->processedData = (new VoiceoverDataProcessor($processData))->speechOptions();
            $result = $this->speech();

            $audio .= base64_encode($result);
        }

        $audioPath = (new VoiceoverDataProcessor())->prepareFile($audio, $speechData['data']['target_format']);

        $newArray = [
            'audioPath' => $audioPath,
            'processData' => $processData
        ];
        return new VoiceoverResponse($newArray);
    }

    public function processOptionsData(array $content)
    {
        return (new VoiceoverDataProcessor)->processOptionsData($content);
    }
    # Voiceover End

    # Speech To Text Start
    public function speechToTextOptions(): array
    {
       return (new SpeechToTextDataProcessor)->speechToTextOptions();
    }

    /**
     * Generates titles using AI options.
     *
     */
    public function speechToText(array $aiOptions)
    {
        $this->processedData = (new SpeechToTextDataProcessor($aiOptions))->audioDataOptions();

        $filePath = (new SpeechToTextDataProcessor())->prepareFile($this->processedData['file']);
        $fullPath = public_path( 'uploads/aiAudios/' . $filePath);
        $resources = fopen($fullPath, 'r');
        $this->processedData['file'] = $resources;

        $response = $this->audio();
        unlink($fullPath);

        return new SpeechToTextResponse($response, $aiOptions['duration']);
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
        $processorClass = "Modules\\AzureOpenAi\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->customerValidationRules();
        }

        return [];
    }
    # Speech To Text End
}
