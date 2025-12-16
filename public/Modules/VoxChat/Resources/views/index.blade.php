@extends('layouts.user_master')
@section('page_title', __('VoxChat - المحادثة الذكية'))

@push('styles')
<style>
    /* VoxChat Styles */
    .voxchat-container {
        height: calc(100vh - 88px);
        display: flex;
        overflow: hidden;
    }
    
    /* Sidebar */
    .voxchat-sidebar {
        width: 280px;
        border-left: 1px solid rgba(139, 92, 246, 0.1);
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }
    
    .voxchat-sidebar.collapsed {
        width: 0;
        overflow: hidden;
    }
    
    /* Main Chat Area */
    .voxchat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    /* Messages Container */
    .messages-container {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem;
        scroll-behavior: smooth;
    }
    
    #messages-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .messages-container::-webkit-scrollbar {
        width: 6px;
    }
    
    .messages-container::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .messages-container::-webkit-scrollbar-thumb {
        background: rgba(139, 92, 246, 0.3);
        border-radius: 3px;
    }
    
    /* Message Bubbles */
    .message-bubble {
        max-width: 85%;
        margin-bottom: 1rem;
        animation: fadeInUp 0.3s ease;
        position: relative;
        display: flex; /* Ensure bubble itself is a flex container if needed, or just block */
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* User message - on the LEFT (RTL layout) */
    .message-user {
        margin-right: auto;
        margin-left: 0;
        justify-content: flex-end; /* For flex bubble */
    }
    
    /* Assistant message - on the RIGHT (RTL layout) */
    .message-assistant {
        margin-left: auto;
        margin-right: 0;
        justify-content: flex-start; /* For flex bubble */
    }
    
    .message-content {
        padding: 1rem 1.25rem;
        border-radius: 1.25rem;
        line-height: 1.8;
        font-size: 0.95rem;
        word-wrap: break-word;
        overflow-wrap: break-word;
        display: flex; /* Use flex to contain children properly */
        flex-direction: column;
        height: auto !important; /* Force auto height */
        min-height: min-content;
    }
    
    .message-content {
        padding: 1rem 1.25rem;
        border-radius: 1.25rem;
        line-height: 1.8;
        font-size: 0.95rem;
        word-wrap: break-word;
        overflow-wrap: break-word;
        width: 100%;
    }
    
    .message-user .message-content {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: white;
        border-radius: 1.25rem 1.25rem 0.25rem 1.25rem;
    }
    
    .message-assistant .message-content {
        background: rgba(139, 92, 246, 0.15);
        color: #e2e8f0;
        border-radius: 1.25rem 1.25rem 1.25rem 0.25rem;
    }
    
    .message-content ul,
    .message-content ol {
        padding-right: 1.5rem;
        padding-left: 0;
        margin: 0.75rem 0;
        list-style-position: inside;
    }
    
    .message-content ol {
        list-style-type: decimal;
    }
    
    .message-content ul {
        list-style-type: disc;
    }
    
    [dir="ltr"] .message-content ul,
    [dir="ltr"] .message-content ol {
        padding-left: 1.5rem;
        padding-right: 0;
    }
    
    .message-content li {
        margin-bottom: 0.5rem;
        padding-right: 0.5rem;
    }
    
    [dir="ltr"] .message-content li {
        padding-left: 0.5rem;
        padding-right: 0;
    }
    
    .message-content p {
        margin-bottom: 0.5rem;
    }
    
    .message-content p:last-child {
        margin-bottom: 0;
    }
    
    .message-content h3,
    .message-content h4 {
        margin-top: 1rem;
        color: #a855f7;
    }
    
    .message-content h3:first-child,
    .message-content h4:first-child {
        margin-top: 0;
    }
    
    .message-content strong {
        color: #c084fc;
    }
    
    .message-user .message-content {
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        color: white;
        border-bottom-right-radius: 0.25rem;
        box-shadow: 0 2px 10px rgba(124, 58, 237, 0.3);
    }
    
    .message-user .message-content strong {
        color: white;
    }
    
    .message-assistant .message-content {
        background: linear-gradient(135deg, rgba(55, 48, 83, 0.95) 0%, rgba(45, 38, 73, 0.95) 100%);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-bottom-left-radius: 0.25rem;
        color: #e2e8f0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    
    .message-assistant .message-content h3,
    .message-assistant .message-content h4 {
        color: #c4b5fd;
    }
    
    .message-assistant .message-content strong {
        color: #ddd6fe;
    }
    
    /* Typing Indicator */
    .typing-indicator {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem;
        color: #8b5cf6;
    }
    
    .typing-indicator.hidden {
        display: none !important;
    }
    
    .typing-dots {
        display: flex;
        gap: 4px;
    }
    
    .typing-dot {
        width: 8px;
        height: 8px;
        background: #8b5cf6;
        border-radius: 50%;
        animation: typingBounce 1.4s infinite ease-in-out;
    }
    
    .typing-dot:nth-child(1) { animation-delay: -0.32s; }
    .typing-dot:nth-child(2) { animation-delay: -0.16s; }
    .typing-dot:nth-child(3) { animation-delay: 0s; }
    
    @keyframes typingBounce {
        0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
        40% { transform: scale(1); opacity: 1; }
    }
    
    /* Input Area */
    .input-area {
        padding: 1rem 1.5rem 1.5rem;
        border-top: 1px solid rgba(139, 92, 246, 0.1);
        background: inherit;
    }
    
    .input-wrapper {
        display: flex;
        align-items: flex-end;
        gap: 0.75rem;
        background: rgba(139, 92, 246, 0.05);
        border: 2px solid rgba(139, 92, 246, 0.2);
        border-radius: 1.5rem;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    
    .input-wrapper:focus-within {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
    }
    
    .message-input {
        flex: 1;
        border: none;
        background: transparent;
        resize: none;
        font-size: 1rem;
        line-height: 1.5;
        max-height: 150px;
        color: inherit;
    }
    
    .message-input:focus {
        outline: none;
    }
    
    .message-input::placeholder {
        color: #9ca3af;
    }
    
    .send-btn {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        border: none;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    
    .send-btn:hover:not(:disabled) {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
    }
    
    .send-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    /* Call Button */
    .call-btn {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
        position: relative;
    }
    
    .call-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
    }
    
    .call-btn.active {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        animation: pulse-call 2s infinite;
    }
    
    @keyframes pulse-call {
        0%, 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
        50% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
    }
    
    /* Voice Call Modal */
    .call-modal {
        position: fixed;
        bottom: 120px;
        left: 50%;
        transform: translateX(-50%) translateY(20px);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 100;
    }
    
    .call-modal.active {
        transform: translateX(-50%) translateY(0);
        opacity: 1;
        visibility: visible;
    }
    
    .call-modal-content {
        background: linear-gradient(135deg, rgba(17, 24, 39, 0.95) 0%, rgba(31, 41, 55, 0.95) 100%);
        backdrop-filter: blur(20px);
        border-radius: 2rem;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .call-control-btn {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: white;
    }
    
    .call-control-btn:hover {
        transform: scale(1.1);
    }
    
    .call-control-btn.end-call {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
    }
    
    .call-control-btn.end-call:hover {
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.6);
    }
    
    .call-control-btn.video-btn {
        background: rgba(139, 92, 246, 0.2);
        border: 2px solid rgba(139, 92, 246, 0.5);
    }
    
    .call-control-btn.video-btn:hover {
        background: rgba(139, 92, 246, 0.4);
        border-color: #a855f7;
    }
    
    .call-control-btn.video-btn.active {
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        border-color: transparent;
    }
    
    .call-control-btn.screen-btn {
        background: rgba(59, 130, 246, 0.2);
        border: 2px solid rgba(59, 130, 246, 0.5);
    }
    
    .call-control-btn.screen-btn:hover {
        background: rgba(59, 130, 246, 0.4);
        border-color: #3b82f6;
    }
    
    .call-control-btn.screen-btn.active {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-color: transparent;
    }
    
    .call-timer {
        font-family: 'SF Mono', 'Fira Code', monospace;
        font-size: 1.25rem;
        color: white;
        min-width: 70px;
        text-align: center;
        font-weight: 600;
    }
    
    .call-status {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
    }
    
    .call-status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10b981;
        animation: pulse-dot 1.5s infinite;
    }
    
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    .call-status-text {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.7);
    }
    
    /* Audio Visualizer */
    .audio-visualizer {
        display: flex;
        align-items: center;
        gap: 3px;
        height: 30px;
        padding: 0 0.5rem;
    }
    
    .audio-bar {
        width: 4px;
        background: linear-gradient(180deg, #a855f7 0%, #7c3aed 100%);
        border-radius: 2px;
        animation: audio-wave 0.5s ease-in-out infinite;
    }
    
    .audio-bar:nth-child(1) { height: 30%; animation-delay: 0s; }
    .audio-bar:nth-child(2) { height: 60%; animation-delay: 0.1s; }
    .audio-bar:nth-child(3) { height: 100%; animation-delay: 0.2s; }
    .audio-bar:nth-child(4) { height: 60%; animation-delay: 0.3s; }
    .audio-bar:nth-child(5) { height: 30%; animation-delay: 0.4s; }
    
    @keyframes audio-wave {
        0%, 100% { transform: scaleY(1); }
        50% { transform: scaleY(0.5); }
    }
    
    /* Quick Suggestions */
    .suggestions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 0.75rem;
        margin-top: 1rem;
    }
    
    .suggestion-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background: rgba(139, 92, 246, 0.05);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 1rem;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: right;
    }
    
    .suggestion-btn:hover {
        background: rgba(139, 92, 246, 0.1);
        border-color: #8b5cf6;
        transform: translateY(-2px);
    }
    
    /* Conversation List */
    .conversations-container {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .conversation-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        border-radius: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(139, 92, 246, 0.15);
        position: relative;
        overflow: hidden;
    }
    
    .conversation-item::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(180deg, #7c3aed 0%, #a855f7 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .conversation-item:hover {
        background: rgba(139, 92, 246, 0.1);
        border-color: rgba(139, 92, 246, 0.3);
        transform: translateX(-4px);
        box-shadow: 4px 4px 15px rgba(139, 92, 246, 0.15);
    }
    
    .conversation-item:hover::before {
        opacity: 1;
    }
    
    .conversation-item.active {
        background: linear-gradient(135deg, rgba(124, 58, 237, 0.15) 0%, rgba(168, 85, 247, 0.1) 100%);
        border-color: rgba(139, 92, 246, 0.4);
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.2);
    }
    
    .conversation-item.active::before {
        opacity: 1;
    }
    
    .conversation-icon {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.75rem;
        background: linear-gradient(135deg, rgba(124, 58, 237, 0.2) 0%, rgba(168, 85, 247, 0.15) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid rgba(139, 92, 246, 0.2);
    }
    
    .conversation-item:hover .conversation-icon {
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        border-color: transparent;
    }
    
    .conversation-item:hover .conversation-icon svg {
        color: white;
    }
    
    .conversation-info {
        flex: 1;
        min-width: 0;
    }
    
    .conversation-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: inherit;
        margin-bottom: 0.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .conversation-time {
        font-size: 0.75rem;
        opacity: 0.6;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .conversation-delete {
        opacity: 0;
        transition: opacity 0.2s ease;
        padding: 0.375rem;
        border-radius: 0.5rem;
        color: #ef4444;
    }
    
    .conversation-item:hover .conversation-delete {
        opacity: 1;
    }
    
    .conversation-delete:hover {
        background: rgba(239, 68, 68, 0.1);
    }
    
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(-20px);
        }
    }
    
    /* Welcome Screen */
    .welcome-screen {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        text-align: center;
        padding: 2rem;
    }
    
    .welcome-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        border-radius: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.4); }
        50% { box-shadow: 0 0 0 20px rgba(139, 92, 246, 0); }
    }
    
    /* Typewriter effect */
    .typewriter-cursor {
        display: inline-block;
        width: 2px;
        height: 1.2em;
        background: #8b5cf6;
        margin-right: 2px;
        animation: blink 1s infinite;
    }
    
    @keyframes blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0; }
    }
    
    /* Mobile responsive */
    @media (max-width: 768px) {
        .voxchat-sidebar {
            position: fixed;
            right: 0;
            top: 0;
            height: 100%;
            z-index: 50;
            background: inherit;
            box-shadow: -4px 0 20px rgba(0,0,0,0.1);
        }
        
        .voxchat-sidebar.collapsed {
            transform: translateX(100%);
        }
        
        .message-bubble {
            max-width: 90%;
        }
    }
