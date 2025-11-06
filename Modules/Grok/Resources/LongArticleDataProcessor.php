<?php

namespace Modules\Grok\Resources;

use Str;

class LongArticleDataProcessor
{
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function longarticleOptions(): array
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
        return [];
    }

    public function titlePrompt(): string
    {
        return filteringBadWords("Generate " . ($this->data['number_of_title'] == '1' ? 'only one' :  $this->data['number_of_title']) ." seo friendly ". Str::plural('title', $this->data['number_of_title']) ." in " . ($this->data['options']['language'] ?? 'English'). " language based on this topic & keywords in " . ($this->data['options']['tone'] ?? 'Normal') . " tone. Topic: " . $this->data['topic'] . ", Keywords: " . $this->data['keywords'] . ". ". ($this->data['number_of_title'] == '1' ? "The title" : "Each titles") ." must be an array element, give the output as an array. No addtional text before and after array [] brackets.");
    }

    public function titleDataOptions(): array
    {
        return [
            'model' => data_get($this->data, 'options.model', 'grok-3'),
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $this->titlePrompt()
                ]
            ],
            'temperature' => (float) data_get($this->data, 'options.temperature', 1),
            'max_completion_tokens' => maxToken('longarticle_grok')
        ];
    }

    public function titleOptions(): array
    {
        return $this->titleDataOptions();
    }

    public function outlinePrompt(): string
    {
        return filteringBadWords("Generate section headings only to write a blog in " . ($this->data['options']['language'] ?? 'English') . " language in " . ($this->data['options']['tone'] ?? 'Normal') . " tone based on this title & keywords, Title: " . $this->data['title'] . ", Keywords: " . $this->data['keywords'] . ". Each section headings must be an array element, giving the output as an array. No additional text before and after array [] brackets. Please not prefix array elements with numbers and enclose array elements in double-quotes.");

    }

    public function outlineDataOptions(): array
    {
        return [
            'model' => data_get($this->data, 'options.model', 'grok-3'),
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $this->outlinePrompt()
                ]
            ],
            'temperature' => (float) data_get($this->data, 'options.temperature', 1),
            'max_completion_tokens' => maxToken('longarticle_grok')
        ];
    }

    public function outlineOptions(): array
    {
        return $this->outlineDataOptions();
    }
    
    public function articlePrompt(): string
    {
        return filteringBadWords("This is the title: " . $this->data['title'] . ". These are the keywords: " . $this->data['keywords'] . ". This is the Heading list: " . $this->data['outlines'] . ". Expand each Heading section to generate article in " . ($this->data['options']['language'] ?? 'English') . " language in ". ($this->data['options']['tone'] ?? 'Normal') ." tone. Do not add other Headings or write more than the specific Headings in Heading list. Give the Heading output in bold font.");

    }

    public function articleDataOptions(): array
    {
        return [
            'model' => data_get($this->data, 'options.model', 'grok-3'),
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $this->articlePrompt()
                ]
            ],
            'temperature' => (float) data_get($this->data, 'options.temperature', 1),
            'max_completion_tokens' => maxToken('longarticle_grok'),
            'stream' => true
        ];
    }

    public function articleOptions(): array
    {
        return $this->articleDataOptions();
    }

    /**
     * Returns a fake titles response for testing purposes.
     *
     * @return object Fake titles response.
     */
    public function fakeTitles()
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
                            'content' => "[\"Unveiling the Benefits: How AI Technology is Shaping Our Future\"]",
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

    /**
     * Returns a fake outline response for testing purposes.
     *
     * @return object Response containing generated outlines.
     */
    public function fakeOutlines()
    {
        return [
            (object) [
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
                                'content' => "[\n\"Unleashing AI Superpowers: Exploring the Future of AI Technology\",\n\"Unlocking the Potential: AI Integration Services for the Future of AI\",\n\"Intelligent Automation and Machine Learning on Demand: Powering the Future of AI\",\n\"The Future of AI: OpenAI Envisions On-Demand AI Superpowers\"\n]",
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
            ]
        ];

    }

}