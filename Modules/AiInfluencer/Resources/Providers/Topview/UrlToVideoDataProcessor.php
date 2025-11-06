<?php

namespace Modules\AiInfluencer\Resources\Providers\Topview;

class UrlToVideoDataProcessor
{
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function rules(): array
    {
        return [];
    }

    /**
     * Returns an array of options for configuring the character chatbot.
     *
     * @return array The configuration options for the character chatbot.
     */
    public function urlToVideoOptions(): array
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
                'value' => 'Topview',
                'visibility' => true
            ],
            [
                'type' => 'textarea',
                'label' => 'Title',
                'name' => 'title',
                'value' => 'Title of the Video.',
                'maxlength' => 1000,
                'tooltip_limit' => 150,
                'placeholder' =>  'Please provide a brief description, it will be displayed on the customer interface. Note that this will be added to the customer panel.',
                'visibility' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Language',
                'name' => 'language',
                'value' => [
                    "English", "Arabic", "Bulgarian", "Croatian", "Czech", "Danish", "Dutch", "Filipino", "Finnish", "French", "German", "Greek", "Hindi", "Hungarian", "Indonesian", "Italian", "Japanese", "Korean", "Malay", "Norwegian", "Polish", "Portuguese", "Romanian", "Russian", "Simplified Chinese", "Slovak", "Spanish", "Swedish", "Traditional Chinese", "Turkish", "Ukrainian", "Vietnamese", "Thai"
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Video Length',
                'name' => 'video_length',
                'value' => [
                    '30 to 50s',
                    '15 to 30s',
                    '30 to 45s',
                    '45 to 60s'
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Aspect Ratio',
                'name' => 'aspect_ratio',
                'value' => [
                    '9:16',
                    '3:4',
                    '1:1',
                    '4:3',
                    '16:9',
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'textarea',
                'label' => 'Script Description',
                'name' => 'override_script',
                'value' => 'Replace Video Script with Your Own Text.',
                'maxlength' => 1000,
                'tooltip_limit' => 150,
                'placeholder' =>  'Please provide a brief description, it will be displayed on the customer interface. Note that this will be added to the customer panel.',
                'visibility' => true,
            ]
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
     * Retrieves the validation rules for the current data processor, from the customer's perspective.
     * 
     * @return array An array of validation rules.
     */
    public function customerValidationRules()
    {
        $validationRules['provider'] = 'required';
        $validationRules['url'] = 'nullable|required_if:file,null|url';
        $validationRules['file'] = 'nullable|required_if:url,null|file|mimes:mp4,webm,ogg,avi,mov,wmv,flv,mkv';
        $validationMessage = [
            'provider.required' => __('Provider is required.'),
            'url.required_if' => __('Video URL is required.'),
            'file.required_if' => __('Video file is required.'),
            'file.mimes' => __('Video file must be of mp4, webm, ogg, avi, mov, wmv, flv, mkv format.'),
        ];

        return [
            $validationRules,
            $validationMessage
        ];
    }

    /**
     * Prepares the data to be sent to the AI provider.
     * 
     * @return array The prepared data.
     */
    public function prepareUrlToVideoData(): array
    {
        $url = isset($this->data['uploaded_file_name']) && !is_null($this->data['uploaded_file_name']) ? objectStorage()->url($this->data['uploaded_file_name']) : $this->data['url'];
        return [
            'productLink' => $url,
            'productName' => data_get($this->data, 'title', 'Video Title'),
            'language' => data_get(moduleConfig('aiinfluencer.providers.topview.parameters.language'), $this->data['language'], 'en'),
            'videoLengthType' => (int) data_get(moduleConfig('aiinfluencer.providers.topview.parameters.video_length'), $this->data['video_length'], 1),
            'aspectRatio' => data_get($this->data, 'aspect_ratio', '9:16'),
            'isDiyScript' => !is_null(data_get($this->data, 'override_script', null)),
            'diyScriptDescription' => data_get($this->data, 'override_script', null),
        ];
    }
}
