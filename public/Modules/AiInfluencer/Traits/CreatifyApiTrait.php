<?php

namespace Modules\AiInfluencer\Traits;
use Illuminate\Http\Response;

trait CreatifyApiTrait 
{

    public function aiKey()
    {
        $apiKey = config('aiKeys.CREATIFY.API_KEY');

        if (empty($apiKey)) {
            throw new \Exception(__("There's an issue with the :x API key. Kindly reach out to the administration for assistance.", ['x' => 'CREATIFY']), Response::HTTP_UNAUTHORIZED);
        }

        return $apiKey;
    }

    public function aiId()
    {
        $apiKey = config('aiKeys.CREATIFY_API_ID.API_KEY');

        if (empty($apiKey)) {
            throw new \Exception(__("There's an issue with the :x API ID. Kindly reach out to the administration for assistance.", ['x' => 'CREATIFY']), Response::HTTP_UNAUTHORIZED);
        }

        return $apiKey;
    }

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
            "X-API-ID: " . $this->aiId(),
            "X-API-KEY: " . $this->aiKey(),
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

        return [
            'code' => $curlStatusCode,
            'body' => json_decode($response, true), 
        ];
    }

}