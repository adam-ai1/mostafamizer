<?php

namespace Modules\MarketingBot\Providers\Handlers;

use Modules\MarketingBot\Contract\Resources\MarketingBotContract;
use Modules\MarketingBot\Providers\WhatsAppManager;
use Modules\MarketingBot\Providers\Resources\WhatsAppDataProcessor;
use Modules\MarketingBot\Responses\ChannelResponse;

class WhatsAppMarketingBotHandler implements MarketingBotContract
{
    /**
     * Create a new WhatsApp marketing bot handler instance.
     *
     * @param WhatsAppManager $manager
     */
    public function __construct(private WhatsAppManager $manager)
    {
    }

    /**
     * Send an initial campaign message via WhatsApp.
     *
     * @param array $data Message data including campaign, contact info, etc.
     * @return ChannelResponse
     */
    public function sendInitialMessage(array $data): ChannelResponse
    {
        $dataProcessor = new WhatsAppDataProcessor($data);
        $payload = $dataProcessor->initialMessage();
        $userId = $data['user_id'] ?? null;

        return $this->manager->sendMessage($payload, $userId);
    }

    /**
     * Reply to a conversation message via WhatsApp.
     *
     * @param array $data Reply data including conversation_id, message, etc.
     * @return ChannelResponse
     */
    public function replyMessage(array $data): ChannelResponse
    {
        $dataProcessor = new WhatsAppDataProcessor($data);
        $payload = $dataProcessor->replyMessage();
        $userId = $data['user_id'] ?? null;

        return $this->manager->sendMessage($payload, $userId);
    }
}
