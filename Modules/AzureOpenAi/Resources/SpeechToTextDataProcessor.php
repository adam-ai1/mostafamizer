<?php

namespace Modules\AzureOpenAi\Resources;

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
                'value' => 'azureopenai',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'gpt-4o-mini-transcribe',
                    'gpt-4o-transcribe',
                    'whisper',
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Word Filters',
                'name' => 'word_filter',
                'value' => [
                    'Active', 'Inactive'
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Languages',
                'name' => 'language',
                'value' => $this->languages(),
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Temperature',
                'name' => 'temperature',
                'value' => [
                    "0", "0.2", "0.5", "0.8", "1"
                ],
                'default_value' => "0",
                'tooltip' => __('The temperature ranges from 0 to 1. Higher values, such as 0.8, make the output more random, while lower values, like 0.2, produce more focused and deterministic results. If the temperature is set to 0, the model will automatically adjust it using log probability until specific thresholds are reached.'),
                'visibility' => true,
                'required' => true
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
     * Retrieves the list of valid languages for speech generation.
     *
     * @return array 
     */
    public function languages(): array
    {
        return Language::where(['status' => 'Active'])->pluck('name')->toArray();
    }

    /**
     * Prepares the options for audio data processing.
     *
     * @return array
     */
    public function audioDataOptions(): array
    {
        $language = data_get($this->data, 'language', 'English');
        $allLanguages = getShortLanguageName(true);
        $langCode = array_search($language, $allLanguages);
 
        return [
            'temperature' => data_get($this->data, 'temperature', 1),
            'model' => data_get($this->data, 'model', 'whisper-1'),
            'file' => data_get($this->data, 'file'),
            'response_format'=> "json",
            'language' => $langCode,
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
        $tempFile = 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'aiAudios'. DIRECTORY_SEPARATOR;
        $tempPath =  date('Ymd') . DIRECTORY_SEPARATOR . md5(uniqid()) . '.' . $uploadedFile->getClientOriginalExtension();

        objectStorage()->put($tempFile . $tempPath, file_get_contents($uploadedFile->getRealPath()));

        return $tempPath;
    }

}