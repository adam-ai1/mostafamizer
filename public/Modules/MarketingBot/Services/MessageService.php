<?php

namespace Modules\MarketingBot\Services;

use Exception;
use ChannelManager;
use Modules\MarketingBot\Contract\Resources\MarketingBotContract;
use Modules\MarketingBot\Responses\ChannelResponse;

class MessageService
{
    /**
     * Send an initial campaign message.
     *
     * @param array $data Message data including channel, campaign, contact info, etc.
     * @return ChannelResponse
     * @throws Exception
     */
    public function sendInitialMessage(array $data): ChannelResponse
    {
        $channel = $data['channel'] ?? request('channel');
        $userId = $data['user_id'] ?? auth()->id();

        if (!$channel) {
            throw new Exception(__('Channel is required.'));
        }

        if (!$userId) {
            throw new Exception(__('User not found.'));
        }

        // Get the channel manager instance
        $channelInstance = ChannelManager::isActive($channel, $userId);
        
        if (!$channelInstance) {
            throw new Exception(__('Channel not found or not active.'));
        }

        try {
            // Get marketing bot handler from manager
            if (!method_exists($channelInstance, 'getMarketingBotHandler')) {
                throw new Exception(__('Channel does not support messaging operations.'));
            }

            $handler = $channelInstance->getMarketingBotHandler();

            if (!$handler instanceof MarketingBotContract) {
                throw new Exception(__('Channel does not support sending messages.'));
            }

            $response = $handler->sendInitialMessage($data);

            if (!$response instanceof ChannelResponse) {
                throw new Exception(__('Invalid response from channel API.'));
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Reply to a conversation message.
     *
     * @param array $data Reply data including channel, conversation_id, message, etc.
     * @return ChannelResponse
     * @throws Exception
     */
    public function replyMessage(array $data): ChannelResponse
    {
        $channel = $data['channel'] ?? request('channel');
        $userId = $data['user_id'] ?? auth()->id();

        if (!$channel) {
            throw new Exception(__('Channel is required.'));
        }

        if (!$userId) {
            throw new Exception(__('User not found.'));
        }

        // Get the channel manager instance
        $channelInstance = ChannelManager::isActive($channel, $userId);
        
        if (!$channelInstance) {
            throw new Exception(__('Channel not found or not active.'));
        }

        try {
            // Get marketing bot handler from manager
            if (!method_exists($channelInstance, 'getMarketingBotHandler')) {
                throw new Exception(__('Channel does not support messaging operations.'));
            }

            $handler = $channelInstance->getMarketingBotHandler();

            if (!$handler instanceof MarketingBotContract) {
                throw new Exception(__('Channel does not support sending messages.'));
            }

            $response = $handler->replyMessage($data);

            if (!$response instanceof ChannelResponse) {
                throw new Exception(__('Invalid response from channel API.'));
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

