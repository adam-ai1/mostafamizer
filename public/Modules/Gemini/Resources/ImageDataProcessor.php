<?php

namespace Modules\Gemini\Resources;

class ImageDataProcessor
{
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function rules()
    {
        return [
            'variant' => [
                'imagen-3.0-generate-002' => [
                    1, 2, 3, 4
                ],
                'gemini-2.0-flash-preview-image-generation' => [
                    1
                ],
                'gemini-2.5-flash-image-preview' => [
                    1
                ],
                'imagen-4.0-generate-preview-06-06' => [
                    1, 2, 3, 4
                ],
                'imagen-4.0-fast-generate-preview-06-06' => [
                    1, 2, 3, 4
                ],
                'imagen-4.0-ultra-generate-preview-06-06' => [
                    1
                ],
            ],
            'aspect_ratio' => [
                'imagen-3.0-generate-002' => [
                    '1:1',
                    '4:5',
                    '3:4',
                    '2:3',
                    '9:16',
                    '16:9',
                ],
                'gemini-2.0-flash-preview-image-generation' => [
                    '1:1'
                ],
                'gemini-2.5-flash-image-preview' => [
                    '1:1',
                ],
                'imagen-4.0-generate-preview-06-06' => [
                    '1:1',
                    '3:4',
                    '4:3',
                    '9:16',
                    '16:9',
                ],
                'imagen-4.0-fast-generate-preview-06-06' => [
                    '1:1',
                    '3:4',
                    '4:3',
                    '9:16',
                    '16:9',
                ],
                'imagen-4.0-ultra-generate-preview-06-06' => [
                    '1:1',
                    '3:4',
                    '4:3',
                    '9:16',
                    '16:9',
                ],
            ],
            'person_generation' => [
                'imagen-3.0-generate-002' => [
                    'ALLOW_ADULT',
                    'DONT_ALLOW'
                ],
                'gemini-2.0-flash-preview-image-generation' => [
                ],
                'gemini-2.5-flash-image-preview' => [
                ],
                'imagen-4.0-generate-preview-06-06' => [
                    'ALLOW_ADULT',
                    'DONT_ALLOW',
                    'ALLOW_ALL'
                ],
                'imagen-4.0-fast-generate-preview-06-06' => [
                    'ALLOW_ADULT',
                    'DONT_ALLOW',
                    'ALLOW_ALL'
                ],
                'imagen-4.0-ultra-generate-preview-06-06' => [
                    'ALLOW_ADULT',
                    'DONT_ALLOW',
                    'ALLOW_ALL'
                ],
            ],
            'service' => [
                'imagen-3.0-generate-002' => [
                    'text-to-image' => [
                        'prompt' => true,
                        'file' => false,
                        'aspect_ratio' => true,
                        'variant' => true,
                        'person_generation' => true
                    ]
                ],
                'imagen-4.0-generate-preview-06-06' => [
                    'text-to-image' => [
                        'prompt' => true,
                        'file' => false,
                        'aspect_ratio' => true,
                        'variant' => true,
                        'person_generation' => true
                    ]
                ],
                'imagen-4.0-fast-generate-preview-06-06' => [
                    'text-to-image' => [
                        'prompt' => true,
                        'file' => false,
                        'aspect_ratio' => true,
                        'variant' => true,
                        'person_generation' => true
                    ]
                ],
                'imagen-4.0-ultra-generate-preview-06-06' => [
                    'text-to-image' => [
                        'prompt' => true,
                        'file' => false,
                        'aspect_ratio' => true,
                        'variant' => true,
                        'person_generation' => true
                    ]
                ],
                'gemini-2.0-flash-preview-image-generation' => [
                    'text-to-image' => [
                        'prompt' => true,
                        'file' => false,
                        'aspect_ratio' => true,
                        'variant' => true,
                        'person_generation' => false
                    ],
                    'image-to-image' => [
                        'prompt' => true,
                        'file' => true,
                        'aspect_ratio' => false,
                        'variant' => false,
                        'person_generation' => false
                    ],
                ],
                'gemini-2.5-flash-image-preview' => [
                    'text-to-image' => [
                        'prompt' => true,
                        'file' => false,
                        'aspect_ratio' => false,
                        'variant' => false,
                        'person_generation' => false
                    ],
                    'image-to-image' => [
                        'prompt' => true,
                        'file' => true,
                        'aspect_ratio' => false,
                        'variant' => false,
                        'person_generation' => false
                    ],
                ]
            ],
        ];
    }

