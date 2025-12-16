<?php

namespace Modules\MarketingBot\Contract\Resources;

use Modules\MarketingBot\Responses\ChannelResponse;

interface TemplateContract
{
    /**
     * Fetch templates from the channel API.
     *
     * @param string|null $userId Optional user ID for credentials.
     * @return ChannelResponse
     */
    public function fetchTemplates(?string $userId = null): ChannelResponse;

    /**
     * Delete a template from the channel API.
     *
     * @param string $templateName Template name to delete.
     * @param string|null $userId Optional user ID for credentials.
     * @return ChannelResponse
     */
    public function deleteTemplate(string $templateName, ?string $userId = null): ChannelResponse;
}
