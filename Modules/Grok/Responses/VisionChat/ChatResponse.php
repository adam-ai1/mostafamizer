<?php 

namespace Modules\Grok\Responses\VisionChat;

use Modules\OpenAI\Contracts\Responses\VisionChat\VisionChatResponseContract;
use Exception;

class ChatResponse implements VisionChatResponseContract
{
    public $content;
    public $response;
    public $expense;
    public $word;

    public function __construct($aiResponse) 
    {
        $this->response = $aiResponse;
        $this->content();
        $this->words();
        $this->expense();
    }

    public function content(): string
    {
        if ($this->response->code !== 200) {

            if (isset($this->response->body->error->code) && $this->response->body->error->code == 401) {
                $this->handleException(__("There's an issue with your API key."));
            }

            $this->handleException($this->response->body->error->message ??$this->response->body->error);
        }

        return $this->content = $this->response->body->choices[0]->message->content;
    }

    // NOTE:: Word count will be depend on provider word count method - need refactor after complete
    public function words(): int
    {
        return $this->word = str_word_count($this->response->body->choices[0]->message->content);
    }

    // NOTE:: Expense count will be modified according to common expense calculation
    public function expense(): int
    {
        return $this->expense = $this->response->body->usage->total_tokens;
    }

    public function response(): mixed
    {
        return $this->response = $this->response->body;
    }

    public function handleException(string $message): Exception
    {
        throw new \Exception($message);
    }
}