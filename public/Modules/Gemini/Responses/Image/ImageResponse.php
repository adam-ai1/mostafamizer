<?php 

namespace Modules\Gemini\Responses\Image;

use Modules\OpenAI\Contracts\Responses\ImageResponseContract;
use Intervention\Image\Facades\Image;
use Exception;
class ImageResponse implements ImageResponseContract
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
        if (isset($this->response->error)) {
            $this->handleException($this->response->error->message);
            return;
        }
        $parts = $this->response->candidates[0]->content->parts;
        foreach ($parts as $part) {
            if (isset($part->inlineData->data)) {
                $this->images[] = Image::make($part->inlineData->data);
                break;
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