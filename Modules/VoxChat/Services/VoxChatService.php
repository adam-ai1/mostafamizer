<?php

namespace Modules\VoxChat\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\VoxChat\Entities\VoxConversation;
use Modules\VoxChat\Entities\VoxMessage;

class VoxChatService
{
    protected ?string $apiKey;
    protected string $apiUrl = 'https://api.openai.com/v1/chat/completions';
    protected string $defaultModel = 'gpt-4o';
    protected int $maxTokens = 2048;
    protected float $temperature = 0.7;

    public function __construct()
    {
        // Try multiple config paths
        $this->apiKey = config('aiKeys.OPENAI.API_KEY') 
            ?: config('openAI.openAIKey') 
            ?: env('OPENAI') 
            ?: env('OPENAI_API_KEY')
            ?: null;
    }

    /**
     * Get AI response for a message in a conversation.
     */
    public function getResponse(VoxConversation $conversation, string $userMessage): array
    {
        $messages = $this->buildMessageHistory($conversation, $userMessage);
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60)->post($this->apiUrl, [
                'model' => $conversation->ai_model ?? $this->defaultModel,
                'messages' => $messages,
                'max_tokens' => $this->maxTokens,
                'temperature' => $this->temperature,
                'stream' => false,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'content' => $data['choices'][0]['message']['content'] ?? 'عذراً، لم أتمكن من الرد.',
                    'tokens_used' => $data['usage']['total_tokens'] ?? 0,
                    'model' => $data['model'] ?? $this->defaultModel,
                ];
            }

