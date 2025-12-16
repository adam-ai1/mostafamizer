<?php

namespace Modules\FalAi\Resources;

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
        $klingAspectRatio = ['16:9', '9:16', '1:1'];
        $klingDuration = [5, 10];

        $lumaDreamsMachineAspectRatio = ['16:9', '9:16', '4:3', '3:4', '21:9', '9:21'];
        $lumaDreamsMachineDuration = [5, 9];
        $lumaDreamsResolution = ['540p', '720p', '1080p'];

        $hunyuanAspectRatio = ['16:9', '9:16'];
        $hunyuanResolution = ['480p', '580p', '720p'];
        $hunyuanNumberFrames = [129 , 85];

        $haiperDuration = [4, 6];

        $klingCameraControl = ['down_back', 'forward_up', 'right_turn_forward', 'left_turn_forward'];

        $veo2AspectRatio = ['16:9', '9:16'];
        $veo3AspectRatio = ['1:1', '16:9', '9:16'];
        $veo2Duration = [5, 6, 7, 8];
        $yesNoOptions = ['Yes', 'No'];

        return [
            'aspect_ratio' => [
                'veo3-fast' => ['1:1', '16:9', '9:16'],
                'veo3' => $veo3AspectRatio,
                'veo2' => $veo2AspectRatio,
                'kling-video-v2.1-master' => $klingAspectRatio,
                'kling-video-v2-master' => $klingAspectRatio,
                'kling-video-v1-pro' => $klingAspectRatio,
                'kling-video-v1-standard' => $klingAspectRatio,
                'kling-video-v1.5-pro' => $klingAspectRatio,
                'kling-video-v1.6-standard' => $klingAspectRatio,
                'kling-video-v1.6-pro' => $klingAspectRatio,
                'luma-dream-machine' => $lumaDreamsMachineAspectRatio,
                'luma-dream-machine-ray-2' => $lumaDreamsMachineAspectRatio,
                'luma-dream-machine-ray-2-flash' => $lumaDreamsMachineAspectRatio,
                'hunyuan-video' => $hunyuanAspectRatio,
                'hunyuan-video-lora' => $hunyuanAspectRatio,
                'kling-video-v2.5-turbo-pro' => ['16:9', '9:16', '1:1'],
                'sora-2' => ['16:9', '9:16'],
                'sora-2-pro' => ['16:9', '9:16']
            ],
            'duration' => [
                'veo3-fast' => [4, 6, 8],
                'veo3' => [4, 6, 8],
                'veo2' => $veo2Duration,
                'kling-video-v2.1-master' => $klingDuration,
                'kling-video-v2-master' => $klingDuration,
                'kling-video-v1-pro' => $klingDuration,
                'kling-video-v1-standard' => $klingDuration,
                'kling-video-v1.5-pro' => $klingDuration,
                'kling-video-v1.6-standard' => $klingDuration,
                'kling-video-v1.6-pro' => $klingDuration,
                'luma-dream-machine' => $lumaDreamsMachineDuration,
                'luma-dream-machine-ray-2' => $lumaDreamsMachineDuration,
                'luma-dream-machine-ray-2-flash' => $lumaDreamsMachineDuration,
                'haiper-video-v2' => $haiperDuration,
                'haiper-video-v2.5-fast' => $haiperDuration,
                'kling-video-v2.5-turbo-pro' => [5, 10],
                'sora-2' => [4, 8, 12],
                'sora-2-pro' => [4, 8, 12],
            ],
            'generate_audio' => [
                'veo3' => $yesNoOptions,
                'veo3-fast' => $yesNoOptions,
            ],
            'camera_control' => [
                'kling-video-v1-pro' => $klingCameraControl,
                'kling-video-v1-standard' => $klingCameraControl,
                'kling-video-v1.5-pro' => $klingCameraControl,
                'kling-video-v1.6-standard' => $klingCameraControl,
                'kling-video-v1.6-pro' => $klingCameraControl,
            ],
            'resolution' => [
                'luma-dream-machine' => $lumaDreamsResolution,
                'luma-dream-machine-ray-2' => $lumaDreamsResolution,
                'luma-dream-machine-ray-2-flash' => $lumaDreamsResolution,
                'hunyuan-video' => $hunyuanResolution,
                'hunyuan-video-lora' => $hunyuanResolution,
                'sora-2' => ['720p'],
                'sora-2-pro' => ['720p', '1080p'],
                'veo3' => ['720p', '1080p'],
                'veo3-fast' => ['720p', '1080p'],
            ],
            'num_frames' => [
                'hunyuan-video' => $hunyuanNumberFrames,
                'hunyuan-video-lora' => $hunyuanNumberFrames,
            ],
            'enable_safety_checker' => [
                'hunyuan-video' => ['On', 'Off'],
                'hunyuan-video-lora' => ['On', 'Off'],
            ], 
            'pro_mode' => [
                'hunyuan-video' => ['On', 'Off'],
                'hunyuan-video-lora' => ['On', 'Off'],
            ],
            'negative_prompt' => [
                'mochi-v1' => true,
                'kling-video-v2.1-master' => true,
                'kling-video-v2-master' => true,
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
                'value' => 'FalAi',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Service',
                'name' => 'service',
                'value' => [
                    'text-to-video',
                ],
                'visibility' => true,
                'admin_visibility' => false,
                'default_value' => 'text-to-video',
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'veo3-fast',
                    'sora-2',
                    'sora-2-pro',
                    'kling-video-v2.5-turbo-pro',
                    'veo2',
                    'veo3',
                    'kling-video-v2.1-master',
                    'kling-video-v2-master',
                    'kling-video-v1-pro', 
                    'kling-video-v1-standard',
                    'kling-video-v1.5-pro',
                    'kling-video-v1.6-standard',
                    'kling-video-v1.6-pro',
                    'minimax-video-01',
                    'luma-dream-machine',
                    'luma-dream-machine-ray-2',
                    'luma-dream-machine-ray-2-flash',
                    'haiper-video-v2',
                    'haiper-video-v2.5-fast',
                    'mochi-v1',
                    'hunyuan-video',
                    'hunyuan-video-lora',
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Aspect Ratio',
                'name' => 'aspect_ratio',
                'value' => [
                    '16:9', '9:16', '1:1', '4:3', '3:4', '21:9', '9:21'
                ],
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Duration',
                'name' => 'duration',
                'value' => [
                    4, 5, 6, 7, 8, 9, 10, 12
                ],
                'visibility' => true
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
                'type' => 'dropdown',
                'label' => 'Camera Control',
                'name' => 'camera_control',
                'value' => [ 
                    'down_back', 'forward_up', 'right_turn_forward', 'left_turn_forward'
                 ],
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Resolution',
                'name' => 'resolution',
                'value' => [
                    '480p', '540p', '580p', '720p', '1080p'
                ],
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Number Of Frames',
                'name' => 'num_frames',
                'value' => [
                    129, 85
                ],
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Pro Mode',
                'name' => 'pro_mode',
                'value' => [
                    'On', 'Off'
                ],
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Enable Safety Checker',
                'name' => 'enable_safety_checker',
                'value' => [
                    'On', 'Off'
                ],
                'visibility' => true
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

    public function customerValidationRules()
    {
        $validationRules['prompt'] = 'required';
        $validationRules['provider'] = 'required';
        $validationRules['options.model'] = 'required|in:veo2,veo3,kling-video-v2.1-master,kling-video-v2-master,kling-video-v1-pro,kling-video-v1-standard,kling-video-v1.5-pro,kling-video-v1.6-standard,kling-video-v1.6-pro,minimax-video-01,luma-dream-machine,luma-dream-machine-ray-2,luma-dream-machine-ray-2-flash,haiper-video-v2,haiper-video-v2.5-fast,mochi-v1,hunyuan-video,hunyuan-video-lora,sora-2,sora-2-pro,kling-video-v2.5-turbo-pro,veo3-fast';
        $validationMessage = [
            'prompt.required' => __('Please enter a prompt to generate an video.'),
            'provider.required' => __('Please select a provider.'),
            'options.model.required' => __('Please select a model.'),
            'options.model.in' => __('Please select a valid model.'),
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

        $model = data_get($this->data['options'], 'model', 'kling-video-v1-pro');

        $commonKeys = [
            'kling' => ['duration', 'aspect_ratio', 'camera_control', 'negative_prompt'],
            'luma'  => ['duration', 'resolution', 'aspect_ratio'],
            'haiper'  => ['duration'],
            'mochi'  => ['duration'],
            'haiper-video-v2'  => ['duration'],
            'haiper-video-v2.5-fast'  => ['duration'],
            'hunyuan'  => ['pro_mode', 'aspect_ratio', 'resolution', 'num_frames', 'enable_safety_checker'],
            'veo2'  => ['duration', 'aspect_ratio'],
            'veo3'  => ['duration', 'aspect_ratio', 'generate_audio', 'negative_prompt', 'resolution'],
            'sora-2'  => ['duration', 'aspect_ratio', 'resolution'],
            'sora-2-pro'  => ['duration', 'aspect_ratio', 'resolution'],
        ];
        
        // Define allowed keys per model
        $allowedKeys = [
            'kling-video-v2.5-turbo-pro' => 'kling',
            'veo3-fast' => 'veo3',
            'veo3' => 'veo3',
            'veo2' => 'veo2',
            'kling-video-v2.1-master' => 'kling',
            'kling-video-v2-master' => 'kling',
            'kling-video-v1-pro' => 'kling',
            'kling-video-v1-standard' => 'kling',
            'kling-video-v1.5-pro' => 'kling',
            'kling-video-v1.6-standard' => 'kling',
            'kling-video-v1.6-pro' => 'kling',
            'minimax-video-01' => 'minimax',
            'luma-dream-machine' => 'luma',
            'luma-dream-machine-ray-2' => 'luma',
            'luma-dream-machine-ray-2-flash' => 'luma',
            'haiper-video-v2' => 'haiper',
            'haiper-video-v2.5-fast' => 'haiper',
            'mochi-v1' => 'mochi',
            'hunyuan-video' => 'hunyuan',
            'hunyuan-video-lora' => 'hunyuan',
            'sora-2' => 'sora-2',
            'sora-2-pro' => 'sora-2',
        ];
        
        // Define static values per model
        $staticValues = [
            'minimax-video-01' => ['prompt_optimizer' => true],
            'haiper-video-v2' => ['prompt_enhancer' => true],
            'haiper-video-v2.5-fast' => ['prompt_enhancer' => true],
            'veo3-fast' => ['prompt_enhancer' => true, 'auto_fix' => true],
        ];
        
        $keys = $commonKeys[$allowedKeys[$model] ?? ''] ?? [];
        
        $filteredData = [];
        foreach ($keys as $key) {
            $value = data_get($this->data, "options.$key");
        
            // Handle duration format based on model type
            if ($key === 'duration' && isset($allowedKeys[$model])) {
                $value = in_array($allowedKeys[$model], ['haiper', 'kling', 'sora-2']) ? (int) $value : "{$value}s";
            }

            if ( $key === 'pro_mode' || $key === 'enable_safety_checker' ) {
                $value = $value === 'On' ? true : false;
            }

            if ( $key === 'generate_audio' ) {
                $value = $value === 'Yes' ? true : false;
            }
        
            $filteredData[$key] = $value;
        }
        
        $filteredData['prompt'] = data_get($this->data, 'prompt');

        return array_merge(array_filter($filteredData), array_filter($staticValues[$model] ?? []));
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
                return $returnKey ? $key : $this->formatValue($key, $searchKey, $values[$searchKey], $options);
            }
        }
        return null;
    }

    /**
     * Format a value based on the provider and search key.
     *
     * @param string $provider The provider name.
     * @param string $searchKey The key associated with the value.
     * @param mixed $value The value to format.
     * @param array $options Additional options for future extensions.
     * 
     * @return string The formatted value.
     */
    private function formatValue(string $provider, string $searchKey, $value, array $options): string
    {
        if ($searchKey === 'sora-2-pro') {
            return "{$value}/{$options['service']}/pro";
        }
        
        if (in_array($provider, ['kling-video', 'sora-2'])) {
            return "{$value}/{$options['service']}";
        }
        
        return $value;
    }
}