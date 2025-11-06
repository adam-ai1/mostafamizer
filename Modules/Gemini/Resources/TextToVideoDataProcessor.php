<?php

namespace Modules\Gemini\Resources;

class TextToVideoDataProcessor
{
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function validationRules()
    {
        return [];
    }

    public function rules()
    {
        return [
            'variant' => [
                'veo-2.0-generate-001' => [
                    1,2
                ],
                'veo-3.0-generate-preview' => [
                    1
                ],
                'veo-3.0-fast-generate-preview' => [
                    1
                ],
            ],
            'aspect_ratio' => [
                'veo-2.0-generate-001' => [
                    '16:9',
                    '9:16'
                ],
                'veo-3.0-generate-preview' => [
                    '16:9',
                ],
                'veo-3.0-fast-generate-preview' => [
                    '16:9',
                ],
            ],
            'person_generation' => [
                'veo-2.0-generate-001' => [
                    'allow_all',
                    'allow_adult',
                    'dont_allow'
                ],
                'veo-3.0-generate-preview' => [
                    'allow_all',
                ],
                'veo-3.0-fast-generate-preview' => [
                    'allow_all',
                ],
            ],
            'service' => [
                'text-to-video' => [
                    'prompt' => true,
                ],
            ],
        ];
    }

    public function textToVideoOptions(): array
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
                'value' => 'Gemini',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Service',
                'name' => 'service',
                'value' => [
                    'text-to-video',
                ],
                'default_value' => 'text-to-video',
                'visibility' => true,
                'admin_visibility' => false,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'veo-2.0-generate-001',
                    'veo-3.0-generate-preview',
                    'veo-3.0-fast-generate-preview'
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Variant',
                'name' => 'variant',
                'value' => [
                    1, 2
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Aspect Ratio',
                'name' => 'aspect_ratio',
                'value' => [
                    '16:9', '9:16',
                ],
                'default_value' => '16:9',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Person Generation',
                'name' => 'person_generation',
                'value' => [
                    'allow_all',
                    'allow_adult',
                    'dont_allow'
                ],
                'visibility' => true
            ],
            [
                'type' => 'textarea',
                'label' => 'Negative Prompt',
                'name' => 'negative_prompt',
                'value' => __('Keywords of what you do not wish to see in the output image.'),
                'maxlength' => 10000,
                'tooltip_limit' => 150,
                'placeholder' =>  __('Please provide a brief description, it will be displayed on the customer interface. Note that this will be added to the customer panel.'),
                'visibility' => true,
            ],
        ];
    }

    public function customerValidationRules()
    {
        $validationRules['prompt'] = 'required';
        $validationRules['provider'] = 'required';
        $validationRules['options.model'] = 'required|in:veo-2.0-generate-001,veo-3.0-generate-preview,veo-3.0-fast-generate-preview';
        $validationMessage = [
            'prompt.required' => __('Please enter a prompt to generate an video.'),
            'provider.required' => __('Please select a provider'),
            'options.model.required' => __('Please select a model'),
            'options.model.in' => __('Please select a valid model'),
        ];

        return [
            $validationRules,
            $validationMessage
        ];
    }

    public function prepareData(): array
    {
        return $this->getFilteredData();
    }

    public function getFilteredData(): array
    {
        $data = [
            "instances" => [
                [
                    "prompt" => $this->data['prompt']
                ]
            ],
            "parameters" => [
                'aspectRatio' => data_get($this->data, 'options.aspect_ratio', '16:9'),
                'personGeneration' => data_get($this->data, 'options.person_generation', 'allow_all'),
                'sampleCount' => (int) data_get($this->data, 'options.variant', 1),
            ]
        ];

        $negativePrompt = data_get($this->data, 'options.negative_prompt', '');

        if ($negativePrompt != '') {
            $data['parameters']['negativePrompt'] = $negativePrompt;
        }

        return $data;
    }
}