<?php 

namespace Modules\Gemini\Responses\TextToVideo;

use Exception;

use Modules\OpenAI\Contracts\Responses\TextToVideo\FetchVideoResponseContact;

class FetchVideoResponse implements FetchVideoResponseContact
{
    public $response;

    public $urls = [];

    public function __construct($aiResponse) 
    {
        $this->response = $aiResponse;
        $this->process();
    }

    /**
     * Set video id.
     *
     * This method returns the video method to getting id.
     *
     */
    public function process()
    {   
        foreach ($this->response as $response) {
            $this->urls[] = $response;
        }

        return $this->urls();
    }
        
    public function urls(): array
    {
        return $this->urls;
    }

    /**
     * Retrieves the original API response.
     *
     * This method returns the original API response object received during initialization.
     *
     * @return mixed The original API response.
     */
    public function response(): mixed
    {
        return $this->response['body'];
    }

    /**
     * Handles exceptions by throwing a new Exception instance.
     *
     * This method throws a new Exception instance with the provided error message.
     *
     * @param string $message The error message to be included in the exception.
     *
     * @return Exception The thrown Exception instance.
     */
    public function handleException(string $message): Exception
    {
        throw new \Exception($message);
    }
}