    public function imageOptions(): array
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
                'visibility' => false
            ],
            [
                'type' => 'dropdown',
                'label' => 'Service',
                'name' => 'service',
                'value' => [
                    'text-to-image',
                    'image-to-image',
                ],
                'default_value' => 'text-to-image',
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'gemini-2.5-flash-image-preview',
                    'gemini-2.0-flash-preview-image-generation',
                    'imagen-3.0-generate-002',
                    'imagen-4.0-generate-preview-06-06',
                    'imagen-4.0-ultra-generate-preview-06-06',
                    'imagen-4.0-fast-generate-preview-06-06'
                ],
                'default_value' => 'imagen-3.0-generate-002',
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Variant',
                'name' => 'variant',
                'value' => [
                    1, 2, 3, 4
                ],
                'default_value' => 1,
                'visibility' => true,
                "required" => true,
            ],
            [
                "type" => "dropdown",
                "label" => "Art Style",
                "name" => "art_style",
                "value" => [
                    '3D Model',
                    'Analog Film',
                    'Anime',
                    'Cinematic',
                    'Comic Book',
                    'Digital Art',
                    'Enhance',
                    'Fantasy Art',
                    'Isometric',
                    'Line Art',
                    'Low Poly',
                    'Modeling Compound',
                    'Neon Punk',
                    'Origami',
                    'Photographic',
                    'Pixel Art',
                    'Tile Texture'
                ],
                "default" => "Normal",
                "visibility" => true,
                'required' => true
            ],
            [
                "type" => "dropdown",
                "label" => "Light Effect",
                "name" => "light_effect",
                "value" => [
                    "Normal",
                    "Studio",
                    "Warm",
                    "Cold",
                    "Ambient",
                    "Neon",
                    'Foggy'
                ],
                "default" => "Normal",
                "visibility" => true,
                'required' => true
            ],
            [
                "type" => "dropdown-with-image",
                "label" => "Image Art Style",
                "name" => "image_art_style",
                "value" => [
                    [
                        "label" => "Normal",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\normal.jpg",
                    ],
                    [
                        "label" => "3D Model",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\3d-animation.png",
                    ],
                    [
                        "label" => "Analog Film",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\analog-film.jpg",
                    ],
                    [
                        "label" => "Anime",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\anime.png",
                    ],
                    [
                        "label" => "Cinematic",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\cinematic.jpg",
                    ],
                    [
                        "label" => "Comic Book",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\comic.png", 
                    ],
                    [
                        "label" => "Digital Art",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\digital-art.png",
                    ],  
                    [
                        "label" => "Enhance",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\enhance.png",
                    ],
                    [
                        "label" => "Fantasy Art",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\fantasy.png",
                    ],
                    [
                        "label" => "Isometric",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\isometric.jpg",
                    ],
                    [
                        "label" => "Line Art",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\line-art.png",
                    ],
                    [
                        "label" => "Low Poly",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\low-poly.png",
                    ],
                    [
                        "label" => "Modeling Compound",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\modeling-compound.png",
                    ],
                    [
                        "label" => "Neon Punk",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\neon-punk.png",
                    ],
                    [
                        "label" => "Origami",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\origami.jpg",
                    ],
                    [
                        "label" => "Photographic",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\photographic.jpg",
                    ],
                    [
                        "label" => "Pixel Art",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\pixel-art.jpg",
                    ],
                    [
                        "label" => "Tile Texture",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\tile-texture.jpg",  
                    ],  
                    [
                        "label" => "Water Color",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\art-style\\water-color.png",
                    ]
                ],
                "visibility" => true,
                'admin_visibility' => false,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Aspect Ratio',
                'name' => 'aspect_ratio',
                'value' => [
                    '1:1',
                    '3:4',
                    '4:3',
                    '9:16',
                    '3:2',
                    '16:9'
                ],
                'default_value' => '1:1',
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Person Generation',
                'name' => 'person_generation',
                'value' => [
                    'DONT_ALLOW',
                    'ALLOW_ADULT',
                    'ALLOW_ALL'
                ],
                'default_value' => 'DONT_ALLOW',
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'file',
                'label' => 'File',
                'name' => 'file',
                'value' => '',
                'visibility' => true,
                'data-field' => "file"
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
        $validationRules['prompt'] = 'required';
        $validationRules['provider'] = 'required';
        $validationRules['options.service'] = 'required';
        $validationRules['options.model'] = 'required|in:imagen-3.0-generate-002,gemini-2.0-flash-preview-image-generation,gemini-2.5-flash-image-preview,imagen-4.0-generate-preview-06-06,imagen-4.0-fast-generate-preview-06-06,imagen-4.0-ultra-generate-preview-06-06';
        $validationRules['file'] = 'nullable|required_if:options.service,image-to-image|file|mimes:jpeg,png,jpg';

        $validationMessage = [
            'provider.required' => __('Provider is required to generate an image.'),
            'options.service.required' => __('Service field is required.'),
            'options.model.required' => __('Model field is required.'),
            'options.model.in' => __('Invalid model. Please select a valid model.'),
            'prompt.required' => __('Prompt field is required.'),
            'file.required_if' => __('The file field is required.'),
            'file.file' => __('The file must be a valid file.'),
            'file.mimes' => __('The file must be a JPEG, PNG, or JPG'),
        ];

        return [
            $validationRules,
            $validationMessage,
        ];
    }

    public function imageDataOptions()
    {
        $model = data_get($this->data, 'options.model', 'imagen-3.0-generate-002');
        $service = data_get($this->data, 'options.service', 'text-to-image');
        $options = $this->data['options'];
        $prompt = $this->imagePrompt();

        if ($this->isGeminiImageModel($model)) {
            return $this->buildImageModelData($model, $prompt, $options);
        }

        $parts = $this->buildPromptParts($prompt, $service, $options);

        return $this->buildGenericData($model, $parts);
    }

    private function isGeminiImageModel($model)
    {
        return in_array($model, moduleConfig('gemini.image_models.imagen'));
    }

    private function buildImageModelData($model, $prompt, $options)
    {
        return [
            'instances' => [
                [
                    'prompt' => $prompt,
                ],
            ],
            'parameters' => [
                'sampleCount' => (int) data_get($options, 'variant', 1),
                'aspectRatio' => data_get($options, 'aspect_ratio', '1:1'),
                'personGeneration' => data_get($options, 'person_generation', 'DONT_ALLOW'),
            ],
            'model' => $model
        ];
    }

    private function buildPromptParts($prompt, $service, $options)
    {
        $parts = [
            ['text' => $prompt],
        ];

        if ($service === 'image-to-image' && !empty($options['file'])) {
            $file = $options['file'];
            $filePath = $file->getRealPath();
            $fileContent = file_get_contents($filePath);

            if ($fileContent !== false) {
                $parts[] = [
                    'inline_data' => [
                        'mime_type' => $file->getMimeType(),
                        'data' => base64_encode($fileContent),
                    ],
                ];
            }
        }

        return $parts;
    }

    private function buildGenericData($model, $parts)
    {
        return [
            'model' => $model,
            'contents' => [
                [
                    'parts' => $parts,
                ],
            ],
            'generationConfig' => [
                'responseModalities' => ['TEXT', 'IMAGE'],
            ],
        ];
    }

    public function imageData(): array
    {
        return $this->imageDataOptions();
    }

    public function prepareFile()
    {
        $uploadedFile = $this->data['options']['file'] ?? null;

        if (!is_null($uploadedFile)) {
            $originalFileName = $uploadedFile->getClientOriginalName();
            return new \CURLFile($uploadedFile->getRealPath(), $uploadedFile->getMimeType(), $originalFileName);
        }

        return $uploadedFile;
    }

    public function imagePrompt(): string
    {
        return filteringBadWords("Generate image based on this concept \"" . $this->data['prompt'] . "\". Image art style will be " .  data_get($this->data['options'],'art_style', 'Normal') . " and light effect will be " .  data_get($this->data['options'],'light_effect', 'Normal') );
    }
}
