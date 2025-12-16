<?php

namespace Modules\OpenAI\Transformers\Api\v2\Voiceover;

use Illuminate\Http\Resources\Json\JsonResource;

class VoiceDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'voice_name' => $this->voice_name,
            'language_code' => $this->language_code,
            'providers' => ucfirst($this->providers),
            'audio_url' => $this->googleAudioUrl(),
            'gender' => $this->gender,
            'status' => $this->status,
            'image' => $this->fileUrl(),
            'created_at' => timeToGo($this->created_at, false, 'ago'),
        ];
    }
}
