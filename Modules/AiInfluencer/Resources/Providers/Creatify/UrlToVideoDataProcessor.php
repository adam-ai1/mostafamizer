<?php

namespace Modules\AiInfluencer\Resources\Providers\Creatify;

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
                'value' => 'Creatify',
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
                    "Arabic", "Bulgarian", "Czech", "Danish", "German", "Greek", "Modern", "English", "Spanish", " Castilian", "Finnish", "French", "Hindi", "Croatian", "Indonesian", "Italian", "Japanese", "Korean", "Malay", "Dutch", "Polish", "Portuguese", "Romanian", "Moldavian", "Moldovan", "Russian", "Slovak", "Swedish", "Tamil", "Tagalog", "Turkish", "Ukrainian", "Chinese"
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Video Length',
                'name' => 'video_length',
                'value' => [
                    '15',
                    '30',
                    '60'
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Aspect Ratio',
                'name' => 'aspect_ratio',
                'value' => [
                    '16x9',
                    '1x1',
                    '9x16'
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Caption Style',
                'name' => 'caption_style',
                'value' => [
                    "NORMAL_BLACK", "NORMAL_WHITE", "NORMAL_RED", "NORMAL_BLUE", "NEO", "BRICK", "FRENZY", "VERANA", "MUSTARD", "GLOW", "MINT", "COOLERS", "BILO", "TOONS", "DEEP_BLUE", "MYSTIQUE", "CAUTION", "DUALITY"
                ],
                'visibility' => true,
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Caption',
                'name' => 'no_caption',
                'value' => [
                    "Yes", "No"
                ],
                'visibility' => true,
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Emotion',
                'name' => 'no_emotion',
                'value' => [
                    "Yes", "No"
                ],
                'visibility' => true,
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Background Music Volume',
                'name' => 'background_music_volume',
                'value' => [
                    "Low", "Default", "High"
                ],
                'visibility' => true,
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Voiceover Volume',
                'name' => 'voiceover_volume',
                'value' => [
                    "Low", "Default", "High"
                ],
                'visibility' => true,
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Background Music',
                'name' => 'no_background_music',
                'value' => [
                    "Yes", "No"
                ],
                'visibility' => true,
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Script Styles',
                'name' => 'script_styles',
                'value' => [
                    "Benefits", "Brand Story", "Call To Action", "Discovery", "Don't Worry", "Emotional", "Gen Z", "How To", "Let Me Show You", "Motivational", "Problem Solution", "Product Highlights", "Product Lifestyle", "Response Bubble", "Special Offers", "Storytime", "3 Reasons Why", "Trending Topics", "DIY"
                ],
                'visibility' => true,
                'required' => true,
            ],
            [
                'type' => 'textarea',
                'label' => 'Overwrite Script',
                'name' => 'override_script',
                'value' => 'Override script for the video.',
                'maxlength' => 1000,
                'tooltip_limit' => 150,
                'placeholder' =>  'Please provide a brief description, it will be displayed on the customer interface. Note that this will be added to the customer panel.',
                'visibility' => true,
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
            'link' => $url,
            'name' => data_get($this->data, 'title', 'Video Title'),
            'language' => data_get(moduleConfig('aiinfluencer.providers.creatify.parameters.language'), $this->data['language'], 'en'),
            'video_length' => (int) data_get($this->data, 'video_length', 15),
            'script_styles' => data_get(moduleConfig('aiinfluencer.providers.creatify.parameters.script_styles'), $this->data['script_styles'], 'DiscoveryWriter'),
            'ascect_ratio' => data_get($this->data, 'aspect_ratio', '16x9'),
            'override_script' => data_get($this->data, 'override_script', null),
            'background_music_url' => data_get($this->data, 'background_music_url', null),
            'background_music_volume' => data_get(moduleConfig('aiinfluencer.providers.creatify.parameters.background_music_volume'), $this->data['background_music_volume'], null),
            'voiceover_volume' => data_get(moduleConfig('aiinfluencer.providers.creatify.parameters.voiceover_volume'), $this->data['voiceover_volume'], null),
            'caption_style' =>  data_get(moduleConfig('aiinfluencer.providers.creatify.parameters.caption_style'), $this->data['caption_style'], 'NORMAL_BLACK'),
            'no_caption' => $this->data['no_caption'] === 'Yes' ? true : false,
            'no_emotion' => $this->data['no_emotion'] === 'Yes' ? true : false,
            'no_background_music' => $this->data['no_background_music'] === 'Yes' ? true : false,
        ];
    }
}
