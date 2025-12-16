<?php 

namespace Modules\FalAi\Responses\TextToVideo;

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
        if ($this->response['code'] == 404) {
            return $this->handleException(__('Video not found.'));
        }

        if (!in_array($this->response['code'], [200, 202])) {
            $message = is_array($this->response['body']['detail']) ? $this->response['body']['detail'][0]['msg'] : $this->response['body']['detail'];
            $message = $message ?? __('Something went wrong, please try again.');
            return $this->handleException($message);
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
        switch ($this->response['body']['status']) {
            case 'IN_QUEUE':
                return $this->status = 'queued';
            case 'IN_PROGRESS':
                return $this->status = 'running';
            case 'COMPLETED':
                return $this->status = 'succeeded';
            default:
                return $this->status = 'queued';
        }
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
        return $this->urls = $this->response['body']['video']['url'] ?? [];
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