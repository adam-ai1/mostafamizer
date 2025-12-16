<?php

/**
 * @package TextToVideoService
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Khayeruzzaman <[shakib.techvill@gmail.com]>
 * @created 14-10-2025
 */
namespace Modules\MarketingBot\Services;

use Modules\OpenAI\Entities\Archive;
use Exception, Str, DB, ChannelManager;
use Illuminate\Database\Eloquent\Builder;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Entities\Segment;
use Modules\MarketingBot\Entities\Template;
use Modules\MarketingBot\Services\TemplateService;
use Modules\MarketingBot\Services\MessageService;
use Modules\OpenAI\Services\v2\FeatureManagerService;

class ChannelService
{
    protected $channel = null;

    public function __construct() 
    {   
        if (! is_null(request('channel'))) {
            $this->channel = ChannelManager::isActive(request('channel'), request('user_id'));
        }
    }

    /**
     * Sync templates from the channel API.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws Exception
     */
    public function syncTemplates()
    {
        if (! $this->channel) {
            throw new Exception(__('Please kindly check your channel connection first and then try again.'));
        }

        $channelName = request('channel');
        $userId = request('user_id') ?? auth()->id();

        $templateService = new TemplateService();
        return $templateService->syncTemplates($channelName, $userId);
    }

    public function getTemplates(string $channel = null)
    {
        return Template::with('metas')->where('user_id', auth()->id())
            ->when($channel, function (Builder $query) use ($channel) {
                return $query->where('channel', $channel);
            });
    }

    public function getTemplateById($id)
    {
        return Template::with('metas')->where('id', $id)->where('user_id', auth()->id())->first();
    }

    /**
     * Delete a template.
     *
     * @param int $id Template ID.
     * @return bool
     * @throws Exception
     */
    public function deleteTemplate($id)
    {
        if (! $this->channel) {
            throw new Exception(__('Channel not found.'));
        }

        $channelName = request('channel');
        $userId = request('user_id') ?? auth()->id();

        $templateService = new TemplateService();
        return $templateService->deleteTemplate($id, $channelName, $userId);
    }

    /**
     * Send a campaign message.
     *
     * @param array $data Message data.
     * @return \Modules\MarketingBot\Responses\ChannelResponse Response from the channel.
     * @throws Exception If the channel is not found.
     */
    public function sendCampaignMessage(array $data)
    {
        if (! $this->channel) {
            throw new Exception(__('Channel not found.'));
        }

        $data['channel'] = request('channel');
        $data['user_id'] = request('user_id') ?? auth()->id();

        $messageService = new MessageService();
        return $messageService->sendInitialMessage($data);
    }

    /**
     * Replies to a message in a channel.
     *
     * @param array $data The data to send for the reply message.
     * @return \Modules\MarketingBot\Responses\ChannelResponse The response from the channel.
     * @throws Exception If the channel is not found.
     */
    public function replyMessage(array $data)
    {
        if (! $this->channel) {
            throw new Exception(__('Please kindly check your channel connection first and then try again.'));
        }

        $archive = Archive::where('parent_id', $data['conversation_id'])->latest()->first();
        $parent = Archive::with('metas')->where('id', $data['conversation_id'])->first();

        if (! $parent) {
            throw new Exception(__('Conversation not found.'));
        }

        if ($archive) {
            $data['message_id'] = $archive->message_id;
            $data['chat_id'] = $parent->telegram_chat_id ?? null;
        }

        $data['channel'] = request('channel');
        $data['user_id'] = $data['user_id'] ?? request('user_id') ?? auth()->id();
        $data['contact_number'] = null;
        
        $contactFound = false;
        $segmentFound = false;
        
        // Try to find contact first (works for both WhatsApp and Telegram subscribers)
        if ($parent->contact_id) {
            $contact = Contact::where('id', $parent->contact_id)->first();
            if ($contact) {
                $contactFound = true;
                // Get phone number for WhatsApp or Telegram subscribers
                $data['contact_number'] = $contact->phone ?? null;
            }
        }

        // For Telegram groups, check segment_id (segments don't have phone, but have telegram_chat_id)
        if ($parent->segment_id) {
            $segment = Segment::with('metas')->where('id', $parent->segment_id)->first();
            if ($segment) {
                $segmentFound = true;
                // For Telegram groups, chat_id is already set above from parent->telegram_chat_id
                // No phone number needed for groups
                $data['contact_number'] = null;
            }
        }

        // If neither contact nor segment found, throw error
        if (! $contactFound && ! $segmentFound) {
            $channel = $data['channel'] ?? 'unknown';
            $entityType = ($channel === 'telegram') ? __('subscriber or group') : __('contact or group');
            throw new Exception(__('Unable to reply: :x information not found.', ['x' => $entityType]));
        }

        $messageService = new MessageService();
        return $messageService->replyMessage($data);
    }


    /**
     * Retrieves the models associated with each provider for the given feature.
     * 
     * @param string $featureName The name of the feature to retrieve models for.
     * 
     * @return array The array of models associated with each provider.
     * 
     */
    public function providers(string $featureName)
    {
        $featureService = new FeatureManagerService();
        $providers = $featureService->getAllProviders($featureName);
        $data = [];
        
        foreach ($providers as $provider) {
            $modelAttribute = collect($provider['attributes'] ?? [])
                ->firstWhere('name', 'model');
            
            if ($modelAttribute) {
                $data[$provider['name']] = $modelAttribute['value'];
            }
        }

        return $data;
    }
}