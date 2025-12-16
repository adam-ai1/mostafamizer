<?php

namespace App\Lib;
use Modules\OpenAI\Entities\FeaturePreference;

class ChannelManager
{
    private $channels = [];

    /**
     * Add a provider to the collection.
     *
     * @param string $channel The fully qualified class name of the provider.
     * @param string|null $alias The alias for the provider.
     * @throws \Exception If the class does not exist.
     * @return void
     */
    public function add(string $channel, ?string $alias = null): void
    {
        if (! class_exists($channel)) {
            throw new \Exception("Class '$channel' does not exist.");
        }

        // Determine the alias for the provider
        $alias = $alias ? strtolower($alias) : strtolower(class_basename($channel));
        
        $channelInstance = new $channel($alias);

        if (! $channelInstance instanceof Channel) {
            throw new \Exception("Class $channel must need to extends the \App\Lib\Channel class.");
        }

        $this->channels[$alias] = $channelInstance;
    }

    /**
     * Get all channels.
     *
     * @return array The array containing all channels.
     */
    public function get(): array
    {
        return $this->channels;
    }

    /**
     * Get all channels.
     *
     * @return array The array containing all channels.
     */
    public function all(): array
    {
       return $this->channels;
    }

    /**
     * Find a provider by its alias.
     *
     * @param string $alias The alias of the provider to find.
     * @return object|null The provider object if found, or null if not found.
     */
    public function find(string $alias): ?object
    {
        return $this->channels[strtolower($alias)] ?? null;
    }

    public function databaseOptions(?string $channelName = null, ?string $userId = null): array
    {
        // Get preference and active channels
        $preference = FeaturePreference::with('metas')->where('slug', 'marketing-bot')->first();

        $activeChannels = json_decode($preference->getMeta('general_options'), true);

        // Filter only "on" channels
        $enabledChannels = array_keys(array_filter($activeChannels, function($status) {
            return $status === 'on';
        }));

        $userId = $userId ?? auth()->id();

        if (!$userId) {
            throw new \Exception(__('User not found'));
        }

        // Get user with their metadata
        $user = \App\Models\User::with('metas')->where('id', $userId)->first();

        // Build credential forms for each enabled channel
        $credentialForms = [];

        foreach ($enabledChannels as $channel) {
            // Get credentials for this channel from user metas
            $channelCredential = $user->{$channel};
            
            $credentialForms[$channel] = [
                'channel' => $channel,
                'credentials' => $channelCredential ? json_decode($channelCredential, true) : null,
            ];
        }

        return $channelName ? $credentialForms[$channelName] : $credentialForms;
    }

    /**
     * Check if the provider is active for the specified feature.
     *
     * @param string $alias The alias (name) of the provider.
     * @param string $userId The user ID to check.
     * @return object|null Returns the provider object if active, or null if not found.
     */
    public function isActive(string $alias, string $userId): object|null
    {
        try {
            $channelData = $this->databaseOptions($alias, $userId);
            
            // Check if channel data exists and has valid structure
            if (!isset($channelData['channel']) || $channelData['channel'] !== $alias) {
                return null;
            }

            // Check if credentials exist
            if (empty($channelData['credentials'])) {
                return null;
            }

            return $this->find($alias);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Validate channel credentials.
     *
     * @param string $alias The channel alias.
     * @param string|null $userId The user ID.
     * @return bool True if credentials are valid, false otherwise.
     */
    public function validateCredentials(string $alias, ?string $userId = null): bool
    {
        try {
            $options = $this->databaseOptions($alias, $userId);
            return !empty($options['credentials']);
        } catch (\Exception $e) {
            return false;
        }
    }

}
