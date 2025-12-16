<?php 

namespace Modules\Gemini\Responses\Video;
use Exception;
use Modules\OpenAI\Contracts\Responses\Video\VideoResponseContract;

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
            return $this->handleException(__("There's an issue with the :x API key. Kindly reach out to the administration for assistance.", ['x' => 'Gemini']));
        }

        if (isset($this->response['body']['error'])) {
            return $this->handleException($this->response['body']['error']['message']);
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
        return $this->videoId = $this->response['body']['name'];
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
