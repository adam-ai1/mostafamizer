<?php

namespace Modules\MarketingBot\Responses;

use Modules\MarketingBot\Responses\ChannelResponse;

class WhatsAppResponseHandler
{
    /**
     * Handle WhatsApp API response and extract error message.
     *
     * @param ChannelResponse $response
     * @return array ['success' => bool, 'message' => string]
     */
    public static function handle(ChannelResponse $response): array
    {
        if ($response->successful()) {
            return [
                'success' => true,
                'message' => __('WhatsApp connection verified successfully.')
            ];
        }

        $error = $response->getError();
        $message = $response->getMessage();
        $code = $response->getCode();

        // Extract specific error messages from WhatsApp API
        if (isset($error['error'])) {
            $whatsappError = $error['error'];
            
            if (isset($whatsappError['message'])) {
                $message = $whatsappError['message'];
            } elseif (isset($whatsappError['error_user_msg'])) {
                $message = $whatsappError['error_user_msg'];
            } elseif (isset($whatsappError['error_subcode'])) {
                $message = __('WhatsApp API Error: ') . ($whatsappError['error_subcode'] ?? __('Unknown error'));
            }
        }

        // Handle common HTTP status codes
        if ($code === 401) {
            $message = __('Invalid WhatsApp credentials. Please check your SID and Token.');
        } elseif ($code === 403) {
            $message = __('WhatsApp API access forbidden. Please verify your permissions.');
        } elseif ($code === 404) {
            $message = __('WhatsApp phone number not found. Please verify your Phone Number ID.');
        } elseif ($code >= 500) {
            $message = __('WhatsApp API server error. Please try again later.');
        }

        return [
            'success' => false,
            'message' => $message ?: __('Failed to verify WhatsApp connection.')
        ];
    }
}

