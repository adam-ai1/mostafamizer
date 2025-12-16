<?php

namespace Modules\MarketingBot\Contract\Handlers;

use Modules\MarketingBot\Contract\Resources\RecipientHandlerInterface;
use Modules\MarketingBot\Entities\MarketingCampaign;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Entities\Segment;

class DefaultRecipientHandler implements RecipientHandlerInterface
{
    /**
     * Resolve recipients from campaign or payload.
     */
    public function resolveRecipients(MarketingCampaign $campaign, array $payload): array
    {
        // Try payload first
        if (!empty($payload['recipients'])) {
            $recipients = is_array($payload['recipients']) 
                ? $payload['recipients'] 
                : json_decode($payload['recipients'], true);
            
            if (is_array($recipients)) {
                return [
                    'segments' => $recipients['segments'] ?? [],
                    'contacts' => $recipients['contacts'] ?? [],
                ];
            }
        }

        // Try campaign meta
        $recipientsMeta = $campaign->getMeta('recipients');
        if ($recipientsMeta) {
            $recipients = is_array($recipientsMeta) 
                ? $recipientsMeta 
                : json_decode($recipientsMeta, true);
            
            if (is_array($recipients)) {
                return [
                    'segments' => $recipients['segments'] ?? [],
                    'contacts' => $recipients['contacts'] ?? [],
                ];
            }
        }

        return ['segments' => [], 'contacts' => []];
    }

    /**
     * Get chat ID from segment metas using channel-specific pattern.
     */
    public function getSegmentChatId(Segment $segment, string $channel): ?string
    {
        $metaKey = strtolower($channel) . '_chat_id';
        $chatId = $segment->getMeta($metaKey);
        
        return $chatId ? (string) $chatId : null;
    }

    /**
     * Get contact identifier for the channel.
     */
    public function getContactIdentifier(Contact $contact, string $channel): ?string
    {
        $metaKey = strtolower($channel) . '_contact_id';
        $identifier = $contact->getMeta($metaKey);
        
        if ($identifier) {
            return (string) $identifier;
        }

        // Fallback to phone for channels that use it
        return $contact->phone ?? null;
    }

    /**
     * Extract contact IDs from segments.
     */
    public function getContactsFromSegments(array $segmentIds, int $userId, string $channel): array
    {
        if (empty($segmentIds)) {
            return [];
        }

        // For default handler, segments don't contain contacts
        // This would need to be implemented per channel if needed
        return [];
    }

    /**
     * Merge contacts from segments with direct contacts and remove duplicates.
     */
    public function mergeAndDeduplicateContacts(array $segmentContacts, array $directContacts): array
    {
        $merged = array_merge($segmentContacts, $directContacts);
        return array_values(array_unique($merged));
    }

    /**
     * Prepare message payload for sending to a recipient.
     */
    public function prepareMessagePayload(array $basePayload, $recipient, string $type, string $channel): array
    {
        $payload = array_merge($basePayload, [
            'channel' => $channel,
        ]);

        if ($type === 'segment' && $recipient instanceof Segment) {
            $chatId = $this->getSegmentChatId($recipient, $channel);
            $payload['segment_id'] = $recipient->id;
            $payload['chat_type'] = 'group';
            if ($chatId) {
                $payload['chat_id'] = $chatId;
            }
        } elseif ($type === 'contact' && $recipient instanceof Contact) {
            $identifier = $this->getContactIdentifier($recipient, $channel);
            $payload['contact_id'] = $recipient->id;
            $payload['chat_type'] = 'private';
            if ($identifier) {
                $payload['contact_number'] = $identifier;
                // Also set channel-specific identifier
                $metaKey = strtolower($channel) . '_contact_id';
                $payload[$metaKey] = $identifier;
            }
        }

        return $payload;
    }

    /**
     * Default: extract contacts from segments (safer default).
     */
    public function shouldProcessSegmentsAsGroups(string $channel): bool
    {
        return false; // Extract contacts by default
    }
}

