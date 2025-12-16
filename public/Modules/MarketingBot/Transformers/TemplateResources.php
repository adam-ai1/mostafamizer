<?php

namespace Modules\MarketingBot\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TemplateResources extends JsonResource
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
            'name' => ucfirst($parts),
            'channel' => ucfirst($this->channel),
            'status' => $this->status,
            'created_at' => timeToGo($this->created_at, false, 'ago'),
            'updated_at' => timeToGo($this->updated_at, false, 'ago'),
            'meta' => $this->metas,
            'user' => new UserResource($this->user),
        ];
    }
}
