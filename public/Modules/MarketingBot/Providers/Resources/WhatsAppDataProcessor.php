<?php

namespace Modules\MarketingBot\Providers\Resources;

use Modules\MarketingBot\Entities\MarketingCampaign;
use Modules\MarketingBot\Entities\Template;

class WhatsAppDataProcessor
{
    private $data = [];

    public function __construct(array $aiOptions = [])
    {
        $this->data = $aiOptions;
    }

    public function initialMessage()
    {
        $campaign = MarketingCampaign::with('metas')->where('user_id', auth()->id())->where('id', $this->data['campaign'])->first();
        $template = Template::with('metas')->where('user_id', auth()->id())->where('id', $this->data['template'])->first();

        return $this->formatWhatsAppTemplate($template, $campaign);
    }

    public function formatWhatsAppTemplate($template, $campaign)
    {
        // For WhatsApp API, we need to extract form data from the request/campaign data
        // Since campaign stores template components, we need to get form data from the current request
        $currentData = $this->data;

        // Process file uploads using CampaignService
        $campaignService = app(\Modules\MarketingBot\Services\CampaignService::class);
        $processedData = $campaignService->processFileUploads($currentData, json_decode($template->components, true));

        // Extract form data from processed data
        $formData = [
            'header' => $processedData['header'] ?? null,
            'body' => $processedData['body'] ?? null,
            'buttons' => $processedData['buttons'] ?? null,
        ];

        // Debug: Log what header data we received
        \Log::info('Campaign Header Data Debug', [
            'processedData_header' => $processedData['header'] ?? 'not set',
            'formData_header' => $formData['header'],
            'currentData_keys' => array_keys($this->data),
            'currentData_header' => $this->data['header'] ?? 'not set',
            'all_currentData' => $this->data
        ]);

        // Get template components and process them for external URLs
        $originalComponents = json_decode($template->components, true);
        $processedComponents = $campaignService->processTemplateComponents($originalComponents);

        // Merge form data with processed template structure (handle template value replacement)
        $mergedComponents = $this->mergeTemplateValues($formData, $processedComponents);

        // Format components for WhatsApp API
        $components = $this->formatComponentsForWhatsApp($mergedComponents, $processedComponents);
        
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $this->data['contact_number'],
            'type' => 'template',
            'template' => [
                'name' => $template->title,
                'language' => [
                    'code' => $template->language ?? 'en_US'
                ],
                'components' => $components
            ]
        ];
        
        // Log the payload for debugging
        \Log::info('WhatsApp Template Payload', [
            'mergedComponents' => $mergedComponents,
            'processed_components' => $processedComponents,
            'original_components' => $originalComponents
        ]);
        
