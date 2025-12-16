<?php

namespace Modules\MarketingBot\Contract\Resources;

use Modules\MarketingBot\Entities\MarketingCampaign;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Entities\Segment;

interface RecipientHandlerInterface
{
    /**
     * Resolve recipients from campaign or payload.
     * Returns unified structure with 'segments' and 'contacts' keys.
     *
     * @param MarketingCampaign $campaign
     * @param array $payload
     * @return array ['segments' => [...], 'contacts' => [...]]
     */
    public function resolveRecipients(MarketingCampaign $campaign, array $payload): array;

    /**
     * Get chat ID from segment metas using channel-specific pattern.
     *
     * @param Segment $segment
     * @param string $channel
     * @return string|null
     */
    public function getSegmentChatId(Segment $segment, string $channel): ?string;

    /**
     * Get contact identifier for the channel.
     *
     * @param Contact $contact
     * @param string $channel
     * @return string|null
     */
    public function getContactIdentifier(Contact $contact, string $channel): ?string;

    /**
     * Extract contact IDs from segments (for channels where segments contain contacts).
     *
     * @param array $segmentIds
     * @param int $userId
     * @param string $channel
     * @return array Array of contact IDs
     */
    public function getContactsFromSegments(array $segmentIds, int $userId, string $channel): array;

    /**
     * Merge contacts from segments with direct contacts and remove duplicates.
     *
     * @param array $segmentContacts
     * @param array $directContacts
     * @return array Unique contact IDs
     */
    public function mergeAndDeduplicateContacts(array $segmentContacts, array $directContacts): array;

    /**
     * Prepare message payload for sending to a recipient (segment or contact).
     *
     * @param array $basePayload
     * @param Segment|Contact $recipient
     * @param string $type 'segment' or 'contact'
     * @param string $channel
     * @return array
     */
    public function prepareMessagePayload(array $basePayload, $recipient, string $type, string $channel): array;

    /**
     * Determine if segments should be processed as groups (send one message to group)
     * or if contacts should be extracted from segments.
     *
     * @param string $channel
     * @return bool True if segments should be processed as groups, false if contacts should be extracted
     */
    public function shouldProcessSegmentsAsGroups(string $channel): bool;
}

