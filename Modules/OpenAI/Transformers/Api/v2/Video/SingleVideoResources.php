<?php

namespace Modules\OpenAI\Transformers\Api\v2\Video;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\OpenAI\Entities\Archive;

class SingleVideoResources extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'slug_url' => url('user/gallery?slug=' . $this->slug),
            'url' =>  $this->checkUrl(),
            'favorite' => $this->checkFavorite(),
            'videos' => SingleVideoResources::collection(Archive::with('metas')->where('parent_id', $this->id)->get()),
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'metas' => $this->metas->pluck('value', 'key')
        ];
    }

    /**
     * Check if the current image is marked as a favorite by the authenticated user.
     *
     * @return bool True if the image is a favorite, false otherwise.
     */
    private function checkFavorite()
    {
        if (is_null(auth()->user()->image_favorites)) {
            return false;
        }

        return in_array($this->id, auth()->user()->image_favorites);
    }

    /**
     * Check and modify URLs within the metadata.
     *
     * @return array The updated metadata with valid URLs for 'images_urls' and 'url' keys.
     */
    public function checkUrl() 
    {
        $fileName = $this->metas->where('key', 'file_name')->value('value');

        if ($fileName) {
            return objectStorage()->url(
                'public/uploads/aiVideos/' . str_replace("\\", "/", $fileName)
            );
        }

        return url('/');
    }
}
