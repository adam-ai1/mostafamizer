<?php

namespace Modules\Meta\Resources;

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
                'value' => 'Meta',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'Llama-3.3-70B-Instruct',
                    'Llama-3.3-8B-Instruct',
                    'Llama-4-Scout-17B-16E-Instruct-FP8',
                    'Llama-4-Maverick-17B-128E-Instruct-FP8',
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
                'type' => 'dropdown',
                'label' => 'Temperature',
                'name' => 'temperature',
                'value' => [
                    '0.0',
                    '0.25',
                    '0.5',
                    '0.75',
                    '1.0'
                ],
                'default_value' => '0.9',
                'visibility' => true,
                'required' => true
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
            'model' => data_get($this->data, 'model', 'Llama-3.3-70B-Instruct'),
            'messages' => $this->prepareMessage($prompt, $this->data['chatReply'], $this->data['chatBot']),
            "temperature" =>  (float) data_get($this->data, 'temperature', '0.9'),
            "max_completion_tokens" => maxToken('aichat_meta'),
        ];
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
        $message[] = [
            'role' => 'system',
            'content' => $chatBot ? $chatBot->promt : 'You are a helpful assistant.'
        ];

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

    /**
     * Retrieves a dummy chat response for the character chatbot.
     *
     * @return object An object representing the dummy chat response.
     */
    public function dummyChat()
    {
        return (object) [
            'code' => 200,
            'body' => (object)  [
                'id' => 'a3d1008e-4544-40d4-d075-11527e794e4a',
                'completion_message' => (object) [
                    'content' => (object) [
                        "type" => "text",
                        "text" => "Hello! How can I assist you today?"
                    ],
                    "role" => "assistant",
                    "stop_reason" => "stop",
                    "tool_calls" => []
                ],
                'metrics' => (object) [
                    (object)[
                        "metric" => "num_completion_tokens",
                        "value" => 25,
                        "unit" => "tokens"
                    ],
                    (object) [
                        "metric" => "num_prompt_tokens",
                        "value" => 25,
                        "unit" => "tokens"
                    ],
                    (object) [
                        "metric" => "num_total_tokens",
                        "value" => 50,
                        "unit" => "tokens"
                    ]
                ],
            ]
        ];
    }
}