            Log::error('VoxChat API Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'content' => 'عذراً، حدث خطأ في الاتصال. حاول مرة أخرى.',
                'tokens_used' => 0,
            ];

        } catch (\Exception $e) {
            Log::error('VoxChat Exception', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'content' => 'عذراً، حدث خطأ غير متوقع. حاول مرة أخرى.',
                'tokens_used' => 0,
            ];
        }
    }

    /**
     * Build message history for context.
     */
    protected function buildMessageHistory(VoxConversation $conversation, string $newMessage): array
    {
        $messages = [];

        // System prompt
        $messages[] = [
            'role' => 'system',
            'content' => VoxConversation::getSystemPrompt(),
        ];

        // Previous messages (last 20 for context)
        $previousMessages = $conversation->messages()
            ->orderBy('created_at', 'asc')
            ->take(20)
            ->get();

        foreach ($previousMessages as $msg) {
            $messages[] = [
                'role' => $msg->role,
                'content' => $msg->content,
            ];
        }

        // New user message
        $messages[] = [
            'role' => 'user',
            'content' => $newMessage,
        ];

        return $messages;
    }

    /**
     * Stream response for typewriter effect.
     */
    public function streamResponse(VoxConversation $conversation, string $userMessage, callable $callback): array
    {
        $messages = $this->buildMessageHistory($conversation, $userMessage);
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(120)->withOptions([
                'stream' => true,
            ])->post($this->apiUrl, [
                'model' => $conversation->ai_model ?? $this->defaultModel,
                'messages' => $messages,
                'max_tokens' => $this->maxTokens,
                'temperature' => $this->temperature,
                'stream' => true,
            ]);

            $fullContent = '';
            $body = $response->body();
            
            // Parse SSE stream
            $lines = explode("\n", $body);
            foreach ($lines as $line) {
                if (str_starts_with($line, 'data: ')) {
                    $data = substr($line, 6);
                    if ($data === '[DONE]') {
                        break;
                    }
                    
                    $json = json_decode($data, true);
                    if (isset($json['choices'][0]['delta']['content'])) {
                        $chunk = $json['choices'][0]['delta']['content'];
                        $fullContent .= $chunk;
                        $callback($chunk);
                    }
                }
            }

            return [
                'success' => true,
                'content' => $fullContent,
                'tokens_used' => 0, // Not available in stream
            ];

        } catch (\Exception $e) {
            Log::error('VoxChat Stream Exception', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'content' => 'عذراً، حدث خطأ في البث.',
                'tokens_used' => 0,
            ];
        }
    }

    /**
     * Generate a title for conversation based on content.
     */
    public function generateConversationTitle(string $firstMessage): string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($this->apiUrl, [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'أنشئ عنواناً قصيراً (5 كلمات كحد أقصى) لمحادثة تبدأ بهذه الرسالة. أجب بالعنوان فقط.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $firstMessage,
                    ],
                ],
                'max_tokens' => 50,
                'temperature' => 0.5,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return trim($data['choices'][0]['message']['content'] ?? 'محادثة جديدة');
            }

        } catch (\Exception $e) {
            Log::error('VoxChat Title Generation Error', [
                'message' => $e->getMessage(),
            ]);
        }

        return \Str::limit($firstMessage, 30);
    }

    /**
     * Check if API is available.
     */
    public function checkHealth(): bool
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->timeout(10)->get('https://api.openai.com/v1/models');

            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Convert speech to text using Whisper API.
     */
    public function speechToText(string $audioFilePath): array
    {
        try {
            // Verify file exists
            if (!file_exists($audioFilePath)) {
                Log::error('VoxChat STT: Audio file not found', ['path' => $audioFilePath]);
                return [
                    'success' => false,
                    'text' => '',
                    'error' => 'الملف الصوتي غير موجود',
                ];
            }
            
            $fileSize = filesize($audioFilePath);
            Log::info('VoxChat STT: Processing audio', ['path' => $audioFilePath, 'size' => $fileSize]);
            
            // Get file extension for mime type
            $extension = pathinfo($audioFilePath, PATHINFO_EXTENSION);
            $mimeTypes = [
                'webm' => 'audio/webm',
                'mp3' => 'audio/mp3',
                'wav' => 'audio/wav',
                'm4a' => 'audio/m4a',
                'ogg' => 'audio/ogg',
            ];
            $mimeType = $mimeTypes[$extension] ?? 'audio/webm';
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->timeout(30)->attach(
                'file',
                fopen($audioFilePath, 'r'),
                'audio.' . $extension
            )->post('https://api.openai.com/v1/audio/transcriptions', [
                'model' => 'whisper-1',
                // Don't force Arabic - let Whisper auto-detect
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => true,
                    'text' => $data['text'] ?? '',
                ];
            }

            Log::error('VoxChat STT Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'text' => '',
                'error' => 'فشل تحويل الصوت لنص',
            ];

        } catch (\Exception $e) {
            Log::error('VoxChat STT Exception', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'text' => '',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Convert text to speech using OpenAI TTS API.
     */
    public function textToSpeech(string $text, string $voice = 'alloy'): array
    {
        try {
            // Limit text length for faster response
            $text = mb_substr($text, 0, 400);
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.openai.com/v1/audio/speech', [
                'model' => 'tts-1', // Faster model (tts-1 is faster than tts-1-hd)
                'input' => $text,
                'voice' => $voice, // alloy, echo, fable, onyx, nova, shimmer
                'response_format' => 'mp3',
                'speed' => 1.25, // Faster speech (1.0 - 4.0)
            ]);

            if ($response->successful()) {
                // Save audio to temp file
                $filename = 'voxchat_' . uniqid() . '.mp3';
                $path = storage_path('app/public/voxchat/' . $filename);
                
                // Ensure directory exists
                if (!file_exists(dirname($path))) {
                    mkdir(dirname($path), 0755, true);
                }
                
                file_put_contents($path, $response->body());
                
                // Use route to serve audio (bypasses symlink issues)
                $audioUrl = route('user.voxchat.audio', ['filename' => $filename]);
                
                Log::info('VoxChat: TTS audio saved', ['path' => $path, 'url' => $audioUrl]);

                return [
                    'success' => true,
                    'audio_url' => $audioUrl,
                    'path' => $path,
                ];
            }

            Log::error('VoxChat TTS Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'error' => 'فشل تحويل النص لصوت',
            ];

        } catch (\Exception $e) {
            Log::error('VoxChat TTS Exception', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Process voice message: STT -> AI Response -> TTS
     */
    public function processVoiceMessage(VoxConversation $conversation, string $audioFilePath): array
    {
        Log::info('VoxChat: Starting voice processing', ['path' => $audioFilePath]);
        
        // Step 1: Convert speech to text
        $sttResult = $this->speechToText($audioFilePath);
        
        Log::info('VoxChat: STT Result', ['success' => $sttResult['success'], 'text' => $sttResult['text'] ?? '']);
        
        if (!$sttResult['success'] || empty($sttResult['text'])) {
            return [
                'success' => false,
                'error' => $sttResult['error'] ?? 'لم أتمكن من فهم ما قلته. حاول مرة أخرى.',
            ];
        }

        $userText = $sttResult['text'];

        // Step 2: Get AI response
        $aiResponse = $this->getResponse($conversation, $userText);
        
        Log::info('VoxChat: AI Response', ['success' => $aiResponse['success']]);
        
        if (!$aiResponse['success']) {
            return [
                'success' => false,
                'error' => $aiResponse['content'],
                'user_text' => $userText,
            ];
        }

        // Step 3: Convert response to speech (using 'onyx' for professional Arabic voice)
        // Summarize long responses for faster TTS
        $ttsText = $aiResponse['content'];
        if (mb_strlen($ttsText) > 300) {
            // Keep first 300 characters for voice response
            $ttsText = mb_substr($ttsText, 0, 300) . '...';
        }
        
        $ttsResult = $this->textToSpeech($ttsText, 'onyx');
        
        Log::info('VoxChat: TTS Result', ['success' => $ttsResult['success'] ?? false, 'audio_url' => $ttsResult['audio_url'] ?? null]);
        
        return [
            'success' => true,
            'user_text' => $userText,
            'assistant_text' => $aiResponse['content'],
            'audio_url' => $ttsResult['audio_url'] ?? null,
            'tokens_used' => $aiResponse['tokens_used'],
        ];
    }

    /**
     * Create an ephemeral token for OpenAI Realtime API.
     * This allows browser to connect directly via WebRTC.
     */
    public function createRealtimeSession(string $voice = 'shimmer'): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.openai.com/v1/realtime/sessions', [
                'model' => 'gpt-4o-mini-realtime-preview-2024-12-17', // Mini model (cheaper)
                'voice' => $voice, // shimmer = friendly & warm voice
                'instructions' => 'أنت VoxAI، صديقك الذكي في منصة VoxCraft! 🌟 تحدث بطريقة مرحة وودودة وحماسية. استخدم تعبيرات لطيفة مثل "يا هلا!" و"تمام!" و"رائع!". كن متحمساً لمساعدة المستخدم. أجب بإيجاز مع لمسة من المرح. إذا سألك أحد بالإنجليزية، أجب بالإنجليزية بنفس الطاقة الإيجابية!',
                'input_audio_transcription' => [
                    'model' => 'whisper-1',
                ],
                'turn_detection' => [
                    'type' => 'server_vad',
                    'threshold' => 0.5,
                    'prefix_padding_ms' => 300,
                    'silence_duration_ms' => 500,
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::debug('VoxChat: Realtime session created', [
                    'session_id' => $data['id'] ?? null,
                ]);

                return [
                    'success' => true,
                    'client_secret' => $data['client_secret']['value'] ?? null,
                    'expires_at' => $data['client_secret']['expires_at'] ?? null,
                    'session_id' => $data['id'] ?? null,
                ];
            }

            Log::error('VoxChat Realtime Session Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'error' => 'فشل إنشاء جلسة المحادثة الصوتية',
            ];

        } catch (\Exception $e) {
            Log::error('VoxChat Realtime Session Exception', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
