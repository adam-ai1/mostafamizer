<?php

namespace Modules\ElevenLabs;

use App\Lib\AiProvider;
use Modules\ElevenLabs\Traits\ElevenLabsApiTrait;
use Modules\ElevenLabs\Resources\VoiceCloneDataProcessor;
use Modules\OpenAI\Contracts\Resources\VoiceCloneContract;
use Modules\ElevenLabs\Responses\VoiceClone\VoiceCloneResponse;
use Modules\ElevenLabs\Responses\VoiceClone\VoiceCloneUpdateResponse;
use Modules\OpenAI\Contracts\Responses\VoiceClone\VoiceCloneResponseContract;

use Modules\ElevenLabs\Resources\VoiceoverDataProcessor;
use Modules\OpenAI\Contracts\Resources\VoiceoverContract;
use Modules\ElevenLabs\Responses\Voiceover\VoiceoverResponse;
use Modules\OpenAI\Contracts\Responses\Voiceover\VoiceoverResponseContract;

use Modules\OpenAI\Contracts\Resources\SpeechToTextContract;
use Modules\ElevenLabs\Resources\SpeechToTextDataProcessor;
use Modules\ElevenLabs\Responses\SpeechToText\SpeechToTextResponse;

class ElevenLabsProvider extends AiProvider implements VoiceoverContract, VoiceCloneContract, SpeechToTextContract
{
    private $production = true;

    use ElevenLabsApiTrait;

    /**
     * Holds the processed data after it has been manipulated or transformed.
     * This property is typically used within the context of a class to store
     * data that has been modified or processed in some way.
     *
     * @var array Contains an array of data resulting from processing operations.
     */
    protected $processedData;


    /**
     * Get the description of the AI provider.
     * 
     * This method returns an array that contains the title, description, and
     * image of the AI provider.
     * 
     * @return array The description of the AI provider.
     */
    public function description(): array
    {
        return [
            'title' => 'ElevenLabs',
            'description' => 'ElevenLabs is a cutting-edge voiceover platform renowned for its hyper-realistic AI voices. It boasts an extensive library of voices, including those resembling celebrities, and empowers users to customize the tone, style, and even emotions of the generated speech. This level of control makes elevenlabs a powerful tool for various applications, from creating engaging audio books and podcasts to developing interactive voice assistants and more.',
            'image' => 'Modules/ElevenLabs/Resources/assets/image/elevenlabs.jpg',
        ];
    }
    /**
     * Provides the options for the voiceover feature.
     *
     * The voiceover feature uses the voice cloning service from ElevenLabs. This
     * method returns the options that can be used to configure the voiceover
     * feature.
     *
     * @return array The options for the voiceover feature.
     */

    public function voiceCloneOptions(): array
    {
        return (new VoiceCloneDataProcessor)->voiceCloneOptions();
    }

    /**
     * Creates a new voice clone using the provided AI options.
     *
     * This method processes the provided AI options to generate data required
     * for cloning a voice. It then initiates the cloning process and returns
     * the response containing details of the created voice clone.
     *
     * @param array $aiOptions The AI options used for voice cloning.
     *
     * @return VoiceCloneResponseContract The response containing the voice clone details.
     */

    public function voiceClone(array $aiOptions): VoiceCloneResponseContract
    {
        $this->processedData = (new VoiceCloneDataProcessor($aiOptions))->voiceCloneDataOptions();
        return new VoiceCloneResponse($this->clone());
    }

    /**
     * Uploads a file using the VoiceCloneDataProcessor.
     *
     * This method takes a file and utilizes the VoiceCloneDataProcessor to handle 
     * the file upload process, returning the path of the uploaded file.
     *
     * @param \Illuminate\Http\UploadedFile $file The file to be uploaded.
     * 
     * @return string The path where the uploaded file is stored.
     */

    public function filePath ($file) 
    {
        return (new VoiceCloneDataProcessor())->uploadFile($file);
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
        $speechData = $aiOptions;
        unset($speechData['data']['additionalData']);

        $audio = "";
        $processData = [];
        foreach ($aiOptions['data']['additionalData'] as $key => $data) {

            $processData = (new VoiceoverDataProcessor)->prepareVoiceoverData($speechData['data'], $data, $key);
            $this->processedData = (new VoiceoverDataProcessor($processData))->speechOptions();

            $result = $this->speech($data['name']);

            if ($result['code'] != 200) {
                $res = json_decode($result['body'], true);
                throw new \Exception($res['detail']['message']);
            }

            $audio .= $result['body'];
        }

        $audioPath = (new VoiceoverDataProcessor())->prepareFile($audio, $speechData['data']['target_format']);
        return new VoiceoverResponse([
            'audioPath' => $audioPath,
            'processData' => $processData
        ]);
    }

