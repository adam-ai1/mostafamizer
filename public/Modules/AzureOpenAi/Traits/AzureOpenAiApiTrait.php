<?php

namespace Modules\AzureOpenAi\Traits;

use GuzzleHttp\Client;

use GuzzleHttp\Exception\RequestException;

trait AzureOpenAiApiTrait
{
    /**
     * Retrieve the API key for the Gemini AI module.
     *
     * @return string
     */
    public function aiKey(): string
    {
        $key = config("aiKeys.AZUREOPENAI.API_KEY"); 

        if (empty($key)) {
            throw new \Exception(__("There's an issue with the API key. Please contact the administration for assistance."));
        }

        return $key;
    }

    public function client(string $model)
    {
        $apiUrl = config("aiKeys.AZUREOPENAI.ENDPOINT");

        if (empty($apiUrl)) {
            throw new \Exception(__("There's an issue with the API URL. Please contact the administration for assistance."));
        }

        return \OpenAI::factory()
            ->withBaseUri(sprintf('%s/openai/deployments/%s', $apiUrl, $model))
            ->withHttpHeader('api-key', $this->aiKey())
            ->withQueryParam('api-version', '2025-01-01-preview')
            ->make();
    }

    public function chat()
    {
        $model = data_get($this->processedData, 'model');
        return $this->client($model)->chat()->create($this->processedData);
    }

    public function chatStream()
    {
        $model = data_get($this->processedData, 'model');
        return $this->client($model)->chat()->createStreamed($this->processedData);
    }

    public function images()
    {
        $model = data_get($this->processedData, 'model');
        return $this->client($model)->images()->create($this->processedData);
    }

    public function embeddings()
    {
        $model = data_get($this->processedData, 'model');
        return $this->client($model)->embeddings()->create($this->processedData);
    }

    public function audio()
    {
        $model = data_get($this->processedData, 'model');
        return $this->client($model)->audio()->transcribe($this->processedData);
    }

    public function speech()
    {
        $model = data_get($this->processedData, 'model');
        return $this->client($model)->audio()->speech($this->processedData);
    }
}
