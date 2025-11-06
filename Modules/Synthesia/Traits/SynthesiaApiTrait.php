<?php

namespace Modules\Synthesia\Traits;
use Illuminate\Http\Response;
use GuzzleHttp\Client;

trait SynthesiaApiTrait
{

    public function aiKey()
    {
        $apiKey = config('aiKeys.SYNTHESIA.API_KEY');

        if (empty($apiKey)) {
            throw new \Exception(__("There's an issue with the :x API key. Kindly reach out to the administration for assistance.", ['x' => __('SYNTHESIA')]), Response::HTTP_UNAUTHORIZED);
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
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
        ];

        if ($method == "POST" && !empty($postData)) {
            $defaultOptions[CURLOPT_POST] = true;
            $defaultOptions[CURLOPT_POSTFIELDS] = $postData;
        }

        $defaultHeaders = [
            "Authorization: " . $this->aiKey()
        ];

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

    public function makeRequest($url, $method = "POST", $postData = [], $headers = []) 
    {
        
        try {
            $client = new Client();

            $response = $client->request(strtoupper($method), $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'x-api-key' => $this->aiKey(),
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            return [
                'code' => $response->getStatusCode(),
                'body' => $data
            ];

        } catch (\Exception $e) {

            return [
                'code' => $e->getCode(),
                'body' => [
                    'error' => [
                        'code' => $e->getCode(),
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }

    }

}