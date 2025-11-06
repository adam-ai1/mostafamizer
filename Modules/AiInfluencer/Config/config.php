<?php

return [
    'name' => 'AiInfluencer',
    'providers' => [
        'vizard' => [
            'base_url' => 'https://elb-api.vizard.ai/hvizard-server-front/open-api/v1/project/',
            'parameters' => [
                'video_type' => [
                    'Remote video file' => '1',
                    'YouTube' => '2',
                    'Google Drive' => '3',
                    'Vimeo' => '4',
                    'StreamYard' => '5',
                    'TikTok' => '6',
                    'Twitter' => '7',
                    'Rumble' => '8',
                    'Twitch' => '9',
                    'Loom' => '10',
                    'Facebook' => '11',
                    'LinkedIn' => '12'
                ],
                'prefer_length' => [
                    'Automatically chosen' => '0',
                    'Less than 30 seconds' => '1',
                    '30 to 60 seconds' => '2',
                    '60 to 90 seconds' => '3',
                    '90 seconds to 3 minutes' => '4'
                ],
                'lang' => [
                    'English' => 'en',
                    'Arabic' => 'ar',
                    'Bulgarian' => 'bg',
                    'Croatian' => 'hr',
                    'Czech' => 'cs',
                    'Danish' => 'da',
                    'Dutch' => 'nl',
                    'Finnish' => 'fi',
                    'French' => 'fr',
                    'German' => 'de',
                    'Greek' => 'el',
                    'Hebrew' => 'iw',
                    'Hindi' => 'hi',
                    'Hungarian' => 'hu',
                    'Indonesian' => 'id',
                    'Italian' => 'it',
                    'Japanese' => 'ja',
                    'Korean' => 'ko',
                    'Lithuanian' => 'lt',
                    'Malay' => 'mal',
                    'Mandarin-Simplified' => 'zh',
                    'Mandarin-Traditional' => 'zh-TW',
                    'Norwegian' => 'no',
                    'Polish' => 'pl',
                    'Portuguese' => 'pt',
                    'Romanian' => 'ro',
                    'Russian' => 'ru',
                    'Serbian' => 'sr',
                    'Slovak' => 'sk',
                    'Spanish' => 'es',
                    'Swedish' => 'sv',
                    'Turkish' => 'tr',
                    'Ukrainian' => 'uk',
                    'Vietnamese' => 'vi'
                ],
                'ratio_of_clip' => [
                    '9:16' => '1',
                    '1:1' => '2',
                    '4:5' => '3',
                    '16:9' => '4'
                ],
                'remove_silence_switch' => [
                    'No' => '0',
                    'Yes' => '1'
                ],
                'headline_switch' => [
                    'No' => '0',
                    'Yes' => '1'
                ],
            ]
        ],
        'klap' => [
            'base_url' => 'https://api.klap.app/v2'
        ],
        'creatify' => [
            'base_url' => 'https://api.creatify.ai/api',
            'parameters' => [
                'language' => [
                    'Arabic' => 'ar', 
                    'Bulgarian' => 'bg', 
                    'Czech' => 'cs', 
                    'Danish' => 'da', 
                    'German' => 'de', 
                    'Greek' => 'el',
                    'Modern' => 'el', 
                    'English' => 'en', 
                    'Spanish' => 'es',
                    'Castilian' => 'es', 
                    'Finnish' => 'fi', 
                    'French' => 'fr', 
                    'Hindi' => 'hi', 
                    'Croatian' => 'hr', 
                    'Indonesian' => 'id', 
                    'Italian' => 'it', 
                    'Japanese' => 'ja', 
                    'Korean' => 'ko', 
                    'Malay' => 'ms', 
                    'Dutch' => 'nl', 
                    'Polish' => 'pl', 
                    'Portuguese' => 'pt', 
                    'Romanian' => 'ro',
                    'Moldavian' => 'ro',
                    'Moldovan' => 'ro',
                    'Russian' => 'ru',
                    'Slovak' => 'sk',
                    'Swedish' => 'sv',
                    'Tamil' => 'ta',
                    'Tagalog' => 'tl',
                    'Turkish' => 'tr',
                    'Ukrainian' => 'uk',
                    'Chinese' => 'zh'
                ],
                'script_styles' => [
                    'Benefits' => 'BenefitsV2', 
                    'Brand Story' => 'BrandStoryV2', 
                    'Call To Action' => 'CallToActionV2', 
                    'Discovery' => 'DiscoveryWriter', 
                    "Don't Worry" => 'DontWorryWriter', 
                    'Emotional' => 'EmotionalWriter', 
                    'Gen Z' => 'GenzWriter', 
                    'How To' => 'HowToV2', 
                    'Let Me Show You' => 'LetMeShowYouWriter', 
                    'Motivational' => 'MotivationalWriter', 
                    'Problem Solution' => 'ProblemSolutionV2', 
                    'Problem-Solution' => 'ProblemSolutionWriter', 
                    'Product Highlights' => 'ProductHighlightsV2', 
                    'Product Lifestyle' => 'ProductLifestyleV2', 
                    'Response Bubble' => 'ResponseBubbleWriter', 
                    'Special Offers' => 'SpecialOffersV2', 
                    'Storytime' => 'StoryTimeWriter', 
                    '3 Reasons Why' => 'ThreeReasonsWriter', 
                    'Trending Topics' => 'TrendingTopicsV2'
                ],
                'voiceover_volume' => [
                    'Low' => 0,
                    'Default' => null,
                    'High' => 1
                ],
                'background_music_volume' => [
                    'Low' => 0,
                    'Default' => null,
                    'High' => 1
                ],
                'caption_style' => [
                    "NORMAL_BLACK" => "normal-black",
                    "NORMAL_WHITE" => "normal-white",
                    "NORMAL_RED" => "normal-red",
                    "NORMAL_BLUE" => "normal-blue",
                    "NEO" => "neo",
                    "BRICK" => "brick",
                    "FRENZY" => "frenzy",
                    "VERANA" => "verana",
                    "MUSTARD" => "mustard",
                    "GLOW" => "glow",
                    "MINT" => "mint",
                    "COOLERS" => "coolers",
                    "BILO" => "bilo",
                    "TOONS" => "toons",
                    "DEEP_BLUE" => "deep-blue",
                    "MYSTIQUE" => "mystique",
                    "CAUTION" => "caution",
                    "DUALITY" => "duality",
                ]
            ]
        ],
        'topview' => [
            'base_url' => 'https://api.topview.ai/api',
            'parameters' => [
                'language' => [
                    'Arabic' => 'ar', 
                    'Bulgarian' => 'bg', 
                    'Czech' => 'cs', 
                    'Danish' => 'da', 
                    'German' => 'de', 
                    'Greek' => 'el',
                    'Modern' => 'el',
                    'English' => 'en',
                    'Spanish' => 'es',
                    'Castilian' => 'es',
                    'Finnish' => 'fi',
                    'French' => 'fr',
                    'Hindi' => 'hi',
                    'Croatian' => 'hr',
                    'Indonesian' => 'id',
                    'Italian' => 'it',
                    'Japanese' => 'ja',
                    'Korean' => 'ko',
                    'Malay' => 'ms',
                    'Dutch' => 'nl',
                    'Polish' => 'pl',
                    'Portuguese' => 'pt',
                    'Romanian' => 'ro',
                    'Moldavian' => 'ro',
                    'Moldovan' => 'ro',
                    'Russian' => 'ru',
                    'Slovak' => 'sk',
                    'Swedish' => 'sv',
                    'Tamil' => 'ta',
                    'Tagalog' => 'tl',
                    'Turkish' => 'tr',
                    'Ukrainian' => 'uk',
                    'Chinese' => 'zh'
                ],
                'video_length' => [
                    '15 to 30s' => 1,
                    '30 to 45s' => 2,
                    '45 to 60s' => 3,
                    '60 to 75s' => 4,
                ],
                'avatarSourceFrom' =>[
                    'avatar-list' => 1,
                    'custom-avatar-list' => 2
                ]
            ]
        ]

    ]
];
