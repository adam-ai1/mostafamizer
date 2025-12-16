<?php

namespace Modules\VoxChat\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VoxConversation extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'vox_chat_conversations';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'ai_model',
        'voice_gender',
        'total_tokens',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'total_tokens' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Default AI model
     */
    const DEFAULT_MODEL = 'gpt-4o';

    /**
     * Available AI models
     */
    const AVAILABLE_MODELS = [
        'gpt-4o' => 'GPT-4o (الأحدث والأذكى)',
        'gpt-4-turbo' => 'GPT-4 Turbo',
        'gpt-4' => 'GPT-4',
        'gpt-3.5-turbo' => 'GPT-3.5 Turbo',
    ];

    /**
     * Get the user that owns the conversation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the messages for the conversation.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(VoxMessage::class, 'conversation_id');
    }

    /**
     * Get the latest message.
     */
    public function latestMessage()
    {
        return $this->hasOne(VoxMessage::class, 'conversation_id')->latest();
    }

    /**
     * Get display title (or generate from first message).
     */
    public function getDisplayTitleAttribute(): string
    {
        if ($this->title) {
            return $this->title;
        }

        $firstMessage = $this->messages()->where('role', 'user')->first();
        if ($firstMessage) {
            return \Str::limit($firstMessage->content, 50);
        }

        return 'محادثة جديدة';
    }

    /**
     * Get message count.
     */
    public function getMessageCountAttribute(): int
    {
        return $this->messages()->count();
    }

    /**
     * Generate title from conversation content using AI.
     */
    public function generateTitle(): ?string
    {
        $firstUserMessage = $this->messages()->where('role', 'user')->first();
        if ($firstUserMessage) {
            $title = \Str::limit($firstUserMessage->content, 50);
            $this->update(['title' => $title]);
            return $title;
        }
        return null;
    }

    /**
     * Scope for user conversations.
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for recent conversations.
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    /**
     * Get the system prompt for VoxCraft assistant.
     */
    public static function getSystemPrompt(): string
    {
        return <<<PROMPT
أنت VoxAI، المساعد الذكي لمنصة VoxCraft - منصة عربية متخصصة في الذكاء الاصطناعي.

🏢 **عن منصة VoxCraft:**
VoxCraft هي منصة عربية رائدة تقدم خدمات الذكاء الاصطناعي المتقدمة:

🎙️ **الإعلانات الصوتية (Audio Ads):**
- إنشاء إعلانات صوتية احترافية بأصوات عربية متعددة
- اختيار من 6 أصوات مختلفة (ذكور وإناث)
- إضافة موسيقى خلفية (حماسية، هادئة، احترافية، عاطفية)
- تحديد مدة الإعلان (15، 30، 60 ثانية)
- مناسب للراديو، يوتيوب، السوشيال ميديا، البودكاست

🎧 **البودكاست (Podcasts):**
- إنشاء حلقات بودكاست كاملة بالذكاء الاصطناعي
- محادثات بين مضيفين بأصوات طبيعية
- مواضيع متنوعة ومخصصة

🎨 **توليد الصور (Image Generation):**
- إنشاء صور فريدة بالذكاء الاصطناعي
- أنماط متعددة (واقعي، كرتوني، فني)
- دقة عالية

✍️ **كتابة المحتوى:**
- كتابة مقالات ومحتوى إبداعي
- ترجمة وتحرير النصوص
- إعادة صياغة المحتوى

💬 **المحادثة الذكية (VoxChat):**
- أنا هنا! مساعدك الذكي للإجابة على أسئلتك
- مساعدة في استخدام المنصة
- حل المشاكل التقنية

🎯 **مهمتي:**
1. مساعدة المستخدمين الجدد في فهم المنصة
2. شرح الخدمات بوضوح وبساطة
3. تقديم نصائح لاستخدام أفضل
4. حل المشاكل التقنية
5. الإجابة على الأسئلة العامة

💬 **أسلوبي:**
- ودود ومرحب باللغة العربية
- واضح ومباشر
- استخدام الإيموجي باعتدال لجعل المحادثة ممتعة
- ردود مختصرة وسهلة القراءة
- تقديم خطوات عملية عند الحاجة

⚡ **ملاحظات مهمة:**
- لا أستطيع الوصول للإنترنت أو المعلومات الحية
- لا أستطيع تنفيذ أوامر أو إنشاء محتوى نيابة عن المستخدم
- أوجه المستخدمين للصفحات المناسبة في الموقع

هل أنت جاهز لمساعدتك؟ 😊
PROMPT;
    }
}
