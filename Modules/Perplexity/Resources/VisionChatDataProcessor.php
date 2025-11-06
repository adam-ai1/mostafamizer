<?php

namespace Modules\Perplexity\Resources;

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
                'value' => 'Gemini',
                'visibility' => true
            ],
            [
                'type' => 'dropdown',
                'label' => 'Models',
                'name' => 'model',
                'value' => [
                    'sonar-pro',
                ],
                'visibility' => true,
                'required' => true
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
     * Retrieve the validation rules for the current data processor.
     * 
     * @return array An array of validation rules.
     */
    public function validationRules()
    {
        return [
            'max_tokens' => 'required|integer|min:1|max:8192',
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

        return [
            'model' => data_get($this->data, 'model', 'sonar-pro'),
            'messages' =>  $messages,
            "temperature" => data_get($this->data, 'temperature', 1),
            "max_tokens" => maxToken('visionchat_perplexity')
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
        $message = [];
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
     * Generates the absolute path for an image file.
     *
     *
     * @param string $name The filename of the image.
     * @return string The absolute path to the image file.
     */
    private function imagePath($name) {
        return 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'aiVision' . DIRECTORY_SEPARATOR . $name;
    }
}
