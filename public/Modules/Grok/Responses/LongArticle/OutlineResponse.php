<?php

namespace Modules\Grok\Responses\LongArticle;

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
    }

    public function content(): array
    {
        if ($this->response[0]->code !== 200) {

            if ($this->response[0]->body->error->code == 401) {
                $this->handleException(__("There's an issue with your API key."));
            }

            $this->handleException($this->response[0]->body->error->message ?? $this->response[0]->body->error);
        }

        $articleContent = [];
        if (isset($this->response) && count($this->response) > 1) {
            foreach ($this->response as $value) {
                $articleContent[] = json_decode($value->body->choices[0]->message->content);
            }
        } else {
            
            $articleContent[] = json_decode($this->response[0]->body->choices[0]->message->content);
        }

        return $this->articleContent =  $articleContent;
    }

    public function words(): int
    {
        if (isset($this->response) && count($this->response) > 1) {
            
            foreach ($this->response as $word) {
                $this->word +=  preference('word_count_method') == 'token'
                    ? (int) subscription('tokenToWord', $this->expense()) : countWords($word->body->choices[0]->message->content);
            }

        } else {
            $this->word += preference('word_count_method') == 'token'
                ? (int) subscription('tokenToWord', $this->expense()) : countWords($this->response[0]->body->choices[0]->message->content);
        }

        return $this->word;
    }

    public function expense(): int
    {
        if (isset($this->response) && count($this->response) > 1) {
            foreach ($this->response as $expense) {
                $this->expense += $expense->body->usage->total_tokens;
            }
        } else {
            $this->expense += $this->response[0]->body->usage->total_tokens;
        }

        return $this->expense;
    }

    public function response(): mixed
    {
        
        if (isset($this->response) && count($this->response) > 1) {
            
            // Initialize the new value with the first result
            $responseValue = $this->response[0];

            // Aggregate results
            foreach ($this->response as $key => $contentResponse) {
                if ($key > 0) {
                    $responseValue->body->choices[] = $contentResponse->body->choices[0];
                    $responseValue->body->usage->total_tokens += $contentResponse->body->usage->total_tokens;
                }
            }

            $this->response = $responseValue;
        } else {
            $this->response = $this->response[0];
        }

        return $this->response;
    }

    public function handleException(string $message): Exception
    {
        throw new Exception($message);
    }
}