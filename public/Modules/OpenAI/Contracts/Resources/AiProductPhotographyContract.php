<?php

namespace Modules\OpenAI\Contracts\Resources;

interface AiProductPhotographyContract
{
    /**
     * Provide the provider options for aiChat settings.
     *
     * @return array
     */
    public function aiProductPhotographyOptions(): array;
}
