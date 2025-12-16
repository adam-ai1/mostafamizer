<?php

namespace Modules\MarketingBot\Providers\Handlers;

use Modules\MarketingBot\Contract\Resources\MarketingBotContract;
use Modules\MarketingBot\Providers\TelegramManager;
use Modules\MarketingBot\Providers\Resources\TelegramDataProcessor;
use Modules\MarketingBot\Responses\ChannelResponse;

class TelegramMarketingBotHandler implements MarketingBotContract
{
    /**
     * Create a new Telegram marketing bot handler instance.
     *
     * @param TelegramManager $manager
     */
    public function __construct(private TelegramManager $manager)
    {
    }

    /**
     * Send an initial campaign message via Telegram.
     *
     * @param array $data Message data including campaign, contact info, etc.
     * @return ChannelResponse
     */
    public function sendInitialMessage(array $data): ChannelResponse
    {
        $dataProcessor = new TelegramDataProcessor($data);
        $payload = $dataProcessor->initialMessage();
        $userId = $data['user_id'] ?? null;

        return $this->manager->sendMessage($payload, $userId);
    }

    /**
     * Reply to a conversation message via Telegram.
     *
     * @param array $data Reply data including conversation_id, message, etc.
     * @return ChannelResponse
     */
    public function replyMessage(array $data): ChannelResponse
    {
        $dataProcessor = new TelegramDataProcessor($data);
        $payload = $dataProcessor->replyMessage();
        $userId = $data['user_id'] ?? null;

        return $this->manager->sendMessage($payload, $userId);
    }
}