</style>
@endpush

@section('content')
<div class="voxchat-container font-Figtree bg-color-F6 dark:bg-color-29 text-color-14 dark:text-white" dir="rtl">
    
    {{-- Sidebar - Conversation History --}}
    <aside class="voxchat-sidebar bg-white dark:bg-color-3A" id="sidebar">
        {{-- New Chat Button --}}
        <div class="p-4 border-b border-color-DF dark:border-color-47 mt-48" style="margin-top: 180px;">
            <button onclick="startNewChat()" 
                    class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl magic-bg text-white font-semibold hover:opacity-90 transition-all shadow-lg shadow-purple-500/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                {{ __('محادثة جديدة') }}
            </button>
        </div>
        
        {{-- Conversation List --}}
        <div class="flex-1 overflow-y-auto p-3" id="conversation-list">
            <div class="conversations-container">
                @foreach($conversations as $conv)
                <div class="conversation-item" data-id="{{ $conv->id }}" onclick="loadConversation({{ $conv->id }})">
                    <div class="conversation-icon">
                        <svg class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <div class="conversation-info">
                        <p class="conversation-title">{{ $conv->display_title }}</p>
                        <p class="conversation-time">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $conv->updated_at->diffForHumans() }}
                        </p>
                    </div>
                    <button class="conversation-delete" onclick="event.stopPropagation(); deleteConversation({{ $conv->id }})" title="{{ __('حذف') }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </aside>
    
    {{-- Main Chat Area --}}
    <main class="voxchat-main">
        {{-- Header --}}
        <header class="flex items-center justify-between px-6 py-4 border-b border-color-DF dark:border-color-47 bg-white dark:bg-color-3A">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="p-2 rounded-lg hover:bg-color-F6 dark:hover:bg-color-29 transition-colors lg:hidden">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-[#7c3aed] to-[#a855f7] flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-bold text-lg" id="chat-title">VoxChat</h1>
                    <p class="text-xs text-color-89 dark:text-color-DF flex items-center gap-1">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        {{ __('متصل') }}
                    </p>
                </div>
            </div>
            
            <div class="flex items-center gap-2">
                {{-- Camera Button --}}
                <button onclick="toggleCamera()" 
                        class="p-2.5 rounded-xl hover:bg-color-F6 dark:hover:bg-color-29 transition-colors text-color-89 hover:text-purple-600"
                        title="{{ __('فتح الكاميرا') }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </button>
                
                {{-- Screen Share Button --}}
                <button onclick="toggleScreenShare()" 
                        class="p-2.5 rounded-xl hover:bg-color-F6 dark:hover:bg-color-29 transition-colors text-color-89 hover:text-purple-600"
                        title="{{ __('مشاركة الشاشة') }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </button>
            </div>
        </header>
        
        {{-- Messages Area --}}
        <div class="messages-container" id="messages-container">
            {{-- Welcome Screen (shown when no conversation) --}}
            <div class="welcome-screen" id="welcome-screen">
                <div class="welcome-logo">
                    <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                
                <h2 class="text-2xl font-bold mb-2">{{ __('مرحباً بك في VoxChat') }} 👋</h2>
                <p class="text-color-89 dark:text-color-DF mb-8 max-w-md">
                    {{ __('أنا مساعدك الذكي في VoxCraft. اسألني أي شيء عن خدماتنا أو كيفية استخدام المنصة!') }}
                </p>
                
                {{-- Quick Suggestions --}}
                <div class="suggestions-grid w-full max-w-2xl" id="suggestions">
                    <button class="suggestion-btn" onclick="sendSuggestion('كيف أنشئ إعلان صوتي؟')">
                        <span class="text-2xl">🎙️</span>
                        <span>{{ __('كيف أنشئ إعلان صوتي؟') }}</span>
                    </button>
                    <button class="suggestion-btn" onclick="sendSuggestion('أريد إنشاء بودكاست')">
                        <span class="text-2xl">🎧</span>
                        <span>{{ __('أريد إنشاء بودكاست') }}</span>
                    </button>
                    <button class="suggestion-btn" onclick="sendSuggestion('كيف أولد صورة بالذكاء الاصطناعي؟')">
                        <span class="text-2xl">🎨</span>
                        <span>{{ __('كيف أولد صورة؟') }}</span>
                    </button>
                    <button class="suggestion-btn" onclick="sendSuggestion('ما هي خدمات VoxCraft؟')">
                        <span class="text-2xl">🚀</span>
                        <span>{{ __('ما هي خدمات VoxCraft؟') }}</span>
                    </button>
                </div>
            </div>
            
            {{-- Messages will be inserted here --}}
            <div id="messages-list" class="hidden"></div>
        </div>
        
        {{-- Typing Indicator - Outside messages container --}}
        <div class="typing-indicator hidden px-6 pb-2" id="typing-indicator">
            <div class="flex items-center gap-2 text-purple-500">
                <div class="typing-dots">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
                <span class="text-sm">{{ __('VoxAI يكتب...') }}</span>
            </div>
        </div>
        
        {{-- Input Area --}}
        <div class="input-area bg-white dark:bg-color-3A">
            <div class="input-wrapper">
                <textarea 
                    id="message-input"
                    class="message-input"
                    placeholder="{{ __('اكتب رسالتك هنا...') }}"
                    rows="1"
                    onkeydown="handleKeyDown(event)"
                    oninput="autoResize(this)"
                ></textarea>
                
                {{-- Attachment Button --}}
                <button class="p-2 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors text-color-89 hover:text-purple-600">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                    </svg>
                </button>
                
                {{-- Voice Button --}}
                <button class="p-2 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors text-color-89 hover:text-purple-600" title="{{ __('رسالة صوتية') }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                    </svg>
                </button>
                
                {{-- Voice Call Button --}}
                <button class="call-btn" id="call-btn" onclick="toggleVoiceCall()" title="{{ __('اتصال صوتي') }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </button>
                
                {{-- Send Button --}}
                <button class="send-btn" id="send-btn" onclick="sendMessage()" disabled>
                    <svg class="w-5 h-5 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </div>
        </div>
    </main>
</div>

{{-- Voice Call Modal --}}
<div class="call-modal" id="call-modal">
    <div class="call-modal-content">
        {{-- Call Status --}}
        <div class="call-status">
            <div class="call-status-dot"></div>
            <span class="call-status-text">{{ __('متصل') }}</span>
        </div>
        
        {{-- Audio Visualizer --}}
        <div class="audio-visualizer" id="audio-visualizer">
            <div class="audio-bar"></div>
            <div class="audio-bar"></div>
            <div class="audio-bar"></div>
            <div class="audio-bar"></div>
            <div class="audio-bar"></div>
        </div>
        
        {{-- Timer --}}
        <div class="call-timer" id="call-timer">00:00</div>
        
        {{-- Divider --}}
        <div class="w-px h-10 bg-white/20"></div>
        
        {{-- Video Button --}}
        <button class="call-control-btn video-btn" id="video-toggle-btn" onclick="toggleVideoCall()" title="{{ __('تفعيل الفيديو') }}">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
        </button>
        
        {{-- Screen Share Button --}}
        <button class="call-control-btn screen-btn" id="screen-toggle-btn" onclick="toggleScreenInCall()" title="{{ __('مشاركة الشاشة') }}">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </button>
        
        {{-- End Call Button --}}
        <button class="call-control-btn end-call" onclick="endVoiceCall()" title="{{ __('إنهاء المكالمة') }}">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z"/>
            </svg>
        </button>
    </div>
</div>

{{-- Video Preview Modal --}}
<div id="video-preview-modal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-[200]">
    <div class="relative bg-gray-900 rounded-2xl overflow-hidden max-w-4xl w-full mx-4">
        <video id="video-preview" autoplay playsinline class="w-full aspect-video bg-black"></video>
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-3">
            <button onclick="closeVideoPreview()" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-full font-semibold transition-colors">
                {{ __('إغلاق') }}
            </button>
        </div>
    </div>
</div>

{{-- Camera/Screen Share Modal --}}
<div id="media-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-color-3A rounded-2xl p-6 max-w-2xl w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold" id="media-modal-title">{{ __('الكاميرا') }}</h3>
            <button onclick="closeMediaModal()" class="p-2 rounded-lg hover:bg-color-F6 dark:hover:bg-color-29">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <video id="media-video" autoplay playsinline class="w-full rounded-xl bg-black"></video>
    </div>
</div>
@endsection

@push('scripts')
<script>
// VoxChat JavaScript
let currentConversationId = null;
let isLoading = false;

const messagesContainer = document.getElementById('messages-container');
const messagesList = document.getElementById('messages-list');
const welcomeScreen = document.getElementById('welcome-screen');
const messageInput = document.getElementById('message-input');
const sendBtn = document.getElementById('send-btn');
const typingIndicator = document.getElementById('typing-indicator');

// Enable/disable send button based on input
messageInput.addEventListener('input', function() {
    sendBtn.disabled = this.value.trim() === '';
});

// Auto-resize textarea
function autoResize(el) {
    el.style.height = 'auto';
    el.style.height = Math.min(el.scrollHeight, 150) + 'px';
}

// Handle Enter key
function handleKeyDown(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        if (!sendBtn.disabled) {
            sendMessage();
        }
    }
}

