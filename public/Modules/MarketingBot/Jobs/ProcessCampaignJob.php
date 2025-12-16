<?php

namespace Modules\MarketingBot\Jobs;

use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\MarketingBot\Entities\MarketingCampaign;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Entities\Segment;
use Modules\MarketingBot\Services\CampaignService;
use Modules\MarketingBot\Services\ChannelService;
use Modules\MarketingBot\Services\RecipientHandlerFactory;
use Throwable;

class ProcessCampaignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $campaignId;

    /**
     * @var int
     */
    public $userId;

    /**
     * @var array
     */
    public $payload;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 600;

    public function __construct(int $campaignId, int $userId, array $payload)
    {
        $this->campaignId = $campaignId;
        $this->userId = $userId;
        $this->payload = $payload;

        $this->onQueue('campaigns');
    }

    /**
     * Execute the job.
     *
     * @throws \Throwable
     */
    public function handle(): void
    {
        $campaign = MarketingCampaign::find($this->campaignId);

        if (! $campaign) {
            Log::warning('ProcessCampaignJob: Campaign not found.', ['campaign_id' => $this->campaignId]);
            return;
        }

        try {
            $user = User::find($this->userId);
            if ($user) {
                auth()->setUser($user);
            }

            $request = app('request');
            $request->merge([
                'user_id' => $this->userId,
                'channel' => $campaign->channel,
            ]);

            // Get channel-specific handler
            $handler = RecipientHandlerFactory::getHandler($campaign->channel);

            // Resolve recipients (segments and contacts)
            $recipients = $handler->resolveRecipients($campaign, $this->payload);
            
            Log::info('ProcessCampaignJob: Recipients resolved.', [
                'campaign_id' => $this->campaignId,
                'recipients' => $recipients,
                'payload_keys' => array_keys($this->payload),
            ]);

            // Determine if segments should be processed as groups or contacts extracted
            $processSegmentsAsGroups = $handler->shouldProcessSegmentsAsGroups($campaign->channel);

            $allContacts = [];
            $segmentsToProcess = [];

            if ($processSegmentsAsGroups) {
                // For channels like Telegram: Process segments as groups (send one message to group)
                $segmentsToProcess = $recipients['segments'] ?? [];
                // Also include direct contacts
                $allContacts = $recipients['contacts'] ?? [];
            } else {
                // For channels like WhatsApp: Extract contacts from segments and merge with direct contacts
                $segmentContacts = $handler->getContactsFromSegments(
                    $recipients['segments'] ?? [],
                    $this->userId,
                    $campaign->channel
                );
                $allContacts = $handler->mergeAndDeduplicateContacts(
                    $segmentContacts,
                    $recipients['contacts'] ?? []
                );
            }

            // Check if we have any recipients to process
            $hasSegments = !empty($segmentsToProcess);
            $hasContacts = !empty($allContacts);

            if (! $hasSegments && ! $hasContacts) {
                Log::warning('ProcessCampaignJob: No recipients to process.', ['campaign_id' => $this->campaignId]);
                $campaign->update(['status' => 'published']);
                return;
            }

            $campaign->update(['status' => 'running']);

            $campaignService = app(CampaignService::class);
            $channelService = new ChannelService();

            // Process segments as groups (e.g., Telegram groups)
            if ($hasSegments) {
                foreach ($segmentsToProcess as $segmentId) {
                    $segment = Segment::with('metas')->where('id', $segmentId)
                        ->where('user_id', $this->userId)
                        ->first();

                    if (! $segment) {
                        Log::warning('ProcessCampaignJob: Segment not found.', [
                            'campaign_id' => $this->campaignId,
                            'segment_id' => $segmentId,
                        ]);
                        continue;
                    }

                    $messagePayload = $handler->prepareMessagePayload(
                        array_merge($this->payload, ['campaign' => $campaign->id]),
                        $segment,
                        'segment',
                        $campaign->channel
                    );

                    try {
                        $response = $channelService->sendCampaignMessage($messagePayload);
                        $campaignService->storeInfo($response, $campaign, $messagePayload);
                    } catch (Exception $e) {
                        Log::error('ProcessCampaignJob: Failed to send message to segment.', [
                            'campaign_id' => $this->campaignId,
                            'segment_id' => $segmentId,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            }

            // Process contacts (merged from segments + direct contacts)
            if ($hasContacts) {
                foreach ($allContacts as $contactId) {
                    $contact = Contact::with('metas')->where('id', $contactId)
                        ->where('user_id', $this->userId)
                        ->first();

                    if (! $contact) {
                        Log::warning('ProcessCampaignJob: Contact not found.', [
                            'campaign_id' => $this->campaignId,
                            'contact_id' => $contactId,
                        ]);
                        continue;
                    }

                    $messagePayload = $handler->prepareMessagePayload(
                        array_merge($this->payload, ['campaign' => $campaign->id]),
                        $contact,
                        'contact',
                        $campaign->channel
                    );

                    try {
                        $response = $channelService->sendCampaignMessage($messagePayload);
                        $campaignService->storeInfo($response, $campaign, $messagePayload);
                    } catch (Exception $e) {
                        Log::error('ProcessCampaignJob: Failed to send message to contact.', [
                            'campaign_id' => $this->campaignId,
                            'contact_id' => $contactId,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            }

            // Mark campaign as completed after processing all recipients
            $campaign->update(['status' => 'published']);
            Log::info('ProcessCampaignJob: Campaign completed successfully.', [
                'campaign_id' => $this->campaignId,
                'segments_processed' => count($segmentsToProcess),
                'contacts_processed' => count($allContacts),
            ]);
        } catch (Throwable $e) {
            // Log the error and mark campaign as failed
            Log::error('ProcessCampaignJob: Critical error occurred.', [
                'campaign_id' => $this->campaignId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            // Update campaign status to failed
            $campaign->update(['status' => 'failed']);
            
            // Re-throw to trigger job failure handling
            throw $e;
        }
    }


    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        MarketingCampaign::where('id', $this->campaignId)->update(['status' => 'failed']);

        Log::error('ProcessCampaignJob failed.', [
            'campaign_id' => $this->campaignId,
            'message' => $exception->getMessage(),
        ]);
    }
}
