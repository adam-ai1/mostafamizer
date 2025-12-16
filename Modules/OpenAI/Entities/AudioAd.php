<?php

/**
 * @package AudioAd
 * @author VoxCraft
 * @created 2024-12-15
 */

namespace Modules\OpenAI\Entities;

use App\Models\Model;
use App\Models\User;

class AudioAd extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'audio_ads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'ad_text',
        'product_type',
        'ad_style',
        'target_platform',
        'target_duration',
        'voice_id',
        'voice_name',
        'background_music',
        'music_volume',
        'generated_script',
        'audio_path',
        'audio_voice_only',
        'actual_duration',
        'status',
        'tier',
        'error_message',
        'provider',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'metadata' => 'array',
        'target_duration' => 'integer',
        'actual_duration' => 'integer',
        'music_volume' => 'float',
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
     * Ad Style constants
     */
    const STYLE_PROFESSIONAL = 'professional';
    const STYLE_CASUAL = 'casual';
    const STYLE_ENERGETIC = 'energetic';
    const STYLE_EMOTIONAL = 'emotional';

    /**
     * Target Platform constants
     */
    const PLATFORM_RADIO = 'radio';
    const PLATFORM_YOUTUBE = 'youtube';
    const PLATFORM_SOCIAL_MEDIA = 'social_media';
    const PLATFORM_PODCAST = 'podcast';

    /**
     * Duration presets (in seconds)
     */
    const DURATION_SHORT = 15;
    const DURATION_MEDIUM = 30;
    const DURATION_LONG = 60;

    /**
     * Background Music options
     */
    const MUSIC_NONE = 'none';
    const MUSIC_UPBEAT = 'upbeat';
    const MUSIC_CORPORATE = 'corporate';
    const MUSIC_EMOTIONAL = 'emotional';
    const MUSIC_ENERGETIC = 'energetic';
    const MUSIC_CALM = 'calm';

    /**
     * Available voices for ads
     */
    public static function getAvailableVoices(): array
    {
        return [
            'EXAVITQu4vr4xnSDxMaL' => ['name' => 'سارة', 'gender' => 'female', 'description' => 'صوت نسائي واضح واحترافي'],
            'CwhRBWXzGAHq8TQ4Fs17' => ['name' => 'روجر', 'gender' => 'male', 'description' => 'صوت رجالي قوي وواثق'],
            'JBFqnCBsd6RMkjVDRZzb' => ['name' => 'جورج', 'gender' => 'male', 'description' => 'صوت رجالي دافئ وودود'],
            'XB0fDUnXU5powFXDhCwa' => ['name' => 'شارلوت', 'gender' => 'female', 'description' => 'صوت نسائي حيوي ومرح'],
            'pFZP5JQG7iQjIQuC4Bku' => ['name' => 'ليلى', 'gender' => 'female', 'description' => 'صوت نسائي عربي أصيل'],
            'TX3LPaxmHKxFdv7VOQHJ' => ['name' => 'لايام', 'gender' => 'male', 'description' => 'صوت شاب وحماسي'],
        ];
    }

    /**
     * Get style options with labels
     */
    public static function getStyleOptions(): array
    {
        return [
            self::STYLE_PROFESSIONAL => 'احترافي وموثوق',
            self::STYLE_CASUAL => 'ودي وغير رسمي',
            self::STYLE_ENERGETIC => 'حماسي ومُحفّز',
            self::STYLE_EMOTIONAL => 'عاطفي ومؤثر',
        ];
    }

    /**
     * Get platform options with labels
     */
    public static function getPlatformOptions(): array
    {
        return [
            self::PLATFORM_RADIO => 'راديو',
            self::PLATFORM_YOUTUBE => 'يوتيوب',
            self::PLATFORM_SOCIAL_MEDIA => 'سوشيال ميديا',
            self::PLATFORM_PODCAST => 'بودكاست',
        ];
    }

    /**
     * Get duration options with labels
     */
    public static function getDurationOptions(): array
    {
        return [
            self::DURATION_SHORT => '15 ثانية - قصير',
            self::DURATION_MEDIUM => '30 ثانية - متوسط',
            self::DURATION_LONG => '60 ثانية - طويل',
        ];
    }

    /**
     * Get music options with labels
     */
    public static function getMusicOptions(): array
    {
        return [
            self::MUSIC_NONE => 'بدون موسيقى',
            self::MUSIC_UPBEAT => 'موسيقى مرحة',
            self::MUSIC_CORPORATE => 'موسيقى احترافية',
            self::MUSIC_EMOTIONAL => 'موسيقى عاطفية',
            self::MUSIC_ENERGETIC => 'موسيقى حماسية',
            self::MUSIC_CALM => 'موسيقى هادئة',
        ];
    }

    /**
     * Product type suggestions
     */
    public static function getProductTypes(): array
    {
        return [
            'technology' => 'تقنية وإلكترونيات',
            'food' => 'طعام ومشروبات',
            'fashion' => 'أزياء وموضة',
            'health' => 'صحة وجمال',
            'services' => 'خدمات',
            'education' => 'تعليم وتدريب',
            'real_estate' => 'عقارات',
            'automotive' => 'سيارات',
            'entertainment' => 'ترفيه',
            'finance' => 'مالية وبنوك',
            'travel' => 'سفر وسياحة',
            'other' => 'أخرى',
        ];
    }

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDuration(): string
    {
        if (!$this->actual_duration) {
            return '--:--';
        }
        
        $minutes = floor($this->actual_duration / 60);
        $seconds = $this->actual_duration % 60;
        
        return sprintf('%d:%02d', $minutes, $seconds);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
            self::STATUS_PROCESSING => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
            self::STATUS_COMPLETED => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
            self::STATUS_FAILED => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400',
        };
    }

    /**
     * Get status label in Arabic
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'قيد الانتظار',
            self::STATUS_PROCESSING => 'جاري المعالجة',
            self::STATUS_COMPLETED => 'مكتمل',
            self::STATUS_FAILED => 'فشل',
            default => 'غير معروف',
        };
    }

    /**
     * Check if ad is ready to play
     */
    public function isReady(): bool
    {
        return $this->status === self::STATUS_COMPLETED && !empty($this->audio_path);
    }

    /**
     * Get full audio URL
     */
    public function getAudioUrl(): ?string
    {
        if (!$this->audio_path) {
            return null;
        }
        
        return asset($this->audio_path);
    }

    /**
     * Scope for user's ads
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for completed ads
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }
}
