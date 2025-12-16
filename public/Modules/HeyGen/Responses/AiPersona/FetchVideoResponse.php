<?php 

namespace Modules\HeyGen\Responses\AiPersona;

use Exception;

use Modules\OpenAI\Contracts\Responses\AiPersona\FetchVideoResponseContract;

class FetchVideoResponse implements FetchVideoResponseContract
{
    public $response;

    public $videos = [];

    public function __construct($aiResponse) 
    {
        $this->response = $aiResponse;
        $this->process();
    }
    
    /**
     * Process the response from the API.
     *
     * This method processes the response from the API and returns the video urls.
     *
     * @return array|Exception The video urls or an Exception if the API request fails.
     */
    public function process(): array|Exception
    {
        if ($this->response['code'] != 200) {
            $message = isset($this->response['body']['error']) ? $this->response['body']['error']['message'] : $this->response['body']['message'];
            $message = $message ?? __('Something went wrong, please try again.');
            return $this->handleException($message);
        } 

        $this->videos[] = file_get_contents($this->response['body']['data']['video_url']);

        return $this->videos();
    }
        
    /**
     * Retrieves the video urls.
     *
     * This method returns the video urls as an array.
     *
     * @return array The video urls.
     */
    public function videos(): array
    {
        return $this->videos;
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