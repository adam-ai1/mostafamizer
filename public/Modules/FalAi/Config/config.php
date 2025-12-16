<?php

return [
    'name' => 'FalAi',
    'BASE_URL' => 'https://queue.fal.run/fal-ai/',
    'FALAI' => [
        'API_KEY' => env('FALAI', false)
    ],
    
    'videomaker' => [
        'providers' => [
            'kling-video' => [
                'kling-video-v2.1-master' => 'kling-video/v2.1/master',
                'kling-video-v2.1-master' => 'kling-video/v2.1/master',
                'kling-video-v2.1-pro' => 'kling-video/v2.1/pro',
                'kling-video-v2.1-standard' => 'kling-video/v2.1/standard',
                'kling-video-v2-master' => 'kling-video/v2/master',
                'kling-video-v1-pro' => 'kling-video/v1/pro',
                'kling-video-v1-standard' => 'kling-video/v1/standard',
                'kling-video-v1.5-pro' => 'kling-video/v1.5/pro',
                'kling-video-v1.6-standard' => 'kling-video/v1.6/standard',
                'kling-video-v1.6-pro' => 'kling-video/v1.6/pro',
                'kling-video-v2.5-turbo-pro' => 'kling-video/v2.5-turbo/pro',
            ],
            'minimax' => [
                'minimax-video-01' => 'minimax/video-01',
                'minimax-hailuo02-pro' => 'minimax/hailuo-02/pro',
                'minimax-hailuo02-standard' => 'minimax/hailuo-02/standard',
            ],
            'luma-dream-machine' => [
                'luma-dream-machine' => 'luma-dream-machine',
                'luma-dream-machine-ray-2' => 'luma-dream-machine/ray-2',
                'luma-dream-machine-ray-2-flash' => 'luma-dream-machine/ray-2/flash',
            ],
            'haiper-video' => [
                'haiper-video-v2' => 'haiper-video/v2',
                'haiper-video-v2.5-fast' => 'haiper-video/v2.5/fast',
            ],
            'mochi-v1' => [
                'mochi-v1' => 'mochi-v1',
            ],
            'hunyuan-video' => [
                'hunyuan-video' => 'hunyuan-video',
            ],
            'hunyuan-video-lora'   => [
                'hunyuan-video-lora' => 'hunyuan-video-lora',
            ],
            'veo2' => [
                'veo2' => 'veo2',
            ],
            'veo3' => [
                'veo3' => 'veo3',
                'veo3-fast' => 'veo3/fast',
            ],
            'sora-2' => [
                'sora-2' => 'sora-2',
                'sora-2-pro' => 'sora-2',
            ]
        ],
    ],
    'imagemaker' => [
        'providers' =>[
            'flux-pro' => [
                'flux-pro-new' => 'flux-pro/new',
                'flux-pro-v1.1' => 'flux-pro/v1.1',
                'flux-pro-v1.1-ultra' => 'flux-pro/v1.1-ultra',
                'flux-pro-kontext' => 'flux-pro/kontext',
                'flux-pro-kontext-max' => 'flux-pro/kontext/max',
            ],
            'flux' => [
                'flux-dev' => 'flux/dev',
                'flux-schnell' => 'flux/schnell',
                'flux-schnell-redux' => 'flux/schnell/redux',
            ],
            'flux-kontext-lora' => [
                'flux-kontext-lora' => 'flux-kontext-lora',
            ],
            'ideogram' => [
                'ideogram-v2' => 'ideogram/v2',
                'ideogram-v2-turbo' => 'ideogram/v2/turbo',
                'ideogram-v2a' => 'ideogram/v2a',
                'ideogram-v2a-turbo' => 'ideogram/v2a/turbo',
            ],
            'playground-v25' => [
                'playground-v25' => 'playground-v25',
            ],
            'imagen4' => [
                'imagen4-preview' => 'imagen4/preview',
                'imagen4-preview-ultra' => 'imagen4/preview/ultra',
                'imagen4-preview-fast' => 'imagen4/preview/fast',
            ],
        ],
        'size' => [
            '512x512' => 'square',
            '1024x1024' => 'square_hd',
            '768x1024' => 'portrait_4_3',
            '576x1024' => 'portrait_16_9',
            '1024x768' => 'landscape_4_3',
            '1024x576' => 'landscape_16_9',
        ],
        'art_style' => [
            'Auto' => 'auto',
            '3D Model' => 'render_3D',
            'Anime' => 'anime',
            'General' => 'general',
            'Realistic' => 'realistic',
            'Design' => 'design',
        ]
    ]
];
