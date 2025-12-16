<?php

namespace Modules\Presentation\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Presentation\Models\Presentation;
use Exception;

class PresentationService
{
    protected $openAiKey;
    protected $openAiModel;

    public function __construct()
    {
        $this->openAiKey = apiKey('openai');
        $this->openAiModel = 'gpt-3.5-turbo';
    }

    /**
     * Generate presentation slides
     */
    public function generate(string $topic, int $slidesCount, string $style, ?string $language = null)
    {
        $prompt = $this->buildPrompt($topic, $slidesCount, $style, $language);
        $slidesData = $this->getAiGeneration($prompt);
        
        // Parse JSON response
        $slides = $this->parseSlides($slidesData);
        $slides = $this->enforceSlideCount($slides, $slidesCount, $topic);
        
        // Save to database
        $presentation = Presentation::create([
            'user_id' => auth()->id(),
            'topic' => $topic,
            'style' => $style,
            'language' => $language ?: 'auto',
            'slides_count' => count($slides),
            'slides' => $slides,
        ]);
        
        return [
            'id' => $presentation->id,
            'topic' => $topic,
            'style' => $style,
            'slides' => $slides,
            'created_at' => $presentation->created_at->toIso8601String()
        ];
    }

    /**
     * Build AI prompt for presentation generation
     */
    protected function buildPrompt(string $topic, int $slidesCount, string $style, ?string $language): string
    {
        $langInstruction = 'Detect the language from the topic and user phrasing. Respond entirely in that detected language; if the topic is Arabic, use Arabic RTL-friendly wording, otherwise use the detected language.';
        
        $styleDescriptions = [
            'professional' => 'Professional and formal tone, suitable for business presentations',
            'creative' => 'Creative and engaging, with innovative ideas and visual suggestions',
            'minimal' => 'Clean and minimalist, focusing on key points with minimal text',
            'corporate' => 'Corporate style suitable for stakeholder presentations',
            'educational' => 'Educational and informative, suitable for teaching and learning'
        ];
        
        $styleDesc = $styleDescriptions[$style] ?? $styleDescriptions['professional'];
        
        return <<<PROMPT
Create a presentation about: "{$topic}"

Requirements:
    - Generate exactly {$slidesCount} slides. If you produce more, keep ONLY the first {$slidesCount}; if fewer, expand content to reach {$slidesCount}.
- Style: {$styleDesc}
- {$langInstruction}

For each slide, provide:
1. slide_number: The slide number (1, 2, 3, etc.)
2. title: A compelling slide title
3. content: Main content points (as an array of bullet points, 3-5 points per slide)
4. speaker_notes: Brief speaker notes for the presenter
5. visual_suggestion: A suggestion for visual elements or images

IMPORTANT: Return ONLY a valid JSON array with no additional text. Format:
[
  {
    "slide_number": 1,
    "title": "Slide Title",
    "content": ["Point 1", "Point 2", "Point 3"],
    "speaker_notes": "Notes for presenter",
    "visual_suggestion": "Suggested visual"
  }
]

First slide should be a title slide with the presentation title and a brief subtitle.
Last slide should be a conclusion/summary or Q&A slide.
PROMPT;
    }

    /**
     * Get AI generation from OpenAI
     */
    protected function getAiGeneration(string $prompt): string
    {
        if (empty($this->openAiKey)) {
            throw new Exception('OpenAI API key not configured');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->openAiKey,
            'Content-Type' => 'application/json',
        ])->timeout(90)->post('https://api.openai.com/v1/chat/completions', [
            'model' => $this->openAiModel,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an expert presentation designer. You create compelling, well-structured presentations with engaging content. Always return valid JSON only, no markdown or extra text.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.7,
            'max_tokens' => 3000,
        ]);

        if (!$response->successful()) {
            Log::error('OpenAI API Error: ' . $response->body());
            throw new Exception('Failed to generate presentation');
        }

        $data = $response->json();
        return $data['choices'][0]['message']['content'] ?? '';
    }

    /**
     * Parse slides from AI response
     */
    protected function parseSlides(string $content): array
    {
        // Remove markdown code blocks if present
        $content = preg_replace('/```json\s*/', '', $content);
        $content = preg_replace('/```\s*/', '', $content);
        $content = trim($content);
        
        $slides = json_decode($content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('JSON Parse Error: ' . json_last_error_msg());
            Log::error('Content: ' . $content);
            throw new Exception('Failed to parse presentation data');
        }
        
        if (!is_array($slides) || empty($slides)) {
            throw new Exception('Invalid presentation data structure');
        }
        
        return $slides;
    }

    /**
     * Ensure slide count matches requested number
     */
    protected function enforceSlideCount(array $slides, int $slidesCount, string $topic): array
    {
        // Trim any extras
        if (count($slides) > $slidesCount) {
            $slides = array_slice($slides, 0, $slidesCount);
        }

        // If fewer, pad with simple generated stubs
        if (count($slides) < $slidesCount) {
            $missing = $slidesCount - count($slides);
            $lastNumber = count($slides);
            for ($i = 1; $i <= $missing; $i++) {
                $lastNumber++;
                $slides[] = [
                    'slide_number' => $lastNumber,
                    'title' => "Additional Insight {$lastNumber}",
                    'content' => [
                        "Key point about {$topic}",
                        'Contextual insight for the audience',
                        'Practical takeaway to implement'
                    ],
                    'speaker_notes' => 'Auto-filled to meet requested slide count; refine as needed.',
                    'visual_suggestion' => 'Simple iconography or bullet list visualization'
                ];
            }
        }

        // Reindex slide_number sequentially
        foreach ($slides as $idx => &$slide) {
            $slide['slide_number'] = $idx + 1;
        }

        return $slides;
    }
}
