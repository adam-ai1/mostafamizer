<?php

namespace Modules\AiInfluencer\Contracts\Resources;

interface UrlToVideoContract
{
    /**
     * Provide the provider options for Ai Shorts settings.
     *
     * @return array
     */
    public function urlToVideoOptions(): array;
    
    /**
     * Provide the provider rules for Ai Shorts settings.
     *  
     * @return array
     */
    public function urlToVideoRules(): array;
    
    /**
     * Generate video details based on provided text.
     *
     * @param array $aiOptions
     */
    public function generateUrlToVideo(array $aiOptions): mixed;
}
