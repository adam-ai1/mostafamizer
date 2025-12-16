<?php

namespace Modules\MarketingBot\Contract\Handlers;

use Modules\MarketingBot\Contract\Resources\RecipientHandlerInterface;
use Modules\MarketingBot\Entities\MarketingCampaign;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Entities\Segment;

class TelegramRecipientHandler implements RecipientHandlerInterface
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
     * Get chat ID from segment metas.
     */
    public function getSegmentChatId(Segment $segment, string $channel): ?string
    {
        return $segment->getMeta('telegram_chat_id') ?: null;
    }

    /**
     * Get contact identifier for Telegram.
     */
    public function getContactIdentifier(Contact $contact, string $channel): ?string
    {
        return $contact->getMeta('telegram_contact_id') ?: null;
    }

    /**
     * Extract contact IDs from segments.
     * For Telegram, segments (groups) don't contain contacts directly.
     * Groups are separate entities, so this returns empty array.
     */
    public function getContactsFromSegments(array $segmentIds, int $userId, string $channel): array
    {
        // Telegram groups don't contain contacts in the same way as WhatsApp segments
        // Groups are separate entities, so return empty
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
     * Prepare message payload for Telegram.
     */
    public function prepareMessagePayload(array $basePayload, $recipient, string $type, string $channel): array
    {
        $payload = array_merge($basePayload, ['channel' => $channel]);

        if ($type === 'segment' && $recipient instanceof Segment) {
            $chatId = $this->getSegmentChatId($recipient, $channel);
            $payload['segment_id'] = $recipient->id;
            $payload['title'] = $recipient->name ?? 'Telegram Group';
            $payload['chat_type'] = 'group';
            if ($chatId) {
                $payload['chat_id'] = $chatId;
                $payload['telegram_chat_id'] = $chatId;
            }
        } elseif ($type === 'contact' && $recipient instanceof Contact) {
            $payload['contact_id'] = $recipient->id;
            $payload['contact_number'] = $recipient->phone ?? null;
            $payload['chat_type'] = 'private';
            $telegramContactId = $this->getContactIdentifier($recipient, $channel);
            if ($telegramContactId) {
                $payload['telegram_contact_id'] = $telegramContactId;
            }
        }

        return $payload;
    }

    /**
     * Telegram segments are groups, so process them as groups.
     */
    public function shouldProcessSegmentsAsGroups(string $channel): bool
    {
        return true;
    }
}

