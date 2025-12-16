<?php

namespace Modules\AiInfluencer\Resources\Providers\Vizard;

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
                'value' => 'Vizard',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Video Type',
                'name' => 'video_type',
                'value' => [
                    'Remote video file',
                    'YouTube',
                    'Google Drive',
                    'Vimeo',
                    'StreamYard',
                    'TikTok',
                    'Twitter',
                    'Rumble',
                    'Twitch',
                    'Loom',
                    'Facebook',
                    'LinkedIn',
                ],
                'visibility' => true,
                'required' => true,
                'tooltip' => 'Please select "Remote Video File" if you\'ve uploaded a video. This will ensure it plays correctly.',
            ],
            [
                'type' => 'dropdown',
                'label' => 'Clip Length',
                'name' => 'prefer_length',
                'value' => [
                    'Automatically chosen',
                    'Less than 30 seconds',
                    '30 to 60 seconds',
                    '60 to 90 seconds',
                    '90 seconds to 3 minutes',
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Language',
                'name' => 'language',
                'value' => [
                    'English', 'Arabic', 'Bulgarian', 'Croatian', 'Czech', 'Danish', 'Dutch', 'Finnish', 'French', 'German', 'Greek', 'Hebrew', 'Hindi', 'Hungarian', 'Indonesian', 'Italian', 'Japanese', 'Korean', 'Lithuanian', 
                    'Malay', 'Mandarin-Simplified', 'Mandarin-Traditional', 'Norwegian', 'Polish', 'Portuguese', 'Romanian', 'Russian', 'Serbian', 'Slovak', 'Spanish', 'Swedish', 'Turkish', 'Ukrainian', 'Vietnamese'

                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Aspect Ratio',
                'name' => 'ratio_of_clip',
                'value' => [
                    '9:16', 
                    '1:1', 
                    '4:5',
                    '16:9'
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'number',
                'label' => 'Max Clip Number',
                'name' => 'max_clip_number',
                'min' => 1,
                'max' => 100,
                'value' => 5,
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Remove Silence',
                'name' => 'remove_silence_switch',
                'value' => [
                    'Yes',
                    'No'
                ],
                'visibility' => true,
                'required' => true

            ],
            [
                'type' => 'dropdown',
                'label' => 'Subtitles',
                'name' => 'subtitle_switch',
                'value' => [
                    'Yes',
                    'No'
                ],
                'visibility' => true,
                'required' => true

            ],
            [
                'type' => 'dropdown',
                'label' => 'Headlines',
                'name' => 'headline_switch',
                'value' => [
                    'Yes',
                    'No'
                ],
                'visibility' => true,
                'required' => true

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
        $url = isset($this->data['uploaded_file_name']) && !is_null($this->data['uploaded_file_name']) ? objectStorage()->url($this->data['uploaded_file_name']) : $this->data['url']; 
        return [
            'videoUrl' => $url,
            'lang' => data_get(moduleConfig('aiinfluencer.providers.vizard.parameters.language'),$this->data['language'], 'en'),
            'preferLength' => [(int) data_get(moduleConfig('aiinfluencer.providers.vizard.parameters.prefer_length'),$this->data['prefer_length'], '0')],
            'videoType' => (int) data_get(moduleConfig('aiinfluencer.providers.vizard.parameters.video_type'),$this->data['video_type'], '0'),
            'ratioOfClip' => (int) data_get(moduleConfig('aiinfluencer.providers.vizard.parameters.ratio_of_clip'),$this->data['ratio_of_clip'], '0'),
            'removeSilenceSwitch' => (int) data_get(moduleConfig('aiinfluencer.providers.vizard.parameters.remove_silence_switch'),$this->data['remove_silence_switch'], '0'),
            'maxClipNumber' => (int) data_get(moduleConfig('aiinfluencer.providers.vizard.parameters.max_clip_number'),$this->data['max_clip_number'], '10'),
            'subtitleSwitch' => (int) data_get(moduleConfig('aiinfluencer.providers.vizard.parameters.subtitle_switch'),$this->data['subtitle_switch'], '0'),
            'headlineSwitch' => (int) data_get(moduleConfig('aiinfluencer.providers.vizard.parameters.headline_switch'),$this->data['headline_switch'], '0'),
        ];
    }
}
