<?php

namespace Modules\FalAi\Resources;

class ImageDataProcessor
{
    private $data = [];

    private $imageFileName = null;

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function rules()
    {
        $generalArtStyle = [
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
            'Water Color',
            'Auto',
            'General',
            'Realistic',
            'Design'
        ];

        $ideogramArtStyle = [
            'Auto',
            'General',
            'Realistic',
            'Design',
            '3D Model',
            'Anime'
        ];

        $generalVariant = [ 1, 2, 3, 4];
        $playgroundVariant = [1, 2, 3, 4, 5, 6, 7, 8];

       return [
        'guidance_scale' => [
            'flux-pro-new' => [
                'min' => 1,
                'max' => 20
            ],
            'flux-pro-v1.1' => [],
            'flux-pro-v1.1-ultra' => [],
            'flux-dev' => [
                'min' => 1,
                'max' => 20
            ],
            'flux-schnell' => [],
            'flux-schnell-redux' => [],
            'ideogram-v2' => [],
            'ideogram-v2-turbo' => [],
            'ideogram-v2a' => [],
            'ideogram-v2a-turbo' => [],
            'playground-v25' => [
                'min' => 1,
                'max' => 20
            ],
            'flux-kontext-lora' => [
                'min' => 1,
                'max' => 20
            ],
            'flux-pro-kontext'  => [
                'min' => 1,
                'max' => 20
            ],
            'flux-pro-kontext-max'  => [
                'min' => 1,
                'max' => 20
            ]
        ],
        'num_inference_steps' => [
            'flux-pro-new' => [
                'min' => 1,
                'max' => 50
            ],
            'flux-pro-v1.1' => [],
            'flux-pro-v1.1-ultra' => [],
            'flux-dev' => [
                'min' => 1,
                'max' => 50
            ],
            'flux-schnell' => [
                'min' => 1,
                'max' => 12
            ],
            'flux-schnell-redux' => [
                'min' => 1,
                'max' => 12
            ],
            'ideogram-v2' => [],
            'ideogram-v2-turbo' => [],
            'ideogram-v2a' => [],
            'ideogram-v2a-turbo' => [],
            'playground-v25' => [
                'min' => 1,
                'max' => 50
            ],
            'flux-kontext-lora' => [
                'min' => 1,
                'max' => 30
            ],
            'flux-pro-kontext'  => [ 
            ],
            'flux-pro-kontext-max'  => [
            ]
        ],
        'strength' => [
            'flux-pro-new' => [],
            'flux-pro-v1.1' => [],
            'flux-pro-v1.1-ultra' => [],
            'flux-dev' => [
                'min' => 0.1,
                'max' => 1,
                'step' => 0.05
            ],
            'flux-schnell' => [],
            'flux-schnell-redux' => [],
            'ideogram-v2' => [],
            'ideogram-v2-turbo' => [],
            'ideogram-v2a' => [],
            'ideogram-v2a-turbo' => [],
            'playground-v25' => [
                'min' => 0,
                'max' => 1,
                'step' => 0.05
            ],
            'flux-kontext-lora' => [
                'min' => 0,
                'max' => 1,
                'step' => 0.1
            ]
        ],
        'aspect_ratio' => [
            'flux-pro-new' => [],
            'flux-pro-v1.1' => [],
            'flux-pro-v1.1-ultra' => [
                '1:1',
                '16:9',
                '21:9',
                '2:3',
                '3:2',
                '3:4',
                '4:3',
                '9:16',
                '9:21',
            ],
            'flux-dev' => [],
            'flux-schnell' => [],
            'flux-schnell-redux' => [],
            'ideogram-v2' => [
                '10:16', 
                '16:10', 
                '9:16', 
                '16:9', 
                '4:3', 
                '3:4', 
                '1:1', 
                '1:3', 
                '3:1', 
                '3:2', 
                '2:3'
            ],
            'ideogram-v2-turbo' => [
                '10:16', 
                '16:10', 
                '9:16', 
                '16:9', 
                '4:3', 
                '3:4', 
                '1:1', 
                '1:3', 
                '3:1', 
                '3:2', 
                '2:3'
            ],
            'ideogram-v2a' => [
                '10:16', 
                '16:10', 
                '9:16', 
                '16:9', 
                '4:3', 
                '3:4', 
                '1:1', 
                '1:3', 
                '3:1', 
                '3:2', 
                '2:3'
            ],
            'ideogram-v2a-turbo' => [
                '10:16', 
                '16:10', 
                '9:16', 
                '16:9', 
                '4:3', 
                '3:4', 
                '1:1', 
                '1:3', 
                '3:1', 
                '3:2', 
                '2:3'
            ],
            'playground-v25' => [],
            'imagen4-preview' => [
                '1:1',
                '3:4',
                '4:3',
                '9:16',
                '16:9',
            ],
            'imagen4-preview-ultra' => [
                '1:1',
                '3:4',
                '4:3',
                '9:16',
                '16:9',
            ],
            'imagen4-preview-fast' => [
                '1:1',
                '3:4',
                '4:3',
                '9:16',
                '16:9',
            ],
            'flux-pro-kontext' => [
                '1:1',
                '16:9',
                '21:9',
                '2:3',
                '3:2',
                '3:4',
                '4:3',
                '9:16',
                '9:21',
            ],
            'flux-pro-kontext-max' => [
                '1:1',
                '16:9',
                '21:9',
                '2:3',
                '3:2',
                '3:4',
                '4:3',
                '9:16',
                '9:21',
            ],
        ],
        'size' => [
            'flux-pro-new' => [
                "512x512",
                "1024x1024",
                "768x1024",
                "576x1024",
                "1024x768",
                "1024x576"
            ],
            'flux-pro-v1.1' => [
                '512x512',
                '1024x1024',
                '768x1024',
                '576x1024',
                '1024x768',
                '1024x576',
            ],
            'flux-pro-v1.1-ultra' => [],
            'flux-dev' => [
                '512x512',
                '1024x1024',
                '768x1024',
                '576x1024',
                '1024x768',
                '1024x576',
            ],
            'flux-schnell' => [
                '512x512',
                '1024x1024',
                '768x1024',
                '576x1024',
                '1024x768',
                '1024x576',
            ],
            'flux-schnell-redux' => [
                '512x512',
                '1024x1024',
                '768x1024',
                '576x1024',
                '1024x768',
                '1024x576',
            ],
            'ideogram-v2' => [],
            'ideogram-v2-turbo' => [],
            'ideogram-v2a' => [],
            'ideogram-v2a-turbo' => [],
            'playground-v25' => [
                '512x512',
                '1024x1024',
                '768x1024',
                '576x1024',
                '1024x768',
                '1024x576',
            ],
            'flux-kontext-lora' => [
                "512x512",
                "1024x1024",
                "768x1024",
                "576x1024",
                "1024x768",
                "1024x576"
            ],
            'flux-pro-kontext' => [
            ],
            'flux-pro-kontext-max' => [
            ]
        ],
        'enable_safety_checker' => [
            'flux-pro-new' => [],
            'flux-pro-v1.1' => [
                'Yes',
                'No'
            ],
            'flux-pro-v1.1-ultra' => [
                'Yes',
                'No'
            ],
            'flux-dev' => [
                'Yes',
                'No'
            ],
            'flux-schnell' => [
                'Yes',
                'No'
            ],
            'flux-schnell-redux' => [
                'Yes',
                'No'
            ],
            'ideogram-v2' => [],
            'ideogram-v2-turbo' => [],
            'ideogram-v2a' => [],
            'ideogram-v2a-turbo' => [],
            'playground-v25' => [
                'Yes',
                'No'
            ],
            'flux-kontext-lora' => [
                'Yes',
                'No'
            ],
            'flux-pro-kontext' => [
            ],
            'flux-pro-kontext-max' => [
            ]
        ],
        'service' => [
            'flux-pro-new' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => true,
                    'variant' => true,
                    'guidance_scale' => true,
                    'num_inference_steps' => true,
                    'strength' => false,
                    'negative_prompt' => false,
                    'model' => true,
                    'enable_safety_checker' => false,
                    'aspect_ratio' => false,
                    'art_style' => true,
                    'light_effect' => true
                ],
            ],
            'flux-pro-v1.1' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => true,
                    'variant' => true,
                    'guidance_scale' => false,
                    'num_inference_steps' => false,
                    'strength' => false,
                    'negative_prompt' => false,
                    'model' => true,
                    'enable_safety_checker' => true,
                    'aspect_ratio' => false,
                    'art_style' => true,
                    'light_effect' => true,

                ],
            ],
            'flux-pro-v1.1-ultra' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => false,
                    'variant' => true,
                    'guidance_scale' => false,
                    'num_inference_steps' => false,
                    'strength' => false,
                    'negative_prompt' => false,
                    'aspect_ratio' => true,
                    'enable_safety_checker' => true,
                    'art_style' => true,
                    'light_effect' => true,
                    'model' => true,
                ],
            ],
            'flux-dev' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => true,
                    'variant' => true,
                    'guidance_scale' => true,
                    'num_inference_steps' => true,
                    'strength' => false,
                    'negative_prompt' => false,
                    'aspect_ratio' => false,
                    'enable_safety_checker' => true,
                    'art_style' => true,
                    'light_effect' => true,
                    'model' => true,
                ],
                'image-to-image' => [
                    'prompt' => true,
                    'file' => true,
                    'size' => false,
                    'strength' => true,
                    'negative_prompt' => false,
                    'guidance_scale' => true,
                    'num_inference_steps' => true,
                    'aspect_ratio' => false,
                    'enable_safety_checker' => true,
                    'variant' => true,
                    'art_style' => true,
                    'light_effect' => true,
                    'model' => true,
                ],
            ],
            'flux-schnell' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => true,
                    'variant' => true,
                    'guidance_scale' => true,
                    'num_inference_steps' => true,
                    'strength' => false,
                    'light_effect' => true,
                    'negative_prompt' => false,
                    'aspect_ratio' => false,
                    'enable_safety_checker' => true,
                    'art_style' => true,
                    'model' => true,
                ],
            ],
            'flux-schnell-redux' => [
                'image-to-image' => [
                    'prompt' => false,
                    'file' => true,
                    'size' => false,
                    'strength' => false,
                    'art_style' => false,
                    'light_effect' => false,
                    'negative_prompt' => false,
                    'num_inference_steps' => true,
                    'guidance_scale' => false,
                    'aspect_ratio' => false,
                    'enable_safety_checker' => true,
                    'variant' => true,
                    'model' => true,
                ],
            ],
            'ideogram-v2' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'variant' => false,
                    'light_effect' => true,
                    'negative_prompt' => false,
                    'num_inference_steps' => false,
                    'guidance_scale' => false,
                    'strength' => false,
                    'aspect_ratio' => true,
                    'size' => false,
                    'enable_safety_checker' => false,
                    'art_style' => true,
                    'model' => true,
                ],
            ],
            'ideogram-v2-turbo' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'variant' => false,
                    'light_effect' => true,
                    'negative_prompt' => false,
                    'num_inference_steps' => false,
                    'guidance_scale' => false,
                    'strength' => false,
                    'aspect_ratio' => true,
                    'size' => false,
                    'enable_safety_checker' => false,
                    'art_style' => true,
                    'model' => true,
                ],
            ],
            'ideogram-v2a' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'variant' => false,
                    'light_effect' => true,
                    'negative_prompt' => false,
                    'num_inference_steps' => false,
                    'guidance_scale' => false,
                    'strength' => false,
                    'aspect_ratio' => true,
                    'size' => false,
                    'enable_safety_checker' => false,
                    'art_style' => true,
                    'model' => true,
                ],
            ],
            'ideogram-v2a-turbo' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => true,
                    'variant' => false,
                    'light_effect' => true,
                    'negative_prompt' => false,
                    'num_inference_steps' => false,
                    'guidance_scale' => false,
                    'strength' => false,
                    'aspect_ratio' => true,
                    'size' => false,
                    'enable_safety_checker' => false,
                    'art_style' => true,
                    'model' => true,
                ],
            ],
            'playground-v25' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => true,
                    'variant' => true,
                    'guidance_scale' => true,
                    'num_inference_steps' => true,
                    'strength' => false,
                    'light_effect' => true,
                    'negative_prompt' => true,
                    'art_style' => true,
                    'aspect_ratio' => false,
                    'enable_safety_checker' => false,
                    'model' => true,
                ],
                'image-to-image' => [
                    'prompt' => true,
                    'file' => true,
                    'size' => false,
                    'strength' => true,
                    'negative_prompt' => true,
                    'light_effect' => true,
                    'art_style' => true,
                    'guidance_scale' => true,
                    'num_inference_steps' => true,
                    'variant' => true,
                    'aspect_ratio' => false,
                    'enable_safety_checker' => false,
                    'model' => true,
                ],
            ],
            'imagen4-preview' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => false,
                    'variant' => true,
                    'guidance_scale' => false,
                    'num_inference_steps' => false,
                    'strength' => false,
                    'light_effect' => false,
                    'negative_prompt' => true,
                    'art_style' => true,
                    'aspect_ratio' => true,
                    'enable_safety_checker' => false,
                    'model' => true,
                ],
            ],
            'imagen4-preview-ultra' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => false,
                    'variant' => true,
                    'guidance_scale' => false,
                    'num_inference_steps' => false,
                    'strength' => false,
                    'light_effect' => false,
                    'negative_prompt' => true,
                    'art_style' => true,
                    'aspect_ratio' => true,
                    'enable_safety_checker' => false,
                    'model' => true,
                ],
            ],
            'imagen4-preview-fast' => [
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => false,
                    'variant' => true,
                    'guidance_scale' => false,
                    'num_inference_steps' => false,
                    'strength' => false,
                    'light_effect' => false,
                    'negative_prompt' => true,
                    'art_style' => true,
                    'aspect_ratio' => true,
                    'enable_safety_checker' => false,
                    'model' => true,
                ],
            ],
            'flux-kontext-lora' => [
                'image-to-image' => [
                    'prompt' => true,
                    'file' => true,
                    'file' => true,
                    'size' => false,
                    'variant' => true,
                    'guidance_scale' => true,
                    'num_inference_steps' => true,
                    'strength' => true,
                    'light_effect' => false,
                    'negative_prompt' => false,
                    'art_style' => false,
                    'aspect_ratio' => false,
                    'enable_safety_checker' => true,
                    'model' => true,
                ],
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => true,
                    'variant' => true,
                    'guidance_scale' => true,
                    'num_inference_steps' => true,
                    'strength' => false,
                    'light_effect' => false,
                    'negative_prompt' => false,
                    'art_style' => false,
                    'aspect_ratio' => false,
                    'enable_safety_checker' => true,
                    'model' => true,
                ],
            ],
            'flux-pro-kontext' => [
                'image-to-image' => [
                    'prompt' => true,
                    'file' => true,
                    'size' => false,
                    'variant' => true,
                    'guidance_scale' => true,
                    'num_inference_steps' => false,
                    'strength' => false,
                    'light_effect' => false,
                    'negative_prompt' => false,
                    'art_style' => false,
                    'aspect_ratio' => true,
                    'enable_safety_checker' => false,
                    'model' => true,
                ],
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => false,
                    'variant' => true,
                    'guidance_scale' => true,
                    'num_inference_steps' => false,
                    'strength' => false,
                    'light_effect' => false,
                    'negative_prompt' => false,
                    'art_style' => false,
                    'aspect_ratio' => true,
                    'enable_safety_checker' => false,
                    'model' => true,
                ],
            ],
            'flux-pro-kontext-max' => [
                'image-to-image' => [
                    'prompt' => true,
                    'file' => true,
                    'size' => false,
                    'variant' => true,
                    'guidance_scale' => true,
                    'num_inference_steps' => false,
                    'strength' => false,
                    'light_effect' => false,
                    'negative_prompt' => false,
                    'art_style' => false,
                    'aspect_ratio' => true,
                    'enable_safety_checker' => false,
                    'model' => true,
                ],
                'text-to-image' => [
                    'prompt' => true,
                    'file' => false,
                    'size' => false,
                    'variant' => true,
                    'guidance_scale' => true,
                    'num_inference_steps' => false,
                    'strength' => false,
                    'light_effect' => false,
                    'negative_prompt' => false,
                    'art_style' => false,
                    'aspect_ratio' => true,
                    'enable_safety_checker' => false,
                    'model' => true,
                ],
            ],
        ],
        'art_style' => [
            'flux-pro-new' => $generalArtStyle,
            'flux-pro-v1.1' => $generalArtStyle,
            'flux-pro-v1.1-ultra' => $generalArtStyle,
            'flux-dev' => $generalArtStyle,
            'flux-schnell' => $generalArtStyle,
            'flux-schnell-redux' => $generalArtStyle,
            'ideogram-v2' => $ideogramArtStyle,
            'ideogram-v2-turbo' => $ideogramArtStyle,
            'ideogram-v2a' => $ideogramArtStyle,
            'ideogram-v2a-turbo' => $ideogramArtStyle,
            'playground-v25' => $generalArtStyle
        ],
        'variant' => [
            'flux-pro-new' => $generalVariant,
            'flux-pro-v1.1' => $generalVariant,
            'flux-pro-v1.1-ultra' => $generalVariant,
            'flux-dev' => $generalVariant,
            'flux-schnell' => $generalVariant,
            'flux-schnell-redux' => $generalVariant,
            'ideogram-v2' => $generalVariant,
            'ideogram-v2-turbo' => $generalVariant,
            'ideogram-v2a' => $generalVariant,
            'ideogram-v2a-turbo' => $generalVariant,
            'playground-v25' => $playgroundVariant,
            'imagen4-preview' => $generalVariant,
            'imagen4-preview-ultra' => [1],
            'imagen4-preview-fast' => $generalVariant,
            'flux-kontext-lora' => $generalVariant,
            'flux-pro-kontext' => $generalVariant,
            'flux-pro-kontext-max' => $generalVariant
        ],
        'guidance_rescale' => [
            'flux-pro-new' => [],
            'flux-pro-v1.1' => [],
            'flux-pro-v1.1-ultra' => [],
            'flux-dev' => [],
            'flux-schnell' => [],
            'flux-schnell-redux' => [],
            'ideogram-v2' => [],
            'ideogram-v2-turbo' => [],
            'ideogram-v2a' => [],
            'ideogram-v2a-turbo' => [],
            'playground-v25' => [],
            'imagen4-preview' => [],
            'imagen4-preview-ultra' => [],
            'imagen4-preview-fast' => [],
            'flux-kontext-lora' => [],
            'flux-pro-kontext' => [],
            'flux-pro-kontext-max' => [],
        ]
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
                'value' => 'FalAi',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Service',
                'name' => 'service',
                'value' => [
                    'text-to-image',
                    'image-to-image',
                ],
                'visibility' => true,
                'default_value' => 'text-to-image',
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'flux-pro-new',
                    'flux-pro-v1.1',
                    'flux-pro-v1.1-ultra',
                    'flux-dev',
                    'flux-schnell',
                    'flux-schnell-redux',
                    'ideogram-v2',
                    'ideogram-v2-turbo',
                    'ideogram-v2a',
                    'ideogram-v2a-turbo',
                    'playground-v25',
                    'imagen4-preview',
                    'imagen4-preview-ultra',
                    'imagen4-preview-fast',
                    'flux-kontext-lora',
                    'flux-pro-kontext',
                    'flux-pro-kontext-max',
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Variant',
                'name' => 'variant',
                'value' => [
                    1, 2, 3, 4, 5, 6, 7, 8
                ],
                'visibility' => true,
                'required' => true,
            ],
            [
                "type" => "dropdown",
                "label" => "Size",
                "name" => "size",
                "value" => [
                    "512x512",
                    "1024x1024",
                    "768x1024",
                    "576x1024",
                    "1024x768",
                    "1024x576"
                ],
                "visibility" => true,
                "required" => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Aspect Ratio',
                'name' => 'aspect_ratio',
                'value' => [
                    '1:1',
                    '16:9',
                    '21:9',
                    '2:3',
                    '3:2',
                    '3:4',
                    '4:3',
                    '9:16',
                    '9:21',
                    '10:16', 
                    '16:10',  
                    '1:3', 
                    '3:1',
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
                    'Water Color',
                    'Auto',
                    'General',
                    'Realistic',
                    'Design'
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
            [
                "type" => "dropdown",
                "label" => "Enable Safety Checker",
                "name" => "enable_safety_checker",
                "value" => [
                    'Yes',
                    'No',
                ],
                "default_value" => "Yes",
                "visibility" => true,
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
            [
                'type' => 'textarea',
                'label' => 'Negative Prompt',
                'name' => 'negative_prompt',
                'value' => 'Keywords of what you do not wish to see in the output image.',
                'maxlength' => 10000,
                'tooltip_limit' => 150,
                'placeholder' => 'Please provide a brief description, it will be displayed on the customer interface. Note that this will be added to the customer panel.',
                'visibility' => true,
            ],
            [
                "type" => "slider",
                "label" => "Number Inference Steps",
                "name" => "num_inference_steps",
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'value' => 28,
                'tooltip' => 'The number of inference steps to perform.',
                "visibility" => true,
                "required" => true,
            ],
            [
                "type" => "slider",
                "label" => "Guidance Scale",
                "name" => "guidance_scale",
                'min' => 1,
                'max' => 20,
                'step' => 0.5,
                'value' => 4,
                'tooltip' => 'The CFG (Classifier Free Guidance) scale is a measure of how close you want the model to stick to your prompt when looking for a related image to show you.',
                "visibility" => true,
                "required" => true,
            ],
            [
                "type" => "slider",
                "label" => "Strength",
                "name" => "strength",
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'value' => 0.95,
                'tooltip' => 'The strength of the initial image. Higher strength values are better for this model.',
                "visibility" => true,
                "required" => true,
            ],
            [
                "type" => "slider",
                "label" => "Guidance Rescale",
                "name" => "guidance_rescale",
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'value' => 0,
                'tooltip' => 'The rescale factor for the CFG.',
                "visibility" => true,
                "required" => true,
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
        $validationRules['prompt'] = 'required_if:options.model,flux-pro-new,flux-pro-v1.1,flux-pro-v1.1-ultra,flux-dev,flux-schnell,ideogram-v2,ideogram-v2-turbo,ideogram-v2a,ideogram-v2a-turbo,playground-v25,imagen4-preview-ultra,imagen4-preview-fast,flux-pro-kontext,flux-pro-kontext-max,flux-kontext-lora';
        $validationRules['options.model'] = 'required|in:flux-pro-new,flux-pro-v1.1,flux-pro-v1.1-ultra,flux-dev,flux-schnell,flux-schnell-redux,ideogram-v2,ideogram-v2-turbo,ideogram-v2a,ideogram-v2a-turbo,playground-v25,imagen4-preview,imagen4-preview-ultra,imagen4-preview-fast,flux-pro-kontext,flux-pro-kontext-max,flux-kontext-lora';
        $validationMessage = [
            'provider.required' => __('Provider is required for generate image.'),
            'prompt.required' => __('Please enter a prompt to generate an image.'),
            'options.model.required' => __('Model field is required.'),
            'options.model.in' => __('Invalid model. Please select a valid model.'),
        ];

        return [
            $validationRules,
            $validationMessage
        ];
    }

    public function imageDataOptions()
    {
        $options = $this->data['options'];
        $model = data_get($options, 'model', 'flux-pro-new');
        $service = data_get($options, 'service', 'text-to-image');
        $size = $this->filterSize(data_get($options, 'size', '512x512'));
        $prompt = $this->imagePrompt();
        $variant = data_get($options, 'variant', 1);
        $aspectRatio = data_get($options, 'aspect_ratio', '1:1');
        $guidanceScale = data_get($options, 'guidance_scale', 3.5);
        $inferenceSteps = data_get($options, 'num_inference_steps', 28);
        $enableSafetyChecker = data_get($options, 'enable_safety_checker', 'Yes') === 'Yes';
        $strength = data_get($options, 'strength', 0.95);
        $negativePrompt = data_get($options, 'negative_prompt', '');

        $guidanceRescale = data_get($options, 'guidance_rescale', 0);
        // Common base payload
        $basePayload = [
            "num_images" => $variant
        ];

        // Model-specific payloads
        switch ($model) {
            case 'flux-pro-new':
                return array_merge($basePayload, [
                    "prompt" => $prompt,
                    "image_size" => $size,
                    "num_inference_steps" => $inferenceSteps,
                    "guidance_scale" => $guidanceScale
                ]);

            case 'flux-pro-v1.1':
                return array_merge($basePayload, [
                    "prompt" => $prompt,
                    "image_size" => $size,
                    "enable_safety_checker" => $enableSafetyChecker
                ]);

            case 'flux-pro-v1.1-ultra':
                return array_merge($basePayload, [
                    "prompt" => $prompt,
                    "image_size" => $size,
                    "aspect_ratio" => $aspectRatio,
                    "enable_safety_checker" => $enableSafetyChecker
                ]);

            case 'flux-dev':

                if ($service === 'image-to-image') {
                    $imageUrl = objectStorage()->url($this->data['uploaded_file_name']);
                
                    return array_merge($basePayload, [
                        "prompt" => $prompt,
                        "image_url" => $imageUrl,
                        "aspect_ratio" => $aspectRatio,
                        "enable_safety_checker" => $enableSafetyChecker,
                        "guidance_scale" => $guidanceScale,
                        "num_inference_steps" => $inferenceSteps,
                        "strength" => $strength
                    ]);
                }

                return array_merge($basePayload, [
                    "prompt" => $prompt,
                    "aspect_ratio" => $aspectRatio,
                    "enable_safety_checker" => $enableSafetyChecker,
                    "guidance_scale" => $guidanceScale,
                    "num_inference_steps" => $inferenceSteps
                ]);

            case 'flux-schnell':
                return array_merge($basePayload, [
                    "prompt" => $prompt,
                    "image_size" => $size,
                    "enable_safety_checker" => $enableSafetyChecker,
                    "num_inference_steps" => $inferenceSteps
                ]);

            case 'flux-schnell-redux':
                $imageUrl = objectStorage()->url($this->data['uploaded_file_name']);

                return array_merge($basePayload, [
                    "image_url" => $imageUrl,
                    "image_size" => $size,
                    "enable_safety_checker" => $enableSafetyChecker,
                    "num_inference_steps" => (int) $inferenceSteps
                ]);

            case 'ideogram-v2':
                return [
                    'prompt' => $prompt,
                    'aspect_ratio' => $aspectRatio,
                    'expand_prompt' => true,
                    'style' => $this->filterArtStyle(data_get($options, 'art_style', 'auto')),
                ];
            
            case 'ideogram-v2-turbo':
                return [
                    'prompt' => $prompt,
                    'aspect_ratio' => $aspectRatio,
                    'expand_prompt' => true,
                    'style' => $this->filterArtStyle(data_get($options, 'art_style', 'auto')),
                ];
            
            case 'ideogram-v2a':
                return [
                    'prompt' => $prompt,
                    'aspect_ratio' => $aspectRatio,
                    'expand_prompt' => true,
                    'style' => $this->filterArtStyle(data_get($options, 'art_style', 'auto')),
                ];

            case 'ideogram-v2a-turbo':
                return [
                    'prompt' => $prompt,
                    'aspect_ratio' => $aspectRatio,
                    'expand_prompt' => true,
                    'style' => $this->filterArtStyle(data_get($options, 'art_style', 'auto')),
                ];
            
            case 'playground-v25':
                
                if ($service === 'image-to-image') {
                    $imageUrl = objectStorage()->url($this->data['uploaded_file_name']);
                
                    return array_merge($basePayload, [
                        "image_url" => $imageUrl,
                        "prompt" => $prompt,
                        "negative_prompt" => $negativePrompt,
                        "image_size" => $size,
                        "num_inference_steps" => $inferenceSteps,
                        "guidance_scale" => $guidanceScale,
                        "strength" => $strength,
                        "num_images" => $variant,
                        "embeddings" => [],
                        "enable_safety_checker" => $enableSafetyChecker,
                        "guidance_rescale" => $guidanceRescale,
                    ]);
                }

                return array_merge($basePayload, [
                    "prompt" => $prompt,
                    "negative_prompt" => $negativePrompt,
                    "image_size" => $size,
                    "num_inference_steps" => $inferenceSteps,
                    "enable_safety_checker" => $enableSafetyChecker,
                    "guidance_scale" => $guidanceScale,
                    "num_images" => $variant,
                    "guidance_rescale" => $guidanceRescale,
                    "embeddings" => [],
                ]);

                case 'imagen4-preview':
                case 'imagen4-preview-fast':
                case 'imagen4-preview-ultra':
                    return [
                        'prompt'           => $prompt,
                        'negative_prompt'  => $negativePrompt,
                        'aspect_ratio'     => $aspectRatio,
                        'num_images'       => $variant,
                    ];

                case 'flux-kontext-lora':
                    if ($service === 'image-to-image') {
                        $imageUrl = objectStorage()->url($this->data['uploaded_file_name']);
                        return array_merge($basePayload, [
                            "image_url" => $imageUrl,
                            "prompt" => $prompt,
                            "num_inference_steps" => $inferenceSteps,
                            "guidance_scale" => $guidanceScale,
                            "num_images" => $variant,
                            "output_format" => "png",
                            "enable_safety_checker" => $enableSafetyChecker,
                            "strength" => $strength
                        ]);
                    } else {
                        return array_merge($basePayload, [
                            "prompt" => $prompt,
                            "image_size" => $size,
                            "num_inference_steps" => $inferenceSteps,
                            "guidance_scale" => $guidanceScale,
                            "num_images" => $variant,
                            "enable_safety_checker" => $enableSafetyChecker,
                            "output_format" => "png"
                        ]);
                    }

                case 'flux-pro-kontext':
                case 'flux-pro-kontext-max':
                    if ($service === 'image-to-image') {
                        $imageUrl = objectStorage()->url($this->data['uploaded_file_name']);
                        return array_merge($basePayload, [
                            "prompt" => $prompt,
                            "guidance_scale" => $guidanceScale,
                            "num_images" => $variant,
                            "output_format" => "png",
                            'aspect_ratio' => $aspectRatio,
                            "image_url" => $imageUrl,
                        ]);
                    } else {
                        return array_merge($basePayload, [
                            "prompt" => $prompt,
                            "guidance_scale" => $guidanceScale,
                            "num_images" => $variant,
                            "output_format" => "png",
                            'aspect_ratio'     => $aspectRatio,
                        ]);
                    }

            default:
                // Optionally handle unsupported model types
                return [];
        }
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

    /**
     * Generates a descriptive prompt for image generation.
     *
     * This function constructs a string prompt that includes the main concept
     * from the provided data, as well as optional styling options such as
     * art style and light effect. The prompt is processed to filter out any
     * inappropriate language.
     *
     * @return string A filtered descriptive prompt for image generation.
     */
    public function imagePrompt(): string
    {
        return filteringBadWords("Generate image based on this concept \"" . $this->data['prompt'] . "\". Image art style will be " .  data_get($this->data['options'],'art_style', 'Normal') . " and light effect will be " .  data_get($this->data['options'],'light_effect', 'Normal') );
    }


    /**
     * Filters the given size key and returns the corresponding image size configuration.
     *
     * @param string $size The size key to filter.
     * @return string The image size configuration associated with the given size key,
     *                or 'square_hd' if the size key is not found in the configuration.
     */
    private function filterSize($size)
    {
        return moduleConfig('falai.imagemaker.size')[$size] ?? 'square_hd';
    }

    /**
     * Finds provider data by searching for a specific key within an array.
     *
     * @param array $data An array of data to search through.
     * @param string $searchKey The key to search for within the data array.
     * @param bool $returnKey Optional. If true, returns the key associated with the found value; 
     *                        otherwise, returns the value itself. Defaults to true.
     * @param array $options Optional. Additional options for future extensions.
     * 
     * @return string|null Returns the key or value associated with the search key, or null if not found.
     */

    public function findProviderData(array $data, string $searchKey, bool $returnKey = true, array $options = []): ?string
    {
        foreach ($data as $key => $values) {
            if (array_key_exists($searchKey, $values)) {
                return $returnKey ? $key : $values[$searchKey];
            }
        }
        return null;
    }

    /**
     * Filters the given art style key and returns the corresponding art style configuration.
     *
     * @param string $style The art style key to filter.
     * @return string The art style configuration associated with the given style key, or 'auto' if the style key is not found in the configuration.
     */
    private function filterArtStyle($style)
    {
        return moduleConfig('falai.imagemaker.art_style')[$style] ?? 'auto';
    }
}
