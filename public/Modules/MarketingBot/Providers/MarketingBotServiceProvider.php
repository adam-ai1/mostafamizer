<?php

namespace Modules\MarketingBot\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use App\Facades\ChannelManager;

class MarketingBotServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        add_filter('modify_feature_data', function ($features) {
            $activeRoutes = activeMenu(
                route('user.marketing-bot.template'),
                route('user.marketing-bot.inbox'),
                route('user.marketing-bot.campaigns.index'),
                route('user.marketing-bot.templates.index'),
                route('user.marketing-bot.campaigns.whatsapp-campaign.create'),
                route('user.marketing-bot.campaigns.telegram-campaign.create'),
                route('user.marketing-bot.settings'),
                route('user.marketing-bot.contacts'),
                route('user.marketing-bot.segments'),
                route('user.marketing-bot.subscribers'),
                route('user.marketing-bot.groups'),
            );
            $data = [
                [
                    'id' => 'marketing-bot',
                    'category' => 'Marketing Tools',
                    'name' => __('Marketing Bot'),
                    'description' => __('Marketing Bot Description'),
                    'icon' => '<svg class="marketing-bot-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="24" height="24">
                        <defs>
                            <linearGradient id="gradient-marketing-bot" x1="0" x2="64" y1="32" y2="32" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="' .  ($activeRoutes['color1'] ?? '#141414') . '"/>
                            <stop offset="1" stop-color="' .  ($activeRoutes['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                        </defs>
                        <!-- Bot Head -->
                        <rect x="16" y="20" width="32" height="28" rx="4" fill="url(#gradient-marketing-bot)"/>
                        <!-- Bot Eyes -->
                        <circle class="bot-eye" cx="26" cy="32" r="3" fill="#ffffff" opacity="0.9"/>
                        <circle class="bot-eye" cx="38" cy="32" r="3" fill="#ffffff" opacity="0.9"/>
                        <!-- Bot Antenna -->
                        <circle cx="32" cy="18" r="2.5" fill="url(#gradient-marketing-bot)"/>
                        <line x1="32" y1="18" x2="32" y2="20" stroke="url(#gradient-marketing-bot)" stroke-width="2" stroke-linecap="round"/>
                        <!-- Speech Bubble (Marketing) -->
                        <path d="M48 14 Q52 10 56 14 Q56 18 52 18 L46 18 Q44 20 46 22 L52 22 Q54 22 52 24 L46 24 Q44 24 44 22 L44 18 Q44 16 46 16 L52 16 Q54 14 52 14 Z" fill="url(#gradient-marketing-bot)" opacity="0.8"/>
                        <!-- Bot Mouth (smile) -->
                        <path class="bot-mouth" d="M 26 40 Q 32 44 38 40" stroke="#ffffff" stroke-width="2" fill="none" stroke-linecap="round" opacity="0.7"/>
                    </svg>',
                    'access' => hasAccess('marketing_bot') && customerPanelAccess('marketing_bot'),
                    'route' => route('user.marketing-bot.template'),
                    'menu' => $activeRoutes,
                    'settings' => [
                        'toggle_id' => 'marketing_bot',
                        'label' => __('Marketing Bot'),
                        'description' => __('Toggle to enable or disable support for Marketing Bot.'),
                    ],
                    'type' => 'feature'
                ],
            ];
            return array_merge($features, $data);
        });
    }

    /**
     * Bootstrap the service provider.
     *
     * @return void
     */
    public function boot()
    {
        // Register ChannelManager providers - only if ChannelManager is available
        // This prevents errors during upgrades when providers might not be fully loaded
        if (app()->bound('channelmanager') && class_exists('App\Facades\ChannelManager')) {
            try {
                ChannelManager::add('\\Modules\\MarketingBot\\Providers\\WhatsAppManager', 'whatsapp');
                ChannelManager::add('\\Modules\\MarketingBot\\Providers\\TelegramManager', 'telegram');
            } catch (\Exception $e) {
                // Log the error but don't break the upgrade process
                Log::warning('MarketingBot ChannelManager registration failed: ' . $e->getMessage());
            }
        }
    }
}