    /**
     * Processes the options data using the VoiceoverDataProcessor.
     *
     * This method delegates the processing of the provided content array
     * to the VoiceoverDataProcessor's processOptionsData method.
     *
     * @param array $content The options data to be processed.
     * @return array The processed options data.
     */
    public function processOptionsData(array $content)
    {
        return (new VoiceoverDataProcessor())->processOptionsData($content);
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
        $processorClass = "Modules\\ElevenLabs\\Resources\\" . $processor;

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
        $processorClass = "Modules\\ElevenLabs\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->customerValidationRules();
        }

        return [];
    }

    /**
     * Get the validation rules for a specific voiceover processor.
     * 
     * @param string $processor The name of the data processor class.
     * 
     * @return array Validation rules for the processor.
     */
    public function voiceoverValidationRules(string $processor): array
    {
        $processorClass = "Modules\\ElevenLabs\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->voiceoverValidationRules();
        }

        return [];
    }

    /**
     * Updates an existing voice clone.
     *
     * @param array $aiOptions The voice clone options.
     *
     * @return VoiceCloneUpdateResponse The API response or error details.
     */
    public function updateVoice(array $aiOptions)
    {
        $this->processedData = (new VoiceCloneDataProcessor($aiOptions))->processVoiceCloneData();
        return new VoiceCloneUpdateResponse($this->editVoice($aiOptions['voice_name']));
    }

    /**
     * Deletes an existing voice clone.
     *
     * @param array $aiOptions The voice clone options containing the voice name.
     *
     * @return VoiceCloneUpdateResponse The API response or error details.
     */
    public function deleteVoice(array $aiOptions)
    {
        return new VoiceCloneUpdateResponse($this->destroyVoice($aiOptions['voice_name']));
    }

    /**
     * Provides the options for the speech-to-text feature.
     * 
     * @return array The options for the speech-to-text feature.
     */
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

        $this->processedData['file'] = $filePath;

        return new SpeechToTextResponse(! $this->production ? $this->speechToTextDummyData() : $this->audio(), $aiOptions['duration']);
    }

    /**
     * Returns dummy data for speech-to-text functionality.
     *
     * @return array dummy speech-to-text data.
     */
    public function speechToTextDummyData()
    {
        return [
                "code" => 200,
                "body" => json_encode([
                    "language_code" => "eng",
                    "language_probability" => 0.9485334157943726,
                    "text" => "Good morning, team. I wanted to check on the progress of the new feature rollout. How are we doing? Morning, Aleeva. The backend APIs are almost ready. We just need to integrate the video generation module with the frontend. And from the design side, all UI elements are finalized. I've also prepared mockups for the speech-to-text interface. They're ready for review.",
                    "words" => [
                        ["text" => "Good", "start" => 0.119, "end" => 0.339, "type" => "word", "logprob" => 0.0],
                        ["text" => "morning,", "start" => 0.399, "end" => 1.018, "type" => "word", "logprob" => 0.0],
                        ["text" => "team.", "start" => 1.08, "end" => 1.639, "type" => "word", "logprob" => 0.0],
                        ["text" => "I", "start" => 1.74, "end" => 1.799, "type" => "word", "logprob" => 0.0],
                        ["text" => "wanted", "start" => 1.839, "end" => 2.119, "type" => "word", "logprob" => 0.0],
                        ["text" => "to", "start" => 2.139, "end" => 2.259, "type" => "word", "logprob" => 0.0],
                        ["text" => "check", "start" => 2.299, "end" => 2.48, "type" => "word", "logprob" => 0.0],
                        ["text" => "on", "start" => 2.519, "end" => 2.619, "type" => "word", "logprob" => 0.0],
                        ["text" => "the", "start" => 2.619, "end" => 2.679, "type" => "word", "logprob" => 0.0],
                        ["text" => "progress", "start" => 2.74, "end" => 3.179, "type" => "word", "logprob" => 0.0],
                        ["text" => "of", "start" => 3.22, "end" => 3.299, "type" => "word", "logprob" => 0.0],
                        ["text" => "the", "start" => 3.319, "end" => 3.379, "type" => "word", "logprob" => 0.0],
                        ["text" => "new", "start" => 3.46, "end" => 3.599, "type" => "word", "logprob" => 0.0],
                        ["text" => "feature", "start" => 3.679, "end" => 4.019, "type" => "word", "logprob" => 0.0],
                        ["text" => "rollout.", "start" => 4.078, "end" => 5.34, "type" => "word", "logprob" => 0.0],
                        ["text" => "How", "start" => 5.38, "end" => 5.539, "type" => "word", "logprob" => 0.0],
                        ["text" => "are", "start" => 5.619, "end" => 5.719, "type" => "word", "logprob" => 0.0],
                        ["text" => "we", "start" => 5.759, "end" => 5.899, "type" => "word", "logprob" => 0.0],
                        ["text" => "doing?", "start" => 5.919, "end" => 6.559, "type" => "word", "logprob" => 0.0],
                        ["text" => "Morning,", "start" => 6.619, "end" => 7.219, "type" => "word", "logprob" => 0.0],
                        ["text" => "Aleeva.", "start" => 7.259, "end" => 7.959, "type" => "word", "logprob" => 0.0],
                        ["text" => "The", "start" => 7.98, "end" => 8.039, "type" => "word", "logprob" => 0.0],
                        ["text" => "backend", "start" => 8.099, "end" => 8.46, "type" => "word", "logprob" => 0.0],
                        ["text" => "APIs", "start" => 8.579, "end" => 8.94, "type" => "word", "logprob" => 0.0],
                        ["text" => "are", "start" => 8.94, "end" => 9.039, "type" => "word", "logprob" => 0.0],
                        ["text" => "almost", "start" => 9.039, "end" => 9.4, "type" => "word", "logprob" => 0.0],
                        ["text" => "ready.", "start" => 9.46, "end" => 10.119, "type" => "word", "logprob" => 0.0],
                        ["text" => "We", "start" => 10.139, "end" => 10.279, "type" => "word", "logprob" => 0.0],
                        ["text" => "just", "start" => 10.32, "end" => 10.48, "type" => "word", "logprob" => 0.0],
                        ["text" => "need", "start" => 10.539, "end" => 10.699, "type" => "word", "logprob" => 0.0],
                        ["text" => "to", "start" => 10.719, "end" => 10.8, "type" => "word", "logprob" => 0.0],
                        ["text" => "integrate", "start" => 10.86, "end" => 11.3, "type" => "word", "logprob" => 0.0],
                        ["text" => "the", "start" => 11.34, "end" => 11.42, "type" => "word", "logprob" => 0.0],
                        ["text" => "video", "start" => 11.46, "end" => 11.8, "type" => "word", "logprob" => 0.0],
                        ["text" => "generation", "start" => 11.84, "end" => 12.359, "type" => "word", "logprob" => 0.0],
                        ["text" => "module", "start" => 12.42, "end" => 12.779, "type" => "word", "logprob" => 0.0],
                        ["text" => "with", "start" => 12.779, "end" => 12.9, "type" => "word", "logprob" => 0.0],
                        ["text" => "the", "start" => 12.92, "end" => 13.0, "type" => "word", "logprob" => 0.0],
                        ["text" => "frontend.", "start" => 13.06, "end" => 14.399, "type" => "word", "logprob" => 0.0],
                        ["text" => "And", "start" => 14.4, "end" => 14.539, "type" => "word", "logprob" => 0.0],
                        ["text" => "from", "start" => 14.559, "end" => 14.699, "type" => "word", "logprob" => 0.0],
                        ["text" => "the", "start" => 14.739, "end" => 14.819, "type" => "word", "logprob" => 0.0],
                        ["text" => "design", "start" => 14.859, "end" => 15.279, "type" => "word", "logprob" => 0.0],
                        ["text" => "side,", "start" => 15.38, "end" => 16.039, "type" => "word", "logprob" => 0.0],
                        ["text" => "all", "start" => 16.1, "end" => 16.26, "type" => "word", "logprob" => 0.0],
                        ["text" => "UI", "start" => 16.34, "end" => 16.579, "type" => "word", "logprob" => 0.0],
                        ["text" => "elements", "start" => 16.659, "end" => 17.1, "type" => "word", "logprob" => 0.0],
                        ["text" => "are", "start" => 17.12, "end" => 17.26, "type" => "word", "logprob" => 0.0],
                        ["text" => "finalized.", "start" => 17.299, "end" => 18.7, "type" => "word", "logprob" => 0.0],
                        ["text" => "I've", "start" => 18.76, "end" => 18.88, "type" => "word", "logprob" => 0.0],
                        ["text" => "also", "start" => 18.92, "end" => 19.219, "type" => "word", "logprob" => 0.0],
                        ["text" => "prepared", "start" => 19.239, "end" => 19.72, "type" => "word", "logprob" => 0.0],
                        ["text" => "mockups", "start" => 19.799, "end" => 20.28, "type" => "word", "logprob" => 0.0],
                        ["text" => "for", "start" => 20.319, "end" => 20.42, "type" => "word", "logprob" => 0.0],
                        ["text" => "the", "start" => 20.46, "end" => 20.559, "type" => "word", "logprob" => 0.0],
                        ["text" => "speech-to-text", "start" => 20.659, "end" => 21.459, "type" => "word", "logprob" => 0.0],
                        ["text" => "interface.", "start" => 21.52, "end" => 22.5, "type" => "word", "logprob" => 0.0],
                        ["text" => "They're", "start" => 22.5, "end" => 22.659, "type" => "word", "logprob" => 0.0],
                        ["text" => "ready", "start" => 22.68, "end" => 22.959, "type" => "word", "logprob" => 0.0],
                        ["text" => "for", "start" => 23.0, "end" => 23.1, "type" => "word", "logprob" => 0.0],
                        ["text" => "review.", "start" => 23.14, "end" => 23.78, "type" => "word", "logprob" => 0.0],
                    ],
                    "transcription_id" => "ttpey5iElFaTuJce9Cm1"
                ])
            ]; 
    }
}
