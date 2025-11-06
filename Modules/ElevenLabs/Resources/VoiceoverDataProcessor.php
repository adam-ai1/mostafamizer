<?php

namespace Modules\ElevenLabs\Resources;

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
                'value' => 'ElevensLab',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                   "Eleven Multilingual V2", "Eleven Turbo V2_5", "Eleven Turbo V2", "Eleven Multilingual V1", "Eleven Monolingual V1", "Eleven V3"
                ],
                'visibility' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Converted To',
                'name' => 'target_format',
                'value' => [
                    'MP3 at 22.05kHz, 32 kbps', 'MP3 at 44.1kHz, 32 kbps', 'MP3 at 44.1kHz, 64 kbps', 'MP3 at 44.1kHz, 96 kbps', 'MP3 at 44.1kHz, 128 kbps', 'MP3 at 44.1kHz, 192 kbps', 'PCM at 16kHz', 'PCM at 22.05kHz', 'PCM at 24kHz', 'PCM at 44.1kHz', 'uLaw at 8kHz'
                ],
                'default_value' => 'MP3 at 44.1kHz, 128 kbps',
                'visibility' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Stability',
                'name' => 'stability',
                'value' => [
                    '0.0', '0.2', '0.4', '0.6', '0.8', '1.0'
                ],
                'default_value' => '0.0',
                'tooltip' => 'Increasing stability will make the voice more consistent between re-generations, but it can also make it sounds a bit monotone. On longer text fragments we recommend lowering this value.',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Similarity Boost',
                'name' => 'similarity_boost',
                'value' => [
                    '0.0', '0.2', '0.4', '0.6', '0.8', '1.0'
                ],
                'default_value' => '0.0',
                'tooltip' => 'High enhancement improves voice clarity and enhances speaker similarity. However, setting it too high may introduce artifacts. Adjust this setting to achieve the best results.',
                'visibility' => true
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
            ],
        ];
    }

    public function speechDataOptions(): array
    {
        return [
            'text' => $this->data['prompt'],
            'model_id' => array_flip(moduleConfig('openai.voiceover.elevenlabs.model'))[$this->data['model']],
            'voice_settings' => [
                'stability' => $this->data['stability'],
                'similarity_boost' => $this->data['similarity_boost']
            ],
            'target_format' => array_flip(moduleConfig('openai.voiceover.elevenlabs.target_format'))[$this->data['target_format']],
        ];

    }

    public function speechOptions(): array
    {
        return $this->speechDataOptions();
    }

    public function prepareVoiceoverData(array $originalData, array $data, int $n)
    {
        $originalData['prompt'] = "";

        $originalData['prompt'] .= "'" . filteringBadWords($data['prompt']);
        $originalData['voice_name'] = $data['name'];
        $originalData['gender'] = $data['gender'];
        $originalData['voice'] = $data['voice'];
        $originalData['language'] = $data['language'];
        
        return $originalData;
    }

    /**
     * Process options data
     *
     * @param array $content
     * @return array
     */
    public function processOptionsData(array $data): array
    {
        return [
            'language' => $this->processLanguageData($data['language']),
            'stability' => $data['stability'],
            'similarity_boost' => $data['similarity_boost'],
            'gender' => $data['gender'],
            'voice' => $data['voice'],
        ];
    }

    /**
     * prepare file
     * @return [type]
     */
    public function prepareFile($data, $targetFormat)
    {
        $extension = $this->format(array_flip(moduleConfig('openai.voiceover.elevenlabs.target_format'))[$targetFormat]);
        (new VoiceoverService)->uploadPath();
 
        $clientExtension = strtolower($extension);
        $fileName = md5(uniqid()) . "." . $clientExtension;
        $destinationFolder = 'public' . DIRECTORY_SEPARATOR . 'uploads'. DIRECTORY_SEPARATOR . 'googleAudios'. DIRECTORY_SEPARATOR . date('Ymd') . DIRECTORY_SEPARATOR;
        
        if (!isExistFile($destinationFolder)) {
            createDirectory($destinationFolder);
        }

        $filePath = $destinationFolder . $fileName;

        objectStorage()->put($filePath, $data);

        return date('Ymd') . DIRECTORY_SEPARATOR . $fileName;
    }

    /**
     * Retrieve the validation rules for the current data processor.
     * 
     * @return array An array of validation rules.
     */
    public function customerValidationRules()
    {
       return [];
    }

    public function validationRules()
    {
        return [];
    }

    public function format($targetFormat)
    {
        $parts = explode('_', $targetFormat);
        return $parts[0] ?? 'mp3';
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
}
