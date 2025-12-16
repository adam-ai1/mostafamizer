<?php

namespace Modules\OpenAI\Transformers\Api\v2\SpeechToText;

use Illuminate\Http\Resources\Json\JsonResource;

class SpeechToTextDetailsResource extends JsonResource
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
            'type' => $this->type,
            'title' => trimWords($this->title, 90),
            'content' => $this->content,
            'provider' => $this->provider,
            'expense' => $this->expense,
            'created_at' => timeToGo($this->created_at, false, 'ago'),
            'updated_at' => timeToGo($this->updated_at, false, 'ago'),
            'meta' => $this->metas(),
        ];
    }

    /**
     * Get the meta data of the speech to text.
     *
     * @return array The meta data of the speech to text.
     */
    private function metas()
    {
        $metas = $this->metas->pluck('value', 'key');
    
        foreach ($metas as $key => $value) {
            if ($key === 'file_name') {
                $metas[$key] = objectStorage()->url("public/uploads/aiAudios/{$value}");
            }
        }
        return $metas;
    }
}
