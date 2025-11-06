<?php

return [
    'name' => 'AzureOpenAi',
    'BASE_URL' => env('AZUREOPENAI_URL', false),
    'AZUREOPENAI' => [
        'API_KEY' => env('AZUREOPENAI', false)
    ],
];
