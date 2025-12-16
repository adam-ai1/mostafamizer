<?php

namespace Modules\Pebblely\Resources;
use Illuminate\Validation\Rule;

class AiProductPhotographyDataProcessor
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
            'service' => [
                'default' => [
                    'create-background' => [
                        'file' => true,
                        'size' => true,
                        'background' => true,
                        'negative_prompt' => true,
                        'mask' => false,
                        'description' => true
                    ],
                    'remove-background' => [
                        'file' => true,
                        'background' => false,
                        'size' => false,
                        'negative_prompt' => false,
                        'mask' => false,
                        'description' => false
                    ], 
                    'upscale' => [
                        'file' => true,
                        'background' => false,
                        'mask' => false,
                        'size' => true,
                        'negative_prompt' => false,
                        'description' => false
                    ], 
                    'outpaint' => [
                        'file' => true,
                        'size' => true,
                        'background' => true,
                        'negative_prompt' => true,
                        'mask' => false,
                        'description' => true
                    ], 
                    'inpaint' => [
                        'file' => true,
                        'background' => true,
                        'size' => false,
                        'mask' => true,
                        'description' => true
                    ]
                ]
            ],
        ];
    }

    /**
     * Returns an array of options for configuring the character chatbot.
     *
     * @return array The configuration options for the character chatbot.
     */
    public function aiProductPhotographyOptions(): array
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
                'value' => 'pebblely',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Model',
                'name' => 'model',
                'value' => [
                    'default'
                ],
                'visibility' => true,
                'required' => true,
                'default_value' => 'default',
                'admin_visibility' => false,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Service',
                'name' => 'service',
                'value' => [
                    'create-background', 'remove-background', 'upscale', 'outpaint', 'inpaint'
                ],
                'visibility' => true,
                'required' => true,
                'default_value' => 'create-background',
            ],
            [
                "type" => "dropdown",
                "label" => "Size",
                "name" => "size",
                "value" => [
                    "512x512",
                    "1024x1024",
                    "2048x2048",
                ],
                "visibility" => true,
                "required" => true,
            ],
            [
                'type' => 'file',
                'label' => 'Mask',
                'name' => 'mask',
                'value' => '',
                'visibility' => true,
                'data-field' => "mask"
            ],
            [
                'type' => 'textarea',
                'label' => 'Description',
                'name' => 'description',
                'value' => 'Tell the AI what background/setting you want - overrides background if both are used.',
                'maxlength' => 500,
                'tooltip_limit' => 150,
                'placeholder' =>  'Please provide a short description, it will be displayed on the customer interface. Note that this will be added to the customer panel.',
                'visibility' => true,
            ],
            [
                'type' => 'textarea',
                'label' => 'Negative Prompt',
                'name' => 'negative_prompt',
                'value' => 'Keywords of what you do not wish to see in the output image.',
                'maxlength' => 500,
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
    public function customerValidationRules()
    {
        $data = request()->input('options');
        return [
            [
                'options.service' => 'required|in:create-background,remove-background,upscale,outpaint,inpaint',
                'options.file' => 'required|file|mimes:jpeg,jpg,png,gif',
                'options.size' => 'nullable|in:512x512,1024x1024,2048x2048',
                'options.mask' => 'nullable|required_if:options.service,inpaint|file|mimes:jpeg,jpg,png,gif',
                'options.negative_prompt' => 'nullable|string|max:500',
                'options.description' => 'nullable|string|max:1000',
                'options.background_id' => [
                    Rule::requiredIf(function () use ($data) {
                        return empty($data['description'] ?? null)
                            && !in_array($data['service'] ?? '', ['remove-background', 'upscale']);
                    }),
                ],
            ], 
            [
                'options.service.required' => _('Service field is required.'),
                'options.service.in' => _('Invalid service. Please select a valid service.'),
                'options.file.required' => _('The file field is required.'),
                'options.file.file' => _('The file must be a valid file.'),
                'options.file.mimes' => _('Please select a valid file format.'),
                'options.size.in' => _('Invalid size. Please select a valid size.'),
                'options.mask.file' => _('Please select a valid mask file.'),
                'options.background' => _('The background is required when description is empty and service is not remove background or upscale.'),
            ]
        ];
    }
    /**
     * Prepare the data for the AI service.
     *
     * @return array The prepared data for the AI service.
     */

    public function prepareData()
    {
        $data = $this->data;
        $service = data_get($data, 'options.service', 'create-background');
        $file = data_get($data, 'options.file', null);
        $mask = data_get($data, 'options.mask', null);
        $size = data_get($data, 'options.size', '512x512');
        $negativePrompt = data_get($data, 'options.negative_prompt', '');
        $theme = data_get($data, 'options.original_background', 'Surprise me');
        $dimensions = explode('x', $size);
        $description = data_get($data, 'options.description', '');

        $mime = $file->getMimeType();
        $base64 = base64_encode(file_get_contents($file->getRealPath()));

        $basePayload = [];

        if ($description != '') {
            $basePayload['description'] = $description;
        }

        if ($negativePrompt != '') {
            $basePayload['negative'] = $negativePrompt;
        }

        if ($mask) {
            $basePayload['mask'] = base64_encode(file_get_contents($mask->getRealPath()));
        }

        switch ($service) {
            case 'create-background':
                return array_merge($basePayload, [
                    'images' => [
                        "data:{$mime};base64,{$base64}"
                    ],
                    'width' => (int)$dimensions[0],
                    'height' => (int)$dimensions[1],
                    'theme' => $theme,
                ]);
            case 'remove-background':
                return [
                    'image' => "data:{$mime};base64,{$base64}",
                ];
            case 'upscale':
                return array_merge($basePayload, [
                    'image' => "data:{$mime};base64,{$base64}",
                    'size' => (int)$dimensions[0],
                ]);
            case 'outpaint':
                return [
                    'image' => $base64,
                    'width' => (int)$dimensions[0],
                    'theme' => $theme,
                ];
            case 'inpaint':
                return array_merge($basePayload, [
                    'image' => $base64,
                    'theme' => $theme,
                ]);
        }
    }

    /**
     * Process Pebblely data into format that can be inserted into the ProductBackground table.
     *
     * @param array $data The data to be processed, coming from the Pebblely API.
     * @return array
     */
    public function processData(array $data): array
    {
        $newData = [];

        foreach ($data['body'] as $key => $value) {

            if (empty($value['label']) || empty($value['thumbnail'])) {
                continue;
            }
            $id = cleanedUrl($value['label']);

            $backgroundId[] = $id;
            
            $newData[] = [
                'user_id' => auth()->user()->id,
                'name' => $value['label'],
                'background_id' => $id,
                'file_url' => $value['thumbnail'],
                'provider' => 'pebblely',
                'type' => 'ai_product_photography',
                'status' => 'Active',
            ];
        }

        return [
            'background_id' => $backgroundId,
            'data' => $newData,
        ];
    }
}