<?php

namespace Modules\OpenAI\Transformers\Api\v2\AiVideo;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\OpenAI\Entities\Archive;

class AiVideoDetailsResource extends JsonResource
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
            'id' => $this['video']->id,
            'title' => $this['video']->title,
            'type' => $this['video']->type,
            'provider' => $this['video']->provider,
            'expense' => $this['video']->expense,
            'expense_type' => $this['video']->expense_type,
            'created_at' => timeToGo($this['video']->created_at, false, 'ago'),
            'updated_at' => timeToGo($this['video']->updated_at, false, 'ago'),
            'user' => [
                'id' => $this['video']->user?->id,
                'name' => $this['video']->user?->name,
            ],
            'meta' => $this->checkUrl(),
            'videos' => SingleVideoResources::collection(Archive::with('metas')->where('parent_id', $this['video']->id)->get()),
            'subscription' => $this['balance'] ?? '',
        ];
    }

    /**
     * Check and modify URLs within the metadata.
     *
     * @return array The updated metadata with valid URLs for 'images_urls' and 'url' keys.
     */
    public function checkUrl() {
        $metas = $this['video']->metas->pluck('value', 'key');
    
        foreach ($metas as $key => $meta) {
            if ($key === 'videos_url' && is_array($meta)) {
                foreach ($meta as $index => $data) {
                    $meta[$index] = objectStorage()->url('public\\uploads\\aiVideos\\' . str_replace("\\", "/", $data));
                }
                $metas[$key] = $meta;
            } elseif ($key === 'url') {
                $metas[$key] = objectStorage()->url('public\\uploads\\aiVideos\\' . str_replace("\\", "/", $meta));
            }
        }

        return $metas;
    }
}
