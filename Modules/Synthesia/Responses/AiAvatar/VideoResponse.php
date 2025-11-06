<?php

namespace Modules\Synthesia\Responses\AiAvatar;
use Exception;

use Modules\OpenAI\Contracts\Responses\AiAvatar\AiAvatarResponseContract;

class VideoResponse implements AiAvatarResponseContract
{
    public $response;
    public $video;

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
            return $this->handleException(__("There's an issue with the :x API key. Kindly reach out to the administration for assistance.", ['x' => 'Synthesia']));
        }
        
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

        return $this->video();
    }
    
    /**
     * Retrieves the video id.
     *
     * This method returns the video id as a string during initialization.
     *
     * @return string The video id.
     */
    public function video(): mixed
    {
        return $this->video = $this->response['body']['id'];
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
