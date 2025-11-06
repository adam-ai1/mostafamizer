<?php 

namespace Modules\AiInfluencer\Responses\AiShorts\Creatify;

use Exception;

use Modules\AiInfluencer\Contracts\Responses\AiShorts\FetchVideoResponseContract;

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
     * This method processes the response from the API and returns the video.
     *
     * @return array
     */
    public function process()
    {
        if ($this->response['code'] != 200) {
            $message = $this->response['body']['message'] ?? __('Something went wrong, please try again.');
            return $this->handleException($message);
        }

        $this->videos[] = file_get_contents($this->response['body']['product']['url']);

        return $this->videos();
    }
    
    /**
     * Get the processed videos.
     *
     * Returns the array of videos processed from the API response.
     *
     * @return array
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