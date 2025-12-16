<?php

namespace Modules\SeoAnalyzer\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class SeoAnalyzerService
{
    protected $openAiKey;
    protected $openAiModel;

    public function __construct()
    {
        $this->openAiKey = apiKey('openai');
        $this->openAiModel = 'gpt-3.5-turbo';
    }

    /**
     * Analyze URL for SEO
     */
    public function analyze(string $url, string $analysisType)
    {
        // Fetch URL content
        $pageContent = $this->fetchPageContent($url);
        
        // Build prompt based on analysis type
        $prompt = $this->buildPrompt($url, $pageContent, $analysisType);
        
        // Get analysis from OpenAI
        $analysis = $this->getAiAnalysis($prompt);
        
        return [
            'url' => $url,
            'analysis_type' => $analysisType,
            'analysis' => $analysis,
            'timestamp' => now()->toIso8601String()
        ];
    }

    /**
     * Fetch page content from URL
     */
    protected function fetchPageContent(string $url): array
    {
        try {
            $response = Http::timeout(15)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (compatible; SEOAnalyzer/1.0)'
                ])
                ->get($url);

            if (!$response->successful()) {
                throw new Exception("Failed to fetch URL: HTTP {$response->status()}");
            }

            $html = $response->body();
            
            return [
                'title' => $this->extractTitle($html),
                'meta_description' => $this->extractMetaDescription($html),
                'meta_keywords' => $this->extractMetaKeywords($html),
                'h1_tags' => $this->extractHeadings($html, 'h1'),
                'h2_tags' => $this->extractHeadings($html, 'h2'),
                'images_without_alt' => $this->countImagesWithoutAlt($html),
                'total_images' => $this->countTotalImages($html),
                'word_count' => $this->countWords($html),
                'links_count' => $this->countLinks($html),
                'has_canonical' => $this->hasCanonical($html),
                'has_robots_meta' => $this->hasRobotsMeta($html),
                'has_viewport' => $this->hasViewport($html),
                'has_og_tags' => $this->hasOpenGraphTags($html),
                'has_twitter_cards' => $this->hasTwitterCards($html),
                'has_schema' => $this->hasSchemaMarkup($html),
            ];
        } catch (Exception $e) {
            Log::error('SEO Fetch Error: ' . $e->getMessage());
            throw new Exception("Unable to fetch page content: " . $e->getMessage());
        }
    }

    /**
     * Build AI prompt based on analysis type
     */
    protected function buildPrompt(string $url, array $pageData, string $analysisType): string
    {
        $locale = app()->getLocale();
        $langInstruction = $locale === 'ar' ? 'الرجاء الرد باللغة العربية.' : 'Please respond in English.';
        
        $baseInfo = "URL: {$url}\n" .
            "Page Title: {$pageData['title']}\n" .
            "Meta Description: {$pageData['meta_description']}\n" .
            "Meta Keywords: {$pageData['meta_keywords']}\n" .
            "H1 Tags: " . implode(', ', $pageData['h1_tags']) . "\n" .
            "H2 Tags: " . implode(', ', array_slice($pageData['h2_tags'], 0, 5)) . "\n" .
            "Word Count: {$pageData['word_count']}\n" .
            "Total Images: {$pageData['total_images']}\n" .
            "Images without Alt: {$pageData['images_without_alt']}\n" .
            "Links Count: {$pageData['links_count']}\n" .
            "Has Canonical: " . ($pageData['has_canonical'] ? 'Yes' : 'No') . "\n" .
            "Has Viewport: " . ($pageData['has_viewport'] ? 'Yes' : 'No') . "\n" .
            "Has Open Graph: " . ($pageData['has_og_tags'] ? 'Yes' : 'No') . "\n" .
            "Has Twitter Cards: " . ($pageData['has_twitter_cards'] ? 'Yes' : 'No') . "\n" .
            "Has Schema Markup: " . ($pageData['has_schema'] ? 'Yes' : 'No') . "\n";

        $prompts = [
            'full' => "Perform a comprehensive SEO analysis for this webpage:\n\n{$baseInfo}\n\nProvide detailed analysis including:\n1. Overall SEO Score (0-100)\n2. Title Tag Analysis\n3. Meta Description Analysis\n4. Heading Structure Analysis\n5. Content Analysis\n6. Image Optimization\n7. Technical SEO Issues\n8. Mobile Friendliness\n9. Social Media Optimization\n10. Specific Recommendations for Improvement\n\n{$langInstruction}",
            
            'keywords' => "Analyze keywords for this webpage:\n\n{$baseInfo}\n\nProvide:\n1. Current keyword usage analysis\n2. Suggested primary keywords (5-10)\n3. Suggested secondary keywords (10-15)\n4. Long-tail keyword opportunities (5-10)\n5. Keyword density recommendations\n6. Title tag keyword optimization suggestions\n7. Meta description keyword suggestions\n\n{$langInstruction}",
            
            'meta' => "Analyze meta tags for this webpage:\n\n{$baseInfo}\n\nProvide:\n1. Title tag analysis (length, keyword presence, effectiveness)\n2. Meta description analysis (length, call-to-action, keywords)\n3. Suggested improved title tags (3 options)\n4. Suggested improved meta descriptions (3 options)\n5. Open Graph tag recommendations\n6. Twitter Card recommendations\n7. Schema markup suggestions\n\n{$langInstruction}",
            
            'content' => "Analyze content for this webpage:\n\n{$baseInfo}\n\nProvide:\n1. Content quality assessment\n2. Word count analysis (ideal vs current)\n3. Heading structure evaluation\n4. Content readability score\n5. Content uniqueness suggestions\n6. Internal linking opportunities\n7. Content improvement recommendations\n8. Suggested content additions\n\n{$langInstruction}",
            
            'technical' => "Perform technical SEO analysis for this webpage:\n\n{$baseInfo}\n\nProvide:\n1. Canonical URL status\n2. Mobile responsiveness check\n3. Image optimization status\n4. URL structure analysis\n5. Robots meta tag analysis\n6. Structured data recommendations\n7. Page speed suggestions\n8. Security (HTTPS) status\n9. Technical issues found\n10. Priority fixes list\n\n{$langInstruction}"
        ];

        return $prompts[$analysisType] ?? $prompts['full'];
    }

    /**
     * Get AI analysis from OpenAI
     */
    protected function getAiAnalysis(string $prompt): string
    {
        if (empty($this->openAiKey)) {
            throw new Exception('OpenAI API key not configured');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->openAiKey,
            'Content-Type' => 'application/json',
        ])->timeout(60)->post('https://api.openai.com/v1/chat/completions', [
            'model' => $this->openAiModel,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an expert SEO analyst with years of experience in search engine optimization, content marketing, and technical SEO. Provide detailed, actionable insights and recommendations.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.7,
            'max_tokens' => 2000,
        ]);

        if (!$response->successful()) {
            Log::error('OpenAI API Error: ' . $response->body());
            throw new Exception('Failed to get AI analysis');
        }

        $data = $response->json();
        return $data['choices'][0]['message']['content'] ?? '';
    }

    // Helper methods for HTML parsing
    protected function extractTitle(string $html): string
    {
        preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $matches);
        return trim($matches[1] ?? '');
    }

    protected function extractMetaDescription(string $html): string
    {
        preg_match('/<meta[^>]+name=["\']description["\'][^>]+content=["\']([^"\']*)["\'][^>]*>/is', $html, $matches);
        if (empty($matches[1])) {
            preg_match('/<meta[^>]+content=["\']([^"\']*)["\'][^>]+name=["\']description["\'][^>]*>/is', $html, $matches);
        }
        return trim($matches[1] ?? '');
    }

    protected function extractMetaKeywords(string $html): string
    {
        preg_match('/<meta[^>]+name=["\']keywords["\'][^>]+content=["\']([^"\']*)["\'][^>]*>/is', $html, $matches);
        if (empty($matches[1])) {
            preg_match('/<meta[^>]+content=["\']([^"\']*)["\'][^>]+name=["\']keywords["\'][^>]*>/is', $html, $matches);
        }
        return trim($matches[1] ?? '');
    }

    protected function extractHeadings(string $html, string $tag): array
    {
        preg_match_all("/<{$tag}[^>]*>(.*?)<\/{$tag}>/is", $html, $matches);
        return array_map('strip_tags', $matches[1] ?? []);
    }

    protected function countImagesWithoutAlt(string $html): int
    {
        preg_match_all('/<img(?![^>]*alt=["\'][^"\']+["\'])[^>]*>/is', $html, $matches);
        return count($matches[0] ?? []);
    }

    protected function countTotalImages(string $html): int
    {
        preg_match_all('/<img[^>]*>/is', $html, $matches);
        return count($matches[0] ?? []);
    }

    protected function countWords(string $html): int
    {
        $text = strip_tags($html);
        $text = preg_replace('/\s+/', ' ', $text);
        return str_word_count($text);
    }

    protected function countLinks(string $html): int
    {
        preg_match_all('/<a[^>]*href=["\'][^"\']+["\'][^>]*>/is', $html, $matches);
        return count($matches[0] ?? []);
    }

    protected function hasCanonical(string $html): bool
    {
        return (bool) preg_match('/<link[^>]+rel=["\']canonical["\'][^>]*>/is', $html);
    }

    protected function hasRobotsMeta(string $html): bool
    {
        return (bool) preg_match('/<meta[^>]+name=["\']robots["\'][^>]*>/is', $html);
    }

    protected function hasViewport(string $html): bool
    {
        return (bool) preg_match('/<meta[^>]+name=["\']viewport["\'][^>]*>/is', $html);
    }

    protected function hasOpenGraphTags(string $html): bool
    {
        return (bool) preg_match('/<meta[^>]+property=["\']og:/is', $html);
    }

    protected function hasTwitterCards(string $html): bool
    {
        return (bool) preg_match('/<meta[^>]+name=["\']twitter:/is', $html);
    }

    protected function hasSchemaMarkup(string $html): bool
    {
        return (bool) preg_match('/<script[^>]+type=["\']application\/ld\+json["\'][^>]*>/is', $html);
    }
}
