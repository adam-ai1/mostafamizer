<?php

namespace Modules\MarketingBot\Providers\Handlers;

use Modules\MarketingBot\Contract\Resources\TemplateContract;
use Modules\MarketingBot\Providers\WhatsAppManager;
use Modules\MarketingBot\Responses\ChannelResponse;

class WhatsAppTemplateHandler implements TemplateContract
{
    /**
     * Create a new WhatsApp template handler instance.
     *
     * @param WhatsAppManager $manager
     */
    public function __construct(private WhatsAppManager $manager)
    {
    }

    /**
     * Fetch templates from WhatsApp API.
     *
     * @param string|null $userId Optional user ID for credentials.
     * @return ChannelResponse
     */
    public function fetchTemplates(?string $userId = null): ChannelResponse
    {
        return $this->manager->fetchTemplates($userId);
    }

    /**
     * Delete a template from WhatsApp API.
     *
     * @param string $templateName Template name to delete.
     * @param string|null $userId Optional user ID for credentials.
     * @return ChannelResponse
     */
    public function deleteTemplate(string $templateName, ?string $userId = null): ChannelResponse
    {
        return $this->manager->deleteTemplate($templateName, $userId);
    }
}
