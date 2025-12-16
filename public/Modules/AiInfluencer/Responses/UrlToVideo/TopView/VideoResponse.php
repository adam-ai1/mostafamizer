<?php 

namespace Modules\AiInfluencer\Responses\UrlToVideo\Topview;

use Exception;
use Modules\AiInfluencer\Contracts\Responses\UrlToVideo\VideoResponseContract;

class VideoResponse implements VideoResponseContract
{
    public $response;
    public $videoId;

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
        if ($this->response['code'] == 401) {
            return $this->handleException(__("There's an issue with the :x API key. Kindly reach out to the administration for assistance.", ['x' => __('Top View')]));
        }
        
        if ($this->response['code'] != 200) {
            $message = $this->response['body']['error'] ?? __('Something went wrong, please try again.');
            return $this->handleException($message);
        }

        return $this->video();
    }

    /**
     * Retrieves the video id.
     *
     * This method returns the video id during initialization.
     *
     * @return int The vide id.
     */
    public function video(): string
    {
        return $this->videoId = $this->response['body']['result']['taskId'];
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
