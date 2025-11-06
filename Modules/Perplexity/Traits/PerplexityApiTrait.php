<?php

namespace Modules\Perplexity\Traits;

use GuzzleHttp\Client;

use GuzzleHttp\Exception\RequestException;
use Modules\Anthropic\Responses\LongArticle\StreamResponse;
use GuzzleHttp\Psr7\Response;

trait PerplexityApiTrait
{
    /**
     * Retrieve the API key for the Perplexity AI module.
     *
     * @return string
     */
    public function aiKey(): string
    {
        $key = moduleConfig("perplexity.PERPLEXITY.API_KEY");
        if (empty($key)) {
            throw new \Exception(__("There's an issue with the API key. Please contact the administration for assistance."));
        }

        return $key;
    }

    /**
     * Generate content using the specified AI model.
     *
     * @return array|null
     */
    public function chat(string $model)
    {
        $processData = "chat/completions";
        return $this->commonCurl($processData);
    }

    /**
     * Generate content using the specified AI model.
     *
     */
    public function embeddings(string $model)
    {
        $processData = "models/{$model}:embedContent?key=";
        return $this->commonCurl($processData);
    }

    public function images(string $model)
    {
        $processData = $model == 'gemini-2.0-flash-preview-image-generation' ? "models/{$model}:generateContent?key=" : "models/{$model}:predict?key=";
        return $this->commonCurl($processData);
    }

    /**
     * Common cURL function for Perplexity API calls.
     *
     * @param string $data The URL path after the base URL.
     *
     * @return array|null The JSON response from the API, or null if an error occurs.
     */
    public function commonCurl(string $data)
    {
        $curl = curl_init();
        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => moduleConfig('perplexity.BASE_URL') . $data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host'),
            CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer'),
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($this->processedData),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->aiKey(),
            ),
        ));
        // Make API request
        $response = curl_exec($curl);
        
        $curlStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        $err = curl_error($curl);
        
        // Close cURL session
        curl_close($curl);
        $response = !empty($response) ? $response : $err;

        return [
            'code' => $curlStatusCode,
            'body' => json_decode($response, false)
        ];

    }
    
    /**
     * Method to send a chat message using GuzzleHttp\Client to the Anthropic API.
     *
     * @return StreamResponse|null The response from the API wrapped in a StreamResponse object, or null if an error occurred.
     */
    public function chatStream()
    {
        $client = new Client();

        try {
            // Send the POST request
            
            $response = $client->request('POST', moduleConfig('perplexity.BASE_URL') . 'chat/completions' , [
                'json' => $this->processedData,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->aiKey()
                ],
                'stream' => true
            ]);


            return new StreamResponse($response);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // If an error occurs during the request, catch the exception and handle it
            if (strpos($e->getMessage(), '401 Unauthorized') !== false) {
                throw new \Exception(__("There's an issue with your API key."));
            }

            $response = $e->getResponse();

            if ($response) {
                $body = $response->getBody()->getContents();
                $errorData = json_decode($body, true);

                if (isset($errorData['error']['message'])) {
                    throw new \Exception($errorData['error']['message']);
                }
                throw new \Exception($errorData['error']);

            } else {
                throw new \Exception($e->getMessage());
            }
        }
    }

    /**
     * Repeatedly call the 'chat' method a specified number of times and store the responses in an array.
     *
     * @param array $dataOptions Options for AI processing.
     * @return array An array containing the responses from calling the 'chat' method multiple times.
     */
    public function outlineChat(array $dataOptions): array
    {
        $outlineNumber = data_get($dataOptions, 'number_of_outlines', 1);
        $model = data_get($dataOptions, 'options.model', 'sonar-pro');
        $response = [];
        for ($i= 0; $i < $outlineNumber; $i++) {
            $response[] = $this->chat($model);
        }

        return $response;
       
    }
    
    /**
     * Generate audio content using the specified AI model.
     *
     * @param string $model The name of the AI model to use for generating audio content.
     * @return stdClass|null The response from the AI model, or null if an error occurs.
     */
    public function audio(string $model)
    {
        return $this->chat($model);
    }

    public function makeCurlRequest($url, $method = "POST", $postData = [], $headers = [], $returnRaw = false)
    {
        $curl = curl_init();

        // Set cURL options
        $defaultOptions = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host'),
            CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer'),
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        ];

        if ($returnRaw) {
            $defaultOptions[CURLOPT_FOLLOWLOCATION] = true;
        }

        if ($method == "POST" && !empty($postData)) {
            $defaultOptions[CURLOPT_POST] = true;
            $defaultOptions[CURLOPT_POSTFIELDS] = $postData;
        }

        $defaultHeaders = [];

        if ($method == "POST") {
            $defaultHeaders['Content-Type'] = "multipart/form-data";
        } else {
            $defaultHeaders['Accept'] = "application/json";
        }

        $defaultHeaders = array_merge($defaultHeaders, $headers);

        $finalHeaders = [];
        foreach ($defaultHeaders as $key => $value) {
            $finalHeaders[] = "$key: $value";
        }

        $defaultOptions[CURLOPT_HTTPHEADER] = $finalHeaders;

        curl_setopt_array($curl, $defaultOptions);

        // Make API request
        $response = curl_exec($curl);

        if ($returnRaw) {
            return $response;
        }

        $curlStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // Close cURL session
        curl_close($curl);

        return [
            'code' => $curlStatusCode,
            'body' => json_decode($response, true), 
        ];
    }
}
