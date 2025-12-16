<?php

namespace Modules\Grok\Resources;

class CodeDataProcessor
{
    /**
     * Prompt
     *
     * @var string
     */
    protected $prompt;

    /**
     * Description: Private property to store data.
     *
     * This property is used to store data within the class. It is intended
     * to be accessed only within the class itself and not from outside.
     *
     * @var array $data An array to store data.
     */
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    /**
     * Returns an array of code options for the provider.
     *
     * @return array An array of code options with the following structure:
     * - type: string - The type of the option (e.g. "checkbox", "dropdown").
     * - label: string - The label of the option.
     * - name: string - The name of the option.
     * - value: mixed - The value of the option. For "dropdown" options, this is an array of values.
     */
    public function codeOptions(): array
    {
        return [
            [
                'type' => 'checkbox',
                'label' => 'Provider State',
                'name' => 'status',
                'value' => ''
            ],
            [
                'type' => 'dropdown',
                'label' => 'Language',
                'name' => 'language',
                'value' => [
                    'PHP',
                    'Java',
                    'Rubby',
                    'Python',
                    'C#',
                    'Go',
                    'Kotlin',
                    'HTML',
                    'Javascript',
                    'TypeScript',
                    'SQL',
                    'NoSQL'
                ]
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
                'label' => 'Code Level',
                'name' => 'code_level',
                'value' => [
                    'Noob',
                    'Moderate',
                    'High'
                ]
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
            [
                "type" => "dropdown-with-image",
                "label" => "Code Language",
                "name" => "code_language",
                "value" => [
                    [
                        "label" => "PHP",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\php.png",
                    ],
                    [
                        "label" => "Java",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\java.png",
                    ],
                    [
                        "label" => "Rubby",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\rubby.jpg",
                    ],
                    [
                        "label" => "Python",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\python.png",
                    ],
                    [
                        "label" => "C#",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\c-sharp.png",
                    ],
                    [
                        "label" => "Go",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\go-lang.png", 
                    ],
                    [
                        "label" => "Kotlin",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\kotlin.png",
                    ],  
                    [
                        "label" => "HTML",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\html-5.png",
                    ],
                    [
                        "label" => "Javascript",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\js.png",
                    ],
                    [
                        "label" => "TypeScript",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\typescript.png",
                    ],
                    [
                        "label" => "SQL",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\mysql.png",
                    ],
                    [
                        "label" => "NoSQL",
                        "url" => "Modules\\OpenAI\\Resources\\assets\\image\\code\\no-sql.png",
                    ],
                ],
                "visibility" => true,
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

    /**
     * Generates a code generation prompt based on stored data.
     *
     * @return string A string representing the code generation prompt.
     */
    public function articlePrompt(): string
    {
        return "You are an expert coding assistant. Generate high-quality, well-structured code in " . data_get($this->data, 'language', moduleConfig('openAI.codeLanguage')) . " at a " . data_get($this->data, 'codeLevel', moduleConfig('openAI.codeLevel')) . " level";
    }

    /**
     * Generates a code prompt for the OpenAI model.
     *
     * @return array The generated code prompt.
     */
    public function codePrompt(): array
    {
        return $this->prompt = ([
            'model' => data_get($this->data, 'model', 'grok-3'),
            "messages" => [
                [
                    "role" => "system",
                    "content" => $this->articlePrompt()
                ],
                [
                    "role" => "user",
                    "content" => $this->data['prompt']
                ]
            ],
            "temperature" => data_get($this->data, 'temperature', 1),
            "max_completion_tokens" => maxToken('code_grok'),
        ]);
    }

    /**
     * Generates a code prompt for the OpenAI model.
     *
     * @return array The generated code prompt.
     */
    public function code(): array
    {
       return $this->codePrompt();
    }

    /**
     * Returns a dummy code response for testing purposes.
     *
     * @return object The dummy code response.
     */
    public function dummyCode()
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
                            'content' => "```php\n// Dummy code response\nfunction helloWorld() {\n    return 'Hello, World!';\n}\n```",
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
