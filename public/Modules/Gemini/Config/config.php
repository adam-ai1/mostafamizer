<?php

return [
    'name' => 'Gemini',
    'base_url' => 'https://generativelanguage.googleapis.com/v1beta/',
    'image_models' => [
        'imagen' => [
            'imagen-3.0-generate-002',
            'imagen-4.0-generate-preview-06-06',
            'imagen-4.0-fast-generate-preview-06-06',
            'imagen-4.0-ultra-generate-preview-06-06',
        ],
        'gemini' => [
            'gemini-2.0-flash-preview-image-generation',
            'gemini-2.5-flash-image-preview',
        ]
    ]
];
