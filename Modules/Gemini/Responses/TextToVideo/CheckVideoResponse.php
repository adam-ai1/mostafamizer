<?php 

namespace Modules\Gemini\Responses\TextToVideo;

use Exception;

use Modules\OpenAI\Contracts\Responses\TextToVideo\CheckVideoResponseContact;

class CheckVideoResponse implements CheckVideoResponseContact
{
    public $response;

    public string $status = 'queued';
    public array $urls = [];

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
     * @return array The video urls.
     */
    public function process()
    {
        if ($this->response['code'] == 401) {
            return $this->handleException(__("There's an issue with the :x API key. Kindly reach out to the administration for assistance.", ['x' => 'Gemini']));
        }

        if (isset($this->response['body']['error'])) {
            return $this->handleException($this->response['body']['error']['message']);
        }

        return $this->status();
    }
    
    /**
     * Retrieves the status of the video creation process.
     *
     * This method returns the status of the video creation process as returned by the API.
     *
     * @return string The status of the video creation process.
     */
    public function status(): string
    {
        if (isset($this->response['body']['done'])) {
            return $this->status = 'succeeded';
        }

        return $this->status = 'queued';
    }

    /**
     * Retrieves the video urls.
     *
     * This method returns the video urls as an array.
     *
     * @return array The video urls.
     */
    public function urls(): array
    {
        return $this->urls = [];
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