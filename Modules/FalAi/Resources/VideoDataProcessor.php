<?php

namespace Modules\FalAi\Resources;
use App\Rules\CheckValidFile;

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
            'service' => [
                'kling-video-v1-pro' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'end_image' => false,
                        'tail_image' => false,
                        'cfg_scale' => true,
                    ],
                ],
                'kling-video-v1-standard' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'end_image' => false,
                        'tail_image' => false,
                        'cfg_scale' => true,
                    ],
                ],
                'kling-video-v1.5-pro' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'end_image' => false,
                        'tail_image' => false,
                        'cfg_scale' => true,
                    ],
                ],
                'kling-video-v1.6-pro' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'end_image' => false,
                        'tail_image' => false,
                        'cfg_scale' => true,
                    ],
                ],
                'kling-video-v1.6-standard' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'end_image' => false,
                        'tail_image' => false,
                        'cfg_scale' => true,
                    ],
                ],
                'kling-video-v2-master' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'end_image' => false,
                        'tail_image' => false,
                        'cfg_scale' => true,
                    ],
                ],
                'kling-video-v2.1-master' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'end_image' => false,
                        'tail_image' => false,
                        'cfg_scale' => true,
                    ],
                ],
                'kling-video-v2.1-pro' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'end_image' => false,
                        'tail_image' => false,
                        'cfg_scale' => true,
                    ],
                ],
                'kling-video-v2.1-standard' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'end_image' => false,
                        'tail_image' => false,
                        'cfg_scale' => true,
                    ],
                ],
                'minimax-video-01' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'tail_image' => false,
                        'cfg_scale' => false,
                        'end_image' => false
                    ]
                ],
                'minimax-hailuo02-pro' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'tail_image' => false,
                        'cfg_scale' => false,
                        'end_image' => false
                    ]
                ],
                'minimax-hailuo02-standard' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'tail_image' => false,
                        'cfg_scale' => false,
                        'end_image' => false
                    ]
                ],
                'luma-dream-machine' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'tail_image' => false,
                        'cfg_scale' => false,
                        'end_image' => true
                    ]
                ],
                'luma-dream-machine-ray-2' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'tail_image' => false,
                        'cfg_scale' => false,
                        'end_image' => true
                    ]
                ],
                'luma-dream-machine-ray-2-flash' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'tail_image' => false,
                        'cfg_scale' => false,
                        'end_image' => true
                    ]
                ],
                'veo2' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'tail_image' => false,
                        'cfg_scale' => false,
                        'end_image' => false
                    ]
                ],
                'sora-2' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'resolution' => true,
                        'aspect_ratio' => true,
                        'duration' => true,
                        'tail_image' => false,
                        'end_image' => false,
                        'cfg_scale' => false,
                    ]
                ],
                'sora-2-pro' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'resolution' => true,
                        'aspect_ratio' => true,
                        'duration' => true,
                        'tail_image' => false,
                        'end_image' => false,
                        'cfg_scale' => false,
                    ]
                ],
                'kling-video-v2.5-turbo-pro' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'duration' => true,
                        'cfg_scale' => true,
                        'tail_image' => false,
                        'end_image' => false
                    ]
                ],
                'veo3' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'tail_image' => false,
                        'cfg_scale' => false,
                        'end_image' => false,
                    ]
                ],
                'veo3-fast' => [
                    'image-to-video' => [
                        'service' => false,
                        'prompt' => true,
                        'tail_image' => false,
                        'cfg_scale' => false,
                        'end_image' => false
                    ]
                ],

            ],
            'negative_prompt' => [
                'kling-video-v1-pro' => true,
                'kling-video-v1-standard' => true,
                'kling-video-v1.5-pro' => true,
                'kling-video-v1.6-pro' => true,
                'kling-video-v1.6-standard' => true,
                'kling-video-v2-master' => true,
                'kling-video-v2.1-master' => true,
                'kling-video-v2.1-pro' => true,
                'kling-video-v2.1-standard' => true,
                'minimax-video-01' => false,
                'minimax-hailuo02-pro' => false,
                'minimax-hailuo02-standard' => false,
                'luma-dream-machine' => false,
                'luma-dream-machine-ray-2' => true,
                'luma-dream-machine-ray-2-flash' => true,
                'veo2' => false,
                'kling-video-v2.5-turbo-pro' => true,
                'sora-2' => false,
                'sora-2-pro' => false,
                'veo3' => false,
                'veo3-fast' => false
            ],
            'aspect_ratio' => [ 
                'kling-video-v1-pro' => ['16:9', '9:16', '1:1'],
                'kling-video-v1-standard' => ['16:9', '9:16', '1:1'],
                'kling-video-v1.5-pro' => ['16:9', '9:16', '1:1'],
                'kling-video-v1.6-pro' => ['16:9', '9:16', '1:1'],
                'kling-video-v1.6-standard' => ['16:9', '9:16', '1:1'],
                'kling-video-v2-master' => ['16:9', '9:16', '1:1'],
                'minimax-video-01' => [],
                'luma-dream-machine' => ['16:9', '9:16', '4:3', '3:4', '21:9', '9:21'],
                'luma-dream-machine-ray-2' => ['16:9', '9:16', '4:3', '3:4', '21:9', '9:21'],
                'luma-dream-machine-ray-2-flash' => ['16:9', '9:16', '4:3', '3:4', '21:9', '9:21'],
                'veo2' => ['auto', 'auto_prefer_portrait', '16:9', '9:16'],
                'kling-video-v2.1-master' => [],
                'kling-video-v2.5-turbo-pro' => [],
                'sora-2' => ['auto','16:9', '9:16'],
                'sora-2-pro' => ['auto','16:9', '9:16'],
                'veo3' => ['auto','16:9', '9:16', '1:1'],
                'veo3-fast' => ['auto','16:9', '9:16', '1:1'],
            ],
            'duration' => [ 
                'kling-video-v1-pro' => [5, 10],
                'kling-video-v1-standard' => [5, 10],
                'kling-video-v1.5-pro' => [5, 10],
                'kling-video-v1.6-pro' => [5, 10],
                'kling-video-v1.6-standard' => [5, 10],
                'kling-video-v2-master' => [5, 10],
                'kling-video-v2.1-master' => [5, 10],
                'kling-video-v2.1-pro' => [5, 10],
                'kling-video-v2.1-standard' => [5, 10],
                'minimax-video-01' => [],
                'luma-dream-machine' => [],
                'luma-dream-machine-ray-2' => [5],
                'luma-dream-machine-ray-2-flash' => [5],
                'veo2' => [5, 6, 7, 8],
                'kling-video-v2.5-turbo-pro' => [5, 10],
                'sora-2' => [4, 8, 12],
                'sora-2-pro' => [4, 8, 12],
                'veo3' => [8],
                'veo3-fast' => [8],
            ],
            'loop' => [
                'kling-video-v1-pro' => [],
                'kling-video-v1-standard' => [],
                'kling-video-v1.5-pro' => [],
                'kling-video-v1.6-pro' => [],
                'kling-video-v1.6-standard' => [],
                'kling-video-v2-master' => [],
                'kling-video-v2.1-master' => [],
                'kling-video-v2.1-pro' => [],
                'kling-video-v2.1-standard' => [],
                'minimax-video-01' => [],
                'luma-dream-machine' => ['Yes', 'No'],
                'luma-dream-machine-ray-2' => ['Yes', 'No'],
                'luma-dream-machine-ray-2-flash' => ['Yes', 'No'],
                'veo2' => [],
                'kling-video-v2.5-turbo-pro' => [],
                'sora-2' => [],
                'sora-2-pro' => [],
                'veo3' => [],
                'veo3-fast' => [],
            ],
            'resolution' => [
                'kling-video-v1-pro' => [],
                'kling-video-v1-standard' => [],
                'kling-video-v1.5-pro' => [],
                'kling-video-v1.6-pro' => [],
                'kling-video-v1.6-standard' => [],
                'kling-video-v2-master' => [],
                'kling-video-v2.1-master' => [],
                'kling-video-v2.1-pro' => [],
                'kling-video-v2.1-standard' => [],
                'minimax-video-01' => [],
                'luma-dream-machine' => [],
                'luma-dream-machine-ray-2' => ['540p', '720p', '1080p'],
                'luma-dream-machine-ray-2-flash' => ['540p', '720p', '1080p'],
                'veo2' => [],
                'kling-video-v2.1-master' => [],
                'sora-2' => ['720p'],
                'sora-2-pro' => ['720p', '1080p'],
                'veo3' => ['720p', '1080p'],
                'veo3-fast' => ['720p', '1080p'],
            ],
            'generate_audio' => [
                'kling-video-v1-pro' => [],
                'kling-video-v1-standard' => [],
                'kling-video-v1.5-pro' => [],
                'kling-video-v1.6-pro' => [],
                'kling-video-v1.6-standard' => [],
                'kling-video-v2-master' => [],
                'kling-video-v2.1-master' => [],
                'kling-video-v2.1-pro' => [],
                'kling-video-v2.1-standard' => [],
                'minimax-video-01' => [],
                'luma-dream-machine' => [],
                'luma-dream-machine-ray-2' => [],
                'luma-dream-machine-ray-2-flash' => [],
                'veo2' => [],
                'kling-video-v2.1-master' => [],
                'sora-2' => [],
                'sora-2-pro' => [],
                'veo3' => ['Yes', 'No'],
                'veo3-fast' => ['Yes', 'No'],
            ]

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
                'value' => 'FalAi',
                'visibility' => false
            ],
            [
                'type' => 'dropdown',
                'label' => 'Service',
                'name' => 'service',
                'value' => [
                    'image-to-video',
                ],
                'visibility' => true,
                'admin_visibility' => true,
                'default_value' => 'image-to-video',
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'veo3-fast',
                    'veo3',
                    'sora-2',
                    'sora-2-pro',
                    'kling-video-v2.5-turbo-pro',
                    'kling-video-v1-pro', 
                    'kling-video-v1-standard',
                    'kling-video-v1.5-pro',
                    'kling-video-v1.6-pro',
                    'kling-video-v1.6-standard',
                    'kling-video-v2-master',
                    'kling-video-v2.1-master',
                    'kling-video-v2.1-pro',
                    'kling-video-v2.1-standard',
                    'minimax-video-01',
                    'minimax-hailuo02-pro',
                    'minimax-hailuo02-standard',
                    'luma-dream-machine',
                    'luma-dream-machine-ray-2',
                    'luma-dream-machine-ray-2-flash',
                    'veo2'
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Aspect Ratio',
                'name' => 'aspect_ratio',
                'value' => [
                    'auto' , 'auto_prefer_portrait', '16:9', '9:16', '1:1', '4:3', '3:4', '21:9', '9:21'
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Duration',
                'name' => 'duration',
                'value' => [
                    4, 5, 6, 7, 8, 10, 12
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Loop',
                'name' => 'loop',
                'value' => [
                    'Yes', 'No'
                ],
                'default_value' => 'No',
                'visibility' => true,
                'tooltip' => 'Enable video looping (seamlessly connect the end to the start.',
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Resolution',
                'name' => 'resolution',
                'value' => [
                    '540p', '720p', '1080p'
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Generate Audio',
                'name' => 'generate_audio',
                'value' => [
                    'Yes', 'No'
                ],
                'visibility' => true
            ],
            [
                "type" => "slider",
                "label" => "CFG Scale",
                "name" => "cfg_scale",
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'value' => 0.5,
                'tooltip' => 'The CFG (Classifier Free Guidance) scale is a measure of how close you want the model to stick to your prompt when looking for a related image to show you.',
                "visibility" => true,
                "required" => true
            ],
            [
                'type' => 'file',
                'label' => 'File',
                'name' => 'file',
                'value' => '',
                'visibility' => true,
                'restrictions' => [
                    'formats' => ['jpeg', 'png'],
                ],
            ],
            [
                'type' => 'file',
                'label' => 'Tail Image',
                'name' => 'tail_image',
                'value' => '',
                'visibility' => true,
                'tooltip' => 'If you want to add a tail image, you can upload it here. It will be added to the end of the video.',
            ],
            [
                'type' => 'file',
                'label' => 'End Image',
                'name' => 'end_image',
                'value' => '',
                'visibility' => true,
                'tooltip' => 'If you want to add an end image, you can upload it here. It will be added to the end of the video.',
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
        ];
    }

    /**
     * Generates a video configuration array based on provided options.
     *
     * @return array The video configuration payload specific to the model.
     */

    public function generateVideo(): array
    {
        $options = $this->data['options'];
        $model = data_get($options, 'model', 'kling-video-v1-pro');
        $service = data_get($options, 'service', 'image-to-video');
        $duration = data_get($options, 'duration', 5);
        $aspectRatio = data_get($options, 'aspect_ratio', '16:9');
        $negativePrompt = data_get($options, 'negative_prompt', '');
        $cfgScale = data_get($options, 'cfg_scale', 0.5);
        $resolution = data_get($options, 'resolution', '480p');

        $basePayload = [
            "prompt" => $this->prompt()
        ];

        $image = $this->prepareFile('file');
        $tailImage = $this->prepareFile('tail_image');
        $endImage = $this->prepareFile('end_image');

        if ($tailImage) {
            $basePayload['tail_image_url'] = $this->prepareFile('tail_image');
        }

        if ($endImage) {
            $basePayload['end_image_url'] = $this->prepareFile('end_image');
        }

        if ($negativePrompt != '') {
            $basePayload['negative_prompt'] = $negativePrompt;
        }

        // Model-specific payloads
        switch ($model) {
            case 'kling-video-v1-pro':

                return array_merge($basePayload, [
                    "image_url" => $image,
                    "duration" => $duration,
                    "aspect_ratio" => $aspectRatio,
                    "cfg_scale" => $cfgScale,
                    "static_mask_url" => null,
                    "dynamic_masks" => []
                ]);

            case 'kling-video-v1-standard':

                return array_merge($basePayload, [
                    "image_url" => $image,
                    "duration" => $duration,
                    "aspect_ratio" => $aspectRatio,
                    "cfg_scale" => $cfgScale,
                ]);

            case 'kling-video-v1.5-pro':

                return array_merge($basePayload, [
                    "image_url" => $image,
                    "duration" => $duration,
                    "aspect_ratio" => $aspectRatio,
                    "cfg_scale" => $cfgScale,
                ]);

            case 'kling-video-v1.6-standard':

                return array_merge($basePayload, [
                    "image_url" => $image,
                    "duration" => $duration,
                    "aspect_ratio" => $aspectRatio,
                    "cfg_scale" => $cfgScale,
                ]);

            case 'kling-video-v1.6-pro':

                return array_merge($basePayload, [
                    "image_url" => $image,
                    "duration" => $duration,
                    "aspect_ratio" => $aspectRatio,
                    "cfg_scale" => $cfgScale,
                ]);

            case 'kling-video-v2-master':
            case 'kling-video-v2.1-master':
            case 'kling-video-v2.1-pro':
            case 'kling-video-v2.1-standard':

                return array_merge($basePayload, [
                    "image_url" => $image,
                    "duration" => $duration,
                    "cfg_scale" => $cfgScale,
                ]);

            case 'minimax-video-01':
            case 'minimax-hailuo02-pro':
            case 'minimax-hailuo02-standard':

                return array_merge($basePayload, [
                    "image_url" => $image,
                ]);
                
            case 'luma-dream-machine':

                return array_merge($basePayload, [
                    'loop' => data_get($options, 'loop', 'No') == 'Yes' ? true : false,
                    'image_url' => $image,
                    'resolution' => $resolution,
                    'duration' => $duration . 's',
                    
                ]);

            case 'luma-dream-machine-ray-2':
                
                return array_merge($basePayload, [
                    'loop' => data_get($options, 'loop', 'No') == 'Yes' ? true : false,
                    'image_url' => $image,
                    'resolution' => $resolution,
                    'duration' => $duration . 's',

                ]);

            case 'luma-dream-machine-ray-2-flash':
                
                return array_merge($basePayload, [
                    'loop' => data_get($options, 'loop', 'No') == 'Yes' ? true : false,
                    'image_url' => $image,
                    'resolution' => $resolution,
                    'duration' => $duration . 's',

                ]);
            
            case 'veo2':

                return array_merge($basePayload, [
                    'image_url' => $image,
                    'aspect_ratio' => $aspectRatio,
                    'duration' => $duration . 's',
                
                ]);
            
            case 'sora-2':
            case 'sora-2-pro':
                
                return array_merge($basePayload, [
                    'image_url' => $image,
                    'aspect_ratio' => $aspectRatio,
                    'duration' => (int) $duration,
                    'resolution' => $resolution,
                ]);

            case 'kling-video-v2.5-turbo-pro' :

                return array_merge($basePayload, [
                    'image_url' => $image,
                    'duration' => $duration,
                    'cfg_scale' => $cfgScale
                ]);

            case 'veo3':
            case 'veo3-fast':

                return array_merge($basePayload, [
                    'image_url' => $image,
                    'aspect_ratio' => $aspectRatio,
                    'duration' => $duration . 's',
                    'resolution' => $resolution,
                    'generate_audio' => data_get($options, 'generate_audio', 'No') == 'Yes' ? true : false
                ]);

            default:
                // Optionally handle unsupported model types
                return [];
        }
    }

    /**
     * Retrieve the validation rules for the current data processor.
     * 
     * @return array An array of validation rules.
     */
    public function videoValidationRules()
    {
        $validationRules = [
            'provider' => 'required',
            'prompt' => 'required_if:options.model,kling-video-v1-pro,kling-video-v1-standard,kling-video-v1.5-pro,kling-video-v1.6-standard,kling-video-v1.6-pro,kling-video-v2-master,kling-video-v2.1-master,kling-video-v2.1-pro,kling-video-v2.1-standard,minimax-video-01,minimax-hailuo02-pro,minimax-hailuo02-standard,luma-dream-machine,luma-dream-machine-ray-2,luma-dream-machine-ray-2-flash,veo2,sora-2,sora-2-pro,kling-video-v2.5-turbo-pro,veo3,veo3-fast',
            'options.model' => 'required',
            'options.file' => ['required', new CheckValidFile(getFileExtensions(3))],
        ];

        $validationMessage = [
            'provider.required' => __('Please select a provider.'),
            'prompt.required_if' => __('Please enter a prompt.'),
            'options.model.required' => __('Please select a model.'),
            'options.file.required' => __('Please select a file.'),
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
     * @param string $name The name of the file to prepare.
     *
     * @return string|null The prepared file, ready for use in a API request.
     */
    public function prepareFile($name)
    {
        $uploadedFile = $this->data['options'][$name] ?? null;

        if (!is_null($uploadedFile)) {
            $fileType = $uploadedFile->getMimeType();
            $fileData = base64_encode(file_get_contents($uploadedFile->getRealPath()));
            return 'data:' . $fileType . ';base64,' . $fileData;
        }

        return $uploadedFile;
    }

    public function prompt(): string
    {
        return filteringBadWords("Generate video based on this concept: `" . $this->data['prompt'] . "`.");
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
}
