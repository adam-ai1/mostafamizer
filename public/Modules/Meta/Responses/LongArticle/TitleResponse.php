<?php 

namespace Modules\Meta\Responses\LongArticle;

use Exception;
use Modules\OpenAI\Contracts\Responses\LongArticle\TitleResponseContract;

class TitleResponse implements TitleResponseContract
{
    private $response;

    public function __construct($response)
    {
        $this->response = $response;
        $this->content();
        $this->words();
        $this->expense();
    }
    public function content(): array
    {
        if ($this->response->code !== 200) {

            if (isset($this->response->body->status) && $this->response->body->status == 401) {
                $this->handleException(__("There's an issue with your API key."));
            }

            $this->handleException($this->response->body->error->message ?? $this->response->body->error);
        }

        $content = $this->response->body->completion_message->content->text;
        if (is_string($content)) {
            $content = json_decode($content);
            if (! json_last_error() === JSON_ERROR_NONE) {
                $this->handleException(__('Something went wrong with title generation'));
            }
        }
        return $content;
    }

    public function words(): int
    {
        return  preference('word_count_method') == 'token'
        ? (int) subscription('tokenToWord', $this->expense()) : countWords($this->response->body->completion_message->content->text);
    }

    public function expense(): int
    {
        $totalTokens = null;

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