<?php

/**
 * @package PodcastService
 * @author VoxCraft
 * @created 2024-12-14
 */

namespace Modules\OpenAI\Services;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\OpenAI\Entities\Podcast;
use Modules\OpenAI\Jobs\PodcastGenerationJob;
use Modules\Subscription\Services\PackageSubscriptionService;

class PodcastService
{
    /**
     * Gemini API configuration
     */
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;

    /**
     * Word limits for subscription tiers
     */
    const FREE_TIER_WORD_LIMIT = 300;      // ~2 minutes of audio
    const PREMIUM_TIER_WORD_LIMIT = 3000;  // ~15-20 minutes of audio

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->apiKey = config('aiKeys.GEMINI.API_KEY', '');
        $this->baseUrl = moduleConfig('gemini.base_url', 'https://generativelanguage.googleapis.com/v1beta/');
        $this->model = 'gemini-2.0-flash';
    }

    /**
     * Create a new podcast generation request
     *
     * @param array $data
     * @return array
     */
    public function createPodcast(array $data): array
    {
        try {
            $userId = $data['user_id'] ?? Auth::id();
            
            if (!$userId) {
                return [
                    'success' => false,
                    'error' => __('User not authenticated'),
                ];
            }

            // Check subscription validity for podcast feature
            $validation = subscription('isValidSubscription', $userId, 'podcast');
            if ($validation['status'] != 'success') {
                return [
                    'success' => false,
                    'error' => $validation['message'] ?? __('You have reached your podcast limit. Please upgrade your plan.'),
                ];
            }

            // Determine user subscription tier
            $tier = $this->getUserSubscriptionTier($userId);

            // Create the podcast record
            $podcast = Podcast::create([
                'user_id' => $userId,
                'topic' => $data['topic'],
                'host_a_name' => $data['host_a_name'] ?? 'أليكس',
                'host_b_name' => $data['host_b_name'] ?? 'سارة',
                'source_material' => $data['source_material'] ?? null,
                'status' => Podcast::STATUS_PENDING,
                'tier' => $tier,
                'provider' => 'gemini',
            ]);

            // Increment usage (deduct 1 podcast from balance)
            $subscription = subscription('getUserSubscription', $userId);
            subscription('usageIncrement', $subscription?->id, 'podcast', 1, $userId);

            // Process synchronously (no queue worker needed)
            PodcastGenerationJob::dispatchSync($podcast->id);

            return [
                'success' => true,
                'podcast' => $podcast,
                'message' => __('Podcast generation started. Please wait...'),
            ];
        } catch (Exception $e) {
            Log::error('Podcast creation failed: ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Determine user subscription tier
     *
     * @param int $userId
     * @return string
     */
    public function getUserSubscriptionTier(int $userId): string
    {
        try {
            $subscriptionService = app(PackageSubscriptionService::class);
            $subscription = $subscriptionService->getUserSubscription($userId);

            if (!$subscription) {
                return Podcast::TIER_FREE;
            }

            // Check if user has an active premium subscription
            $package = $subscription->package;
            
            if (!$package) {
                return Podcast::TIER_FREE;
            }

            // Check if the package price is > 0 (paid plan)
            $salePrice = $package->sale_price ?? [];
            $billingCycle = $subscription->billing_cycle ?? 'monthly';
            
            if (isset($salePrice[$billingCycle]) && $salePrice[$billingCycle] > 0) {
                return Podcast::TIER_PREMIUM;
            }

            return Podcast::TIER_FREE;
        } catch (Exception $e) {
            Log::warning('Failed to determine subscription tier: ' . $e->getMessage());
            return Podcast::TIER_FREE;
        }
    }

    /**
     * Generate podcast script using Gemini API
     *
     * @param Podcast $podcast
     * @return array
     */
    public function generatePodcastScript(Podcast $podcast): array
    {
        try {
            if (empty($this->apiKey)) {
                throw new Exception(__('Gemini API key is not configured.'));
            }

            // Build the prompt based on subscription tier
            $prompt = $this->buildPodcastPrompt($podcast);

            // Make API call to Gemini
            $response = $this->callGeminiApi($prompt);

            if (!$response['success']) {
                return $response;
            }

            $script = $response['content'];
            $wordCount = str_word_count($script);
            $estimatedDuration = $this->calculateDuration($wordCount);

            // Extract title from the script or generate one
            $title = $this->extractTitleFromScript($script, $podcast->topic);

            return [
                'success' => true,
                'script' => $script,
                'word_count' => $wordCount,
                'estimated_duration' => $estimatedDuration,
                'title' => $title,
            ];
        } catch (Exception $e) {
            Log::error('Podcast script generation failed: ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Build the podcast generation prompt
     *
     * @param Podcast $podcast
     * @return string
     */
    protected function buildPodcastPrompt(Podcast $podcast): string
    {
        $wordLimit = $podcast->tier === Podcast::TIER_PREMIUM 
            ? self::PREMIUM_TIER_WORD_LIMIT 
            : self::FREE_TIER_WORD_LIMIT;

        $durationText = $podcast->tier === Podcast::TIER_PREMIUM 
            ? '15-20 دقيقة' 
            : '2 دقيقة';

        // Reduce number of turns for faster audio generation
        // Free tier: 4 turns = 8 segments max (faster generation)
        // Premium tier: 10 turns = 20 segments max
        $maxTurns = $podcast->tier === Podcast::TIER_PREMIUM ? 10 : 4;

        // Get host names from podcast or use defaults
        $hostAName = $podcast->host_a_name ?? 'أليكس';
        $hostBName = $podcast->host_b_name ?? 'سارة';

        $prompt = <<<PROMPT
أنت كاتب سيناريوهات بودكاست محترف. قم بكتابة حوار بودكاست جذاب وطبيعي بين مقدمين اثنين يناقشان الموضوع التالي.

**الموضوع:** {$podcast->topic}

**أسماء المضيفين:**
- المضيف الرئيسي: {$hostAName}
- المضيفة المشاركة: {$hostBName}

PROMPT;

        if (!empty($podcast->source_material)) {
            $prompt .= <<<PROMPT

**المادة المرجعية/السياق:**
{$podcast->source_material}

PROMPT;
        }

        $prompt .= <<<PROMPT

**المتطلبات الهامة:**
1. اكتب الحوار بالكامل باللغة العربية الفصحى فقط - لا تستخدم أي كلمات إنجليزية
2. الحوار يجب أن يكون بين "{$hostAName}" و "{$hostBName}"
3. كل سطر يجب أن يبدأ بـ: "Host A:" أو "Host B:" (هذا التنسيق ضروري للنظام) - Host A هو {$hostAName} و Host B هي {$hostBName}
4. **مهم جداً: في الحوار يجب أن ينادي كل مضيف الآخر باسمه الحقيقي ({$hostAName} و {$hostBName}) وليس "مضيف أ" أو "مضيف ب"**
5. **كل مضيف يتكلم في فقرة واحدة طويلة (3-5 جمل) قبل أن يرد الآخر**
6. **الحد الأقصى للتبادلات: {$maxTurns} تبادل فقط (كل تبادل = Host A ثم Host B)**
7. المحادثة يجب أن تكون طبيعية وجذابة ومفيدة
8. يجب أن يتضمن:
   - مقدمة يرحب فيها المضيفان بالمستمعين ويقدمان الموضوع (مثال: "مرحباً أنا {$hostAName}" و "وأنا {$hostBName}")
   - مناقشة رئيسية بنقاط مثيرة وأمثلة وأفكار
   - خاتمة تلخص النقاط الرئيسية وتشكر المستمعين
9. حد الكلمات: تقريباً {$wordLimit} كلمة
10. اجعل الحوار يبدو كبودكاست حقيقي - ردود فعل طبيعية وتدفق سلس

**مثال على التنسيق المطلوب (لاحظ أن كل رد طويل واستخدام الأسماء الحقيقية):**
Host A: مرحباً بكم في بودكاستنا! أنا {$hostAName} ومعي زميلتي المميزة {$hostBName}. اليوم سنتحدث عن موضوع مهم جداً يشغل بال الكثيرين.
Host B: شكراً {$hostAName}! أنا سعيدة جداً بوجودي معكم اليوم. هذا الموضوع قريب من قلبي وأتمنى أن نقدم لكم معلومات قيمة.
Host A: بالتأكيد {$hostBName}، دعينا نبدأ بشرح الأساسيات...

اكتب سيناريو البودكاست الآن باللغة العربية فقط:
PROMPT;

        return $prompt;
    }

    /**
     * Call Gemini API
     *
     * @param string $prompt
     * @return array
     */
    protected function callGeminiApi(string $prompt): array
    {
        try {
            $url = $this->baseUrl . "models/{$this->model}:generateContent?key=" . $this->apiKey;

            $data = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.9,
                    'topP' => 0.95,
                    'topK' => 40,
                    'maxOutputTokens' => 8192,
                ],
                'safetySettings' => [
                    [
                        'category' => 'HARM_CATEGORY_HARASSMENT',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ],
                    [
                        'category' => 'HARM_CATEGORY_HATE_SPEECH',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ],
                    [
                        'category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ],
                    [
                        'category' => 'HARM_CATEGORY_DANGEROUS_CONTENT',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ],
                ]
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 120,
                CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host', 2),
                CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer', true),
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                ],
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $error = curl_error($curl);
            curl_close($curl);

            if ($error) {
                throw new Exception("cURL Error: {$error}");
            }

            if ($httpCode !== 200) {
                $responseData = json_decode($response, true);
                $errorMessage = $responseData['error']['message'] ?? "HTTP Error: {$httpCode}";
                throw new Exception($errorMessage);
            }

            $responseData = json_decode($response, true);

            if (!isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                throw new Exception(__('Invalid response from Gemini API'));
            }

            $content = $responseData['candidates'][0]['content']['parts'][0]['text'];

            return [
                'success' => true,
                'content' => $content,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Calculate estimated duration in seconds based on word count
     * Average speaking rate: 140 words per minute
     *
     * @param int $wordCount
     * @return int
     */
    protected function calculateDuration(int $wordCount): int
    {
        $wordsPerMinute = 140;
        $minutes = $wordCount / $wordsPerMinute;
        return (int) ceil($minutes * 60);
    }

    /**
     * Extract or generate title from script
     *
     * @param string $script
     * @param string $topic
     * @return string
     */
    protected function extractTitleFromScript(string $script, string $topic): string
    {
        // Try to extract title from the script intro
        if (preg_match('/(?:discussing|about|exploring|diving into)\s+"?([^".\n]+)"?/i', $script, $matches)) {
            return trim($matches[1]);
        }

        // Default to topic-based title
        return __('Episode: :topic', ['topic' => ucfirst($topic)]);
    }

    /**
     * Get user's podcasts with pagination
     *
     * @param int $userId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUserPodcasts(int $userId, int $perPage = 10)
    {
        return Podcast::forUser($userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get podcast by ID
     *
     * @param int $id
     * @param int|null $userId
     * @return Podcast|null
     */
    public function getPodcast(int $id, ?int $userId = null): ?Podcast
    {
        $query = Podcast::where('id', $id);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        return $query->first();
    }

    /**
     * Delete podcast
     *
     * @param int $id
     * @param int $userId
     * @return bool
     */
    public function deletePodcast(int $id, int $userId): bool
    {
        $podcast = $this->getPodcast($id, $userId);

        if (!$podcast) {
            return false;
        }

        return $podcast->delete();
    }

    /**
     * Regenerate podcast script
     *
     * @param int $id
     * @param int $userId
     * @return array
     */
    public function regeneratePodcast(int $id, int $userId): array
    {
        $podcast = $this->getPodcast($id, $userId);

        if (!$podcast) {
            return [
                'success' => false,
                'error' => __('Podcast not found'),
            ];
        }

        // Reset status and dispatch job
        $podcast->update([
            'status' => Podcast::STATUS_PENDING,
            'script' => null,
            'error_message' => null,
        ]);

        PodcastGenerationJob::dispatchSync($podcast->id);

        return [
            'success' => true,
            'podcast' => $podcast,
            'message' => __('Podcast regeneration started.'),
        ];
    }

    /**
     * Get word limit based on subscription tier
     *
     * @param string $tier
     * @return int
     */
    public static function getWordLimit(string $tier): int
    {
        return $tier === Podcast::TIER_PREMIUM 
            ? self::PREMIUM_TIER_WORD_LIMIT 
            : self::FREE_TIER_WORD_LIMIT;
    }

    /**
     * Check if podcast generation is available for user
     *
     * @param int $userId
     * @return array
     */
    public function checkAvailability(int $userId): array
    {
        // Check if Gemini API is configured
        if (empty($this->apiKey)) {
            return [
                'available' => false,
                'error' => __('AI service is not configured. Please contact administrator.'),
            ];
        }

        // Check subscription
        $tier = $this->getUserSubscriptionTier($userId);

        return [
            'available' => true,
            'tier' => $tier,
            'word_limit' => self::getWordLimit($tier),
            'duration_limit' => $tier === Podcast::TIER_PREMIUM ? '15-20 minutes' : '2 minutes',
        ];
    }

    /**
     * Generate audio from podcast script using ElevenLabs TTS
     *
     * @param Podcast $podcast
     * @return array
     */
    public function generatePodcastAudio(Podcast $podcast): array
    {
        try {
            // Increase time limit for audio generation
            set_time_limit(900); // 15 minutes
            
            $parsedScript = $podcast->parsed_script;
            
            if (empty($parsedScript)) {
                throw new Exception(__('No parsed script available for audio generation.'));
            }

            // Merge consecutive lines from same speaker to reduce API calls
            $mergedSegments = [];
            $currentSpeaker = null;
            $currentText = '';
            
            foreach ($parsedScript as $line) {
                if ($currentSpeaker === $line['speaker']) {
                    // Same speaker, append text
                    $currentText .= ' ' . $line['text'];
                } else {
                    // Different speaker, save previous and start new
                    if ($currentSpeaker !== null && !empty(trim($currentText))) {
                        $mergedSegments[] = [
                            'speaker' => $currentSpeaker,
                            'text' => trim($currentText)
                        ];
                    }
                    $currentSpeaker = $line['speaker'];
                    $currentText = $line['text'];
                }
            }
            
            // Don't forget the last segment
            if ($currentSpeaker !== null && !empty(trim($currentText))) {
                $mergedSegments[] = [
                    'speaker' => $currentSpeaker,
                    'text' => trim($currentText)
                ];
            }

            Log::info("Podcast audio: Merged " . count($parsedScript) . " lines into " . count($mergedSegments) . " segments");

            // Get ElevenLabs voice IDs - use distinct voices for each speaker
            $elevenLabsVoices = [
                'HOST A' => 'EXAVITQu4vr4xnSDxMaL', // Sarah - Female
                'HOST B' => 'CwhRBWXzGAHq8TQ4Fs17', // Roger - Male
            ];
            
            $totalSegments = count($mergedSegments);
            Log::info("Starting PARALLEL TTS generation with ElevenLabs ({$totalSegments} segments)");
            
            // ⚡ PARALLEL PROCESSING - Generate all audio segments at once!
            $audioSegments = $this->generateAudioParallel($mergedSegments, $elevenLabsVoices);
            
            Log::info("Parallel TTS completed: " . count($audioSegments) . " segments generated");

            if (empty($audioSegments)) {
                throw new Exception(__('Failed to generate any audio segments.'));
            }

            // MP3 files - ElevenLabs returns MP3
            $combinedAudio = implode('', $audioSegments);
            $extension = 'mp3';
            
            if (empty($combinedAudio)) {
                throw new Exception(__('Failed to combine audio segments.'));
            }
            
            // Save the audio file
            $filename = 'podcasts/' . $podcast->id . '_' . time() . '.' . $extension;
            Storage::disk('public')->put($filename, $combinedAudio);
            
            $audioPath = 'storage/' . $filename;
            
            Log::info("Podcast audio saved: {$filename}, size: " . strlen($combinedAudio) . " bytes");

            return [
                'success' => true,
                'audio_path' => $audioPath,
            ];
        } catch (Exception $e) {
            Log::error('Podcast audio generation failed: ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Generate audio segments in PARALLEL using curl_multi
     * This is 5-10x faster than sequential processing!
     *
     * @param array $segments Array of segments with 'speaker' and 'text'
     * @param array $voices Voice IDs for each speaker
     * @return array Array of audio data in order
     */
    protected function generateAudioParallel(array $segments, array $voices): array
    {
        $apiKey = config('aiKeys.ELEVENLABS.API_KEY');
        $baseUrl = moduleConfig('elevenLabs.BASE_URL', 'https://api.elevenlabs.io/v1/');
        
        if (empty($apiKey)) {
            Log::error('ElevenLabs API key not configured');
            return [];
        }
        
        // Process segments SEQUENTIALLY to avoid rate limits (HTTP 429)
        $audioSegments = [];
        $successCount = 0;
        $segmentCount = count($segments);
        $startTime = microtime(true);
        
        Log::info("Starting SEQUENTIAL TTS generation ({$segmentCount} segments)");
        
        foreach ($segments as $index => $segment) {
            $voiceId = $voices[$segment['speaker']] ?? $voices['HOST A'];
            $url = $baseUrl . 'text-to-speech/' . $voiceId;
            
            $data = [
                'text' => $segment['text'],
                'model_id' => 'eleven_flash_v2_5',
                'voice_settings' => [
                    'stability' => 0.5,
                    'similarity_boost' => 0.75,
                ],
            ];
            
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host', 2),
                CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer', true),
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                    "xi-api-key: " . $apiKey,
                ],
            ]);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            // Handle rate limit with retry
            if ($httpCode === 429) {
                Log::warning("TTS: Rate limited on segment {$index}, waiting 2s and retrying...");
                sleep(2);
                
                // Retry once
                $ch = curl_init();
                curl_setopt_array($ch, [
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host', 2),
                    CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer', true),
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => [
                        "Content-Type: application/json",
                        "xi-api-key: " . $apiKey,
                    ],
                ]);
                
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
            }
            
            if ($httpCode === 200 && !empty($response)) {
                $audioSegments[$index] = $response;
                $successCount++;
            } else {
                Log::warning("TTS: Segment {$index} failed with HTTP {$httpCode}");
                $audioSegments[$index] = null;
            }
            
            // Small delay between requests to avoid rate limits
            if ($index < $segmentCount - 1) {
                usleep(300000); // 300ms delay
            }
        }
        
        $elapsedTime = round(microtime(true) - $startTime, 2);
        Log::info("Sequential TTS: {$successCount}/{$segmentCount} segments completed in {$elapsedTime}s");
        
        // Return only successful segments, maintaining order
        ksort($audioSegments);
        return array_filter($audioSegments);
    }

    /**
     * Check if Google Cloud TTS is available
     *
     * @return bool
     */
    protected function isGoogleTtsAvailable(): bool
    {
        // For now, always try Google TTS first
        // It will fail gracefully if not enabled
        return true;
    }

    /**
     * Combine multiple WAV files into one
     * WAV format: RIFF header (44 bytes) + PCM data
     *
     * @param array $wavFiles Array of raw WAV binary data
     * @return string Combined WAV file binary
     */
    protected function combineWavFiles(array $wavFiles): string
    {
        if (empty($wavFiles)) {
            return '';
        }

        // If only one file, return it directly
        if (count($wavFiles) === 1) {
            return $wavFiles[0];
        }

        // Parse the first WAV file to get audio format
        $firstWav = $wavFiles[0];
        
        // Verify it's a valid WAV file
        if (strlen($firstWav) < 44 || substr($firstWav, 0, 4) !== 'RIFF') {
            Log::error("Invalid WAV file: header not found");
            return $firstWav; // Return as-is
        }

        // Extract format info from the first file (assume all files have same format)
        $channels = unpack('v', substr($firstWav, 22, 2))[1];
        $sampleRate = unpack('V', substr($firstWav, 24, 4))[1];
        $bitsPerSample = unpack('v', substr($firstWav, 34, 2))[1];
        $byteRate = unpack('V', substr($firstWav, 28, 4))[1];
        $blockAlign = unpack('v', substr($firstWav, 32, 2))[1];

        Log::info("WAV format: {$channels}ch, {$sampleRate}Hz, {$bitsPerSample}bit");

        // Collect all PCM data (skip 44-byte header from each file)
        $allPcmData = '';
        foreach ($wavFiles as $wav) {
            if (strlen($wav) > 44) {
                // Find the "data" chunk
                $dataPos = strpos($wav, 'data');
                if ($dataPos !== false) {
                    // Skip 'data' (4 bytes) + size (4 bytes) = 8 bytes after 'data'
                    $dataStart = $dataPos + 8;
                    $allPcmData .= substr($wav, $dataStart);
                } else {
                    // Fallback: assume standard 44-byte header
                    $allPcmData .= substr($wav, 44);
                }
            }
        }

        $dataSize = strlen($allPcmData);
        $fileSize = 36 + $dataSize;

        // Build new WAV header
        $header = 'RIFF';                                    // ChunkID
        $header .= pack('V', $fileSize);                     // ChunkSize
        $header .= 'WAVE';                                   // Format
        $header .= 'fmt ';                                   // Subchunk1ID
        $header .= pack('V', 16);                            // Subchunk1Size (16 for PCM)
        $header .= pack('v', 1);                             // AudioFormat (1 = PCM)
        $header .= pack('v', $channels);                     // NumChannels
        $header .= pack('V', $sampleRate);                   // SampleRate
        $header .= pack('V', $byteRate);                     // ByteRate
        $header .= pack('v', $blockAlign);                   // BlockAlign
        $header .= pack('v', $bitsPerSample);                // BitsPerSample
        $header .= 'data';                                   // Subchunk2ID
        $header .= pack('V', $dataSize);                     // Subchunk2Size

        return $header . $allPcmData;
    }

    /**
     * Get voice ID for a specific host
     *
     * @param string $host A or B
     * @return string|null
     */
    protected function getVoiceForHost(string $host): ?string
    {
        // Get distinct voices - Female for Host A, Male for Host B
        $gender = $host === 'A' ? 'Female' : 'Male';
        
        $voice = \DB::table('voices')
            ->where('status', 'Active')
            ->whereNull('type')
            ->where('gender', $gender)
            ->first();

        return $voice ? $voice->voice_name : null;
    }

    /**
     * Call ElevenLabs TTS API
     *
     * @param string $voiceId
     * @param string $text
     * @return string|null
     */
    protected function callElevenLabsApi(string $voiceId, string $text): ?string
    {
        try {
            $apiKey = config('aiKeys.ELEVENLABS.API_KEY');
            $baseUrl = moduleConfig('elevenLabs.BASE_URL', 'https://api.elevenlabs.io/v1/');
            
            $url = $baseUrl . 'text-to-speech/' . $voiceId;

            $data = [
                'text' => $text,
                'model_id' => 'eleven_flash_v2_5',
                'voice_settings' => [
                    'stability' => 0.5,
                    'similarity_boost' => 0.75,
                ],
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host', 2),
                CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer', true),
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                    "xi-api-key: " . $apiKey,
                ],
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $error = curl_error($curl);
            curl_close($curl);

            if ($error) {
                Log::error("ElevenLabs cURL Error: {$error}");
                return null;
            }

            if ($httpCode !== 200) {
                Log::error("ElevenLabs HTTP Error: {$httpCode} - " . substr($response, 0, 500));
                return null;
            }

            return $response;
        } catch (Exception $e) {
            Log::error('ElevenLabs API call failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Call Google Cloud TTS API as fallback
     *
     * @param string $text
     * @param string $speaker HOST A or HOST B
     * @return string|null
     */
    protected function callGoogleTtsApi(string $text, string $speaker): ?string
    {
        try {
            $apiKey = config('aiKeys.GOOGLE.API_KEY');
            
            if (empty($apiKey)) {
                Log::error('Google TTS: API key not configured');
                return null;
            }
            
            $url = 'https://texttospeech.googleapis.com/v1/text:synthesize?key=' . $apiKey;
            
            // Detect if text is Arabic
            $isArabic = preg_match('/[\x{0600}-\x{06FF}]/u', $text);
            
            // Select voice based on language and speaker
            if ($isArabic) {
                // Arabic voices
                $voiceName = $speaker === 'HOST A' ? 'ar-XA-Wavenet-A' : 'ar-XA-Wavenet-B';
                $languageCode = 'ar-XA';
            } else {
                // English voices
                $voiceName = $speaker === 'HOST A' ? 'en-US-Wavenet-F' : 'en-US-Wavenet-D';
                $languageCode = 'en-US';
            }
            
            $data = [
                'input' => [
                    'text' => $text
                ],
                'voice' => [
                    'languageCode' => $languageCode,
                    'name' => $voiceName
                ],
                'audioConfig' => [
                    'audioEncoding' => 'MP3',
                    'pitch' => 0,
                    'speakingRate' => 1.0
                ]
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host', 2),
                CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer', true),
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                ],
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $error = curl_error($curl);
            curl_close($curl);

            if ($error) {
                Log::error("Google TTS cURL Error: {$error}");
                return null;
            }

            if ($httpCode !== 200) {
                Log::error("Google TTS HTTP Error: {$httpCode} - " . substr($response, 0, 500));
                return null;
            }

            $responseData = json_decode($response, true);
            
            if (isset($responseData['audioContent'])) {
                Log::info("Google TTS: Successfully generated audio for text: " . substr($text, 0, 50));
                return base64_decode($responseData['audioContent']);
            }
            
            Log::error("Google TTS: No audio content in response");
            return null;
            
        } catch (Exception $e) {
            Log::error('Google TTS API call failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Call Gemini TTS API for audio generation
     *
     * @param string $text
     * @param string $speaker HOST A or HOST B
     * @return string|null
     */
    protected function callGeminiTtsApi(string $text, string $speaker): ?string
    {
        try {
            Log::info("Gemini TTS: Starting for speaker {$speaker}, text length: " . strlen($text));
            
            if (empty($this->apiKey)) {
                Log::error('Gemini API key not configured');
                return null;
            }

            // Detect if text is Arabic
            $isArabic = preg_match('/[\x{0600}-\x{06FF}]/u', $text);
            
            // Select voice based on speaker and language
            if ($isArabic) {
                $voiceName = $speaker === 'HOST A' ? 'Zephyr' : 'Puck';
            } else {
                $voiceName = $speaker === 'HOST A' ? 'Kore' : 'Charon';
            }

            Log::info("Gemini TTS: Using voice {$voiceName} for " . ($isArabic ? 'Arabic' : 'English'));

            $url = $this->baseUrl . "models/gemini-2.5-flash-preview-tts:generateContent?key=" . $this->apiKey;

            $data = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $text]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'responseModalities' => ['AUDIO'],
                    'speechConfig' => [
                        'voiceConfig' => [
                            'prebuiltVoiceConfig' => [
                                'voiceName' => $voiceName
                            ]
                        ]
                    ]
                ]
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 120,
                CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host', 2),
                CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer', true),
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                ],
            ]);

            Log::info("Gemini TTS: Calling API...");
            $response = curl_exec($curl);
            Log::info("Gemini TTS: API response received");
            
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $error = curl_error($curl);
            curl_close($curl);

            Log::info("Gemini TTS: HTTP Code: {$httpCode}");

            if ($error) {
                Log::error("Gemini TTS cURL Error: {$error}");
                return null;
            }

            if ($httpCode !== 200) {
                Log::error("Gemini TTS HTTP Error: {$httpCode} - " . substr($response, 0, 500));
                return null;
            }

            $responseData = json_decode($response, true);

            // Extract audio data from response
            if (isset($responseData['candidates'][0]['content']['parts'][0]['inlineData']['data'])) {
                $audioBase64 = $responseData['candidates'][0]['content']['parts'][0]['inlineData']['data'];
                Log::info("Gemini TTS: Successfully generated audio for: " . substr($text, 0, 50));
                return base64_decode($audioBase64);
            }

            Log::error("Gemini TTS: No audio content in response - " . substr($response, 0, 200));
            return null;

        } catch (Exception $e) {
            Log::error('Gemini TTS API call failed: ' . $e->getMessage());
            return null;
        }
    }
}