        return $payload;
    }

    /**
     * Merge form data values with template structure
     *
     * @param array $formData Raw form data (header, body, buttons)
     * @param array $templateComponents Original template components structure
     * @return array Merged components with values
     */
    public function mergeTemplateValues($formData, $templateComponents)
    {
        $merged = [];
        
        foreach ($templateComponents as $component) {
            $mergedComponent = $component;
            
            // Header component
            if ($component['type'] === 'HEADER' && isset($formData['header'])) {
                // Filter out any null/empty values
                $headerValues = array_filter($formData['header'], function($value) {
                    return $value !== null && $value !== '';
                });
                
                if ($component['format'] === 'TEXT') {
                    $mergedComponent['example']['header_text'] = array_values($headerValues);
                } elseif (in_array($component['format'] ?? null, ['IMAGE', 'DOCUMENT', 'VIDEO'])) {
                    // For file formats, use header_handle
                    $filePath = reset($headerValues);
                    if ($filePath) {
                        $mergedComponent['example']['header_handle'] = [$filePath];
                    }
                }
            }
            
            // Body component
            if ($component['type'] === 'BODY' && isset($formData['body'])) {
                // Filter out any null/empty values
                $bodyValues = array_filter($formData['body'], function($value) {
                    return $value !== null && $value !== '';
                });
                if (!empty($bodyValues)) {
                    $mergedComponent['example']['body_text'][0] = array_values($bodyValues);
                }
            }
            
            // Buttons component
            if ($component['type'] === 'BUTTONS' && isset($formData['buttons']) && isset($component['buttons'])) {
                foreach ($component['buttons'] as $index => &$button) {
                    if ($button['type'] === 'COPY_CODE' && isset($formData['buttons'][$index])) {
                        $buttonValue = $formData['buttons'][$index];
                        if ($buttonValue) {
                            $button['example'][0] = $buttonValue;
                        }
                    }
                }
            }
            
            $merged[] = $mergedComponent;
        }
        
        return $merged;
    }

    /**
     * Format merged components for WhatsApp API
     *
     * @param array $mergedComponents Components with merged values
     * @param array $originalComponents Original template components for format reference
     * @return array Formatted components for WhatsApp API
     */
    private function formatComponentsForWhatsApp($mergedComponents, $originalComponents)
    {
        // Create a map of component types to their formats for reliable lookup
        $formatMap = [];
        foreach ($originalComponents as $origComp) {
            if (isset($origComp['type']) && isset($origComp['format'])) {
                if ($origComp['type'] === 'HEADER') {
                    $formatMap['HEADER'] = $origComp['format'];
                }
            }
        }
        
        $components = [];
        
        foreach ($mergedComponents as $index => $component) {
            // Get format from formatMap or original component
            $format = null;
            if ($component['type'] === 'HEADER') {
                $format = $formatMap['HEADER'] ?? $originalComponents[$index]['format'] ?? $component['format'] ?? null;
            } else {
                $format = $originalComponents[$index]['format'] ?? $component['format'] ?? null;
            }
            
            // Header component
            if ($component['type'] === 'HEADER') {
                // Prioritize media formats - check for header_handle first
                if (isset($component['example']['header_handle'][0]) && !empty($component['example']['header_handle'][0])) {
                    $mediaUrl = $component['example']['header_handle'][0];
                    
                    // Verify format is a media type
                    if (in_array($format, ['IMAGE', 'DOCUMENT', 'VIDEO'])) {
                        $formatLower = strtolower($format);
                        
                        // Determine the media type based on format
                        $mediaType = 'image'; // default
                        if ($formatLower === 'document') {
                            $mediaType = 'document';
                        } elseif ($formatLower === 'video') {
                            $mediaType = 'video';
                        }
                        
                        $components[] = [
                            'type' => 'header',
                            'parameters' => [
                                [
                                    'type' => $mediaType,
                                    $mediaType => [
                                        'link' => $mediaUrl
                                    ]
                                ]
                            ]
                        ];
                    } else {
                        // Format is missing or invalid - default to image
                        \Log::warning('WhatsApp Template: Header has media but format is missing or invalid. Defaulting to image.', [
                            'format' => $format,
                            'formatMap' => $formatMap,
                            'component' => $component,
                            'original_component' => $originalComponents[$index] ?? 'not found',
                            'mediaUrl' => $mediaUrl
                        ]);
                        
                        $components[] = [
                            'type' => 'header',
                            'parameters' => [
                                [
                                    'type' => 'image',
                                    'image' => [
                                        'link' => $mediaUrl
                                    ]
                                ]
                            ]
                        ];
                    }
                }
                // Handle TEXT format only if no media header_handle exists
                elseif (isset($component['example']['header_text']) && $format === 'TEXT' && !empty($component['example']['header_text'])) {
                    $components[] = [
                        'type' => 'header',
                        'parameters' => collect($component['example']['header_text'])->map(fn($value) => [
                            'type' => 'text',
                            'text' => $value
                        ])->toArray()
                    ];
                }
            }
            
            // Body component
            if ($component['type'] === 'BODY' && isset($component['example']['body_text'][0]) && !empty($component['example']['body_text'][0])) {
                $components[] = [
                    'type' => 'body',
                    'parameters' => collect($component['example']['body_text'][0])->map(fn($value) => [
                        'type' => 'text',
                        'text' => $value
                    ])->toArray()
                ];
            }
            
            // Button components
            if ($component['type'] === 'BUTTONS' && isset($component['buttons'])) {
                foreach ($component['buttons'] as $index => $button) {
                    if ($button['type'] === 'COPY_CODE' && isset($button['example'][0])) {
                        $components[] = [
                            'type' => 'button',
                            'sub_type' => 'copy_code',
                            'index' => (string)$index,
                            'parameters' => [
                                [
                                    'type' => 'coupon_code',
                                    'coupon_code' => $button['example'][0]
                                ]
                            ]
                        ];
                    }
                }
            }
        }
        
        return $components;
    }

    public function replyMessage()
    {
        \Log::info('data: ' . json_encode($this->data));
        return [
            'messaging_product' => 'whatsapp',
            'to' => $this->data['contact_number'],
            'recipient_type' => 'individual',
            'context' => [
                "message_id" => $this->data['message_id'],
            ],
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" =>  $this->data['message']
            ]
        ];
    }

    
}
