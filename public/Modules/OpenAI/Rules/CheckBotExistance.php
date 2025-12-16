<?php

namespace Modules\OpenAI\Rules;
use Illuminate\Contracts\Validation\Rule;
use Modules\OpenAI\Entities\ChatBot;
use Modules\OpenAI\Entities\EmbededResource;

class CheckBotExistance implements Rule
{
    protected $failureReason;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $chatBot = ChatBot::where('code', $value)->where('type', 'widgetChatBot')->whereHas('user', function ($query) {
            $query->where('status', 'Active');
        })->first();

        if (!$chatBot) {
            $this->failureReason = __('Not Found');
            return false;
        }

        // Check if the found $chatBot is active
        if ($chatBot->status !== 'Active') {
            $this->failureReason = __('Not Active');
            return false;
        }

        // Get provider values - use chatbot's values or fallback to defaults
        $provider = $chatBot->provider ?: 'openai';
        $model = $chatBot->model ?: 'gpt-4';
        $embeddingProvider = $chatBot->embedding_provider ?: 'openai';
        $embeddingModel = $chatBot->embedding_model ?: 'text-embedding-ada-002';

        request()->merge([
            'chatbot_id' => $chatBot->id,
            'provider' => $provider,
            'model' => $model,
            'embedding_provider' => $embeddingProvider,
            'embedding_model' => $embeddingModel,
            'language' => $chatBot->language
        ]);
        $code = $chatBot->code;

        // Check if an embedded resource exists with the required metas
        $botStatus = EmbededResource::with('metas')->whereNull('parent_id')->where('user_id', $chatBot->user_id)
            ->whereHas('metas', function ($q) use ($code) {
                $q->where('key', 'chatbot_code')->where('value', $code);
            })
            ->whereHas('metas', function ($q) {
                $q->where('key', 'state')->where('value', 'Trained');
            })->exists();

        if (!$botStatus) {
            $this->failureReason = __('Not Trained');
            return false;
        }

        return true;
    }

    public function message()
    {
        return __('The selected :x is :reason.', [
            'x' => __('Chat Bot'),
            'reason' => $this->failureReason
        ]);
    }
}
