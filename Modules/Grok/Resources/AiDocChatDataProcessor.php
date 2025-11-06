<?php

namespace Modules\Grok\Resources;

use Str;

class AiDocChatDataProcessor
{
    private $data = [];
    private $token = 1024;

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    /**
     * Returns an array of options for the AI Doc Chat.
     *
     * @return array The array of options for the AI Doc Chat.
     */
    public function aiDocChatOptions(): array
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
                'type' => 'dropdown',
                'label' => 'Temperature',
                'name' => 'temperature',
                'value' => [
                    0, 0.25, 0.50, 0.75, 1, 1.25, 1.50, 1.75, 2
                ],
                'default_value' => 1,
                'visibility' => true
            ],
            [
                'type' => 'number',
                'label' => 'Max Tokens',
                'name' => 'max_tokens',
                'min' => 1,
                'max' => 4096,
                'value' => 1024,
                'visibility' => true
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
     * Returns a prompt for asking a question, filtering out bad words and incorporating the provided context.
     *
     * @return string The prompt for asking a question.
     */
    public function askQuestionPrompt(): string
    {   
        $context = data_get($this->data, 'context', '');
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

        $prompt = " Based on the provided context, respond to the user's query within the scope of `{$context}`. If the context doesn't contain enough information to answer, respond with 'I’m sorry, but I don't have this information.' and avoid generating unrelated content. `{$string}`";

        return filteringBadWords($prompt);
    }

    /**
     * Returns an array of options for asking a question, including the model, messages, and maximum tokens.
     *
     * @return array The array of options for asking a question.
     */
    public function askQuestionDataOptions(): array
    {
        return [
            'model' => data_get($this->data, 'chat_model', 'grok-3'),
            'messages' => [
                ['role' => 'system', 'content' => $this->askQuestionPrompt()],
                ['role' => 'user', 'content' => $this->data['prompt']],
            ],
            'max_completion_tokens' => maxToken('aidocchat_grok'),
        ];
    }

    /**
     * Returns an array of options for asking a question, including the model, messages, and maximum tokens.
     *
     * @return array The array of options for asking a question.
     */
    public function askQuestionOptions(): array
    {
        return $this->askQuestionDataOptions();
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