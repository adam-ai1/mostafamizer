<?php

namespace Modules\OpenAI\Contracts\Resources;

use Modules\OpenAI\Contracts\Responses\AiAvatar\AiAvatarResponseContract;

interface AiAvatarContract
{
    /**
     * Provide the provider options for Ai Avatar settings.
     *
     * @return array
     */
    public function aiAvatarOptions(): array;

    /**
     * Generate video details based on provided text.
     *
     * @param array $aiOptions
     */
    public function generateAvatar(array $aiOptions): AiAvatarResponseContract;
}