<?php

namespace Modules\Grok\Resources;

use Str;

use Modules\OpenAI\Entities\{
    Archive, 
    ChatBot
};

class VisionChatDataProcessor
{
    /**
     * @var int $token which is used as default.
     *
     * This property holds an integer value used as a token identifier within the class.
     * It is initialized to 1024 by default.
     */
    private $token = 1024;

    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    /**
     * Returns an array of options for the vision chat feature.
     *
     * @return array An array of options for the vision chat feature.
     */
    public function visionChatOptions(): array
    {
        return [
            [
                'type' => 'checkbox',
                'label' => 'Provider State',
                'name' => 'status',
                'value' => '',
            ],
            [
                'type' => 'text',
                'label' => 'Provider',
                'name' => 'provider',
                'value' => 'Grok'
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'grok-4',
                ]
            ],
            [
                'type' => 'dropdown',
                'label' => 'Details',
                'name' => 'detail',
                'value' => [
                    'auto',
                    'low',
                    'high',
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

    public function customerValidationRules()
    {
        return [
            'file' => 'file|mimes:jpeg,jpg,png|size:20480', // max 20MB
            'prompt' => 'required|string',
        ];
    }

    /**
     * Returns an array of options for generating vision chat content.
     *
     * @return array An array of options for generating vision chat content.
     */
    public function visionDataOptions(): array
    {
        // Check if a chat with the given chatId exists
        $prompt = filteringBadWords($this->data['prompt']);
        $chat = isset($this->data['chatId']) ? Archive::where(['id' => $this->data['chatId'], 'type' => 'vision_chat'])->first() : null;

        // Prepare options for generating chat content
        $messages = $this->prepareMessage($prompt, $chat);

        //FIXME::May be some issue come if temperature not set from admin panel// check after developement
        return [
            'model' => data_get($this->data, 'model', 'grok-4'),
            'messages' => $messages,
            'max_completion_tokens' => (int) maxToken('visionchat_grok'),
        ];
    }

    /**
     * Prepares content based on the provided reply object.
     *
     * @param string $prompt The prompt to generate content for.
     * @param \Modules\OpenAI\Entities\Archive|null $chat The chat associated with the prompt.
     * @return array The generated content.
     */
    public function prepareMessage(string $prompt, $chat = null): array
    {
        $message[] = [
            "role" => "system",
            "content" => "You are an AI assistant with vision capabilities.  
                    You will be given one or more images along with optional text prompts.  
                    Your task is to:  
                    1. Accurately describe what is visible in the image(s).  
                    2. Interpret details such as objects, people, text, colors, layout, patterns, or emotions.  
                    3. Follow the user's specific request (e.g., identify, analyze, compare, extract text, or explain context).  
                    4. If asked for reasoning, explain step by step clearly.  
                    5. If information is unclear or ambiguous, state assumptions rather than inventing details.  
                    6. Always keep your answer concise, factual, and relevant to the user's query.  

                    When responding, format your answer in a structured way if it involves multiple points."
        ];
        $data[] = [
            "type" => "text",
            "text" => $prompt
        ];

        $files = isset($this->data['file']) ? $this->data['file'] : [];

        if (!is_null($chat)) {
            $chatReply = Archive::with('metas')->where(['parent_id' => $chat->id, 'type' => 'vision_chat_reply'])->orderBy('id', 'asc')->limit(5)->get();

            foreach($chatReply as $reply) {
                $message[] = [
                    'role' => isset($reply->user_id) && $reply->user_id != null ? 'user' : 'system',
                    'content' => $this->prepareContent($reply),
                ];
            }
        }

        if (!empty($files)) {
            foreach ($files as $file) {
                $data [] = [
                    "type" => "image_url",
                    "image_url" => [
                        "url" => "data:image/jpeg;base64,{" . base64_encode(file_get_contents($file)) . "}"
                    ]
                ];
            }
        }
        
        $message[] = [
            'role' => 'user',
            'content' => $data
        ];

        return $message;
    }

    /**
     * Retrieves vision chat options.
     *
     * @return array The vision chat options.
     */
    public function visionOptions(): array
    {
        return $this->visionDataOptions();
    }

    /**
      * Retrieve a vision chat bot by ID
      *
      * @param  int|null  $chatBotId
      * @return ChatBot
      */
    public function chatBot(int $chatBotId = null): ChatBot
    {
        $chatBot = ChatBot::query();
        if ($chatBotId) {
            return $chatBot->where(['id' => $chatBotId, 'status' => 'Active'])->first();
        }
        return $chatBot->where(['status' => 'Active', 'type' => 'vision'])->first();
    }

    /**
     * Prepares content based on the provided reply object.
     *
     * @param object $reply 
     * @return array|string 
     */
    private function prepareContent($reply) {

        if (isset($reply->user_id) && $reply->user_id != null) {
            $data = [];

            $data[] = [
                "type" => "text",
                "text" => $reply->user_reply
            ];

            if (isset($reply->user_files)) {
                foreach ($reply->user_files as $file) {
                    $path = objectStorage()->url($file);
                    $data [] = [
                        "type" => "image_url",
                        "image_url" => [
                            "url" => "data:image/jpeg;base64,{". base64_encode(file_get_contents($path)) . "}"
                        ]
                    ];
                }
            }
            return $data;
        }

        return $reply->bot_reply;
    }

    /**
     * Generates the absolute path for an image file.
     *
     *
     * @param string $name The filename of the image.
     * @return string The absolute path to the image file.
     */
    private function imagePath($name) {
        return 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'aiVision' . DIRECTORY_SEPARATOR . $name;
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
