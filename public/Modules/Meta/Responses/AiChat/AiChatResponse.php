<?php

namespace Modules\Meta\Responses\AiChat;

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

            if (isset($this->response->body->status) && $this->response->body->status == 401) {
                $this->handleException(__("There's an issue with your API key."));
            }

            $this->handleException($this->response->body->error->message ?? $this->response->body->error);
        }

        $this->content = $this->response->body->completion_message->content->text;

        return $this->content;
    }

    public function words(): int
    {
        return $this->word = preference('word_count_method') == 'token'
                ? (int) subscription('tokenToWord', $this->expense)
                : countWords($this->response->body->completion_message->content->text);

    }

    public function expense(): int
    {
        $totalTokens = 0;

        foreach ($this->response->body->metrics as $metric) {
            if ($metric->metric === 'num_total_tokens') {
                
                $totalTokens = $metric->value;
                break; // stop early once found
            }
        }

        return $this->expense = $totalTokens;
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