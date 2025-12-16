<?php

namespace Modules\VoxChat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoxMessage extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'vox_chat_messages';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'conversation_id',
        'role',
        'content',
        'content_type',
        'media_path',
        'audio_response_path',
        'tokens_used',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'tokens_used' => 'integer',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Message roles
     */
    const ROLE_USER = 'user';
    const ROLE_ASSISTANT = 'assistant';
    const ROLE_SYSTEM = 'system';

    /**
     * Content types
     */
    const TYPE_TEXT = 'text';
    const TYPE_AUDIO = 'audio';
    const TYPE_IMAGE = 'image';
    const TYPE_SCREEN = 'screen';
    const TYPE_FILE = 'file';

    /**
     * Get the conversation that owns the message.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(VoxConversation::class, 'conversation_id');
    }

    /**
     * Check if message is from user.
     */
    public function isFromUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    /**
     * Check if message is from assistant.
     */
    public function isFromAssistant(): bool
    {
        return $this->role === self::ROLE_ASSISTANT;
    }

    /**
     * Check if message is system message.
     */
    public function isSystem(): bool
    {
        return $this->role === self::ROLE_SYSTEM;
    }

    /**
     * Get formatted content (with markdown support).
     */
    public function getFormattedContentAttribute(): string
    {
        // Basic markdown to HTML conversion
        $content = $this->content;
        
        // Bold
        $content = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $content);
        
        // Italic
        $content = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $content);
        
        // Code blocks
        $content = preg_replace('/```(.*?)```/s', '<pre><code>$1</code></pre>', $content);
        
        // Inline code
        $content = preg_replace('/`(.*?)`/', '<code>$1</code>', $content);
        
        // Links
        $content = preg_replace('/\[(.*?)\]\((.*?)\)/', '<a href="$2" target="_blank" class="text-purple-500 hover:underline">$1</a>', $content);
        
        // Line breaks
        $content = nl2br($content);
        
        return $content;
    }

    /**
     * Get short preview of content.
     */
    public function getPreviewAttribute(): string
    {
        return \Str::limit(strip_tags($this->content), 100);
    }

    /**
     * Scope for user messages.
     */
    public function scopeFromUser($query)
    {
        return $query->where('role', self::ROLE_USER);
    }

    /**
     * Scope for assistant messages.
     */
    public function scopeFromAssistant($query)
    {
        return $query->where('role', self::ROLE_ASSISTANT);
    }

    /**
     * Get role icon.
     */
    public function getRoleIconAttribute(): string
    {
        return match($this->role) {
            self::ROLE_USER => '👤',
            self::ROLE_ASSISTANT => '🤖',
            self::ROLE_SYSTEM => '⚙️',
            default => '💬',
        };
    }

    /**
     * Get role label.
     */
    public function getRoleLabelAttribute(): string
    {
        return match($this->role) {
            self::ROLE_USER => 'أنت',
            self::ROLE_ASSISTANT => 'VoxAI',
            self::ROLE_SYSTEM => 'النظام',
            default => 'رسالة',
        };
    }
}
