<?php

namespace Modules\Grok\Responses\AiDocChat;

use Modules\OpenAI\Contracts\Responses\AiDocChat\AskQuestionResponseContract;
use Exception;

class AskQuestionResponse implements AskQuestionResponseContract
{
    public $content;
    public $response;
    public $expense;
    public $words;

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

    public function expense(): int
    {
         return $this->expense = $this->response->body->usage->total_tokens;
    }

    public function words(): int
    {
        return $this->words = countWords($this->response->body->choices[0]->message->content);
    }

    public function response(): mixed
    {
        return $this->response;
    }

    public function handleException(string $message): Exception
    {
        throw new Exception($message);
    }
}