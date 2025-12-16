<?php

namespace Modules\AiInfluencer\Resources\Providers\Klap;

class AiShortsDataProcessor
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
    public function aiShortsOptions(): array
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
                'value' => 'klap',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Resolution',
                'name' => 'resolution',
                'value' => [
                    '360x640', 
                    '720x1280', 
                    '1920x1080', 
                    '1080x1080', 
                    '1080x1920'
                ],
                'visibility' => true,
                'required' => true,
                'default_value' => '1080x1920'
            ],
            [
                'type' => 'number',
                'label' => 'Target Clip Count',
                'name' => 'target_clip_count',
                'min' => 1,
                'max' => 50,
                'value' => 10,
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'number',
                'label' => 'Max Clip Count',
                'name' => 'max_clip_count',
                'min' => 1,
                'max' => 50,
                'value' => 10,
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'number',
                'label' => 'Min Duration',
                'name' => 'min_duration',
                'min' => 1,
                'max' => 120,
                'value' => 1,
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'number',
                'label' => 'Max Duration',
                'name' => 'max_duration',
                'min' => 1,
                'max' => 180,
                'value' => 180,
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'number',
                'label' => 'Target Duration',
                'name' => 'target_duration',
                'min' => 1,
                'max' => 120,
                'value' => 60,
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Captions',
                'name' => 'captions',
                'value' => [
                    'Yes', 'No',
                ],
                'visibility' => true,
                'required' => true,
                'default_value' => 'Yes'
            ],
            [
                'type' => 'dropdown',
                'label' => 'Emojis',
                'name' => 'emojis',
                'value' => [
                    'Yes', 'No',
                ],
                'visibility' => true,
                'required' => true,
                'default_value' => 'Yes'
            ],
            [
                'type' => 'dropdown',
                'label' => 'Intro Title',
                'name' => 'intro_title',
                'value' => [
                    'Yes', 'No',
                ],
                'visibility' => true,
                'required' => true,
                'default_value' => 'Yes'
            ],
            [
                'type' => 'dropdown',
                'label' => 'Remove Silences',
                'name' => 'remove_silences',
                'value' => [
                    'Yes', 'No',
                ],
                'visibility' => true,
                'required' => true,
                'default_value' => 'No'
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
    public function prepareData(): array
    {
        $dimensions = explode('x', data_get($this->data, 'resolution', '1080x1920'));
        $width = (int) $dimensions[0];
        $height = (int) $dimensions[1];
        $url = isset($this->data['uploaded_file_name']) && !is_null($this->data['uploaded_file_name']) ? objectStorage()->url($this->data['uploaded_file_name']) : $this->data['url']; 
        
        return [
            'source_video_url' => $url,
            'target_clip_count' => (int) data_get($this->data['target_clip_count'], '10'),
            'max_clip_count' => [data_get($this->data, 'max_clip_count', '0')],
            'min_duration' => (int) data_get($this->data, 'min_duration', '1'),
            'max_duration' => (int) data_get($this->data, 'max_duration', '180'),
            'target_duration' => (int) data_get($this->data, 'target_duration', '60'),
            'dimensions' => [
                'width' => (int) $width,
                'height' => (int) $height,
            ],
            'editing_options' => [
                'captions' => (boolean) data_get($this->data, 'captions', 'Yes') == 'Yes' ? true : false,
                'emojis' => (boolean) data_get($this->data, 'emojis', 'Yes') == 'Yes' ? true : false,
                'intro_title' => (boolean) data_get($this->data, 'intro_title', 'Yes') == 'Yes' ? true : false,
                'remove_silences' => (boolean) data_get($this->data, 'intro_title', 'No') == 'No' ? false : true,
            ]
        ];
    }

    public function prepareLogoData(): array
    {
        return [
            'watermark' => [
                'src_url' => \App\Models\Preference::getLogo(),
                "pos_x" => 0.5,
                "pos_y" => 0.5,
                "scale" => 1
            ]
        ];
    }
}
