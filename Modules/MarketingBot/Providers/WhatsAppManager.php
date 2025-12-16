<?php

namespace Modules\MarketingBot\Providers;

use App\Lib\Channel;
use Modules\MarketingBot\Traits\ChannelApiTrait;
use Modules\MarketingBot\Responses\ChannelResponse;
use Modules\MarketingBot\Responses\WhatsAppResponseHandler;
use Modules\MarketingBot\Providers\Handlers\WhatsAppTemplateHandler;
use Modules\MarketingBot\Providers\Handlers\WhatsAppMarketingBotHandler;
use Illuminate\Support\Facades\Log;

class WhatsAppManager extends Channel
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
            'name' => 'WhatsApp',
            'description' => 'WhatsApp Messenger'
        ];
    }

    /**
     * Fetch templates from WhatsApp API.
     *
     * @param string|null $userId Optional user ID for credentials.
     * @return ChannelResponse
     */
    public function fetchTemplates(?string $userId = null): ChannelResponse
    {
        $credentials = $this->getCredentials($userId);
        $whatsAppId = $credentials['whatsapp_sid'];
        $token = $credentials['whatsapp_token'];
        
        $url = moduleConfig('marketingbot.whatsapp.BASE_URL') . "{$whatsAppId}/message_templates";
        $headers = ['Authorization: Bearer ' . $token];
        
        return $this->makeApiRequest($url, 'GET', [], $headers);
    }

    /**
     * Delete a template from WhatsApp API.
     *
     * @param string $templateName Template name to delete.
     * @param string|null $userId Optional user ID for credentials.
     * @return ChannelResponse
     */
    public function deleteTemplate(string $templateName, ?string $userId = null): ChannelResponse
    {
        $credentials = $this->getCredentials($userId);
        $whatsAppId = $credentials['whatsapp_sid'];
        $token = $credentials['whatsapp_token'];
       
        $url = moduleConfig('marketingbot.whatsapp.BASE_URL') . "{$whatsAppId}/message_templates?name={$templateName}";
        $headers = ['Authorization: Bearer ' . $token];
        
        return $this->makeApiRequest($url, 'DELETE', [], $headers);
    }

    /**
     * Send a message via WhatsApp API.
     *
     * @param array $payload Pre-formatted message payload.
     * @param string|null $userId Optional user ID for credentials.
     * @return ChannelResponse
     */
    public function sendMessage(array $payload, ?string $userId = null): ChannelResponse
    {
        $credentials = $this->getCredentials($userId);
        $phoneNumber = $credentials['phone_number'];
        $token = $credentials['whatsapp_token'];

        $url = moduleConfig('marketingbot.whatsapp.BASE_URL') . "{$phoneNumber}/messages";
        $headers = ['Authorization: Bearer ' . $token];
        
        return $this->makeApiRequest($url, 'POST', json_encode($payload), $headers);
    }

    /**
     * Get the template handler instance.
     *
     * @return WhatsAppTemplateHandler
     */
    public function getTemplateHandler(): WhatsAppTemplateHandler
    {
        return new WhatsAppTemplateHandler($this);
    }

    /**
     * Get the marketing bot handler instance.
     *
     * @return WhatsAppMarketingBotHandler
     */
    public function getMarketingBotHandler(): WhatsAppMarketingBotHandler
    {
        return new WhatsAppMarketingBotHandler($this);
    }

    /**
     * Check connection status by verifying credentials.
     *
     * @param string|null $userId Optional user ID for credentials.
     * @param string|null $webhookUrl Optional webhook URL (not used for WhatsApp).
     * @return array ['success' => bool, 'message' => string]
     */
    public function checkConnection(?string $userId = null, ?string $webhookUrl = null): array
    {
        try {
            // Use existing fetchTemplates method to verify connection
            $response = $this->fetchTemplates($userId);
            
            // Log the response for debugging
            Log::info('WhatsApp Connection Check Response', [
                'user_id' => $userId,
                'successful' => $response->successful(),
                'status_code' => $response->getCode(),
                'response_data' => $response->getData(),
                'error' => $response->getError(),
                'message' => $response->getMessage()
            ]);
            
            // Use WhatsAppResponseHandler to process response
            return WhatsAppResponseHandler::handle($response);
        } catch (\Exception $e) {
            Log::error('WhatsApp Connection Check Exception', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'success' => false,
                'message' => __('Failed to verify WhatsApp connection: :x', ['x' => $e->getMessage()])
            ];
        }
    }
}