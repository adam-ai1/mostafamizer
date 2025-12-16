<?php

namespace Modules\MarketingBot\Responses;

use Modules\MarketingBot\Responses\ChannelResponse;

class TelegramResponseHandler
{
    /**
     * Handle Telegram API response and extract error message.
     *
     * @param ChannelResponse $response
     * @return array ['success' => bool, 'message' => string]
     */
    public static function handle(ChannelResponse $response): array
    {
        $data = $response->getData();

        // Check if Telegram API returned {"ok": true}
        if ($response->successful() && isset($data['ok']) && $data['ok'] === true) {
            return [
                'success' => true,
                'message' => __('Telegram webhook configured successfully.')
            ];
        }

        $error = $response->getError();
        $message = $response->getMessage();
        $code = $response->getCode();

        // Extract specific error messages from Telegram API
        if (isset($data['ok']) && $data['ok'] === false && isset($data['description'])) {
            $message = $data['description'];
        } elseif (isset($error['description'])) {
            $message = $error['description'];
        }

        // Handle common Telegram API error codes
        if (isset($data['error_code'])) {
            $errorCode = $data['error_code'];
            
            switch ($errorCode) {
                case 401:
                    $message = __('Invalid Telegram bot token. Please check your Access Token.');
                    break;
                case 404:
                    $message = __('Telegram bot not found. Please verify your bot token.');
                    break;
                case 400:
                    $message = $message ?: __('Invalid webhook URL. Please check the URL format.');
                    break;
                default:
                    $message = $message ?: __('Telegram API error occurred.');
            }
        }

        // Handle HTTP status codes
        if ($code === 401) {
            $message = __('Invalid Telegram bot token. Please check your Access Token.');
        } elseif ($code === 404) {
            $message = __('Telegram bot not found. Please verify your bot token.');
        } elseif ($code >= 500) {
            $message = __('Telegram API server error. Please try again later.');
        }

        return [
            'success' => false,
            'message' => $message ?: __('Failed to configure Telegram webhook.')
        ];
    }
}

