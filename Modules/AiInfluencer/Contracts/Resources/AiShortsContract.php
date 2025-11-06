<?php

namespace Modules\AiInfluencer\Contracts\Resources;

interface AiShortsContract
{
    /**
     * Provide the provider options for Ai Shorts settings.
     *
     * @return array
     */
    public function aiShortsOptions(): array;
    
    /**
     * Provide the provider rules for Ai Shorts settings.
     *  
     * @return array
     */
    public function aiShortsRules(): array;
    
    /**
     * Generate video details based on provided text.
     *
     * @param array $aiOptions
     */
    public function generateAiShorts(array $aiOptions): mixed;
}
