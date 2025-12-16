<?php

/**
 * @package Podcast
 * @author VoxCraft
 * @created 2024-12-14
 */

namespace Modules\OpenAI\Entities;

use App\Models\Model;
use App\Models\User;

class Podcast extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'podcasts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'topic',
        'host_a_name',
        'host_b_name',
        'source_material',
        'script',
        'status',
        'tier',
        'estimated_duration',
        'word_count',
        'error_message',
        'provider',
        'metadata',
        'audio_path',
        'audio_host_a',
        'audio_host_b',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'metadata' => 'array',
        'estimated_duration' => 'integer',
        'word_count' => 'integer',
    ];

    /**
     * Status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    /**
     * Tier constants
     */
    const TIER_FREE = 'free';
    const TIER_PREMIUM = 'premium';

    /**
     * Word count limit for free tier (approximately 2 minutes of audio)
     * Average speaking rate: 130-150 words per minute
     * For 2 minutes: ~260-300 words
     */
    const FREE_TIER_WORD_LIMIT = 300;

    /**
     * Premium tier word limit (approximately 15-20 minutes)
     */
    const PREMIUM_TIER_WORD_LIMIT = 3000;

    /**
     * Relation with User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if podcast is completed
     *
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Check if podcast is processing
     *
     * @return bool
     */
    public function isProcessing(): bool
    {
        return $this->status === self::STATUS_PROCESSING;
    }

    /**
     * Check if podcast failed
     *
     * @return bool
     */
    public function isFailed(): bool
    {
        return $this->status === self::STATUS_FAILED;
    }

    /**
     * Check if podcast is pending
     *
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Get formatted duration
     *
     * @return string
     */
    public function getFormattedDurationAttribute(): string
    {
        if (!$this->estimated_duration) {
            return '0:00';
        }

        $minutes = floor($this->estimated_duration / 60);
        $seconds = $this->estimated_duration % 60;

        return sprintf('%d:%02d', $minutes, $seconds);
    }

    /**
     * Scope to get user podcasts
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to get completed podcasts
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope to get pending podcasts
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Parse the script into dialogue parts
     *
     * @return array
     */
    public function getParsedScriptAttribute(): array
    {
        if (!$this->script) {
            return [];
        }

        $lines = explode("\n", $this->script);
        $dialogue = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            // Parse lines that start with "Host A:" or "Host B:"
            if (preg_match('/^(Host [AB]):?\s*(.+)$/i', $line, $matches)) {
                $dialogue[] = [
                    'speaker' => strtoupper(trim($matches[1])),
                    'text' => trim($matches[2]),
                ];
            }
        }

        return $dialogue;
    }

    /**
     * Calculate estimated duration based on word count
     * Average speaking rate: 140 words per minute
     *
     * @return int Duration in seconds
     */
    public function calculateEstimatedDuration(): int
    {
        if (!$this->word_count) {
            return 0;
        }

        $wordsPerMinute = 140;
        $minutes = $this->word_count / $wordsPerMinute;

        return (int) ceil($minutes * 60);
    }
}
