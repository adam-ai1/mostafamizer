<?php

namespace Modules\Perplexity\Responses\LongArticle;

use Modules\OpenAI\Contracts\Responses\LongArticle\OutlineResponseContract;
use Exception;

class OutlineResponse implements OutlineResponseContract
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

    public function content(): array
    {
        if ($this->response['code'] === 401) {
            $this->handleException($this->handleException(__("There's an issue with your API key.")));
        }

        $content = [];

        if (isset($this->response['body']) && count($this->response['body']) > 1) {
            
            foreach ($this->response['body'] as $value) {
                $content[] = json_decode($value['choices'][0]['message']['content']);
            }
        } else {
            $content[] = is_array($this->response['body'][0]->choices[0]->message->content) ? $this->response['body'][0]->choices[0]->message->content : json_decode($this->response['body'][0]->choices[0]->message->content) ;
        }
        return $this->content = $content;
    }

    public function words(): int
    {
        return $this->word = preference('word_count_method') == 'token'
                            ? (int) subscription('tokenToWord', $this->response['body'][0]->usage->total_tokens)
                            : countWords($this->response['body'][0]->choices[0]->message->content);

    }

    public function expense(): int
    {
        return $this->expense = $this->response['body'][0]->usage->total_tokens;
    }

    public function response(): mixed
    {
        return $this->response['body'];
    }

    public function handleException(string $message): Exception
    {
        throw new \Exception($message);
    }
}