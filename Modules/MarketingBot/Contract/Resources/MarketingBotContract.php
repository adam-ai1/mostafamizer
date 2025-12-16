<?php

namespace Modules\MarketingBot\Contract\Resources;

use Modules\MarketingBot\Responses\ChannelResponse;

interface MarketingBotContract
{
    /**
     * Send an initial campaign message.
     *
     * @param array $data Message data including campaign, contact info, etc.
     * @return ChannelResponse
     */
    public function sendInitialMessage(array $data): ChannelResponse;

    /**
     * Reply to a conversation message.
     *
     * @param array $data Reply data including conversation_id, message, etc.
     * @return ChannelResponse
     */
    public function replyMessage(array $data): ChannelResponse;
}
