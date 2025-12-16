<?php

namespace Modules\Grok\Resources;


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
                'value' => 'Grok',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'grok-code-fast-1',
                    'grok-4-0709',
                    'grok-3',
                    'grok-3-mini',
                ],
                'visibility' => true
            ],
            [
                'type' => 'number',
                'label' => 'Max Tokens',
                'name' => 'max_tokens',
                'min' => 1,
                'max' => 4096,
                'value' => 1024,
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
            'model' => data_get($this->data, 'model', 'grok-3'),
            'messages' => [
                ['role' => 'system', 'content' => $this->askQuestionPrompt()],
                ['role' => 'user', 'content' => $this->data['prompt']],
            ],
            'max_tokens' => maxToken('chatbot_grok'),
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
            'body' => (object) [
                'id' => 'a3d1008e-4544-40d4-d075-11527e794e4a',
                'object' => 'chat.completion',
                'created' => 1752854522,
                'model' => 'grok-4',
                'choices' => [
                    (object) [
                        'index' => 0,
                        'message' => (object) [
                            'role' => 'assistant',
                            'content' => "Hello! How can I assist you today?",
                            'refusal' => null
                        ],
                        'finish_reason' => 'stop'
                    ]
                ],
                'usage' => (object) [
                    'prompt_tokens' => 32,
                    'completion_tokens' => 9,
                    'total_tokens' => 135,
                    'prompt_tokens_details' => (object) [
                        'text_tokens' => 32,
                        'audio_tokens' => 0,
                        'image_tokens' => 0,
                        'cached_tokens' => 6
                    ],
                    'completion_tokens_details' => (object) [
                        'reasoning_tokens' => 94,
                        'audio_tokens' => 0,
                        'accepted_prediction_tokens' => 0,
                        'rejected_prediction_tokens' => 0
                    ],
                    'num_sources_used' => 0
                ],
                'system_fingerprint' => 'fp_3a7881249c'
            ]
        ];
    }
}
