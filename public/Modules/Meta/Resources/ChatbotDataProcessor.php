<?php

namespace Modules\Meta\Resources;


class ChatbotDataProcessor
{
    private $data = [];

    private $token = 1024;

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function chatbotOptions(): array
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

    /**
     * Returns a prompt for asking a question, filtering out bad words.
     *
     * @return string The prompt for asking a question with bad words filtered out.
     */
    public function askQuestionPrompt(): string
    {
        $context = data_get($this->data, 'content', '');

        return filteringBadWords(
            "Respond to the user's query based on the provided context: '{$context}'.
            If user sends greetings (hello, hi, good morning, etc.): Respond politely with a greeting, then ask how you can help.s
            If the context is sufficient, provide a clear, accurate, and concise answer. If the context lacks sufficient information, reply with: 'I'm sorry, but I don't have this information.'. 
            Avoid generating unrelated content or empty responses. Generate response based on " . (data_get($this->data, 'language', 'English') ) . " language and in " . (data_get($this->data, 'tone',  'Normal')) . " tone.
            Rely solely on the provided context; avoid speculation. Keep the response focused and structured. Include examples only if they enhance clarity."
        );
    }
    /**
     * Returns an array of options for asking a question.
     *
     * @return array
     */
    public function askQuestionDataOptions(): array
    {
        return [
            'model' => data_get($this->data, 'model', 'Llama-3.3-70B-Instruct'),
            'messages' => [
                ['role' => 'system', 'content' => $this->askQuestionPrompt()],
                ['role' => 'user', 'content' => $this->data['prompt']],
            ],
            'temperature' => (float) data_get($this->data, 'temperature', '0.9'),
            'max_completion_tokens' => maxToken('chatbot_meta'),
        ];
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
