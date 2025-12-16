<?php

namespace Modules\Grok\Responses\AiChat;

use Modules\OpenAI\Contracts\Responses\AiChat\AiChatResponseContract;
use Exception;

class AiChatResponse implements AiChatResponseContract
{
    public $content;
    public $response;
    public $expense;
    public $word;

    public function __construct($aiResponse)
    {
        $this->response = $aiResponse;
        $this->content();
        $this->expense();
        $this->words();
    }

    public function content(): string
    {
        if ($this->response->code !== 200) {

            if (isset($this->response->body->error->code) && $this->response->body->error->code == 401) {
                $this->handleException(__("There's an issue with your API key."));
            }

            $this->handleException($this->response->body->error->message ??$this->response->body->error);
        }

        $this->content = $this->response->body->choices[0]->message->content;

        return $this->content;
    }

    public function words(): int
    {
        return $this->word = preference('word_count_method') == 'token'
                ? (int) subscription('tokenToWord', $this->expense)
                : countWords($this->response->body->choices[0]->message->content);

    }

    public function expense(): int
    {
        return $this->expense = $this->response->body->usage->total_tokens;
    }

    public function response(): mixed
    {
        return $this->response->body;
    }

    public function handleException(string $message): Exception
    {
        throw new Exception($message);
    }
}