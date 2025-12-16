<?php

namespace App\Providers;

use App\Lib\ChannelManager;
use Illuminate\Support\ServiceProvider;

class ChannelManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('channelmanager', function ($app) {
            return new ChannelManager;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
