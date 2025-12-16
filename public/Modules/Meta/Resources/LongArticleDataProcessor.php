<?php

namespace Modules\Meta\Resources;

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
                    'Llama-3.3-70B-Instruct',
                    'Llama-3.3-8B-Instruct',
                    'Llama-4-Scout-17B-16E-Instruct-FP8',
                    'Llama-4-Maverick-17B-128E-Instruct-FP8',
                ],
                'default_value' => 'Llama-3.3-70B-Instruct',
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
                    '0.0',
                    '0.25',
                    '0.5',
                    '0.75',
                    '1.0'
                ],
                'default_value' => '0.9',
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
            'model' => data_get($this->data, 'options.model', 'Llama-3.3-70B-Instruct'),
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $this->titlePrompt()
                ]
            ],
            'temperature' => (float) data_get($this->data, 'options.temperature', '0.9'),
            'max_completion_tokens' => maxToken('longarticle_meta')
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
            'model' => data_get($this->data, 'options.model', 'llama-3.3-70b-instruct'),
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $this->outlinePrompt()
                ]
            ],
            'temperature' => (float) data_get($this->data, 'options.temperature', '0.9'),
            'max_completion_tokens' =>maxToken('longarticle_meta')
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
            'model' => data_get($this->data, 'options.model', 'llama-3.3-70b-instruct'),
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $this->articlePrompt()
                ]
            ],
            'temperature' => (float) data_get($this->data, 'options.temperature', '0.9'),
            'max_completion_tokens' =>maxToken('longarticle_meta'),
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
     * @param array $aiOptions Options for AI processing.
     */
    public function fakeTitles()
    {
        return (object) [
            'code' => 200,
            'body' => (object)  [
                'id' => 'a3d1008e-4544-40d4-d075-11527e794e4a',
                'completion_message' => 
                (object) [
                    'content' => (object) [
                        "type" => "text",
                        "text" => "[\"Unveiling the Benefits: How AI Technology is Shaping Our Future\"]"
                    ],
                    "role" => "assistant",
                    "stop_reason" => "stop",
                    "tool_calls" => []
                ],
                'metrics' => [
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

    /**
     * Returns a fake outline response for testing purposes.
     *
     * 
     * @return OutlineResponseContract Response containing generated titles.
     */
    public function fakeOutlines()
    {
        return [
            (object) [
                'code' => 200,
                'body' => (object)  [
                    'id' => 'a3d1008e-4544-40d4-d075-11527e794e4a',
                    'completion_message' => (object) [
                        'content' => (object) [
                            "type" => "text",
                            "text" => "[\n\"Unleashing AI Superpowers: Exploring the Future of AI Technology\",\n\"Unlocking the Potential: AI Integration Services for the Future of AI\",\n\"Intelligent Automation and Machine Learning on Demand: Powering the Future of AI\",\n\"The Future of AI: OpenAI Envisions On-Demand AI Superpowers\"\n]"
                        ],
                        "role" => "assistant",
                        "stop_reason" => "stop",
                        "tool_calls" => []
                    ],
                    'metrics' => [
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
            ]
        ];
    }

}