<?php

namespace Modules\Gemini\Resources;

class VideoDataProcessor
{
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function rules(): array
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
            'service' => [
                'veo-2.0-generate-001' => [
                    'image-to-video' => [
                        'prompt' => false,
                    ],
                ],
                'veo-3.0-generate-preview' => [
                    'image-to-video' => [
                        'prompt' => false,
                    ],
                ],
                'veo-3.0-fast-generate-preview' => [
                    'image-to-video' => [
                        'prompt' => false,
                    ],
                ],
            ],
        ];
    }

    public function videoOptions(): array
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
                    'image-to-video',
                ],
                'default_value' => 'image-to-video',
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
                    'veo-3.0-fast-generate-preview',
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
                'visibility' => true,
                'required' => true
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
            [
                'type' => 'file',
                'label' => 'File',
                'name' => 'file',
                'value' => '',
                'visibility' => true,
                'restrictions' => [],
            ],
        ];
    }

    public function generateVideo(): array
    {
        $data = [
            "instances" => [
                [
                    'image' => $this->prepareFile()
                ]
            ],
            'parameters' => [
                'aspectRatio' => data_get($this->data, 'options.aspect_ratio', '16:9'),
                'sampleCount' => (int) data_get($this->data, 'options.variant', 1),
            ]
        ];

        $negativePrompt = data_get($this->data, 'options.negative_prompt', '');

        if ($negativePrompt != '') {
            $data['parameters']['negativePrompt'] = $negativePrompt;
        }

        return $data;
    }

    /**
     * Retrieve the validation rules for the current data processor.
     * 
     * @return array An array of validation rules.
     */
    public function videoValidationRules()
    {
        $validationRules['provider'] = 'required';
        $validationRules['options.variant'] = 'required';
        $validationRules['options.aspect_ratio'] = 'required';
        $validationRules['options.model'] = 'required|in:veo-2.0-generate-001,veo-3.0-generate-preview,veo-3.0-fast-generate-preview';
        $validationRules['options.file'] = 'required';
        $validationMessage = [
            'provider.required' => __('Provider is required'),
            'options.variant.required' => __('Variant is required'),
            'options.aspect_ratio.required' => __('Aspect ratio is required'),
            'options.file.required' => __('File is required'),
            'options.model.required' => __('Model is required'),
            'options.model.in' => __('Please select a valid model'),
        ];
        return [
            $validationRules,
            $validationMessage
        ];
    }

    /**
     * Prepares a file for upload.
     *
     * If the file is provided in the options, it will be prepared for upload.
     * Otherwise, the function will return null.
     *
     * @return \CURLFile|null The prepared `\CURLFile` instance, ready for use in a cURL request.
     */
    public function prepareFile()
    {
        $uploadedFile = $this->data['options']['file'] ?? null;

        if (!is_null($uploadedFile)) {
            $filePath = $uploadedFile->getRealPath();
            $mimeType = $uploadedFile->getMimeType();
            $imageData = file_get_contents($filePath);
            
            $base64Image = base64_encode($imageData);

            return [
                'bytesBase64Encoded' => $base64Image,
                'mimeType' => $mimeType,
            ];
        }

        return null;
    }
}
