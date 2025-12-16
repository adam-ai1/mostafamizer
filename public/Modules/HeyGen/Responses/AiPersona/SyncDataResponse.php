<?php 

namespace Modules\HeyGen\Responses\AiPersona;
use Exception;

use Modules\OpenAI\Contracts\Responses\AiPersona\SyncDataResponseContract;

class SyncDataResponse implements SyncDataResponseContract
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
    public function process(): mixed
    {
        if ($this->response['code'] == 401) {
            return $this->handleException(__("There's an issue with the :x API key. Kindly reach out to the administration for assistance.", ['x' => __('HEYGEN')]));
        }
        
        if ($this->response['code'] != 200) {
            $message = is_array($this->response['body']['error']) ? $this->response['body']['error']['message'] : $this->response['body']['error'];
            $message = $message ?? __('Something went wrong, please try again.');
            return $this->handleException($message);
        }

        if (is_null($this->response['body'])) {
            throw new \Exception(__('Something went wrong, please try again.'));
        }

        return $this->response['body']['data'];
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
