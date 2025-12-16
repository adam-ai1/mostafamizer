<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static AiProviderInstance find(string $alias)
 * @method static array get()
 * @method static array all()
 * @method static void add()
 * @method static array names()
 * @method static array databaseOptions()
 *
 * @see \App\Lib\ChannelManager
 */

class ChannelManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'channelmanager';
    }
}
