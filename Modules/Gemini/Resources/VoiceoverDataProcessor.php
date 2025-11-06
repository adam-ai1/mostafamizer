<?php

namespace Modules\Gemini\Resources;

use Modules\OpenAI\Services\v2\VoiceoverService;

class VoiceoverDataProcessor
{
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function voiceoverOptions(): array
    {
        return [
            [
                'type' => 'checkbox',
                'label' => 'Provider State',
                'name' => 'status',
                'value' => '',
                'visibility' => true
            ],
            [
                'type' => 'text',
                'label' => 'Provider',
                'name' => 'provider',
                'value' => 'openai',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'Gemini 2.5 Pro Preview TTS',
                    'Gemini 2.5 Flash Preview TTS',
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Converted To',
                'name' => 'target_format',
                'value' => [
                    'WAV'
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'number',
                'label' => 'Conversation Limit',
                'name' => 'conversation_limit',
                'min' => 1,
                'max' => 6,
                'value' => 2,
                'visibility' => true,
                'required' => true
            ]
        ];
    }

    /**
     * Prepare the payload to be sent to the Gemini API.
     *
     * The payload will contain the model, input text, and generation config.
     *
     * @param array $data
     * @return array
     */
    public function speechDataOptions(array $data): array
    {
        $model = $data['model'] ?? 'gemini-2.5-flash-preview-tts';

        $payload = [
            'model' => array_flip(moduleConfig('openai.voiceover.gemini.model'))[$model],
            'contents' => [
                [
                    'parts' => [
                        ['text' => $this->prepareInputText($data)]
                    ]
                ]
            ],
            'generationConfig' => [
                'responseModalities' => ['AUDIO'],
                'speechConfig' => $this->prepareSpeakers($data)
            ]
        ];

        return $payload;

    }

    public function validationRules(): array
    {
        return [];
    }

    public function speechOptions(array $data): array
    {
        return $this->speechDataOptions($data);
    }

    /**
     * Prepare the voiceover data for the Gemini model. This method combines the 
     * text prompts and additional data into a single array.
     *
     * @param array $data
     * @return array
     */
    public function prepareVoiceoverData(array $data)
    {
        $prompt = implode('. ', array_filter($data['prompt']));
        $originalData['prompt'] = "";
        foreach ($data['additionalData'] as $speakerData) {
            $originalData['voice_name'] = $speakerData['name'];
            $originalData['gender'] = $speakerData['gender'];
            $originalData['voice'] = $speakerData['voice'];
            $originalData['language'] = $speakerData['language'];
        }

        $originalData['prompt'] .= filteringBadWords($prompt);
        

        return $originalData;
    }

    /**
     * Prepare the input text for Gemini model.
     *
     * @param array $data
     * @return string
     */
    protected function prepareInputText(array $data): string
    {
        // Single speaker from main data
        if (count($data['additionalData']) == 1 && is_array($data['prompt'])){
            return implode('. ', array_filter($data['prompt']));
        }
        
        foreach ($data['additionalData'] as $key => $speakerData) {

            $hosts[] = $speakerData['name'];
            $conversationParts[] = "{$speakerData['name']}: " . ($speakerData['prompt'] ?? '');
        }

        $conversation = "TTS the following conversation between " . implode(' and ', $hosts) . ":\n\n";
        $conversation .= implode("\n", $conversationParts);

        return $conversation;
        
    }

    /**
     * Prepare speakers for API request
     *
     * @param array $data
     * @return array
     */
    protected function prepareSpeakers(array $data): array
    {
        $speakers = [];

        // Single speaker from main data
        if (count($data['additionalData']) == 1){
            return [
                'voiceConfig' => [
                    'prebuiltVoiceConfig' => [
                        'voiceName' => $data['additionalData'][0]['voice']
                    ]
                ]
            ];
        }

        // Multiple speakers from additionalData
        foreach ($data['additionalData'] as $speakerData) {
            $speakers[] = [
                'speaker' => $speakerData['name'],
                'voiceConfig' => [
                    'prebuiltVoiceConfig' => [
                        'voiceName' => $speakerData['voice']
                    ]
                ]
            ];
        }

        return [
            'multiSpeakerVoiceConfig' => [
                'speakerVoiceConfigs' => $speakers
            ]
        ];
    }


    /**
     * process Options Data
     * @param mixed $content
     *
     * @return [type]
     */
    public function processOptionsData($content)
    {
        return [
            'language' => $this->processLanguageData($content['language']),
            'gender' => $content['gender'],
            'voice' => $content['voice'],
        ];
    }

    /**
     * Process Language Data To Store
     *
     * @param array $lang
     *
     * @return [type]
     */

    public function processLanguageData(string $language)
    {
        $textToSpeechService = new VoiceoverService();
        $lang = explode('-', $language);
        return $lang ? $textToSpeechService->languages($lang[0]) : $language;
    }

    /**
     * prepare file
     * @return [type]
     */
    public function prepareFile($data, $targetFormat)
    {
        $rawData = base64_decode($data);
        $wavData = $this->pcmToWav($rawData);
        (new VoiceoverService)->uploadPath();

        $clientExtension = strtolower($targetFormat);
        $fileName = md5(uniqid()) . "." . $clientExtension;
        $destinationFolder = 'public' . DIRECTORY_SEPARATOR . 'uploads'. DIRECTORY_SEPARATOR . 'googleAudios'. DIRECTORY_SEPARATOR . date('Ymd') . DIRECTORY_SEPARATOR;
        
        if (!isExistFile($destinationFolder)) {
            createDirectory($destinationFolder);
        }

        $filePath = $destinationFolder . $fileName;
        $audioData = $data;

        objectStorage()->put($filePath, $wavData);

        return date('Ymd') . DIRECTORY_SEPARATOR . $fileName;
    }

    /**
     * Converts raw PCM audio data to a full WAV file.
     *
     * @param string $pcmData The raw PCM audio data.
     * @param int $sampleRate The sample rate of the audio data. Defaults to 24000.
     * @param int $channels The number of channels in the audio data. Defaults to 1 (mono).
     * @param int $bitsPerSample The number of bits per sample in the audio data. Defaults to 16.
     *
     * @return string The full WAV file as a string.
     */
    function pcmToWav($pcmData, $sampleRate = 24000, $channels = 1, $bitsPerSample = 16) {
        $dataLength = strlen($pcmData);
        
        // WAV header
        $header = pack('N', 0x52494646); // "RIFF"
        $header .= pack('V', 36 + $dataLength); // File size - 8
        $header .= pack('N', 0x57415645); // "WAVE"
        
        // fmt subchunk
        $header .= pack('N', 0x666d7420); // "fmt "
        $header .= pack('V', 16); // Subchunk1Size
        $header .= pack('v', 1); // Audio format PCM = 1
        $header .= pack('v', $channels); // Number of channels
        $header .= pack('V', $sampleRate); // Sample rate
        $header .= pack('V', $sampleRate * $channels * $bitsPerSample / 8); // Byte rate
        $header .= pack('v', $channels * $bitsPerSample / 8); // Block align
        $header .= pack('v', $bitsPerSample); // Bits per sample
        
        // data subchunk
        $header .= pack('N', 0x64617461); // "data"
        $header .= pack('V', $dataLength); // Subchunk2Size
        
        return $header . $pcmData;
    }


    /**
     * Retrieve the validation rules for the current data processor.
     * 
     * @return array An array of validation rules.
     */
    public function customerValidationRules()
    {

        $validationRules['data']['model'] = 'required';
        $validationRules['additionalData'][0]['name'] = 'required';
        $validationRules['additionalData'][0]['prompt'] = 'required';
        $validationMessage = [
            'data.model.required' => __('Model is required for generate voiceover.'),
            'additionalData.*.name.required' => __('Actor is required for generate voiceover.'),
            'additionalData.*.prompt.required' => __('Prompt is required for generate voiceover.'),
        ];

        return [
            $validationRules,
            $validationMessage
        ];
    }
}
