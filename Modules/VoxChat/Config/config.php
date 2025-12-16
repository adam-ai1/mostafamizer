<?php

return [
    'name' => 'VoxChat',
    
    // Default AI model
    'default_model' => 'gpt-4o',
    
    // Available models
    'models' => [
        'gpt-4o' => [
            'name' => 'GPT-4o',
            'description' => 'الأحدث والأذكى',
            'max_tokens' => 4096,
        ],
        'gpt-4-turbo' => [
            'name' => 'GPT-4 Turbo',
            'description' => 'سريع وذكي',
            'max_tokens' => 4096,
        ],
    ],
    
    // Response settings
    'max_response_tokens' => 2048,
    'temperature' => 0.7,
    
    // Rate limiting
    'rate_limit' => [
        'messages_per_minute' => 20,
        'messages_per_day' => 500,
    ],
];
