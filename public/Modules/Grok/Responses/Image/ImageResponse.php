<?php 

namespace Modules\Grok\Responses\Image;

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
        if ($this->response->code !== 200) {

            if (isset($this->response->body->error->code) && $this->response->body->error->code == 401) {
                $this->handleException(__("There's an issue with your API key."));
            }

            $this->handleException($this->response->body->error->message ?? $this->response->body->error);
        }

        foreach ($this->response->data as $key => $value) {
            if (!empty($value->url)) {
                $this->images[] =  Image::make($value->url);
            } else {
                $this->images[] =  Image::make($value->b64_json);
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