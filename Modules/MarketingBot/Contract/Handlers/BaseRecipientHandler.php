<?php

namespace Modules\MarketingBot\Contract\Handlers;

use Modules\MarketingBot\Contract\Resources\RecipientHandlerInterface;
use Modules\MarketingBot\Entities\MarketingCampaign;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Entities\Segment;

abstract class BaseRecipientHandler implements RecipientHandlerInterface
{
    /**
     * Resolve recipients from campaign or payload.
     * Common logic for all channels.
     */
    public function resolveRecipients(MarketingCampaign $campaign, array $payload): array
    {
        // Try payload first
        if (!empty($payload['recipients'])) {
            $recipients = $this->parseRecipients($payload['recipients']);
            if ($recipients) {
                return $recipients;
            }
        }

        // Try campaign meta
        $recipientsMeta = $campaign->getMeta('recipients');
        if ($recipientsMeta) {
            $recipients = $this->parseRecipients($recipientsMeta);
            if ($recipients) {
                return $recipients;
            }
        }

        return ['segments' => [], 'contacts' => []];
    }

    /**
     * Merge contacts from segments with direct contacts and remove duplicates.
     */
    public function mergeAndDeduplicateContacts(array $segmentContacts, array $directContacts): array
    {
        return array_values(array_unique(array_merge($segmentContacts, $directContacts)));
    }

    /**
     * Parse recipients from various formats.
     */
    protected function parseRecipients($value): ?array
    {
        if (empty($value)) {
            return null;
        }

        if (is_array($value)) {
            return [
                'segments' => $value['segments'] ?? [],
                'contacts' => $value['contacts'] ?? [],
            ];
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return [
                    'segments' => $decoded['segments'] ?? [],
                    'contacts' => $decoded['contacts'] ?? [],
                ];
            }
        }

        return null;
    }

    /**
     * Normalize input to array.
     */
    protected function normalizeArray($value): array
    {
        if (empty($value)) {
            return [];
        }

        if (is_array($value)) {
            return array_filter(array_map('intval', $value));
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return array_filter(array_map('intval', $decoded));
            }
            return array_filter(array_map('intval', explode(',', $value)));
        }

        return [];
    }

    /**
     * Get chat ID from segment metas using channel pattern.
     */
    public function getSegmentChatId(Segment $segment, string $channel): ?string
    {
        $metaKey = strtolower($channel) . '_chat_id';
        $chatId = $segment->getMeta($metaKey);
        
        return $chatId ? (string) $chatId : null;
    }

    /**
     * Get contact identifier using channel pattern.
     */
    public function getContactIdentifier(Contact $contact, string $channel): ?string
    {
        $metaKey = strtolower($channel) . '_contact_id';
        $identifier = $contact->getMeta($metaKey);
        
        return $identifier ? (string) $identifier : null;
    }
}

