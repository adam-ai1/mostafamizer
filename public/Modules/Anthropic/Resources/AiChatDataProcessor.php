<?php

namespace Modules\Anthropic\Resources;

class AiChatDataProcessor
{
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function aiChatOptions(): array
    {
        return [
            [
                'type' => 'checkbox',
                'label' => 'Provider State',
                'name' => 'status',
                'value' => '',
                'visibility' => true
            ],
            [
                'type' => 'text',
                'label' => 'Provider',
                'name' => 'provider',
                'value' => 'Anthropic',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'claude-sonnet-4-5-20250929',
                    'claude-opus-4-1-20250805',
                    'claude-opus-4-0',
                    'claude-sonnet-4-0',
                    'claude-3-7-sonnet-latest',
                    'claude-3-5-haiku-latest',
                    'claude-3-5-sonnet-latest',
                    'claude-3-opus-20240229',
                    'claude-3-sonnet-20240229',
                    'claude-3-haiku-20240307',
                ],
                'visibility' => true,
                'required' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Tones',
                'name' => 'tone',
                'value' => [
                    'Normal', 'Formal', 'Casual', 'Professional', 'Serious', 'Friendly', 'Playful', 'Authoritative', 'Empathetic', 'Persuasive', 'Optimistic', 'Sarcastic', 'Informative', 'Inspiring', 'Humble', 'Nostalgic', 'Dramatic'
                ],
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Languages',
                'name' => 'language',
                'value' => [
                    'English', 'French', 'Arabic', 'Byelorussian', 'Bulgarian', 'Catalan', 'Estonian', 'Dutch'
                ],
                'visibility' => true
            ],
            [
                'type' => 'number',
                'label' => 'Max Tokens',
                'name' => 'max_tokens',
                'min' => 1,
                'max' => 4096,
                'value' => 2048,
                'visibility' => true,
                'required' => true
            ],
        ];
    }

    public function validationRules()
    {
        return [
            'max_tokens' => 'required|integer|min:1|max:4096',
        ];
    }

    public function aiChatDataOptions(): array
    {

        $language = data_get($this->data, 'language', null);
        $tone = data_get($this->data, 'tone', null);
        $commonText = 'Generate response based on';
        $string = ' ';
        if ($language && $tone) {
            $string .= "{$commonText} {$language} language and in {$tone} tone.";
        } elseif ($language) {
            $string .= "{$commonText} {$language} language.";
        } elseif ($tone) {
            $string .= "{$commonText} {$tone} tone.";
        }

        $prompt = $this->data['prompt'] . $string;

        return [
            'model' => data_get($this->data, 'model', 'claude-3-sonnet-20240229'),
            'messages' => $this->prepareMessage($prompt, $this->data['chatReply']),
            'system' => $this->data['chatBot']->promt,
            "temperature" =>  1,
            "max_tokens" => maxToken('aichat_anthropic'),
        ];
    }
    
    /**
     * Prepare a message array based on the provided prompt and optional chat.
     *
     * @param string $prompt The user's prompt.
     * @param object|null $chatReply The optional chat reply object.
     * @return array The prepared message array.
     */
    public function prepareMessage(string $prompt, object $chatReply = null): array
    {
        $message = [];

        if ($chatReply) {
            foreach($chatReply as $reply) {
                $message[] = [
                    'role' => isset($reply->user_id) && $reply->user_id != null ? 'user' : 'assistant',
                    'content' => isset($reply->user_id) && $reply->user_id != null ? $reply->user_reply : $reply->bot_reply,
                ];
            }
        }

        $message[] = ['role' => 'user', 'content' => $prompt];

        return $message;
    }
}