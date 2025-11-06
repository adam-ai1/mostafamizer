<?php

namespace Modules\Grok;

use App\Lib\AiProvider;
use Modules\Grok\Traits\GrokApiTrait;

use Modules\Grok\Resources\TemplateDataProcessor;
use Modules\OpenAI\Contracts\Resources\TemplateContentContract;

use Modules\Grok\Resources\CodeDataProcessor;
use Modules\Grok\Responses\Code\CodeResponse;
use Modules\OpenAI\Contracts\Resources\CodeContract;
use Modules\OpenAI\Contracts\Responses\Code\CodeResponseContract;

use Modules\Grok\Resources\LongArticleDataProcessor;
use Modules\Grok\Responses\LongArticle\StreamResponse;
use Modules\OpenAI\Contracts\Resources\LongArticleContract;

use Modules\Grok\Responses\LongArticle\{
    OutlineResponse,
    TitleResponse
};
use Modules\OpenAI\Contracts\Responses\LongArticle\{
    OutlineResponseContract,
    TitleResponseContract
};

use Modules\Grok\Resources\AiChatDataProcessor;
use Modules\Grok\Responses\AiChat\AiChatResponse;
use Modules\OpenAI\Contracts\Resources\AiChatContract;
use Modules\OpenAI\Contracts\Responses\AiChat\AiChatResponseContract;

use Modules\Grok\Resources\AiDocChatDataProcessor;
use Modules\OpenAI\Contracts\Resources\AiDocChatContract;
use Modules\Grok\Responses\AiDocChat\AskQuestionResponse;
use Modules\OpenAI\Contracts\Responses\AiDocChat\AskQuestionResponseContract;

use Modules\Grok\Resources\VisionChatDataProcessor;
use Modules\OpenAI\Contracts\Resources\VisionChatContract;
use Modules\Grok\Responses\VisionChat\ChatResponse as VisionChatResponse;
use Modules\OpenAI\Contracts\Responses\VisionChat\VisionChatResponseContract;

use Modules\Grok\Responses\Chat\ChatResponse;
use Modules\Grok\Resources\ChatbotDataProcessor;
use Modules\OpenAI\Contracts\Resources\ChatbotContract;
use Modules\OpenAI\Contracts\Responses\Chat\ChatResponseContract;

use Modules\Grok\Resources\ImageDataProcessor;
use Modules\Grok\Responses\Image\ImageResponse;
use Modules\OpenAI\Contracts\Resources\ImageMakerContract;
use Modules\OpenAI\Contracts\Responses\ImageResponseContract;

class GrokProvider extends AiProvider implements TemplateContentContract, CodeContract, LongArticleContract, AiChatContract, AiDocChatContract, VisionChatContract, ChatbotContract, ImageMakerContract
{
    use GrokApiTrait;

    /**
     * Holds the processed data after it has been manipulated or transformed.
     * This property is typically used within the context of a class to store
     * data that has been modified or processed in some way.
     *
     * @var array Contains an array of data resulting from processing operations.
     */
    protected $processedData;

    protected $production = true;

    /**
     * Returns an array containing the title, description, and image of the provider.
     *
     * @return array
     */
    public function description(): array
    {
        return [
            'title' => 'Grok',
            'description' => __(':x is an AI assistant by xAI, integrated with X (formerly Twitter), delivering intelligent, real-time responses and insights to support users with accurate, efficient, and engaging conversational solutions.', ['x' => 'Grok']),
            'image' => 'Modules/Grok/Resources/assets/image/grok.png',
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
        $processorClass = "Modules\\Grok\\Resources\\" . $processor;

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
        $processorClass = "Modules\\Grok\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->customerValidationRules();
        }

        return [];
    }

    // Start Template Content 

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
        if (isset($streamResponse['choices'][0]['delta']['content'])) {
            return $streamResponse['choices'][0]['delta']['content'];
        }

        return "";
    }

    // End Template Content


    // Start Code

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

        if (!$this->production) {
            return new CodeResponse((new CodeDataProcessor($aiOptions))->dummyCode());
        }

        return new CodeResponse($this->chat());
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

    // End Code

    // Start Long Article

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

        if (!$this->production) {
            return new TitleResponse((new LongArticleDataProcessor())->fakeTitles());
        }

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
        if (!$this->production) {
            return new OutlineResponse((new LongArticleDataProcessor())->fakeOutlines());
        }
        return new OutlineResponse($this->outlineChat( $aiOptions['number_of_outlines'] ?? 1));
    }
  
    public function article(array $aiOptions)
    {
        $this->processedData = (new LongArticleDataProcessor($aiOptions))->articleOptions();
        return $this->chatStream();
    }

    public function streamData(array|object $streamResponse): string
    {
        if (isset($streamResponse['choices'][0]['delta']['content'])) {
            return $streamResponse['choices'][0]['delta']['content'];
        }

        return "";
    }

    // End Long Article

    // Start Chat

    /**
     * Retrieves the character chatbot options by instantiating a CharacterChatbotDataProcessor
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
    public function aiChat(array $aiOptions): AiChatResponseContract
    {
        $this->processedData = (new AiChatDataProcessor($aiOptions))->aiChatDataOptions();

        if (!$this->production) {
            return new AiChatResponse((new AiChatDataProcessor($aiOptions))->dummyChat());
        }

        return new AiChatResponse($this->chat());
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

        if (!$this->production) {
            return new AskQuestionResponse((new AiDocChatDataProcessor())->dummyChat());
        }

        return new AskQuestionResponse($this->chat());
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

        if (!$this->production) {
            return new VisionChatResponse((new VisionChatDataProcessor())->dummyChat());
        }

        return new VisionChatResponse($this->chat());
    }

    // End Chat

    // Start Chatbot

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

        if (!$this->production) {
            return new ChatResponse((new ChatbotDataProcessor())->dummyChat());
        }

        return new ChatResponse($this->chat());
    }

    // End Chatbot

    // Start Image
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
    // End Image
}
