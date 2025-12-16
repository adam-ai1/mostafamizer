<?php

namespace Modules\OpenAI\AiProviders\StabilityAi\Resources;

class ImageDataProcessor
{
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function rules()
    {
        $aspectRatios = [
            '16:9',
            '1:1',
            '21:9',
            '2:3',
            '3:2',
            '4:5',
            '5:4',
            '9:16',
            '9:21',
        ];

        $artStyle = [
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
        ];

        $commonService = [
            'text-to-image' => [
                'prompt' => true,
                'file' => false,
                'aspect_ratio' => false,
                'size' => true,
                'variant' => true,
                'light_effect' => true,
                'model' => true,
                'art_style' => true,
                'search_prompt' => false,
                'mask' => false,
                'negative_prompt' => false,
                'up' => false,
                'down' => false,
                'left' => false,
                'right' => false,
                'seed' => false,
                'grow_mask' => false
            ],
            'image-to-image' => [
                'prompt' => true,
                'file' => true,
                'aspect_ratio' => false,
                'size' => false,
                'variant' => false,
                'model' => true,
                'light_effect' => true,
                'art_style' => true,
                'negative_prompt' => false,
                'search_prompt' => false,
                'mask' => false,
                'up' => false,
                'down' => false,
                'left' => false,
                'right' => false,
                'seed' => false,
                'grow_mask' => false
            ],
            'upscale-fast' => [
                'prompt' => false,
                'file' => true,
                'aspect_ratio' => false,
                'size' => false,
                'variant' => false,
                'model' => false,
                'negative_prompt' => false,
                'search_prompt' => false,
                'art_style' => true,
                'light_effect' => true,
                'mask' => false,
                'up' => false,
                'down' => false,
                'left' => false,
                'right' => false,
                'seed' => false,
                'grow_mask' => false
            ],
            'upscale-conservative' => [
                'prompt' => true,
                'file' => true,
                'aspect_ratio' => false,
                'size' => false,
                'variant' => false,
                'model' => false,
                'seed' => true,
                'search_prompt' => false,
                'mask' => false,
                'negative_prompt' => true,
                'art_style' => true,
                'light_effect' => true,
                'up' => false,
                'down' => false,
                'left' => false,
                'right' => false,
                'grow_mask' => false
            ],
            'erase' => [
                'prompt' => false,
                'file' => true,
                'aspect_ratio' => false,
                'size' => false,
                'variant' => false, 
                'model' => false,
                'light_effect' => false,
                'art_style' => false,
                'seed' => true,
                'negative_prompt' => false,
                'search_prompt' => false,
                'mask' => false,
                'up' => false,
                'down' => false,
                'left' => false,
                'right' => false,
                'grow_mask' => false
            ],
            'inpaint' => [
                'prompt' => true,
                'file' => true,
                'aspect_ratio' => false,
                'size' => false,
                'variant' => false, 
                'model' => false,
                'light_effect' => false,
                'negative_prompt' => true,
                'mask' => false,
                'seed' => true,
                'art_style' => true,
                'grow_mask' => true,
                'up' => false,
                'down' => false,
                'left' => false,
                'right' => false,
                'search_prompt' => false,
            ],
            'outpaint' => [
                'prompt' => true,
                'file' => true,
                'size' => false,
                'variant' => false, 
                'model' => false,
                'light_effect' => false,
                'art_style' => true,
                'left' => true,
                'right' => true,
                'up' => true,
                'down' => true,
                'seed' => true,
                'search_prompt' => false,
                'mask' => false,
                'negative_prompt' => false,
                'aspect_ratio' => false,
                'grow_mask' => false,
            ],
            'remove-background' => [
                'prompt' => false,
                'file' => true,
                'aspect_ratio' => false,
                'size' => false,
                'variant' => false, 
                'model' => false,
                'light_effect' => false,
                'art_style' => false,
                'search_prompt' => false,
                'mask' => false,
                'negative_prompt' => false,
                'seed' => false,
                'up' => false,
                'down' => false,
                'left' => false,
                'right' => false,
                'grow_mask' => false
            ],
            'sketch' => [
                'prompt' => true,
                'file' => true,
                'size' => false,
                'variant' => false, 
                'model' => false,
                'light_effect' => false,
                'art_style' => true,
                'seed' => true,
                'search_prompt' => false,
                'mask' => false,
                'negative_prompt' => true,
                'up' => false,
                'down' => false,
                'left' => false,
                'right' => false,
                'grow_mask' => false,
                'aspect_ratio' => false,
            ],
            'structure' => [
                'prompt' => true,
                'file' => true,
                'size' => false,
                'variant' => false, 
                'model' => false,
                'light_effect' => false,
                'art_style' => true,
                'seed' => true,
                'search_prompt' => false,
                'mask' => false,
                'negative_prompt' => true,
                'up' => false,
                'down' => false,
                'left' => false,
                'right' => false,
                'grow_mask' => false,
                'aspect_ratio' => false,
            ],
            'search-and-replace' => [
                'prompt' => true,
                'file' => true,
                'size' => false,
                'variant' => false, 
                'model' => false,
                'light_effect' => false,
                'art_style' => true,
                'seed' => true,
                'grow_mask' => true,
                'search_prompt' => true,
                'mask' => false,
                'negative_prompt' => true,
                'aspect_ratio' => false,
                'up' => false,
                'down' => false,
                'left' => false,
                'right' => false,
            ],
            'search-and-recolor' => [
                'prompt' => true,
                'file' => true,
                'size' => false,
                'variant' => false, 
                'model' => false,
                'light_effect' => false,
                'art_style' => true,
                'seed' => true,
                'grow_mask' => true,
                'search_prompt' => true,
                'mask' => false,
                'negative_prompt' => true,
                'aspect_ratio' => false,
                'up' => false,
                'down' => false,
                'left' => false,
                'right' => false,
            ]
        ];

        $additionalService = $commonService;
        $additionalService['text-to-image'] = array_merge(
            $commonService['text-to-image'],
            [
                'aspect_ratio' => true,
                'size' => false,
                'negative_prompt' => true
            ]
        );

        $extraService = $additionalService;
        $extraService['text-to-image']['negative_prompt'] = false;
        
        return [
            'variant' => [
                'stable-diffusion-xl-1024-v1-0' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                'sd3-large' => [1],
                'sd3-large-turbo' => [1],
                'sd3-medium' => [1],
                'sd3.5-large' => [1],
                'sd3.5-large-turbo' => [1],
                'sd3.5-medium' => [1],
                'sd-ultra' => [1],
                'sd-core' => [1],
                'sd3.5-flash' => [1],
            ],
            'size' => [
                'stable-diffusion-xl-1024-v1-0' => [
                    '1024x1024',
                    '1152x896',
                    '896x1152',
                    '1216x832',
                    '1344x768',
                    '768x1344',
                    '1536x640',
                    '640x1536',
                ],
            ],
            'aspect_ratio' => [
                'sd3-large' => $aspectRatios,
                'sd3-large-turbo' => $aspectRatios,
                'sd3-medium' => $aspectRatios,
                'sd3.5-large' => $aspectRatios,
                'sd3.5-large-turbo' => $aspectRatios,
                'sd3.5-medium' => $aspectRatios,
                'sd-ultra' => $aspectRatios,
                'sd-core' => $aspectRatios,
                'sd3.5-flash' => $aspectRatios
            ],
            'art_style' => [
                'stable-diffusion-xl-1024-v1-0' => $artStyle,
                'sd3-large' => $artStyle,
                'sd3-large-turbo' => $artStyle,
                'sd3-medium' => $artStyle,
                'sd3.5-large' => $artStyle,
                'sd3.5-large-turbo' => $artStyle,
                'sd3.5-medium' => $artStyle,
                'sd-ultra' => $artStyle,
                'sd-core' => $artStyle,
                'sd3.5-flash' => $artStyle
            ],
            'service' => [
                'stable-diffusion-xl-1024-v1-0' => $commonService,
                'sd3-large' => $additionalService,
                'sd3-large-turbo' => $extraService,
                'sd3-medium' => $additionalService,
                'sd3.5-large' => $additionalService,
                'sd3.5-large-turbo' => $additionalService,
                'sd3.5-medium' => $additionalService,
                'sd-ultra' => $additionalService,
                'sd-core' => $additionalService,
                'sd3.5-flash' => $additionalService
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
                'value' => 'Stabilityai',
                'visibility' => false
            ],
            [
                'type' => 'dropdown',
                'label' => 'Service',
                'name' => 'service',
                'value' => [
                    'text-to-image',
                    'image-to-image',
                    'upscale-fast',
                    'upscale-conservative',
                    'erase',
                    'inpaint',
                    'outpaint',
                    'remove-background',
                    'sketch',
                    'structure',
                    'search-and-replace',
                    'search-and-recolor'
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
                    'stable-diffusion-xl-1024-v1-0',
                    'sd3-large',
                    'sd3-large-turbo',
                    'sd3-medium',
                    'sd3.5-large',
                    'sd3.5-large-turbo',
                    'sd3.5-medium',
                    'sd-ultra',
                    'sd-core',
                    'sd3.5-flash'
                ],
                'default_value' => 'stable-diffusion-xl-1024-v1-0',
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Variant',
                'name' => 'variant',
                'value' => [
                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10
                ],
                'default_value' => 1,
                'visibility' => true,
                "required" => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Size',
                'name' => 'size',
                'value' => [
                    '1024x1024',
                    '1152x896',
                    '896x1152',
                    '1216x832',
                    '1344x768',
                    '768x1344',
                    '1536x640',
                    '640x1536',
                ],
                'default_value' => '1024x1024',
                'visibility' => true,
                'required' => true
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
                "default_value" => "Normal",
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
                "default_value" => "Normal",
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
                    '4:5',
                    '5:4',
                    '9:16',
                    '9:21',
                ],
                'default_value' => '1:1',
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'number',
                'label' => 'Left',
                'name' => 'left',
                'min' => 0,
                'max' => 2000,
                'value' => 0,
                'visibility' => true,
                'required' => true,
                'tooltip' => 'A specific value from 0 to 10 to express how strongly the video sticks to the original image.',
            ],
            [
                'type' => 'number',
                'label' => 'Right',
                'name' => 'right',
                'min' => 0,
                'max' => 2000,
                'value' => 0,
                'visibility' => true,
                'required' => true,
                'tooltip' => 'A specific value from 0 to 10 to express how strongly the video sticks to the original image.',
            ],
            [
                'type' => 'number',
                'label' => 'Up',
                'name' => 'up',
                'min' => 0,
                'max' => 2000,
                'value' => 0,
                'visibility' => true,
                'required' => true,
                'tooltip' => 'A specific value from 0 to 10 to express how strongly the video sticks to the original image.',
            ],
            [
                'type' => 'number',
                'label' => 'Down',
                'name' => 'down',
                'min' => 0,
                'max' => 2000,
                'value' => 0,
                'visibility' => true,
                'required' => true,
                'tooltip' => 'A specific value from 0 to 10 to express how strongly the video sticks to the original image.',
            ],
            [
                'type' => 'number',
                'label' => 'Seed',
                'name' => 'seed',
                'min' => 0,
                'max' => 4294967294,
                'value' => 0,
                'visibility' => true,
                'required' => true,
                'tooltip' => "A specific value that is used to guide the 'randomness' of the generation.",
            ],
            [
                'type' => 'number',
                'label' => 'Grow Mask',
                'name' => 'grow_mask',
                'min' => 0,
                'max' => 20,
                'value' => 3,
                'visibility' => true,
                'required' => true,
                'tooltip' => 'Grows the edges of the mask outward in all directions by the specified number of pixels. The expanded area around the mask will be blurred, which can help smooth the transition between inpainted content and the original image.',
            ],
            [
                'type' => 'file',
                'label' => 'File',
                'name' => 'file',
                'value' => '',
                'visibility' => true,
            ],
            [
                'type' => 'file',
                'label' => 'Mask',
                'name' => 'mask',
                'value' => '',
                'visibility' => true,
            ],
            [
                'type' => 'textarea',
                'label' => 'Search Prompt',
                'name' => 'search_prompt',
                'value' => 'Short description of what to inpaint in the image',
                'maxlength' => 10000,
                'tooltip_limit' => 150,
                'placeholder' =>  __('Please provide a brief description, it will be displayed on the customer interface. Note that this will be added to the customer panel.'),
                'visibility' => true,
                'required' => true,
            ],
            [
                'type' => 'textarea',
                'label' => 'Negative Prompt',
                'name' => 'negative_prompt',
                'value' => 'Keywords of what you do not wish to see in the output image.',
                'maxlength' => 10000,
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
        $validationRules['prompt'] = 'required_if:options.service,image-to-image,text-to-image,upscale-conservative,outpaint,sketch,search-and-replace,search-and-recolor,inpaint';
        $validationRules['provider'] = 'required';
        $validationRules['options.service'] = 'required';
        $validationRules['options.model'] = 'required|in:stable-diffusion-xl-1024-v1-0,sd3-large,sd3-large-turbo,sd3-medium,sd3.5-large,sd3.5-large-turbo,sd3.5-medium,sd-ultra,sd-core,sd3.5-flash';
        $validationRules['options.file'] = 'nullable|required_if:options.service,image-to-image,outpaint,remove-background,sketch,inpaint|file|mimes:jpeg,png,jpg';
        $validationRules['options.search_prompt'] = 'nullable|required_if:options.service,search-and-replace,search-and-recolor';

        $validationMessage = [
            'provider.required' => __('Provider is required to generate an image.'),
            'options.service.required' => __('Service field is required.'),
            'options.model.required' => __('Model field is required.'),
            'options.model.in' => __('Invalid model. Please select a valid model.'),
            'prompt.required_if' => __('Prompt field is required.'),
            'options.file.required_if' => __('The file field is required.'),
            'options.file.file' => __('The file must be a valid file.'),
            'options.file.mimes' => __('The file must be a JPEG, PNG, or JPG.'),
            'options.search_prompt.required_if' => __('Search Prompt field is required.'),
        ];

        return [
            $validationRules,
            $validationMessage,
        ];
    }

    public function imageDataOptions()
    {
        return [
            'model' => data_get($this->data['options'], 'model', 'stable-diffusion-xl-1024-v1-0'),
            "service" => data_get($this->data['options'], 'service', 'text-to-image'),
            "prompt" => $this->data['prompt'],
            "samples" => data_get($this->data['options'], 'variant', 1),
            "height" => (int) isset($this->data['options']['size']) ? explode("x", $this->data['options']['size'])[1] : '1024',
            "width" => (int) isset($this->data['options']['size']) ? explode("x", $this->data['options']['size'])[0] : '1024',
            'art_style' => data_get($this->data['options'],'art_style', '3d-model'),
            'light_effect' => data_get($this->data['options'],'light_effect', 'Normal'),
            "cfg_scale" => 7,
            "steps" => 30,
            "clip_guidance_preset" => 'FAST_BLUE',
            'image_file' => isset($this->data['options']['file']) ? file_get_contents($this->data['options']['file']) : null,
            'aspect_ratio' => data_get($this->data['options'], 'aspect_ratio', '1:1'),
            'image' => $this->prepareFile('file'),
            'negative_prompt' => data_get($this->data['options'], 'negative_prompt', ''),
            'left' => data_get($this->data['options'], 'left', 0),
            'right' => data_get($this->data['options'], 'right', 0),
            'up' => data_get($this->data['options'], 'up', 0),
            'down' => data_get($this->data['options'], 'down', 0),
            'search_prompt' => data_get($this->data['options'], 'search_prompt', ''),
            'grow_mask' => data_get($this->data['options'], 'grow_mask', 0),
            'mask' => $this->prepareFile('mask'),
            'seed' => data_get($this->data['options'], 'seed', 0),
        ];
    }

    public function imageData(): array
    {
        return $this->imageDataOptions();
    }

    public function prepareFile(string $name)
     {
        $uploadedFile = $this->data['options'][$name] ?? null;

        if (!is_null($uploadedFile)) {
            $originalFileName = $uploadedFile->getClientOriginalName();
            return new \CURLFile($uploadedFile->getRealPath(), $uploadedFile->getMimeType(), $originalFileName);
        }

        return $uploadedFile;
        
     }
}
