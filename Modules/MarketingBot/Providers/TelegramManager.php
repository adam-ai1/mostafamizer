<?php

namespace Modules\MarketingBot\Providers;

use App\Lib\Channel;
use Modules\MarketingBot\Traits\ChannelApiTrait;
use Modules\MarketingBot\Responses\ChannelResponse;
use Modules\MarketingBot\Responses\TelegramResponseHandler;
use Modules\MarketingBot\Providers\Handlers\TelegramMarketingBotHandler;
use Illuminate\Support\Facades\Log;

class TelegramManager extends Channel
{
    use ChannelApiTrait;

    /**
     * Get channel description.
     *
     * @return array
     */
    public function description(): array
    {
        return [
            'name' => 'Telegram',
            'description' => 'Telegram Bot API'
        ];
    }

    /**
     * Send a message via Telegram API.
     *
     * @param array $payload Pre-formatted message payload.
     * @param string|null $userId Optional user ID for credentials.
     * @return ChannelResponse
     */
    public function sendMessage(array $payload, ?string $userId = null): ChannelResponse
    {
        $credentials = $this->getCredentials($userId);
        $botToken = $credentials['telegram_token'];

        // Decide which method to use based on the payload keys
        $method = isset($payload['photo']) ? 'sendPhoto' : 'sendMessage';

        // Build full API URL
        $baseUrl = moduleConfig('marketingbot.telegram.BASE_URL');
        $url = "{$baseUrl}{$botToken}/{$method}";

        $response = $this->makeApiRequest($url, 'POST', json_encode($payload), []);

        return $response;
    }

    /**
     * Set webhook URL for Telegram bot.
     *
     * @param string $webhookUrl The webhook URL to set.
     * @param string|null $userId Optional user ID for credentials.
     * @return ChannelResponse
     */
    public function setWebhook(string $webhookUrl, ?string $userId = null): ChannelResponse
    {
        $credentials = $this->getCredentials($userId);
        $botToken = $credentials['telegram_token'];

        $baseUrl = moduleConfig('marketingbot.telegram.BASE_URL');
        $url = "{$baseUrl}{$botToken}/setWebhook";
        
        $payload = ['url' => $webhookUrl];

        return $this->makeApiRequest($url, 'POST', json_encode($payload), []);
    }

    /**
     * Get the marketing bot handler instance.
     *
     * @return TelegramMarketingBotHandler
     */
    public function getMarketingBotHandler(): TelegramMarketingBotHandler
    {
        return new TelegramMarketingBotHandler($this);
    }

    /**
     * Check connection status by setting webhook.
     *
     * @param string|null $userId Optional user ID for credentials.
     * @param string|null $webhookUrl The webhook URL to set.
     * @return array ['success' => bool, 'message' => string]
     */
    public function checkConnection(?string $userId = null, ?string $webhookUrl = null): array
    {
        try {
            // Generate webhook URL if not provided and userId is available
            if (empty($webhookUrl) && $userId) {
                $webhookUrl = route('telegram.webhook', ['id' => techEncrypt($userId)]);
            }
            
            if (empty($webhookUrl)) {
                Log::warning('Telegram Connection Check: Webhook URL is empty', [
                    'user_id' => $userId
                ]);
                return [
                    'success' => false,
                    'message' => __('Webhook URL is required for Telegram connection check.')
                ];
            }
            
            $response = $this->setWebhook($webhookUrl, $userId);
            
            // Use TelegramResponseHandler to process response
            return TelegramResponseHandler::handle($response);
        } catch (\Exception $e) {
            Log::error('Telegram Connection Check Exception', [
                'user_id' => $userId,
                'webhook_url' => $webhookUrl ?? 'not_provided',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'success' => false,
                'message' => __('Failed to configure Telegram webhook: :x' , [ 'x' => $e->getMessage()])
            ];
        }
    }
}