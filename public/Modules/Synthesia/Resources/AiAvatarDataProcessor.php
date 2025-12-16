<?php

namespace Modules\Synthesia\Resources;

class AiAvatarDataProcessor
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
        return [];
    }

    public function aiAvatarOptions(): array
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
                'value' => 'Synthesia',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Avatar Style',
                'name' => 'avatar_style',
                'value' => [
                    'Circular', 'Rectangular',
                ],
                'visibility' => true,
                'applies_to' => 'avatar',
                'required' => true,
                'default_value' => 'Normal',
            ],
            [
                'type' => 'dropdown',
                'label' => 'Horizontal Align',
                'name' => 'horizontal_align',
                'value' => [
                    'Left', 'Center', 'Right'
                ],
                'visibility' => true,
                'applies_to' => 'avatar',
                'required' => true,
            ],
            [
                'type' => 'text',
                'label' => 'Background Color',
                'name' => 'background_color',
                'value' => '',
                'visibility' => true,
                'applies_to' => 'avatar',
                'required' => true,
            ],
            [
                'type' => 'text',
                'label' => 'Title',
                'name' => 'title',
                'value' => '',
                'visibility' => true,
                'applies_to' => 'video',
                'required' => true,
            ],
            [
                'type' => 'text',
                'label' => 'Description',
                'name' => 'description',
                'value' => '',
                'visibility' => true,
                'applies_to' => 'video',
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Video Background',
                'name' => 'video_background',
                'value' => [
                    "Green Screen", "Off White", "Warm White", "Light Pink", "Soft Pink", "Light Blue", "Dark Blue", "Soft Cyan", "Strong Cyan", "Light Orange", "Soft Orange", "White Studio", "White Cafe", "Luxury Lobby", "Large Window", "White Meeting Room", "Open Office"
                ],
                'visibility' => true,
                'default_value' => 1,
                'applies_to' => 'video',
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Test Status',
                'name' => 'test',
                'value' => [
                    'Enable', 'Disable'
                ],
                'default_value' => 0,
                'visibility' => true,
                'applies_to' => 'video',
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Visibility',
                'name' => 'visibility',
                'value' => [
                    'Private', 'Public'
                ],
                'visibility' => true,
                'applies_to' => 'video',
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Aspect Ratio',
                'name' => 'aspect_ratio',
                'value' => [
                    '16:9',
                    '9:16',
                    '1:1',
                    '4:5',
                    '5:4',
                ],
                'visibility' => true,
                'applies_to' => 'video',
                'required' => true,
            ]
        ];
    }

    public function customerValidationRules()
    {
        $validationRules['options.avatar_id'] = 'required';
        $validationMessage = [
            'options.avatar_id' => __('Please choose a avatar to generate ai avatar.'),
        ];

        return [
            $validationRules,
            $validationMessage
        ];
    }

    public function prepareData(): array
    {
        return [
            'input' => [
                [
                    'scriptText' => data_get($this->data, 'prompt'),
                    'avatar' => data_get($this->data, 'options.avatar_id', 'anna_costume1_cameraA'),
                    "avatarSettings"=> [
                        "horizontalAlign" => strtolower(data_get($this->data, 'options.horizontal_align', 'Center')),
                        "scale"=> 1,
                        "style"=> strtolower(data_get($this->data, 'options.avatar_style', 'Rectangular')),
                        "backgroundColor"=> data_get($this->data, 'options.background_color'),
                        "seamless" => false
                    ],
                    'background' => strtolower(str_replace( ' ', '_', (data_get($this->data, 'options.video_background', 'Green Screen')))),
                ]
            ],
            'test' => data_get($this->data, 'options.test', 'Disable') === 'Enable' ? true : false,
            'title' => data_get($this->data, 'options.title', ''),
            'description' => data_get($this->data, 'options.description', ''),
            'visibility' => strtolower(data_get($this->data, 'options.visibility', 'Public')),
            'aspectRatio' =>  data_get($this->data, 'options.aspect_ratio', '16:9'),
        ];
    }
}