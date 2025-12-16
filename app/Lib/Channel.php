<?php

namespace App\Lib;

use ChannelManager;
use Modules\MarketingBot\Responses\ChannelResponse;

abstract class Channel
{
    private $alias;

    public function __construct(string $alias) 
    {
        $this->alias = $alias;
    }

    /**
     * Get the channel description.
     *
     * @return array
     */
    public abstract function description(): array;

    /**
     * Get the channel alias.
     *
     * @return string
     */
    public function alias()
    {
        return $this->alias;
    }

    /**
     * Get database options for the channel.
     *
     * @param string|null $channelName
     * @param string|null $userId
     * @return array
     */
    public function databaseOptions(?string $channelName = null, ?string $userId = null): array
    {
        return ChannelManager::databaseOptions($channelName, $userId);
    }

    /**
     * Get credentials for the channel.
     *
     * @param string|null $userId
     * @return array
     */
    protected function getCredentials(?string $userId = null): array
    {
        $options = $this->databaseOptions($this->alias, $userId);
        
        if (!isset($options['credentials']) || !is_array($options['credentials'])) {
            throw new \Exception(__('Channel credentials not found.'));
        }

        return $options['credentials'];
    }

    /**
     * Make an API request and return a standardized ChannelResponse.
     *
     * @param string $url
     * @param string $method
     * @param array|string $data
     * @param array $headers
     * @return ChannelResponse
     */
    protected function makeApiRequest(string $url, string $method = 'POST', $data = [], array $headers = []): ChannelResponse
    {
        if (!method_exists($this, 'makeCurlRequest')) {
            throw new \Exception(__('Channel must use ChannelApiTrait to make API requests.'));
        }

        $rawResponse = $this->makeCurlRequest($url, $method, $data, $headers);
        
        return ChannelResponse::fromRawResponse($rawResponse);
    }
}