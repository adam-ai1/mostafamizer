<?php

/**
 * @package AudioAdService
 * @author VoxCraft
 * @created 2024-12-15
 */

namespace Modules\OpenAI\Services;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\OpenAI\Entities\AudioAd;
use Modules\Subscription\Services\PackageSubscriptionService;

class AudioAdService
{
    /**
     * Gemini API configuration
     */
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;

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
     * Create a new audio ad
     *
     * @param array $data
     * @return array
     */
    public function createAudioAd(array $data): array
    {
        try {
            $userId = $data['user_id'] ?? Auth::id();
            
            if (!$userId) {
                return [
                    'success' => false,
                    'error' => __('User not authenticated'),
                ];
            }

            // Check subscription validity for audio_ads feature
            $validation = subscription('isValidSubscription', $userId, 'audio_ads');
            if ($validation['status'] != 'success') {
                return [
                    'success' => false,
                    'error' => $validation['message'] ?? __('You have reached your audio ads limit. Please upgrade your plan.'),
                ];
            }

            // Determine user subscription tier
            $tier = $this->getUserSubscriptionTier($userId);

            // Create the audio ad record
            $audioAd = AudioAd::create([
                'user_id' => $userId,
                'title' => $data['title'] ?? null,
                'ad_text' => $data['ad_text'],
                'product_type' => $data['product_type'] ?? null,
                'ad_style' => $data['ad_style'] ?? AudioAd::STYLE_PROFESSIONAL,
                'target_platform' => $data['target_platform'] ?? AudioAd::PLATFORM_RADIO,
                'target_duration' => $data['target_duration'] ?? AudioAd::DURATION_MEDIUM,
                'voice_id' => $data['voice_id'] ?? 'EXAVITQu4vr4xnSDxMaL',
                'voice_name' => $data['voice_name'] ?? 'سارة',
                'background_music' => $data['background_music'] ?? AudioAd::MUSIC_NONE,
                'music_volume' => $data['music_volume'] ?? 0.2,
                'status' => AudioAd::STATUS_PROCESSING,
                'tier' => $tier,
                'provider' => 'elevenlabs',
            ]);

            // Increment usage (deduct 1 audio ad from balance)
            $subscription = subscription('getUserSubscription', $userId);
            subscription('usageIncrement', $subscription?->id, 'audio_ads', 1, $userId);

            // Process synchronously (no queue worker needed)
            $this->processAudioAd($audioAd);

            // Refresh to get updated data
            $audioAd->refresh();

            return [
                'success' => $audioAd->status === AudioAd::STATUS_COMPLETED,
                'audio_ad' => $audioAd,
                'message' => $audioAd->status === AudioAd::STATUS_COMPLETED 
                    ? __('Audio ad created successfully!') 
                    : $audioAd->error_message,
            ];
        } catch (Exception $e) {
            Log::error('Audio ad creation failed: ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Process the audio ad generation
     *
     * @param AudioAd $audioAd
     * @return void
     */
    public function processAudioAd(AudioAd $audioAd): void
    {
        try {
            // Step 1: Generate ad script if needed
            $script = $audioAd->ad_text;
            
            // If the ad text is short, we can generate a better script
            if (str_word_count($script) < 20) {
                $scriptResult = $this->generateAdScript($audioAd);
                
                if ($scriptResult['success']) {
                    $script = $scriptResult['script'];
                    $audioAd->update([
                        'generated_script' => $script,
                        'title' => $audioAd->title ?? $scriptResult['title'],
                    ]);
                }
            } else {
                $audioAd->update(['generated_script' => $script]);
            }

            // Step 2: Generate voice audio
            $audioResult = $this->generateVoiceAudio($audioAd, $script);
            
            if (!$audioResult['success']) {
                throw new Exception($audioResult['error']);
            }

            // Step 3: Add background music if selected
            $finalAudioPath = $audioResult['audio_path'];
            
            if ($audioAd->background_music !== AudioAd::MUSIC_NONE) {
                $musicResult = $this->addBackgroundMusic(
                    $audioResult['audio_path'],
                    $audioAd->background_music,
                    $audioAd->music_volume
                );
                
                if ($musicResult['success']) {
                    $finalAudioPath = $musicResult['audio_path'];
                }
            }

            // Update the audio ad with final path
            $audioAd->update([
                'audio_path' => $finalAudioPath,
                'audio_voice_only' => $audioResult['audio_path'],
                'status' => AudioAd::STATUS_COMPLETED,
                'error_message' => null,
            ]);

            Log::info("Audio ad {$audioAd->id} completed successfully");

        } catch (Exception $e) {
            Log::error("Audio ad {$audioAd->id} failed: " . $e->getMessage());
            
            $audioAd->update([
                'status' => AudioAd::STATUS_FAILED,
                'error_message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Generate ad script using AI
     *
     * @param AudioAd $audioAd
     * @return array
     */
    protected function generateAdScript(AudioAd $audioAd): array
    {
        try {
            if (empty($this->apiKey)) {
                throw new Exception(__('Gemini API key is not configured.'));
            }

            $prompt = $this->buildAdPrompt($audioAd);
            $response = $this->callGeminiApi($prompt);

            if (!$response['success']) {
                return $response;
            }

            $script = $response['content'];
            
            // Extract title if present
            $title = $this->extractTitleFromScript($script, $audioAd->ad_text);

            return [
                'success' => true,
                'script' => $script,
                'title' => $title,
            ];
        } catch (Exception $e) {
            Log::error('Ad script generation failed: ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Build the ad script prompt
     *
     * @param AudioAd $audioAd
     * @return string
     */
    protected function buildAdPrompt(AudioAd $audioAd): string
    {
        $styles = [
            AudioAd::STYLE_PROFESSIONAL => 'احترافي وموثوق، يعطي انطباعاً بالمصداقية والخبرة',
            AudioAd::STYLE_CASUAL => 'ودي وغير رسمي، كأنك تتحدث مع صديق',
            AudioAd::STYLE_ENERGETIC => 'حماسي ومُحفّز، مليء بالطاقة والحيوية',
            AudioAd::STYLE_EMOTIONAL => 'عاطفي ومؤثر، يلمس القلب ويثير المشاعر',
        ];

        $platforms = [
            AudioAd::PLATFORM_RADIO => 'إعلان راديو - يجب أن يكون واضحاً وجذاباً للانتباه السمعي فقط',
            AudioAd::PLATFORM_YOUTUBE => 'إعلان يوتيوب - يمكن أن يكون أكثر عصرية وشبابية',
            AudioAd::PLATFORM_SOCIAL_MEDIA => 'إعلان سوشيال ميديا - قصير ومباشر وجذاب من أول ثانية',
            AudioAd::PLATFORM_PODCAST => 'إعلان بودكاست - يبدو طبيعياً كأنه جزء من المحادثة',
        ];

        $durationWords = [
            15 => '35-45 كلمة',
            30 => '70-85 كلمة',
            60 => '140-160 كلمة',
        ];

        $styleDesc = $styles[$audioAd->ad_style] ?? $styles[AudioAd::STYLE_PROFESSIONAL];
        $platformDesc = $platforms[$audioAd->target_platform] ?? $platforms[AudioAd::PLATFORM_RADIO];
        $wordCount = $durationWords[$audioAd->target_duration] ?? $durationWords[30];

        $productTypeText = '';
        if ($audioAd->product_type) {
            $productTypes = AudioAd::getProductTypes();
            $productTypeName = $productTypes[$audioAd->product_type] ?? $audioAd->product_type;
            $productTypeText = "نوع المنتج/الخدمة: {$productTypeName}";
        }

        $prompt = <<<PROMPT
أنت كاتب إعلانات محترف متخصص في الإعلانات الصوتية. اكتب نص إعلان صوتي جذاب وفعال.

**معلومات الإعلان:**
- الموضوع الأساسي: {$audioAd->ad_text}
{$productTypeText}

**المتطلبات:**
1. **المنصة المستهدفة:** {$platformDesc}
2. **أسلوب الإعلان:** {$styleDesc}
3. **المدة المستهدفة:** {$audioAd->target_duration} ثانية ({$wordCount})

**إرشادات الكتابة:**
- اكتب باللغة العربية الفصحى السهلة والمفهومة
- ابدأ بجملة قوية تجذب الانتباه (Hook)
- اذكر الفائدة الرئيسية للعميل
- أضف دعوة للعمل (Call to Action) في النهاية
- اجعل النص سلساً للقراءة بصوت عالٍ
- لا تستخدم علامات ترقيم معقدة أو رموز
- لا تكتب "عنوان:" أو أي علامات تنسيق، فقط النص الإعلاني المباشر

**مثال على الهيكل:**
[جملة جذابة للانتباه]
[شرح المنتج/الخدمة والفوائد]
[دعوة للعمل]

اكتب نص الإعلان الآن (النص فقط، بدون عناوين أو تنسيق):
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
                    'temperature' => 0.8,
                    'topP' => 0.9,
                    'topK' => 40,
                    'maxOutputTokens' => 1024,
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
            
            // Clean up the content
            $content = trim($content);
            $content = preg_replace('/^(عنوان|العنوان|النص|الإعلان):\s*/u', '', $content);

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
     * Generate voice audio using ElevenLabs
     *
     * @param AudioAd $audioAd
     * @param string $script
     * @return array
     */
    protected function generateVoiceAudio(AudioAd $audioAd, string $script): array
    {
        try {
            $apiKey = config('aiKeys.ELEVENLABS.API_KEY');
            $baseUrl = moduleConfig('elevenLabs.BASE_URL', 'https://api.elevenlabs.io/v1/');
            
            if (empty($apiKey)) {
                throw new Exception(__('ElevenLabs API key is not configured.'));
            }

            $voiceId = $audioAd->voice_id;
            $url = $baseUrl . 'text-to-speech/' . $voiceId;

            $data = [
                'text' => $script,
                'model_id' => 'eleven_flash_v2_5',
                'voice_settings' => [
                    'stability' => 0.6,
                    'similarity_boost' => 0.8,
                    'style' => 0.5,
                    'use_speaker_boost' => true,
                ],
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 120,
                CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host', 2),
                CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer', true),
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
                throw new Exception("cURL Error: {$error}");
            }

            if ($httpCode !== 200) {
                $responseData = json_decode($response, true);
                $errorMessage = $responseData['detail']['message'] ?? "HTTP Error: {$httpCode}";
                throw new Exception($errorMessage);
            }

            if (empty($response)) {
                throw new Exception(__('Empty audio response from ElevenLabs'));
            }

            // Save the audio file
            $filename = 'audio_ads/' . $audioAd->id . '_voice_' . time() . '.mp3';
            Storage::disk('public')->put($filename, $response);
            
            $audioPath = 'storage/app/public/' . $filename;
            
            // Calculate actual duration (rough estimate: file size / bitrate)
            // MP3 at 128kbps ≈ 16000 bytes per second
            $actualDuration = (int) (strlen($response) / 16000);
            
            $audioAd->update(['actual_duration' => $actualDuration]);

            Log::info("Audio ad voice generated: {$filename}, size: " . strlen($response) . " bytes, duration: ~{$actualDuration}s");

            return [
                'success' => true,
                'audio_path' => $audioPath,
                'duration' => $actualDuration,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Add background music to the voice audio using FFmpeg
     *
     * @param string $voiceAudioPath
     * @param string $musicType
     * @param float $volume
     * @return array
     */
    protected function addBackgroundMusic(string $voiceAudioPath, string $musicType, float $volume): array
    {
        try {
            // FFmpeg path
            $ffmpegPath = 'C:\\laragon\\bin\\ffmpeg\\ffmpeg-8.0.1-essentials_build\\bin\\ffmpeg.exe';
            
            // Check if FFmpeg exists
            if (!file_exists($ffmpegPath)) {
                Log::warning("FFmpeg not found at: {$ffmpegPath}");
                return [
                    'success' => true,
                    'audio_path' => $voiceAudioPath,
                    'note' => 'FFmpeg not found - returning voice-only audio',
                ];
            }
            
            // Music file path
            $musicFile = public_path("audio/music/{$musicType}.mp3");
            
            if (!file_exists($musicFile)) {
                Log::warning("Music file not found: {$musicFile}");
                return [
                    'success' => true,
                    'audio_path' => $voiceAudioPath,
                    'note' => 'Music file not found - returning voice-only audio',
                ];
            }
            
            // Full path to voice audio
            $voiceFullPath = public_path(str_replace('storage/', 'storage/', $voiceAudioPath));
            
            // Output file path
            $outputFilename = 'audio_ads/' . pathinfo($voiceAudioPath, PATHINFO_FILENAME) . '_mixed_' . time() . '.mp3';
            $outputPath = storage_path('app/public/' . $outputFilename);
            
            // Ensure directory exists
            $outputDir = dirname($outputPath);
            if (!is_dir($outputDir)) {
                mkdir($outputDir, 0755, true);
            }
            
            // FFmpeg command to mix voice with background music
            // - Voice stays at 100% volume
            // - Music is reduced to specified volume (e.g., 0.2 = 20%)
            // - Music is looped to match voice duration
            // - Music fades out at the end
            $command = sprintf(
                '"%s" -y -i "%s" -stream_loop -1 -i "%s" -filter_complex "[1:a]volume=%s[music];[0:a][music]amix=inputs=2:duration=first:dropout_transition=3[out]" -map "[out]" -c:a libmp3lame -q:a 2 "%s" 2>&1',
                $ffmpegPath,
                $voiceFullPath,
                $musicFile,
                $volume,
                $outputPath
            );
            
            Log::info("Mixing audio with FFmpeg: {$command}");
            
            // Execute FFmpeg
            $output = [];
            $returnCode = 0;
            exec($command, $output, $returnCode);
            
            if ($returnCode !== 0) {
                Log::error("FFmpeg failed with code {$returnCode}: " . implode("\n", $output));
                return [
                    'success' => true,
                    'audio_path' => $voiceAudioPath,
                    'note' => 'FFmpeg mixing failed - returning voice-only audio',
                ];
            }
            
            // Check if output file was created
            if (!file_exists($outputPath)) {
                Log::error("FFmpeg output file not created: {$outputPath}");
                return [
                    'success' => true,
                    'audio_path' => $voiceAudioPath,
                    'note' => 'FFmpeg output not created - returning voice-only audio',
                ];
            }
            
            $finalPath = 'storage/app/public/' . $outputFilename;
            
            Log::info("Audio mixed successfully: {$finalPath}");
            
            return [
                'success' => true,
                'audio_path' => $finalPath,
            ];
        } catch (Exception $e) {
            Log::error("Background music mixing failed: " . $e->getMessage());
            return [
                'success' => true,
                'audio_path' => $voiceAudioPath,
                'note' => 'Exception during mixing - returning voice-only audio',
            ];
        }
    }

    /**
     * Extract title from script
     *
     * @param string $script
     * @param string $fallback
     * @return string
     */
    protected function extractTitleFromScript(string $script, string $fallback): string
    {
        // Take first 50 characters as title
        $title = mb_substr($script, 0, 50);
        
        // Cut at last complete word
        $lastSpace = mb_strrpos($title, ' ');
        if ($lastSpace !== false && $lastSpace > 20) {
            $title = mb_substr($title, 0, $lastSpace);
        }
        
        return $title . '...';
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
                return AudioAd::TIER_FREE;
            }

            $package = $subscription->package;
            
            if (!$package) {
                return AudioAd::TIER_FREE;
            }

            $salePrice = $package->sale_price ?? [];
            $billingCycle = $subscription->billing_cycle ?? 'monthly';
            
            if (isset($salePrice[$billingCycle]) && $salePrice[$billingCycle] > 0) {
                return AudioAd::TIER_PREMIUM;
            }

            return AudioAd::TIER_FREE;
        } catch (Exception $e) {
            Log::warning('Failed to determine subscription tier: ' . $e->getMessage());
            return AudioAd::TIER_FREE;
        }
    }

    /**
     * Get user's audio ads with pagination
     *
     * @param int $userId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUserAudioAds(int $userId, int $perPage = 12)
    {
        return AudioAd::forUser($userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get audio ad by ID
     *
     * @param int $id
     * @param int|null $userId
     * @return AudioAd|null
     */
    public function getAudioAd(int $id, ?int $userId = null): ?AudioAd
    {
        $query = AudioAd::where('id', $id);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        return $query->first();
    }

    /**
     * Delete audio ad
     *
     * @param int $id
     * @param int $userId
     * @return bool
     */
    public function deleteAudioAd(int $id, int $userId): bool
    {
        $audioAd = $this->getAudioAd($id, $userId);

        if (!$audioAd) {
            return false;
        }

        // Delete audio files
        if ($audioAd->audio_path) {
            $path = str_replace('storage/', '', $audioAd->audio_path);
            Storage::disk('public')->delete($path);
        }
        
        if ($audioAd->audio_voice_only && $audioAd->audio_voice_only !== $audioAd->audio_path) {
            $path = str_replace('storage/', '', $audioAd->audio_voice_only);
            Storage::disk('public')->delete($path);
        }

        return $audioAd->delete();
    }

    /**
     * Check if audio ad generation is available for user
     *
     * @param int $userId
     * @return array
     */
    public function checkAvailability(int $userId): array
    {
        // Check if ElevenLabs API is configured
        $apiKey = config('aiKeys.ELEVENLABS.API_KEY');
        
        if (empty($apiKey)) {
            return [
                'available' => false,
                'error' => __('Voice service is not configured. Please contact administrator.'),
            ];
        }

        $tier = $this->getUserSubscriptionTier($userId);

        return [
            'available' => true,
            'tier' => $tier,
        ];
    }
}
