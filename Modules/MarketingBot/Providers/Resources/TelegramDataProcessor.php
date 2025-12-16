<?php

namespace Modules\MarketingBot\Providers\Resources;

use Illuminate\Support\Facades\Log;
use Modules\MarketingBot\Entities\MarketingCampaign;
use Modules\MarketingBot\Entities\Contact;
use Modules\MarketingBot\Entities\Segment;

class TelegramDataProcessor
{
    private $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function initialMessage(): array
    {
        $userId = $this->data['user_id'] ?? auth()->id();
        
        if (!$userId) {
            throw new \Exception('User ID is required to send Telegram message.');
        }
        
        $campaign = MarketingCampaign::with('metas')
            ->where('user_id', $userId)
            ->where('id', $this->data['campaign'])
            ->first();
        
        if (!$campaign) {
            Log::error('TelegramDataProcessor: Campaign not found', [
                'campaign_id' => $this->data['campaign'] ?? null,
                'user_id' => $userId,
            ]);
            throw new \Exception('Campaign not found.');
        }

        $chatId = null;

        // Priority 1: Check telegram_chat_id in payload (most direct)
        if (!empty($this->data['telegram_chat_id'])) {
            $chatId = $this->data['telegram_chat_id'];
            Log::info('TelegramDataProcessor: Using telegram_chat_id from payload', ['chat_id' => $chatId]);
        }
        
        // Priority 2: Check chat_id in payload
        if (!$chatId && !empty($this->data['chat_id'])) {
            $chatId = $this->data['chat_id'];
            Log::info('TelegramDataProcessor: Using chat_id from payload', ['chat_id' => $chatId]);
        }

        // Priority 3: Check if this is a segment-based message (group)
        if (!$chatId && !empty($this->data['segment_id'])) {
            $segment = Segment::with('metas')->where('id', $this->data['segment_id'])->first();
            if ($segment) {
                // Get chat_id from segment metas
                $chatId = $segment->getMeta('telegram_chat_id');
                Log::info('TelegramDataProcessor: Segment lookup', [
                    'segment_id' => $segment->id,
                    'segment_name' => $segment->name,
                    'chat_id_from_meta' => $chatId,
                    'description' => $segment->description,
                ]);
                // Also check description field which might contain telegram:chat_id format
                if (!$chatId && !empty($segment->description) && str_starts_with($segment->description, 'telegram:')) {
                    $chatId = str_replace('telegram:', '', $segment->description);
                    Log::info('TelegramDataProcessor: Using chat_id from segment description', ['chat_id' => $chatId]);
                }
            } else {
                Log::warning('TelegramDataProcessor: Segment not found', ['segment_id' => $this->data['segment_id']]);
            }
        }
        
        // Priority 4: Try contact-based message
        if (!$chatId && !empty($this->data['contact_id'])) {
            $contact = Contact::with('metas')->where('id', $this->data['contact_id'])->first();
            if ($contact) {
                $chatId = $contact->getMeta('telegram_contact_id');
                Log::info('TelegramDataProcessor: Contact lookup', [
                    'contact_id' => $contact->id,
                    'chat_id_from_meta' => $chatId,
                ]);
                // Fallback to direct property access for backward compatibility
                if (!$chatId && isset($contact->telegram_contact_id)) {
                    $chatId = $contact->telegram_contact_id;
                    Log::info('TelegramDataProcessor: Using chat_id from contact property', ['chat_id' => $chatId]);
                }
            } else {
                Log::warning('TelegramDataProcessor: Contact not found', ['contact_id' => $this->data['contact_id']]);
            }
        }

        if (!$chatId) {
            Log::error('TelegramDataProcessor: Chat ID not found', [
                'data' => $this->data,
            ]);
            throw new \Exception('Telegram chat ID not found. Either segment_id or contact_id must be provided.');
        }

        Log::info('TelegramDataProcessor: Chat ID resolved successfully', ['chat_id' => $chatId]);

        if($campaign->image) {
            // Use forward slashes for URL path (works on all platforms)
            $imagePath = 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'campaigns' . DIRECTORY_SEPARATOR . $campaign->image;
            // Convert backslashes to forward slashes for URL
            $imagePath = str_replace('\\', '/', $imagePath);
            $photoUrl = objectStorage()->url($imagePath);
            
            Log::info('TelegramDataProcessor: Preparing photo message', [
                'chat_id' => $chatId,
                'image_path' => $imagePath,
                'photo_url' => $photoUrl,
                'has_caption' => !empty($campaign->content),
            ]);
            
            return [
                'chat_id' => $chatId,
                'photo' => $photoUrl,
                'caption' => $campaign->content ?? '',
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true,
            ];
        }

        return [
            'chat_id' => $chatId,
            'text' => $campaign->content,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
        ];
    }

    public function replyMessage(): array
    {
        $chatId = $this->data['chat_id'] ?? ($this->data['conversation_id'] ?? $this->defaultChatId());
        $message = $this->data['message'] ?? '';

        // Check if message contains code blocks, HTML tags, or special characters that break HTML parsing
        // Telegram's HTML parser fails on unescaped <, >, &, and = in code blocks
        $hasCodeBlocks = preg_match('/```[\s\S]*?```|`[^`]+`/', $message);
        $hasHtmlTags = preg_match('/<[^>]+>/', $message);
        $hasComplexFormatting = preg_match('/&[a-z]+;|&lt;|&gt;|&amp;/i', $message);
        
        // If message contains code blocks or complex formatting, send as plain text
        // This prevents Telegram's HTML parser from failing on code with = signs
        if ($hasCodeBlocks || ($hasHtmlTags && $hasComplexFormatting)) {
            Log::info('TelegramDataProcessor: Using plain text mode due to code blocks or complex formatting');
            return [
                'chat_id' => $chatId,
                'text' => $message,
                'disable_web_page_preview' => true,
            ];
        }

        // For simple text messages, use HTML mode with proper escaping
        // Escape HTML entities to prevent parsing errors
        $escapedMessage = htmlspecialchars($message, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        return [
            'chat_id' => $chatId,
            'text' => $escapedMessage,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
        ];
    }

    protected function resolveInitialText($campaign): string
    {
        if (!$campaign) {
            return $this->data['message'] ?? '';
        }

        // If a template was prepared for WhatsApp, fallback to campaign content for Telegram
        return $campaign->content ?: ($this->data['message'] ?? '');
    }

    protected function defaultChatId()
    {
        // Fallback for testing; in production this should come from user/channel settings
        return $this->data['default_chat_id'] ?? null;
    }
}


