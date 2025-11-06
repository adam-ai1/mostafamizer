<?php

namespace Modules\Grok\Resources;

class ImageDataProcessor
{
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function rules()
    {
        return [];
    }

    public function imageOptions(): array
    {
        return [
            [
                "type" => "checkbox",
                "label" => "Provider State",
                "name" => "status",
                "value" => '',
                "visibility" => false
            ],
            [
                "type" => "text",
                "label" => "Provider",
                "name" => "provider",
                "value" => "grok",
                "visibility" => false
            ],
            [
                "type" => "dropdown",
                "label" => "Models",
                "name" => "model",
                "value" => [
                    "grok-2-image-1212",
                ],
                "default_value" => "grok-2-image-1212",
                "visibility" => true,
                "required" => true,
            ],
            [
                "type" => "dropdown",
                "label" => "Variant",
                "name" => "variant",
                "value" => [
                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10
                ],
                "default_value" => 1,
                "visibility" => true,
                "required" => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Aspect Ratio',
                'name' => 'aspect_ratio',
                'value' => [
                    '1:1',
                ],
                'default_value' => '1:1',
                'visibility' => true,
                'required' => true
            ],
            [
                "type" => "dropdown",
                "label" => "Art Style",
                "name" => "art_style",
                "value" => [
                    'Normal',
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
                    'Tile Texture',
                    'Water Color'
                ],
                "default" => "Normal",
                "visibility" => true,
                "required" => true,
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
                "default_value" => "Normal",
                "visibility" => true,
                "required" => true,
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
        ];
    }

    /**
     * Retrieve the validation rules for the current data processor.
     * 
     * @return array An array of validation rules.
     */
    public function validationRules()
    {
        $validationRules['provider'] = 'required';
        $validationRules['prompt'] = 'required';
        $validationRules['options.model'] = 'required|in:grok-2-image-1212';
        $validationRules['options.variant'] = 'required|numeric|min:1|max:10';

        $validationMessage = [
            'provider.required' => __('Provider is required for generate image.'),
            'prompt.required' => __('Please enter a prompt to generate an image.'),
            'options.model.required' => __('Model field is required.'),
            'options.model.in' => __('Invalid model. Please select a valid model.'),
            'options.mvariant.required' => __('Variant field is required.'),
        ];

        return [
            $validationRules,
            $validationMessage
        ];
    }

    public function imageDataOptions()
    {
        return [
            "model" => data_get($this->data, 'options.model', 'grok-2-image-1212'),
            "prompt" => $this->imagePrompt(),
            "n" => (int) data_get($this->data, 'options.variant', 1),
            'response_format' => 'b64_json'
        ];
    }

    public function imageData(): array
    {
        return $this->imageDataOptions();
    }

    public function imagePrompt(): string
    {
        return filteringBadWords("Generate image based on this concept \"" . $this->data['prompt'] . "\"." . 
                (!empty($this->data['options']['art_style']) && !empty($this->data['options']['light_effect']) 
                    ? " Image art style will be " . $this->data['options']['art_style'] . " and light effect will be " . $this->data['options']['light_effect'] 
                    : '')
                );  

    }
}
