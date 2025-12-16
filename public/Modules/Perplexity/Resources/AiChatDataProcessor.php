<?php

namespace Modules\Perplexity\Resources;

class AiChatDataProcessor
{
    private $data = [];

    /**
     * @var int $token which is used as default.
     *
     */
    private $token = 1024;

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    /**
     * Returns an array of options for configuring the character chatbot.
     *
     * @return array The configuration options for the character chatbot.
     */
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
                'value' => 'Gemini',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'sonar',
                    'sonar-pro',
                    'sonar-deep-research',
                    'sonar-reasoning-pro',
                    'sonar-reasoning'
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
                'max' => 8192,
                'value' => 2048,
                'visibility' => true,
                'required' => true
            ],
        ];
    }

    /**
     * Prepares and returns the data options for the chatbot interaction.
     *
     * @return array The data options for the chatbot interaction.
     */
    public function aiChatDataOptions(): array
    {
        return [
            'model' => data_get($this->data, 'model', 'sonar-pro'),
            "messages" => [
                [
                    "role" => "user",
                   'contents' => $this->prepareMessage($this->data['prompt'], $this->data['chatReply'], $this->data['chatBot']),
                ],
            ],
            
            "temperature" => data_get($this->data, 'temperature', 1),
            "max_tokens" => maxToken('aichat_perplexity')
        ];
    }

    /**
     * Retrieve the validation rules for the current data processor.
     * 
     * @return array An array of validation rules.
     */
    public function validationRules()
    {
        return [
            'max_tokens' => 'required|integer|min:1|max:4096',
        ];
    }

    public function chatPrompt(string $prompt): string
    {
        return "Generate base on `" . $prompt . "`" . ". The language will be in " . data_get($this->data, 'language', 'English') . " and the tone will be in " . data_get($this->data, 'tone', 'Casual') . ".";
    }


    /**
     * Prepare a message array based on the provided ChatBot, prompt, and optional chat.
     *
     * @param  object|array  $chatBot  The ChatBot instance.
     * @param  string  $prompt  The user's prompt.
     * @param  \Modules\OpenAI\Entities\Archive|null  $chat  The optional chat instance (can be null).
     * @return array  The prepared message array.
     */
    public function prepareMessage(string $prompt, object $chatReply = null, object|array $chatBot = null): array
    {
        $messages = [];

        if (!empty($chatBot->prompt)) { 
            $messages[] = ['role' => 'system', 'content' => $this->chatPrompt($chatBot->prompt)];
        }

        if ($chatReply) {
            foreach ($chatReply as $reply) {
                $role = isset($reply->user_id) ? 'user' : 'assistant';
                $text = isset($reply->user_id) ? $reply->user_reply : $reply->bot_reply;
                if (!empty($text)) {
                    $messages[] = ['role' => $role, 'content' => $text];
                }
            }
        }
        $messages[] = ['role' => 'user', 'content' => $prompt];
        return $messages;
    }
}