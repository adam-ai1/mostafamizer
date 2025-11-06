<?php 

namespace Modules\Synthesia\Responses\AiAvatar;

use Exception;

use Modules\OpenAI\Contracts\Responses\AiAvatar\FetchVideoResponseContract;

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
        if (!in_array($this->response['code'], [200, 201])) {
            
            $body = $this->response['body'] ?? [];

            // Default message
            $message = __('Something went wrong, please try again.');

            // Check for nested input error
            if (isset($body['context']['input'][0])) {
                $inputError = $body['context']['input'][0];
                // Flatten nested arrays into readable string
                $flattened = [];
                array_walk_recursive($inputError, function($value, $key) use (&$flattened) {
                    $flattened[] = is_string($value) ? $value : json_encode($value);
                });
                $message = implode(' | ', $flattened);
            } elseif (isset($body['error'])) {
                $message = is_string($body['error']) ? $body['error'] : json_encode($body['error']);
            }

            return $this->handleException($message);
        }

        $this->videos[] = file_get_contents($this->response['body']['download']);

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