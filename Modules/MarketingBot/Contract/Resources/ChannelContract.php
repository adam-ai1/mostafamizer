<?php

namespace Modules\MarketingBot\Contract\Resources;


interface ChannelContract
{
    /**
     * Provide the provider options for aiChat settings.
     *
     * @return array
     */
    public function sendMessage(): array;

    public function sync(): array;

}
