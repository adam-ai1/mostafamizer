<?php

namespace Modules\AiInfluencer\Resources\Providers\Creatify;

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
                'value' => 'Creatify',
                'visibility' => true
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
                'label' => 'Script Styles',
                'name' => 'script_styles',
                'value' => [
                    "Benefits", "Brand Story", "Call To Action", "Discovery", "Don't Worry", "Emotional", "Gen Z", "How To", "Let Me Show You", "Motivational", "Problem Solution", "Product Highlights", "Product Lifestyle", "Response Bubble", "Special Offers", "Storytime", "3 Reasons Why", "Trending Topics"
                ],
                'visibility' => true,
                'required' => true,
                'multiple' => true,
                'max_items' => 25
            ],
            [
                'type' => 'textarea',
                'label' => 'Title',
                'name' => 'title',
                'value' => 'Keywords of what you do not wish to see in the output image.',
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
    public function prepareData(): array
    {
        $url = isset($this->data['uploaded_file_name']) && !is_null($this->data['uploaded_file_name']) ? objectStorage()->url($this->data['uploaded_file_name']) : $this->data['url']; 
        return [
            'url' => $url,
            'language' => data_get(moduleConfig('aiinfluencer.providers.creatify.parameters.language'), $this->data['language'], 'en'),
            'video_length' => (int) data_get($this->data, 'video_length', 15),
            'script_styles' => array_map(function ($style) {
                return data_get(moduleConfig('aiinfluencer.providers.creatify.parameters.script_styles'), $style);
            }, $this->data['script_styles']),
        ];
    }
}