// Send message
async function sendMessage() {
    const message = messageInput.value.trim();
    if (!message || isLoading) return;
    
    isLoading = true;
    sendBtn.disabled = true;
    
    // Hide welcome screen, show messages
    welcomeScreen.classList.add('hidden');
    messagesList.classList.remove('hidden');
    
    // Add user message
    addMessage('user', message);
    messageInput.value = '';
    messageInput.style.height = 'auto';
    
    // Show typing indicator
    typingIndicator.classList.remove('hidden');
    scrollToBottom();
    
    try {
        const response = await fetch('{{ route("user.voxchat.send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                message: message,
                conversation_id: currentConversationId,
            }),
        });
        
        const data = await response.json();
        
        typingIndicator.classList.add('hidden');
        
        if (data.success) {
            currentConversationId = data.conversation_id;
            
            // Add assistant message with typewriter effect
            addMessageWithTypewriter('assistant', data.assistant_message.content);
        } else {
            addMessage('assistant', data.error || 'حدث خطأ. حاول مرة أخرى.');
        }
        
    } catch (error) {
        console.error('Error:', error);
        typingIndicator.classList.add('hidden');
        addMessage('assistant', 'حدث خطأ في الاتصال. حاول مرة أخرى.');
    }
    
    isLoading = false;
}

