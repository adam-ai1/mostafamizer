<?php 

namespace Modules\Gemini\Responses\Image;

use Modules\OpenAI\Contracts\Responses\ImageResponseContract;
use Intervention\Image\Facades\Image;
use Exception;
class ImagenResponse implements ImageResponseContract
{
    public $response;
    public $images = [];

    public function __construct($aiResponse) 
    {
        $this->response = $aiResponse;
        $this->process();
    }

    public function process()
    {
   
        if (!empty($this->response->error)) {
            $this->handleException($this->response->error->message);
            return;
        }
    
        if (empty($this->response->predictions) || !is_array($this->response->predictions)) {
            $this->handleException(__('Somewthing went wrong. Please try again.'));
            return;
        }
    
        foreach ($this->response->predictions as $candidate) {
            if (!empty($candidate->bytesBase64Encoded) && !empty($candidate->mimeType)) {
                $this->images[] = Image::make($candidate->bytesBase64Encoded);
            }
        }
    }

    public function images(): array
    {
        return $this->images;
    }

    public function response(): mixed
    {
        return $this->response;
    }

    public function handleException(string $message): Exception
    {
        throw new \Exception($message);
    }
}