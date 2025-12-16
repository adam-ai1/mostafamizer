<?php 

namespace Modules\Pebblely\Responses\AiProductPhotography;

use Modules\OpenAI\Contracts\Responses\AiProductPhotography\AiProductPhotographyResponseContract;
use Intervention\Image\Facades\Image;
use Exception;
class AiProductPhotographyResponse implements AiProductPhotographyResponseContract
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
        if ($this->response['code'] != 200) {
            $message = is_array($this->response['body']['detail']) ? $this->response['body']['detail'][0]['msg'] : $this->response['body']['detail'];
            $messgae = $message ?? __('Something went wrong, please try again.');
            return $this->handleException($message);
        }

        $this->images[] = Image::make($this->response['body']['data']);
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