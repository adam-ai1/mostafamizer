<?php

namespace Modules\VoxChat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\VoxChat\Entities\VoxConversation;
use Modules\VoxChat\Entities\VoxMessage;
use Modules\VoxChat\Services\VoxChatService;

class VoxChatController extends Controller
{
    protected VoxChatService $chatService;

    public function __construct(VoxChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    /**
     * Display the chat interface.
     */
    public function index()
    {
        $userId = Auth::id();
        
        // Get user's conversations
        $conversations = VoxConversation::forUser($userId)
            ->recent()
            ->with('latestMessage')
            ->take(20)
            ->get();

        return view('voxchat::index', [
            'conversations' => $conversations,
        ]);
    }

    /**
     * Start a new conversation.
     */
    public function newConversation(): JsonResponse
    {
        $userId = Auth::id();

        $conversation = VoxConversation::create([
            'user_id' => $userId,
            'ai_model' => VoxConversation::DEFAULT_MODEL,
        ]);

        return response()->json([
            'success' => true,
            'conversation_id' => $conversation->id,
            'message' => 'تم إنشاء محادثة جديدة',
        ]);
    }

    /**
     * Load a specific conversation.
     */
    public function loadConversation(int $id): JsonResponse
    {
        $userId = Auth::id();

        $conversation = VoxConversation::forUser($userId)
            ->with('messages')
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'conversation' => [
                'id' => $conversation->id,
                'title' => $conversation->display_title,
                'messages' => $conversation->messages->map(function ($msg) {
                    return [
                        'id' => $msg->id,
                        'role' => $msg->role,
                        'content' => $msg->content,
                        'formatted_content' => $msg->formatted_content,
                        'created_at' => $msg->created_at->diffForHumans(),
                    ];
                }),
            ],
        ]);
    }

    /**
     * Send a message and get AI response.
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:10000',
            'conversation_id' => 'nullable|integer',
        ]);

        $userId = Auth::id();
        $message = $request->input('message');
        $conversationId = $request->input('conversation_id');

        // Check subscription limits
        $validation = subscription('isValidSubscription', $userId, 'voxchat');
        if ($validation['status'] != 'success') {
            return response()->json([
                'success' => false,
                'error' => $validation['message'] ?? 'لقد استنفدت رصيدك من رسائل VoxChat. يرجى ترقية اشتراكك.',
            ], 403);
        }

        try {
            // Get or create conversation
            if ($conversationId) {
                $conversation = VoxConversation::forUser($userId)->findOrFail($conversationId);
            } else {
                $conversation = VoxConversation::create([
                    'user_id' => $userId,
                    'ai_model' => VoxConversation::DEFAULT_MODEL,
                ]);
            }

            // Save user message
            $userMessage = VoxMessage::create([
                'conversation_id' => $conversation->id,
                'role' => VoxMessage::ROLE_USER,
                'content' => $message,
                'content_type' => VoxMessage::TYPE_TEXT,
            ]);

            // Get AI response
            $aiResponse = $this->chatService->getResponse($conversation, $message);

            // Save AI message
            $assistantMessage = VoxMessage::create([
                'conversation_id' => $conversation->id,
                'role' => VoxMessage::ROLE_ASSISTANT,
                'content' => $aiResponse['content'],
                'content_type' => VoxMessage::TYPE_TEXT,
                'tokens_used' => $aiResponse['tokens_used'] ?? null,
            ]);

            // Update conversation
            $conversation->update([
                'total_tokens' => ($conversation->total_tokens ?? 0) + ($aiResponse['tokens_used'] ?? 0),
            ]);

            // Generate title if first message
            if ($conversation->messages()->count() <= 2 && !$conversation->title) {
                $conversation->generateTitle();
            }

            // Increment VoxChat usage
            $subscription = subscription('getUserSubscription', $userId);
            subscription('usageIncrement', $subscription?->id, 'voxchat', 1, $userId);

            return response()->json([
                'success' => true,
                'conversation_id' => $conversation->id,
                'user_message' => [
                    'id' => $userMessage->id,
                    'content' => $userMessage->content,
                    'role' => 'user',
                ],
                'assistant_message' => [
                    'id' => $assistantMessage->id,
                    'content' => $assistantMessage->content,
                    'formatted_content' => $assistantMessage->formatted_content,
                    'role' => 'assistant',
                ],
            ]);

        } catch (\Exception $e) {
            \Log::error('VoxChat Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'حدث خطأ أثناء معالجة رسالتك. حاول مرة أخرى.',
            ], 500);
        }
    }

    /**
     * Send a voice message and get AI voice response.
     */
    public function sendVoiceMessage(Request $request): JsonResponse
    {
        $request->validate([
            'audio' => 'required|file|mimes:webm,mp3,wav,m4a,ogg,mp4,mpeg|max:25000',
            'conversation_id' => 'nullable|integer',
        ]);

        $userId = Auth::id();
        $conversationId = $request->input('conversation_id');

        // Check subscription limits
        $validation = subscription('isValidSubscription', $userId, 'voxchat');
        if ($validation['status'] != 'success') {
            return response()->json([
                'success' => false,
                'error' => $validation['message'] ?? 'لقد استنفدت رصيدك من رسائل VoxChat. يرجى ترقية اشتراكك.',
            ], 403);
        }

        try {
            // Save uploaded audio file
            $audioFile = $request->file('audio');
            
            // Ensure directory exists
            $voiceDir = storage_path('app/voxchat/voice');
            if (!file_exists($voiceDir)) {
                mkdir($voiceDir, 0755, true);
            }
            
            // Generate unique filename and save file
            $filename = 'voice_' . time() . '_' . uniqid() . '.' . $audioFile->getClientOriginalExtension();
            $fullPath = $voiceDir . DIRECTORY_SEPARATOR . $filename;
            
            // Move uploaded file to destination
            $audioFile->move($voiceDir, $filename);
            
            // Verify file exists
            if (!file_exists($fullPath)) {
                \Log::error('VoxChat: Audio file not saved', ['path' => $fullPath]);
                return response()->json([
                    'success' => false,
                    'error' => 'فشل حفظ الملف الصوتي',
                ]);
            }
            
            \Log::info('VoxChat: Audio file saved', ['path' => $fullPath, 'size' => filesize($fullPath)]);

            // Get or create conversation
            if ($conversationId) {
                $conversation = VoxConversation::forUser($userId)->findOrFail($conversationId);
            } else {
                $conversation = VoxConversation::create([
                    'user_id' => $userId,
                    'ai_model' => VoxConversation::DEFAULT_MODEL,
                ]);
            }

            // Process voice message
            $result = $this->chatService->processVoiceMessage($conversation, $fullPath);

            // Clean up uploaded audio file
            @unlink($fullPath);

            if (!$result['success']) {
                return response()->json([
                    'success' => false,
                    'error' => $result['error'] ?? 'حدث خطأ في معالجة الصوت',
                ]);
            }

            // Save user message
            $userMessage = VoxMessage::create([
                'conversation_id' => $conversation->id,
                'role' => VoxMessage::ROLE_USER,
                'content' => $result['user_text'],
                'content_type' => VoxMessage::TYPE_TEXT,
            ]);

            // Save assistant message
            $assistantMessage = VoxMessage::create([
                'conversation_id' => $conversation->id,
                'role' => VoxMessage::ROLE_ASSISTANT,
                'content' => $result['assistant_text'],
                'content_type' => VoxMessage::TYPE_TEXT,
                'metadata' => [
                    'audio_url' => $result['audio_url'] ?? null,
                    'tokens_used' => $result['tokens_used'] ?? 0,
                ],
            ]);

            // Generate title if first message
            if ($conversation->messages()->count() <= 2) {
                $title = $this->chatService->generateConversationTitle($result['user_text']);
                $conversation->update(['title' => $title]);
            }

            $conversation->touch();

            // Increment VoxChat usage
            $subscription = subscription('getUserSubscription', $userId);
            subscription('usageIncrement', $subscription?->id, 'voxchat', 1, $userId);

            return response()->json([
                'success' => true,
                'conversation_id' => $conversation->id,
                'user_text' => $result['user_text'],
                'user_message' => [
                    'id' => $userMessage->id,
                    'role' => $userMessage->role,
                    'content' => $userMessage->content,
                ],
                'assistant_message' => [
                    'id' => $assistantMessage->id,
                    'role' => $assistantMessage->role,
                    'content' => $assistantMessage->content,
                    'audio_url' => $result['audio_url'] ?? null,
                ],
            ]);

        } catch (\Exception $e) {
            \Log::error('VoxChat Voice Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'حدث خطأ أثناء معالجة الرسالة الصوتية.',
            ], 500);
        }
    }

    /**
     * Delete a conversation.
     */
    public function deleteConversation(int $id): JsonResponse
    {
        $userId = Auth::id();

        $conversation = VoxConversation::forUser($userId)->findOrFail($id);
        $conversation->messages()->delete();
        $conversation->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم حذف المحادثة',
        ]);
    }

    /**
     * Get conversation history for sidebar.
     */
    public function getHistory(): JsonResponse
    {
        $userId = Auth::id();

        $conversations = VoxConversation::forUser($userId)
            ->recent()
            ->take(30)
            ->get()
            ->map(function ($conv) {
                return [
                    'id' => $conv->id,
                    'title' => $conv->display_title,
                    'updated_at' => $conv->updated_at->diffForHumans(),
                    'message_count' => $conv->message_count,
                ];
            });

        return response()->json([
            'success' => true,
            'conversations' => $conversations,
        ]);
    }

    /**
     * Quick suggestions for new users.
     */
    public function getSuggestions(): JsonResponse
    {
        $suggestions = [
            [
                'icon' => '🎙️',
                'text' => 'كيف أنشئ إعلان صوتي؟',
                'category' => 'audio_ads',
            ],
            [
                'icon' => '🎧',
                'text' => 'أريد إنشاء بودكاست',
                'category' => 'podcast',
            ],
            [
                'icon' => '🎨',
                'text' => 'كيف أولد صورة بالذكاء الاصطناعي؟',
                'category' => 'images',
            ],
            [
                'icon' => '💰',
                'text' => 'ما هي الباقات والأسعار؟',
                'category' => 'pricing',
            ],
            [
                'icon' => '❓',
                'text' => 'لدي مشكلة تقنية',
                'category' => 'support',
            ],
            [
                'icon' => '🚀',
                'text' => 'ما هي خدمات VoxCraft؟',
                'category' => 'general',
            ],
        ];

        return response()->json([
            'success' => true,
            'suggestions' => $suggestions,
        ]);
    }

    /**
     * Serve audio file for voice responses.
     */
    public function serveAudio(string $filename)
    {
        $path = storage_path('app/public/voxchat/' . $filename);
        
        if (!file_exists($path)) {
            abort(404, 'Audio file not found');
        }
        
        $mimeType = 'audio/mpeg';
        if (str_ends_with($filename, '.wav')) {
            $mimeType = 'audio/wav';
        } elseif (str_ends_with($filename, '.ogg')) {
            $mimeType = 'audio/ogg';
        }
        
        return response()->file($path, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Create a realtime session for WebRTC voice chat.
     * Returns an ephemeral token that allows the browser to connect directly to OpenAI.
     */
    public function createRealtimeSession(Request $request): JsonResponse
    {
        $voice = $request->input('voice', 'alloy');
        
        $result = $this->chatService->createRealtimeSession($voice);
        
        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'error' => $result['error'] ?? 'فشل إنشاء جلسة المحادثة الصوتية',
            ], 500);
        }
        
        return response()->json([
            'success' => true,
            'client_secret' => $result['client_secret'],
            'expires_at' => $result['expires_at'],
        ]);
    }
}
