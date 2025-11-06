<?php

namespace Modules\ElevenLabs\Resources;

use App\Models\Language;

class SpeechToTextDataProcessor
{
    private $data = [];

    /**
     * Class constructor.
     *
     * Initializes the class with the provided AI options.
     *
     * @param array $aiOptions
     */
    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function speechToTextOptions(): array
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
                'value' => 'ElevenLabs',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'scribe_v1'
                ],
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Word Filters',
                'name' => 'word_filter',
                'value' => [
                    'Active', 'Inactive'
                ],
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Temperature',
                'name' => 'temperature',
                'value' => [
                    "0", "0.2", "0.5", "0.8", "1", "1.2", "1.5", "1.7", "2"
                ],
                'default_value' => "0",
                'tooltip' => __('The temperature ranges from 0 to 1. Higher values, such as 0.8, make the output more random, while lower values, like 0.2, produce more focused and deterministic results. If the temperature is set to 0, the model will automatically adjust it using log probability until specific thresholds are reached.'),
                'visibility' => true
            ],
        ];
    }

    /**
     * Retrieve the validation rules for the current data processor.
     * 
     * @return array An array of validation rules.
     */
    public function validationRules()
    {
        return [];
    }

    /**
     * Prepares the options for audio data processing.
     *
     * @return array
     */
    public function audioDataOptions(): array
    {
        $file = $this->data['file'];
        
        return [
            'model_id' => data_get($this->data, 'model', 'scribe_v1'),
            'file' => data_get($this->data, 'file'),
            'temperature' => (float) data_get($this->data, 'temperature', 0),
        ];
    }

    /**
     * Prepares a file for upload.
     *
     * Copies the uploaded file to a temporary location and returns the path to that location.
     *
     * @param \Illuminate\Http\UploadedFile $file The file to be prepared.
     *
     * @return string The path to the temporary location of the file.
     */
    public function prepareFile($file)
    {
        $uploadedFile = $file;
        $originalFileName = $uploadedFile->getClientOriginalName();
        return new \CURLFile($uploadedFile->getRealPath(), $uploadedFile->getMimeType(), $originalFileName);
    }
}
