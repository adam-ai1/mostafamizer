<?php

namespace Modules\OpenAI\Contracts\Resources;

use Modules\OpenAI\Contracts\Responses\AiPersona\AiPersonaResponseContract;

interface AiPersonaContract
{
    /**
     * Provide the provider options for Ai Persona settings.
     *
     * @return array
     */
    public function aiPersonaOptions(): array;

    /**
     * Generate video details based on provided text.
     *
     * @param array $aiOptions
     */
    public function generatePersona(array $aiOptions): AiPersonaResponseContract;
}