// Copy to clipboard
function copyToClipboard(text, btn) {
    navigator.clipboard.writeText(text).then(() => {
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        setTimeout(() => {
            btn.innerHTML = originalHTML;
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy:', err);
    });
}

// Add message to chat
function addMessage(role, content) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message-bubble message-${role}`;
    
    const avatar = role === 'user' 
        ? '<div class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-sm flex-shrink-0">👤</div>'
        : '<div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#7c3aed] to-[#a855f7] flex items-center justify-center text-white text-sm flex-shrink-0">🤖</div>';
    
    const copyBtn = role === 'assistant' ? `
        <button class="copy-btn absolute top-2 left-2 opacity-0 group-hover:opacity-100 transition-opacity p-1.5 rounded-lg hover:bg-black/5 dark:hover:bg-white/10 text-gray-500 dark:text-gray-400" title="{{ __('نسخ') }}">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
        </button>
    ` : '';

    messageDiv.innerHTML = `
        <div class="flex items-start gap-3 w-full ${role === 'user' ? 'flex-row-reverse' : ''}">
            ${avatar}
            <div class="message-content flex-1 min-w-0 relative group">
                ${copyBtn}
                <div class="content-text">${formatContent(content)}</div>
            </div>
        </div>
    `;
    
    messagesList.appendChild(messageDiv);
    
    if (role === 'assistant') {
        const btn = messageDiv.querySelector('.copy-btn');
        if (btn) {
            btn.addEventListener('click', () => copyToClipboard(content, btn));
        }
    }
    
    scrollToBottom();
}

// Add message with typewriter effect
function addMessageWithTypewriter(role, content) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message-bubble message-${role}`;
    
    const copyBtn = `
        <button class="copy-btn absolute top-2 left-2 opacity-0 group-hover:opacity-100 transition-opacity p-1.5 rounded-lg hover:bg-black/5 dark:hover:bg-white/10 text-gray-500 dark:text-gray-400" title="{{ __('نسخ') }}">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
        </button>
    `;

    messageDiv.innerHTML = `
        <div class="flex items-start gap-3 w-full">
            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#7c3aed] to-[#a855f7] flex items-center justify-center text-white text-sm flex-shrink-0">🤖</div>
            <div class="message-content flex-1 min-w-0 relative group">
                ${copyBtn}
                <div><span id="typewriter-text"></span><span class="typewriter-cursor"></span></div>
            </div>
        </div>
    `;
    
    messagesList.appendChild(messageDiv);
    
    const btn = messageDiv.querySelector('.copy-btn');
    if (btn) {
        btn.addEventListener('click', () => copyToClipboard(content, btn));
    }
    
    const textSpan = messageDiv.querySelector('#typewriter-text');
    const cursor = messageDiv.querySelector('.typewriter-cursor');
    
    let index = 0;
    const speed = 15; // ms per character
    
    function type() {
        if (index < content.length) {
            textSpan.innerHTML = formatContent(content.substring(0, index + 1));
            index++;
            scrollToBottom();
            setTimeout(type, speed);
        } else {
            cursor.remove();
        }
    }
    
    type();
}

// Format content (basic markdown)
function formatContent(content) {
    // Handle lists first (before line breaks)
    const lines = content.split('\n');
    let inUnorderedList = false;
    let inOrderedList = false;
    let formattedLines = [];
    
    for (let line of lines) {
        const trimmedLine = line.trim();
        
        // Check for numbered list items (1. item, 2. item, etc)
        if (trimmedLine.match(/^\d+\.\s+/)) {
            if (inUnorderedList) {
                formattedLines.push('</ul>');
                inUnorderedList = false;
            }
            if (!inOrderedList) {
                formattedLines.push('<ol class="list-decimal pr-5 my-2 space-y-1">');
                inOrderedList = true;
            }
            const listContent = trimmedLine.replace(/^\d+\.\s+/, '');
            formattedLines.push(`<li class="mb-1">${listContent}</li>`);
        }
        // Check for unordered list items (- item or • item or * item)
        else if (trimmedLine.match(/^[-•*]\s+/)) {
            if (inOrderedList) {
                formattedLines.push('</ol>');
                inOrderedList = false;
            }
            if (!inUnorderedList) {
                formattedLines.push('<ul class="list-disc pr-5 my-2 space-y-1">');
                inUnorderedList = true;
            }
            const listContent = trimmedLine.replace(/^[-•*]\s+/, '');
            formattedLines.push(`<li class="mb-1">${listContent}</li>`);
        } else {
            // Close any open lists
            if (inUnorderedList) {
                formattedLines.push('</ul>');
                inUnorderedList = false;
            }
            if (inOrderedList) {
                formattedLines.push('</ol>');
                inOrderedList = false;
            }
            formattedLines.push(line);
        }
    }
    
    // Close any remaining open lists
    if (inUnorderedList) formattedLines.push('</ul>');
    if (inOrderedList) formattedLines.push('</ol>');
    
    content = formattedLines.join('\n');
    
    // Bold text
    content = content.replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold">$1</strong>');
    // Headers (## Header or ### Header)
    content = content.replace(/^###\s+(.*)$/gm, '<h4 class="font-bold text-base mt-3 mb-1">$1</h4>');
    content = content.replace(/^##\s+(.*)$/gm, '<h3 class="font-bold text-lg mt-3 mb-2">$1</h3>');
    // Section headers with colons (Laravel: or Python:)
    content = content.replace(/^(\d+\.\s*)?([A-Za-z\u0600-\u06FF]+):\s*$/gm, '<p class="font-bold mt-3 mb-1 text-purple-400">$1$2:</p>');
    // Emojis with headers
    content = content.replace(/^([🎙️🎧🖼️✍️📝💡🎯🔊📻💬🤖📸🎨🚀⚡]+)\s*(.+):$/gm, '<p class="font-bold mt-3 mb-1">$1 $2:</p>');
    // Line breaks (but not inside list elements)
    content = content.replace(/\n(?!<)/g, '<br>');
    // Clean up extra breaks before/after list elements
    content = content.replace(/<br>(<ul|<ol|<\/ul|<\/ol|<li|<\/li|<h3|<h4|<p class="font-bold)/g, '$1');
    content = content.replace(/(<\/ul>|<\/ol>|<\/li>)<br>/g, '$1');
    
    return content;
}

// Scroll to bottom
function scrollToBottom() {
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// Send suggestion
function sendSuggestion(text) {
    messageInput.value = text;
    sendBtn.disabled = false;
    sendMessage();
}

// Start new chat
function startNewChat() {
    currentConversationId = null;
    messagesList.innerHTML = '';
    messagesList.classList.add('hidden');
    welcomeScreen.classList.remove('hidden');
    document.getElementById('chat-title').textContent = 'VoxChat';
}

// Load conversation
async function loadConversation(id) {
    try {
        const response = await fetch(`{{ url('user/voxchat/conversation') }}/${id}`);
        const data = await response.json();
        
        if (data.success) {
            currentConversationId = id;
            document.getElementById('chat-title').textContent = data.conversation.title;
            
            welcomeScreen.classList.add('hidden');
            messagesList.classList.remove('hidden');
            messagesList.innerHTML = '';
            
            data.conversation.messages.forEach(msg => {
                addMessage(msg.role, msg.content);
            });
            
            // Update active state
            document.querySelectorAll('.conversation-item').forEach(el => {
                el.classList.remove('active');
            });
            document.querySelector(`[data-id="${id}"]`)?.classList.add('active');
        }
    } catch (error) {
        console.error('Error loading conversation:', error);
    }
}

// Delete conversation
async function deleteConversation(id) {
    if (!confirm('{{ __("هل أنت متأكد من حذف هذه المحادثة؟") }}')) {
        return;
    }
    
    try {
        const response = await fetch(`{{ url('user/voxchat/conversation') }}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Remove from list
            const item = document.querySelector(`.conversation-item[data-id="${id}"]`);
            if (item) {
                item.style.animation = 'fadeOut 0.3s ease';
                setTimeout(() => item.remove(), 300);
            }
            
            // If current conversation is deleted, start new chat
            if (currentConversationId === id) {
                startNewChat();
            }
        }
    } catch (error) {
        console.error('Error deleting conversation:', error);
    }
}

// Toggle sidebar
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('collapsed');
}

// Camera toggle
let mediaStream = null;

async function toggleCamera() {
    const modal = document.getElementById('media-modal');
    const video = document.getElementById('media-video');
    const title = document.getElementById('media-modal-title');
    
    if (mediaStream) {
        closeMediaModal();
        return;
    }
    
    try {
        mediaStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        video.srcObject = mediaStream;
        title.textContent = '{{ __("الكاميرا") }}';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    } catch (error) {
        alert('{{ __("لم نتمكن من الوصول للكاميرا") }}');
    }
}

// Screen share
async function toggleScreenShare() {
    const modal = document.getElementById('media-modal');
    const video = document.getElementById('media-video');
    const title = document.getElementById('media-modal-title');
    
    if (mediaStream) {
        closeMediaModal();
        return;
    }
    
    try {
        mediaStream = await navigator.mediaDevices.getDisplayMedia({ video: true });
        video.srcObject = mediaStream;
        title.textContent = '{{ __("مشاركة الشاشة") }}';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        mediaStream.getVideoTracks()[0].onended = closeMediaModal;
    } catch (error) {
        console.log('Screen share cancelled');
    }
}

function closeMediaModal() {
    const modal = document.getElementById('media-modal');
    const video = document.getElementById('media-video');
    
    if (mediaStream) {
        mediaStream.getTracks().forEach(track => track.stop());
        mediaStream = null;
    }
    
    video.srcObject = null;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// ==========================================
// Voice Call Functions - OpenAI Realtime WebRTC
// ==========================================
let isInCall = false;
let callTimer = null;
let callSeconds = 0;
let callMediaStream = null;
let isVideoOn = false;
let isScreenSharing = false;
let peerConnection = null;
let dataChannel = null;
let audioElement = null;
let videoStream = null;
let visionInterval = null; // Interval to send camera frames to AI

function toggleVoiceCall() {
    if (isInCall) {
        endVoiceCall();
    } else {
        startVoiceCall();
    }
}

async function startVoiceCall() {
    const callBtn = document.getElementById('call-btn');
    const callModal = document.getElementById('call-modal');
    
    try {
        // Show loading state
        callBtn.disabled = true;
        addSystemMessage('{{ __("جاري الاتصال...") }}');
        
        // Step 1: Get ephemeral token from our server
        const tokenResponse = await fetch('{{ route("user.voxchat.realtime.session") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ voice: 'alloy' }),
        });
        
        const tokenData = await tokenResponse.json();
        
        if (!tokenData.success) {
            throw new Error(tokenData.error || 'فشل الحصول على جلسة المحادثة');
        }
        
        const ephemeralKey = tokenData.client_secret;
        
        // Step 2: Create WebRTC peer connection
        peerConnection = new RTCPeerConnection();
        
        // Step 3: Setup audio playback
        audioElement = document.createElement('audio');
        audioElement.autoplay = true;
        audioElement.volume = 1.0;
        
        peerConnection.ontrack = (event) => {
            console.log('Received audio track from OpenAI');
            audioElement.srcObject = event.streams[0];
        };
        
        // Step 4: Get microphone and add to connection
        callMediaStream = await navigator.mediaDevices.getUserMedia({ audio: true });
        callMediaStream.getTracks().forEach(track => {
            peerConnection.addTrack(track, callMediaStream);
        });
        
        // Step 5: Setup data channel for events
        dataChannel = peerConnection.createDataChannel('oai-events');
        
        dataChannel.onopen = () => {
            console.log('Data channel opened - connection ready');
        };
        
        dataChannel.onmessage = (event) => {
            handleRealtimeEvent(JSON.parse(event.data));
        };
        
        // Step 6: Create and send offer to OpenAI
        const offer = await peerConnection.createOffer();
        await peerConnection.setLocalDescription(offer);
        
        const sdpResponse = await fetch('https://api.openai.com/v1/realtime?model=gpt-4o-mini-realtime-preview-2024-12-17', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${ephemeralKey}`,
                'Content-Type': 'application/sdp',
            },
            body: offer.sdp,
        });
        
        if (!sdpResponse.ok) {
            throw new Error('فشل الاتصال بخدمة الصوت');
        }
        
        const answerSdp = await sdpResponse.text();
        await peerConnection.setRemoteDescription({
            type: 'answer',
            sdp: answerSdp,
        });
        
        // Connection established!
        isInCall = true;
        callBtn.classList.add('active');
        callBtn.disabled = false;
        callModal.classList.add('active');
        
        // Start timer
        callSeconds = 0;
        updateCallTimer();
        callTimer = setInterval(updateCallTimer, 1000);
        
        // Hide welcome screen
        if (welcomeScreen && !welcomeScreen.classList.contains('hidden')) {
            welcomeScreen.classList.add('hidden');
            messagesList.classList.remove('hidden');
        }
        
        addSystemMessage('{{ __("تم الاتصال! تحدث الآن...") }}');
        
    } catch (error) {
        console.error('Voice call error:', error);
        callBtn.disabled = false;
        addSystemMessage('{{ __("خطأ: ") }}' + error.message);
        endVoiceCall();
    }
}

function handleRealtimeEvent(event) {
    console.log('Realtime event:', event.type, event);
    
    switch (event.type) {
        case 'conversation.item.input_audio_transcription.completed':
            // User's speech was transcribed
            if (event.transcript) {
                addMessage('user', event.transcript);
            }
            break;
            
        case 'response.audio_transcript.done':
            // AI's response transcript
            if (event.transcript) {
                addMessage('assistant', event.transcript);
            }
            break;
            
        case 'response.done':
            // AI finished responding
            console.log('AI response complete');
            break;
            
        case 'input_audio_buffer.speech_started':
            console.log('User started speaking');
            updateAudioVisualizer(80); // Show activity
            break;
            
        case 'input_audio_buffer.speech_stopped':
            console.log('User stopped speaking');
            updateAudioVisualizer(10);
            break;
            
        case 'error':
            console.error('Realtime error:', event.error);
            addSystemMessage('{{ __("خطأ: ") }}' + (event.error?.message || 'حدث خطأ'));
            break;
    }
}

// Capture frame from video and send to AI
function captureAndSendFrame() {
    if ((!isVideoOn && !isScreenSharing) || !videoStream || !dataChannel || dataChannel.readyState !== 'open') {
        return;
    }
    
    const video = document.getElementById('video-preview');
    if (!video || video.readyState < 2) return; // Video not ready
    
    // Create canvas to capture frame
    const canvas = document.createElement('canvas');
    canvas.width = 512; // Smaller size for faster processing
    canvas.height = 384;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    
    // Convert to base64 data URL
    const imageDataUrl = canvas.toDataURL('image/jpeg', 0.7);
    
    // Send image to AI via data channel using correct format
    const event = {
        type: 'conversation.item.create',
        item: {
            type: 'message',
            role: 'user',
            content: [
                {
                    type: 'input_image',
                    image_url: imageDataUrl, // Full data URL format
                }
            ]
        }
    };
    
    try {
        dataChannel.send(JSON.stringify(event));
        console.log('Sent camera frame to AI');
    } catch (e) {
        console.error('Failed to send frame:', e);
    }
}

// Start sending camera frames to AI periodically
// NOTE: OpenAI Realtime API does not support images yet
// Vision mode is disabled until OpenAI adds support
function startVisionMode() {
    // Vision not supported in Realtime API yet
    addSystemMessage('{{ __("الكاميرا مفعلة - يمكنك أن تصف ما تراه للذكاء الاصطناعي بصوتك 🎤") }}');
    // Disabled: Image sending not supported
    // if (visionInterval) {
    //     clearInterval(visionInterval);
    // }
    // visionInterval = setInterval(captureAndSendFrame, 3000);
    // setTimeout(captureAndSendFrame, 500);
}

// Stop sending camera frames
function stopVisionMode() {
    if (visionInterval) {
        clearInterval(visionInterval);
        visionInterval = null;
    }
}

function endVoiceCall() {
    const callBtn = document.getElementById('call-btn');
    const callModal = document.getElementById('call-modal');
    const videoBtn = document.getElementById('video-toggle-btn');
    const screenBtn = document.getElementById('screen-toggle-btn');
    
    // Stop vision mode
    stopVisionMode();
    
    // Stop video stream
    if (videoStream) {
        videoStream.getTracks().forEach(track => track.stop());
        videoStream = null;
    }
    
    // Close data channel
    if (dataChannel) {
        dataChannel.close();
        dataChannel = null;
    }
    
    // Close peer connection
    if (peerConnection) {
        peerConnection.close();
        peerConnection = null;
    }
    
    // Stop audio element
    if (audioElement) {
        audioElement.srcObject = null;
        audioElement = null;
    }
    
    isInCall = false;
    isVideoOn = false;
    isScreenSharing = false;
    
    callBtn.classList.remove('active');
    callBtn.disabled = false;
    callModal.classList.remove('active');
    videoBtn.classList.remove('active');
    screenBtn.classList.remove('active');
    
    // Stop timer
    if (callTimer) {
        clearInterval(callTimer);
        callTimer = null;
    }
    
    // Stop all media streams
    if (callMediaStream) {
        callMediaStream.getTracks().forEach(track => track.stop());
        callMediaStream = null;
    }
    
    // Close video preview if open
    closeVideoPreview();
    
    // Add system message with call duration
    if (!messagesList.classList.contains('hidden') && callSeconds > 0) {
        const duration = formatTime(callSeconds);
        addSystemMessage(`{{ __("انتهى الاتصال") }} - ${duration}`);
    }
    
    callSeconds = 0;
    document.getElementById('call-timer').textContent = '00:00';
}

function updateAudioVisualizer(volume) {
    const bars = document.querySelectorAll('#audio-visualizer .audio-bar');
    const normalizedVolume = Math.min(volume / 100, 1);
    
    bars.forEach((bar, index) => {
        const baseHeight = [30, 60, 100, 60, 30][index];
        const height = baseHeight * (0.3 + normalizedVolume * 0.7);
        bar.style.height = `${height}%`;
    });
}

function updateCallTimer() {
    callSeconds++;
    document.getElementById('call-timer').textContent = formatTime(callSeconds);
}

function formatTime(seconds) {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}

async function toggleVideoCall() {
    const videoBtn = document.getElementById('video-toggle-btn');
    const previewModal = document.getElementById('video-preview-modal');
    const previewVideo = document.getElementById('video-preview');
    
    if (!isInCall) return;
    
    if (isVideoOn) {
        // Turn off video
        isVideoOn = false;
        videoBtn.classList.remove('active');
        stopVisionMode(); // Stop sending frames to AI
        closeVideoPreview();
        
        // Stop video stream
        if (videoStream) {
            videoStream.getTracks().forEach(track => track.stop());
            videoStream = null;
        }
        addSystemMessage('{{ __("تم إيقاف الكاميرا") }}');
    } else {
        try {
            // Turn on video
            videoStream = await navigator.mediaDevices.getUserMedia({ 
                video: { 
                    width: { ideal: 640 },
                    height: { ideal: 480 },
                    facingMode: 'user'
                }, 
                audio: false 
            });
            
            previewVideo.srcObject = videoStream;
            previewModal.classList.remove('hidden');
            previewModal.classList.add('flex');
            
            isVideoOn = true;
            videoBtn.classList.add('active');
            
            // Start sending frames to AI
            startVisionMode();
            
            // If screen sharing is on, turn it off
            if (isScreenSharing) {
                isScreenSharing = false;
                document.getElementById('screen-toggle-btn').classList.remove('active');
            }
            
        } catch (error) {
            console.error('Camera access denied:', error);
            alert('{{ __("لم نتمكن من الوصول للكاميرا") }}');
        }
    }
}

async function toggleScreenInCall() {
    const screenBtn = document.getElementById('screen-toggle-btn');
    const previewModal = document.getElementById('video-preview-modal');
    const previewVideo = document.getElementById('video-preview');
    
    if (!isInCall) return;
    
    if (isScreenSharing) {
        // Turn off screen sharing
        isScreenSharing = false;
        screenBtn.classList.remove('active');
        stopVisionMode(); // Stop sending frames to AI
        closeVideoPreview();
        
        if (videoStream) {
            videoStream.getTracks().forEach(track => track.stop());
            videoStream = null;
        }
        addSystemMessage('{{ __("تم إيقاف مشاركة الشاشة") }}');
    } else {
        try {
            // Turn on screen sharing
            videoStream = await navigator.mediaDevices.getDisplayMedia({ video: true });
            
            previewVideo.srcObject = videoStream;
            previewModal.classList.remove('hidden');
            previewModal.classList.add('flex');
            
            isScreenSharing = true;
            screenBtn.classList.add('active');
            
            // Start sending frames to AI
            startVisionMode();
            
            // If video is on, turn it off
            if (isVideoOn) {
                isVideoOn = false;
                document.getElementById('video-toggle-btn').classList.remove('active');
            }
            
            // Handle when user stops sharing from browser UI
            videoStream.getVideoTracks()[0].onended = () => {
                isScreenSharing = false;
                screenBtn.classList.remove('active');
                stopVisionMode();
                closeVideoPreview();
                addSystemMessage('{{ __("تم إيقاف مشاركة الشاشة") }}');
            };
            
        } catch (error) {
            console.log('Screen share cancelled');
        }
    }
}

function closeVideoPreview() {
    const previewModal = document.getElementById('video-preview-modal');
    const previewVideo = document.getElementById('video-preview');
    
    if (previewVideo.srcObject) {
        previewVideo.srcObject.getTracks().forEach(track => track.stop());
        previewVideo.srcObject = null;
    }
    
    previewModal.classList.add('hidden');
    previewModal.classList.remove('flex');
    
    // Reset button states
    if (!isVideoOn) {
        document.getElementById('video-toggle-btn')?.classList.remove('active');
    }
    if (!isScreenSharing) {
        document.getElementById('screen-toggle-btn')?.classList.remove('active');
    }
}

function addSystemMessage(text) {
    const messageDiv = document.createElement('div');
    messageDiv.className = 'text-center py-2';
    messageDiv.innerHTML = `
        <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-full text-sm text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            ${text}
        </span>
    `;
    messagesList.appendChild(messageDiv);
    scrollToBottom();
}

function addProcessingMessage(id) {
    const messageDiv = document.createElement('div');
    messageDiv.id = id;
    messageDiv.className = 'text-center py-3 processing-message';
    messageDiv.innerHTML = `
        <span class="inline-flex items-center gap-3 px-5 py-3 bg-gradient-to-r from-purple-500/20 to-violet-500/20 border border-purple-500/30 rounded-full text-sm text-purple-300">
            <div class="flex gap-1">
                <span class="w-2 h-2 bg-purple-400 rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                <span class="w-2 h-2 bg-purple-400 rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                <span class="w-2 h-2 bg-purple-400 rounded-full animate-bounce" style="animation-delay: 300ms"></span>
            </div>
            <span>{{ __("جاري تحليل صوتك والتفكير في الرد...") }}</span>
        </span>
    `;
    messagesList.appendChild(messageDiv);
    scrollToBottom();
}

function removeProcessingMessage(id) {
    const element = document.getElementById(id);
    if (element) {
        element.remove();
    }
}
</script>
@endpush
