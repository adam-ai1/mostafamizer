<?php

namespace Modules\MarketingBot\Traits;

trait ChannelApiTrait
{
    /**
     * Make a cURL request to an external API.
     *
     * @param string $url The URL to make the request to.
     * @param string $method The HTTP method (GET, POST, DELETE, etc.).
     * @param array|string $postData The data to send in the request body.
     * @param array $headers Additional headers to include in the request.
     * @return array Returns an array with 'code' (HTTP status code) and 'body' (decoded JSON response).
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
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
        ];

        if ($method == "POST" && !empty($postData)) {
            $defaultOptions[CURLOPT_POST] = true;
            $defaultOptions[CURLOPT_POSTFIELDS] = $postData;
        }

        // Set default headers based on method
        $defaultHeaders = [];
        if (strtoupper($method) == "POST") {
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
        
        return [
            'code' => $curlStatusCode,
            'body' => json_decode($response, true),
        ];
    }

    /**
     * Make a GET request.
     *
     * @param string $url The URL to make the request to.
     * @param array $headers Additional headers to include.
     * @return array Returns an array with 'code' and 'body'.
     */
    public function get(string $url, array $headers = []): array
    {
        return $this->makeCurlRequest($url, 'GET', [], $headers);
    }

    /**
     * Make a POST request.
     *
     * @param string $url The URL to make the request to.
     * @param array|string $data The data to send in the request body.
     * @param array $headers Additional headers to include.
     * @return array Returns an array with 'code' and 'body'.
     */
    public function post(string $url, $data = [], array $headers = []): array
    {
        return $this->makeCurlRequest($url, 'POST', $data, $headers);
    }

    /**
     * Make a DELETE request.
     *
     * @param string $url The URL to make the request to.
     * @param array $headers Additional headers to include.
     * @return array Returns an array with 'code' and 'body'.
     */
    public function delete(string $url, array $headers = []): array
    {
        return $this->makeCurlRequest($url, 'DELETE', [], $headers);
    }
}

