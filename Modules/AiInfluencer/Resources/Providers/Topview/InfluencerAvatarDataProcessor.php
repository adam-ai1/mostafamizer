<?php

namespace Modules\AiInfluencer\Resources\Providers\Topview;

use Modules\OpenAI\Entities\Avatar;
use Modules\OpenAI\Entities\Voice;

class InfluencerAvatarDataProcessor
{
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function rules(): array
    {
        return [];
    }

    /**
     * Returns an array of options for configuring the character chatbot.
     *
     * @return array The configuration options for the character chatbot.
     */
    public function influencerAvatarOptions(): array
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
                'value' => 'Topview',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Avatar Source',
                'name' => 'avatarSourceFrom',
                'value' => [
                    "Avatar List", "Custom Avatar List"
                ],
                'visibility' => true,
                'required' => true,
                'applies_to' => 'avatar',
                'onChange' => 'setAvatar'
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
        return [];
    }

    /**
     * Retrieves the validation rules for the current data processor, from the customer's perspective.
     * 
     * @return array An array of validation rules.
     */
    public function customerValidationRules()
    {
        $validationRules['provider'] = 'required';
        $validationRules['prompt'] = 'required';
        $validationRules['avatarSourceFrom'] = 'required|in:avatar-list,custom-avatar-list';
        $validationRules['avatar_id'] = 'required';
        $validationRules['voice_id'] = 'required';
        $validationMessage = [
            'provider.required' => __('Provider is required.'),
            'prompt.required' => __('Prompt is required.'),
            'avatarSourceFrom.required' => __('Avatar source is required.'),
            'avatarSourceFrom.in' => __('Invalid avatar source. Please select a valid avatar source.'),
            'avatar_id.required' => __('Avatar is required.'),
            'voice_id.required' => __('Voice is required.'),
        ];

        return [
            $validationRules,
            $validationMessage
        ];
    }

    /**
     * Prepares the data to be sent to the AI provider.
     * 
     * @return array The prepared data.
     */
    public function prepareUrlToVideoData(): array
    {
        $url = isset($this->data['uploaded_file_name']) && !is_null($this->data['uploaded_file_name']) ? objectStorage()->url($this->data['uploaded_file_name']) : $this->data['url']; 
        return [
            'productLink' => $url,
            'productName' => data_get($this->data, 'title', 'Video Title'),
            'language' => data_get(moduleConfig('aiinfluencer.providers.topview.parameters.language'), $this->data['language'], 'en'),
            'videoLengthType' => (int) data_get(moduleConfig('aiinfluencer.providers.topview.parameters.video_length'), $this->data['video_length'], 1),
            'aspectRatio' => data_get($this->data, 'aspect_ratio', '9:16'),
            'isDiyScript' => !is_null(data_get($this->data, 'override_script', null)),
            'diyScriptDescription' => data_get($this->data, 'override_script', null),
        ];
    }

    /**
     * Prepares the data to be sent to the AI provider.
     * 
     * @return array The prepared data.
     */
    public function prepareInfluencerAvatarData(): array
    {
        return [
            'avatarSourceFrom' => (int) data_get(moduleConfig('aiinfluencer.providers.topview.parameters.avatarSourceFrom'), $this->data['avatarSourceFrom'], 1),
            'aiAvatarId' => data_get($this->data, 'avatar_id'),
            'audioSourceFrom' => 1, // text to speech
            'ttsText' => data_get($this->data, 'prompt'),
            'voiceoverId' => data_get($this->data, 'voiceover_id'),
        ];
    }

    public function prepareStoreData(array $responseData = [])  
    {
        if ($this->data['type'] === 'voices') {
            return $this->processVoices($responseData['body']['result']['data']);
        }

        return $this->processAvatars($responseData['body']['result']['data']);
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

            if (empty($value['demoAudioUrl'])) {
                continue;
            }

            $allVoices[] = $value['voice_id'];
            $voices[] = [
                'user_id' => auth()->user()->id,
                'name' => $value['voiceName'],
                'voice_name' => $value['voiceId'],
                'gender' => $value['gender'],
                'language_code' => $value['bestSupportLanguage'],
                'status' => 'Active',
                'providers' => $this->data['provider'],
                'type' => 'ai_persona',
                'file_name' => $value['demoAudioUrl']
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
            $allAvatars[] = $value['aiavatarId'];
        }

        Avatar::whereNotIn('avatar_id', $allAvatars)->delete();

        $existingVoices = Avatar::where('type', 'ai_persona')->pluck('avatar_id')->toArray();

        foreach ($allData as $value) {

            if (in_array($value['aiavatarId'], $existingVoices)) {
                continue;
            }

            $avatar = new Avatar();
            $avatar->user_id = auth()->user()->id;
            $avatar->name = $value['aiavatarName'];
            $avatar->avatar_id = $value['aiavatarId'];
            $avatar->gender = $value['gender'];
            $avatar->provider = $this->data['provider'];
            $avatar->type = 'influencer_avatar';
            $avatar->status = 'Active';

            // Meta Value
            $avatar->image_url = $value['coverUrl'];
            $avatar->video_url = $value['previewVideoUrl'];
            $avatar->voiceover_id = $value['voiceoverIdDefault'];
            
            $avatar->save();
        }
    }
}
