<?php

namespace Modules\MarketingBot\Contract\Handlers;

use Modules\MarketingBot\Contract\Resources\RecipientHandlerInterface;
use Modules\MarketingBot\Entities\MarketingCampaign;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Entities\Segment;

class WhatsAppRecipientHandler implements RecipientHandlerInterface
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
     * Get chat ID from segment metas (not used for WhatsApp).
     */
    public function getSegmentChatId(Segment $segment, string $channel): ?string
    {
        return null;
    }

    /**
     * Get contact identifier for WhatsApp.
     */
    public function getContactIdentifier(Contact $contact, string $channel): ?string
    {
        return $contact->phone ?? null;
    }

    /**
     * Extract contact IDs from WhatsApp segments.
     * WhatsApp segments contain contacts, so we need to find contacts that belong to these segments.
     */
    public function getContactsFromSegments(array $segmentIds, int $userId, string $channel): array
    {
        if (empty($segmentIds)) {
            return [];
        }

        // Get contacts that belong to the specified segments
        // Contacts have segment_ids field (comma-separated or JSON)
        $contacts = Contact::with('metas')->where('user_id', $userId)
            ->where('channel', $channel)
            ->get();

        $contactIds = [];
        foreach ($contacts as $contact) {
            $contactSegmentIds = [];
            
            if (!empty($contact->segment_ids)) {
                if (is_array($contact->segment_ids)) {
                    $contactSegmentIds = $contact->segment_ids;
                } else {
                    $decoded = json_decode($contact->segment_ids, true);
                    if (is_array($decoded)) {
                        $contactSegmentIds = $decoded;
                    } else {
                        // Try comma-separated
                        $contactSegmentIds = array_filter(explode(',', (string) $contact->segment_ids));
                    }
                }
            }

            // Check if contact belongs to any of the selected segments
            foreach ($segmentIds as $segmentId) {
                if (in_array($segmentId, $contactSegmentIds)) {
                    $contactIds[] = $contact->id;
                    break; // Contact already added, move to next contact
                }
            }
        }

        return array_unique($contactIds);
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
     * Prepare message payload for WhatsApp.
     */
    public function prepareMessagePayload(array $basePayload, $recipient, string $type, string $channel): array
    {
        $payload = array_merge($basePayload, ['channel' => $channel]);

        if ($type === 'contact' && $recipient instanceof Contact) {
            $payload['contact_id'] = $recipient->id;
            $payload['contact_number'] = $recipient->phone;
            $payload['chat_type'] = 'private';
        } elseif ($type === 'segment' && $recipient instanceof Segment) {
            // WhatsApp segments are contact lists, but we still mark them for consistency
            $payload['segment_id'] = $recipient->id;
            $payload['chat_type'] = 'group';
        }

        return $payload;
    }

    /**
     * WhatsApp segments contain contacts, so extract contacts instead of processing as groups.
     */
    public function shouldProcessSegmentsAsGroups(string $channel): bool
    {
        return false; // Extract contacts from segments
    }
}

