<?php

namespace Modules\Meta\Responses\LongArticle;

use Exception;
use Modules\OpenAI\Contracts\Responses\LongArticle\OutlineResponseContract;

class OutlineResponse implements OutlineResponseContract
{
    public $response;
    public $articleContent;
    public $expense = 0;
    public $word = 0;


    public function __construct($response)
    {
        $this->response = $response;
        $this->content();
        $this->words();
        $this->expense();
        $this->response();
    }

    public function content(): array
    {

        if ($this->response[0]->code !== 200) {

            if (isset($this->response[0]->body->status) && $this->response[0]->body->status == 401) {
                $this->handleException(__("There's an issue with your API key."));
            }

            $this->handleException($this->response[0]->body->error->message ?? $this->response[0]->body->error);
        }

        $articleContent = [];
        if (isset($this->response) && count($this->response) > 1) {
            foreach ($this->response as $value) {
                $articleContent[] = json_decode($value->body->completion_message->content->text);
            }
        } else {
            
            $articleContent[] = json_decode($this->response[0]->body->completion_message->content->text);
        }

        return $this->articleContent =  $articleContent;
    }

    public function words(): int
    {

        if (isset($this->response) && count($this->response) > 1) {

            foreach ($this->response as $word) {
                $this->word +=  preference('word_count_method') == 'token'
                    ? (int) subscription('tokenToWord', $this->expense()) : countWords($word->body->completion_message->content->text);
            }
        
        } else {
            $this->word += preference('word_count_method') == 'token'
                ? (int) subscription('tokenToWord', $this->expense()) : countWords($this->response[0]->body->completion_message->content->text);
        }

        return $this->word;
    }

    public function expense(): int
    {

        $totalTokens = 0;

        if (isset($this->response) && count($this->response) > 1) {

            foreach ($this->response as $expense) {

                foreach ($expense->body->metrics as $metric) {
                    if ($metric->metric === 'num_total_tokens') {
                        
                        $totalTokens += $metric->value;
                        break; // stop early once found
                    }
                }
            }
            
        } else {

            foreach ($this->response[0]->body->metrics as $metric) {

                if ($metric->metric === 'num_total_tokens') {
                    $totalTokens += $metric->value;
                    break; // stop early once found
                }

            }
        }

        return $this->expense = $totalTokens;
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