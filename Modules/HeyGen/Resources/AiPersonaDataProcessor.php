<?php

namespace Modules\HeyGen\Resources;

use Modules\OpenAI\Entities\Avatar;
use Modules\OpenAI\Entities\Voice;

class AiPersonaDataProcessor
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

    public function aiPersonaOptions(): array
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
                'value' => 'HeyGen',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Dimension',
                'name' => 'dimension',
                'value' => [
                    "1280x720",
                    "720x1280",
                ],
                'visibility' => true,
                'required' => true,
                'applies_to' => 'avatar'
            ],
            [
                'type' => 'dropdown',
                'label' => 'Avatar Style',
                'name' => 'avatar_style',
                'value' => [
                    'Circle', 'Normal', 'Close Up', 'Full', 'Voice Only'
                ],
                'visibility' => true,
                'applies_to' => 'avatar',
                'required' => true,
                'default_value' => 'Normal',
            ],
            [
                'type' => 'dropdown',
                'label' => 'Matting',
                'name' => 'matting',
                'value' => [
                    'True', 'False'
                ],
                'visibility' => true,
                'applies_to' => 'avatar',
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Caption',
                'name' => 'caption',
                'value' => [
                    'True', 'False'
                ],
                'visibility' => true,
                'applies_to' => 'avatar',
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Speed',
                'name' => 'speed',
                'value' => [
                    0.5, 1, 1.5
                ],
                'visibility' => true,
                'default_value' => 1,
                'applies_to' => 'voice',
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Pitch',
                'name' => 'pitch',
                'value' => [
                    -50, -25, 0, 25, 50
                ],
                'default_value' => 0,
                'visibility' => true,
                'applies_to' => 'voice',
                'required' => true,
            ],
            [
                'type' => 'dropdown',
                'label' => 'Emotions',
                'name' => 'emotion',
                'value' => [
                    'Excited', 'Friendly', 'Serious', 'Soothing', 'Broadcaster'
                ],
                'visibility' => true,
                'applies_to' => 'voice',
                'required' => true,
            ]
        ];
    }

    public function customerValidationRules()
    {
        $validationRules['options.avatar_id'] = 'required';
        $validationRules['options.voice_id'] = 'required';
        $validationMessage = [
            'options.avatar_id' => __('Please choose a avatar to generate ai persona.'),
            'options.voice_id' => __('Please choose a voice to generate ai persona.')
        ];

        return [
            $validationRules,
            $validationMessage
        ];
    }

    public function prepareData(): array
    {
        $dimension = data_get($this->data, 'options.dimension', '1280x720');

        $width = explode('x', $dimension)[0];
        $height = explode('x', $dimension)[1];

        return [
            'caption' => data_get($this->data, 'options.caption', 'False') === 'True' ? true : false,
            'dimension' => [
                'width' => $width,
                'height' => $height
            ],
            'video_inputs' => [
                [
                    'character' => [
                        'type' => 'avatar',
                        'avatar_id' => data_get($this->data, 'options.avatar_id', 'Abigail_expressive_2024112501'),
                        'avatar_style' => lcfirst(str_replace( ' ', '', data_get($this->data, 'options.avatar_style', 'Normal'))),
                        'matting' => data_get($this->data, 'options.matting', 'False') === 'True' ? true : false
                    ],
                    'voice' => [
                        'type' => 'text',
                        'voice_id' => data_get($this->data, 'options.voice_id', 'f772a099cbb7421eb0176240c611fc43'),
                        'speed' => (float) data_get($this->data, 'options.speed', 1),
                        'pitch' => (int) data_get($this->data, 'options.pitch', 0),
                        'emotion' => data_get($this->data, 'options.emotion', 'Broadcaster'),
                        'input_text' => data_get($this->data, 'prompt'),
                    ]
                ]
            ]
        ];
    }

    public function prepareStoreData(array $responseData = [])  
    {
        if ($this->data['type'] === 'voices') {
            return $this->processVoices($responseData['body']['data']['voices']);
        }

        return $this->processAvatars($responseData['body']['data']['avatars']);
    }

    /**
     * Processes and updates the voice data in the database.
     *
     * @param array $request The request data containing provider information.
     * @param array $allData An array of voice data to process.
     * @return void Returns false if no new voices to process, otherwise void.
     */
    private function processVoices(array $allData): void
    {
        $allVoices = [];
        $voices = [];

        foreach ($allData as $value) {

            if (empty($value['preview_audio'])) {
                continue;
            }

            $allVoices[] = $value['voice_id'];
            $voices[] = [
                'user_id' => auth()->user()->id,
                'name' => $value['name'],
                'voice_name' => $value['voice_id'],
                'gender' => $value['gender'],
                'language_code' => $value['language'],
                'status' => 'Active',
                'providers' => $this->data['provider'],
                'type' => 'ai_persona',
                'file_name' => $value['preview_audio']
            ];
        }

        if (empty($voices)) {
            return ;
        }

        Voice::where('type', 'ai_persona')
            ->whereNotIn('voice_name', $allVoices)
            ->delete();
        
        $existingVoices = Voice::where('type', 'ai_persona')->pluck('voice_name')->toArray();

        $newVoices = array_filter($voices, function ($voice) use ($existingVoices) {
            return !in_array($voice['voice_name'], $existingVoices);
        });

        Voice::insert($newVoices);
    }

    /**
     * Processes and updates the avatar data in the database.
     *
     * @param array $request The request data containing provider information.
     * @param array $allData An array of avatar data to process.
     * @return void
     */
    private function processAvatars(array $allData)
    {
        $allAvatars = [];
        
        foreach ($allData as $value) {
            $allAvatars[] = $value['avatar_id'];
        }

        Avatar::whereNotIn('avatar_id', $allAvatars)->delete();

        $existingVoices = Avatar::where('type', 'ai_persona')->pluck('avatar_id')->toArray();

        foreach ($allData as $value) {

            if (in_array($value['avatar_id'], $existingVoices)) {
                continue;
            }

            $avatar = new Avatar();
            $avatar->user_id = auth()->user()->id;
            $avatar->name = $value['avatar_name'];
            $avatar->avatar_id = $value['avatar_id'];
            $avatar->gender = $value['gender'];
            $avatar->provider = $this->data['provider'];
            $avatar->type = 'ai_persona';
            $avatar->status = 'Active';

            // Meta Value
            $avatar->image_url = $value['preview_image_url'];
            $avatar->video_url = $value['preview_video_url'];
            
            $avatar->save();
        }
    }
}