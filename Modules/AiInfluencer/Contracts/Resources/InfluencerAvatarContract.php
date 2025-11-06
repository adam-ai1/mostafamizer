<?php

namespace Modules\AiInfluencer\Contracts\Resources;

interface InfluencerAvatarContract
{
    /**
     * Provide the provider options for Ai Shorts settings.
     *
     * @return array
     */
    public function influencerAvatarOptions(): array;
    
    /**
     * Provide the provider rules for Ai Shorts settings.
     *  
     * @return array
     */
    public function influencerAvatarRules(): array;
    
    /**
     * Generate video details based on provided text.
     *
     * @param array $aiOptions
     */
    public function generateInfluencerAvatar(array $aiOptions): mixed;
}
