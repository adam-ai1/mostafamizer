<?php

namespace Modules\MarketingBot\Services;

use Modules\MarketingBot\Contract\Resources\RecipientHandlerInterface;
use Modules\MarketingBot\Contract\Handlers\WhatsAppRecipientHandler;
use Modules\MarketingBot\Contract\Handlers\TelegramRecipientHandler;
use Modules\MarketingBot\Contract\Handlers\DefaultRecipientHandler;

class RecipientHandlerFactory
{
    /**
     * Get the appropriate recipient handler for the channel.
     *
     * @param string $channel
     * @return RecipientHandlerInterface
     */
    public static function getHandler(string $channel): RecipientHandlerInterface
    {
        return match (strtolower($channel)) {
            'whatsapp' => new WhatsAppRecipientHandler(),
            'telegram' => new TelegramRecipientHandler(),
            default => new DefaultRecipientHandler(),
        };
    }
}

