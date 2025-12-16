<?php

namespace Modules\Grok\Traits;

use GuzzleHttp\Client;

use GuzzleHttp\Exception\RequestException;
use Modules\Gork\Responses\LongArticle\StreamResponse;

trait GrokApiTrait
{
    /**
     * Retrieve the API key for the Gork AI module.
     *
     * @return string
     */
    public function aiKey(): string
    {
        $key = config("aiKeys.GROK.API_KEY");

        if (empty($key)) {
            throw new \Exception(__("There's an issue with the API key. Please contact the administration for assistance."));
        }

        return $key;
    }

    /**
     * Method to send a chat message using cURL to the Gork API.
     *
     * @return array|null The response from the API in JSON format, or null if an error occurred.
     */
    public function chat()
    {
        return $this->makeCurlRequest(moduleConfig('grok.base_url') . 'v1/chat/completions', "POST", json_encode($this->processedData));
    }

    /**
     * Method to repeatedly call the 'chat' method a specified number of times and store the responses in an array.
     *
     * @param int $outlineNumber The number of times to call the 'chat' method.
     * @return array An array containing the responses from calling the 'chat' method multiple times.
     */
    public function outlineChat(int $outlineNumber): array
    {
        $response = [];
        for ($i= 0; $i < $outlineNumber; $i++) {
            $response[] = $this->chat();
        }

        return $response;
       
    }

    /**
     * Method to send a chat message using GuzzleHttp\Client to the Gork API.
     *
     * @return StreamResponse|null The response from the API wrapped in a StreamResponse object, or null if an error occurred.
     */
    public function chatStream()
    {
        $client = new Client();
        try {
            // Send the POST request
            $response = $client->request('POST', moduleConfig('grok.base_url') . 'v1/chat/completions', [
                'json' => $this->processedData,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->aiKey(),
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
                $errorData = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($errorData['error']['message'] ?? $errorData['error'] ?? $e->getMessage());
            } else {
                throw new \Exception($e->getMessage());
            }
        }
    }

    /**
     * Method to send a chat message using cURL to the Gork API with a long article.
     *
     * @return array|null The response from the API in JSON format, or null if an error occurred.
     */
    public function images()
    {
        return $this->makeCurlRequest(moduleConfig('grok.base_url') . 'images/generations', "POST", json_encode($this->processedData));
    }

    /**
     * Method to make a cURL request to the API.
     *
     * @param string $url The URL to make the request to.
     * @param string $method The type of request to make, e.g. "POST", "GET", "PUT", etc.
     * @param array $postData The data to be sent as the body of the request if $method is "POST".
     * @param array $headers The headers to be sent with the request.
     * @return object An object containing the HTTP status code and the response body.
     */
    public function makeCurlRequest($url, $method = "POST", $postData = [], $headers = [])
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

        if ($method == "POST" && !empty($postData)) {
            $defaultOptions[CURLOPT_POST] = true;
            $defaultOptions[CURLOPT_POSTFIELDS] = $postData;
        }

        $defaultHeaders = [
            "Authorization: Bearer " . $this->aiKey(),
        ];

        if ($method == "POST") {
            $defaultHeaders[] = "Content-Type: application/json";
        } else {
            $defaultHeaders[] = "Accept: application/json";
        }

        $defaultOptions[CURLOPT_HTTPHEADER] = array_merge($defaultHeaders, $headers);

        curl_setopt_array($curl, $defaultOptions);

        // Make API request
        $response = curl_exec($curl);

        $curlStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Close cURL session
        curl_close($curl);

        return (object) [
            'code' => $curlStatusCode,
            'body' => json_decode($response)
        ];
    }
}
