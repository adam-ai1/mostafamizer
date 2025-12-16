@extends('layouts.user_master')
@section('page_title', $podcast->title ?? __('Podcast'))

@php
    $hostAName = $podcast->host_a_name ?? __('Host');
    $hostBName = $podcast->host_b_name ?? __('Hostess');
@endphp

@section('content')
<main class="w-full lg:pt-[88px] pt-20 px-4 lg:px-8 pb-12 overflow-hidden main-content flex flex-col h-screen font-Figtree bg-[#141414] text-white" dir="rtl">
    
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 mb-6 px-2">
        <a href="{{ route('user.podcast.index') }}" class="text-gray-400 hover:text-white text-sm transition-colors">
            {{ __('AI Duo Podcast') }}
        </a>
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-500 rotate-180">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
        <span class="text-white font-medium text-sm truncate max-w-[300px]">{{ $podcast->title ?? __('View Podcast') }}</span>
    </div>

    <div class="flex flex-col lg:flex-row gap-6 h-[calc(100vh-180px)]">
        
        {{-- Left Panel: Player Console (Sticky) --}}
        <div class="w-full lg:w-[450px] xl:w-[500px] flex-shrink-0 flex flex-col gap-4 h-full overflow-y-auto lg:overflow-visible">
            
            {{-- Main Player Card --}}
            <div class="bg-[#1c1c1c] border border-[#2a2a2a] rounded-3xl p-6 flex flex-col items-center text-center shadow-2xl relative overflow-hidden group">
                
                {{-- Background Glow --}}
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-32 bg-[#8b5cf6]/10 blur-3xl rounded-full pointer-events-none"></div>

                {{-- Status Badge --}}
                <div class="mb-8 relative z-10">
                    @if($podcast->status === 'completed')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 mr-2 animate-pulse"></span>
                        {{ __('Ready to Play') }}
                    </span>
                    @elseif($podcast->status === 'processing')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                        <svg class="animate-spin -ml-1 mr-2 h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ __('Generating Audio...') }}
                    </span>
                    @elseif($podcast->status === 'pending')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">
                        {{ __('In Queue') }}
                    </span>
                    @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20">
                        {{ __('Failed') }}
                    </span>
                    @endif
                </div>

                {{-- Visualizer / Avatars Section --}}
                <div class="flex items-center justify-center gap-4 sm:gap-6 mb-8 w-full px-2">
                    
                    {{-- Hostess (Female) --}}
                    <div id="avatar-host-b" class="relative w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-[#252525] border-2 border-[#2a2a2a] flex items-center justify-center transition-all duration-300 opacity-40 transform scale-90">
                        <div class="absolute inset-0 rounded-full bg-pink-500/20 blur-md opacity-0 transition-opacity duration-300" id="glow-host-b"></div>
                        {{-- Female Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#ec4899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                            <line x1="12" y1="19" x2="12" y2="23"></line>
                            <line x1="8" y1="23" x2="16" y2="23"></line>
                        </svg>
                        <span class="absolute -bottom-8 text-xs text-gray-400 font-medium whitespace-nowrap">{{ $hostBName }}</span>
                    </div>

                    {{-- Center Mic (Main) --}}
                    <div class="relative w-32 h-32 sm:w-40 sm:h-40 flex-shrink-0 z-10 mx-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#8b5cf6] to-[#6d28d9] rounded-full opacity-20 blur-xl animate-pulse"></div>
                        <div class="relative w-full h-full rounded-full bg-[#252525] border-4 border-[#2a2a2a] flex items-center justify-center overflow-hidden shadow-2xl">
                            <div class="absolute inset-0 flex items-center justify-center gap-1" id="audio-wave-circular">
                                @for($i = 0; $i < 8; $i++)
                                <div class="w-1.5 bg-[#8b5cf6] rounded-full audio-bar h-6 opacity-40"></div>
                                @endfor
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="relative z-10">
                                <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                                <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                                <line x1="12" y1="19" x2="12" y2="23"></line>
                                <line x1="8" y1="23" x2="16" y2="23"></line>
                            </svg>
                        </div>
                    </div>

                    {{-- Host (Male) --}}
                    <div id="avatar-host-a" class="relative w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-[#252525] border-2 border-[#2a2a2a] flex items-center justify-center transition-all duration-300 opacity-40 transform scale-90">
                        <div class="absolute inset-0 rounded-full bg-blue-500/20 blur-md opacity-0 transition-opacity duration-300" id="glow-host-a"></div>
                        {{-- Male Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                            <line x1="12" y1="19" x2="12" y2="23"></line>
                            <line x1="8" y1="23" x2="16" y2="23"></line>
                        </svg>
                        <span class="absolute -bottom-8 text-xs text-gray-400 font-medium whitespace-nowrap">{{ $hostAName }}</span>
                    </div>

                </div>

                {{-- Title --}}
                <h1 class="text-xl font-bold text-white mb-2 line-clamp-2 leading-tight mt-4">
                    {{ $podcast->title ?? $podcast->topic }}
                </h1>
                <p class="text-sm text-gray-400 mb-8 line-clamp-1">
                    {{ $podcast->topic }}
                </p>

                {{-- Player Controls --}}
                @if($podcast->isCompleted() && $podcast->audio_path)
                <div class="w-full space-y-4">
                    {{-- Progress --}}
                    <div class="w-full group/progress">
                        <div class="flex justify-between text-xs text-gray-500 mb-1 font-mono">
                            <span id="current-time">0:00</span>
                            <span id="total-duration">{{ $podcast->formatted_duration }}</span>
                        </div>
                        <div class="h-1.5 bg-[#333] rounded-full cursor-pointer overflow-hidden relative" id="progress-bar">
                            <div class="h-full bg-[#8b5cf6] rounded-full w-0 relative" id="progress">
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-3 h-3 bg-white rounded-full shadow-lg opacity-0 group-hover/progress:opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center justify-center gap-6">
                        <button class="text-gray-400 hover:text-white transition-colors p-2" id="rewind-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 17l-5-5 5-5M18 17l-5-5 5-5"/>
                            </svg>
                        </button>
                        
                        <button class="w-14 h-14 bg-white text-black rounded-full flex items-center justify-center hover:scale-105 hover:shadow-[0_0_20px_rgba(255,255,255,0.3)] transition-all duration-300" id="play-btn">
                            <svg id="play-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                <path d="M5 3l14 9-14 9V3z"/>
                            </svg>
                            <svg id="pause-icon" class="hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                <rect x="6" y="4" width="4" height="16"></rect>
                                <rect x="14" y="4" width="4" height="16"></rect>
                            </svg>
                        </button>
                        
                        <button class="text-gray-400 hover:text-white transition-colors p-2" id="forward-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M13 17l5-5-5-5M6 17l5-5-5-5"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Hidden Audio --}}
                @php
                    $audioUrl = asset('public/' . $podcast->audio_path);
                    $isWav = str_ends_with($podcast->audio_path, '.wav');
                    $mimeType = $isWav ? 'audio/wav' : 'audio/mpeg';
                @endphp
                <audio id="podcast-audio" class="hidden" preload="auto">
                    <source src="{{ $audioUrl }}" type="{{ $mimeType }}">
                    <source src="{{ asset($podcast->audio_path) }}" type="{{ $mimeType }}">
                </audio>
                @endif
            </div>

            {{-- Metadata Card --}}
            <div class="bg-[#1c1c1c] border border-[#2a2a2a] rounded-2xl p-5 flex justify-between items-center">
                <div class="text-center flex-1 border-r border-[#2a2a2a]">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">{{ __('Duration') }}</p>
                    <p class="text-white font-semibold">{{ $podcast->formatted_duration }}</p>
                </div>
                <div class="text-center flex-1 border-r border-[#2a2a2a]">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">{{ __('Words') }}</p>
                    <p class="text-white font-semibold">{{ number_format($podcast->word_count) }}</p>
                </div>
                <div class="text-center flex-1">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">{{ __('Created') }}</p>
                    <p class="text-white font-semibold">{{ $podcast->created_at->format('M d') }}</p>
                </div>
            </div>

            {{-- Actions --}}
            @if($podcast->isCompleted())
            <div class="grid grid-cols-2 gap-3 mt-auto">
                <a href="{{ route('user.podcast.create') }}" class="flex items-center justify-center gap-2 py-3 rounded-xl bg-[#2a2a2a] text-white font-medium text-sm hover:bg-[#333] transition-colors border border-[#333]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    {{ __('New Episode') }}
                </a>
                <button id="delete-btn" class="flex items-center justify-center gap-2 py-3 rounded-xl bg-red-500/10 text-red-500 font-medium text-sm hover:bg-red-500/20 transition-colors border border-red-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    {{ __('Delete') }}
                </button>
            </div>
            @endif
        </div>

        {{-- Right Panel: Transcript (Scrollable) --}}
        <div class="flex-1 bg-[#1c1c1c] border border-[#2a2a2a] rounded-3xl overflow-hidden flex flex-col shadow-xl">
            {{-- Header --}}
            <div class="p-6 border-b border-[#2a2a2a] flex justify-between items-center bg-[#1c1c1c] z-10">
                <h3 class="text-white font-bold text-lg flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    {{ __('Conversation Transcript') }}
                </h3>
                @if($podcast->isCompleted())
                <button id="copy-script-btn" class="text-gray-400 hover:text-white transition-colors p-2 rounded-lg hover:bg-[#2a2a2a]" title="{{ __('Copy Script') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                </button>
                @endif
            </div>

            {{-- Content --}}
            <div class="flex-1 overflow-y-auto p-6 space-y-6 custom-scrollbar" id="script-container">
                @if($podcast->isCompleted())
                    @php 
                        $parsedScript = $podcast->parsed_script; 
                        $hostAName = $podcast->host_a_name ?? __('Host');
                        $hostBName = $podcast->host_b_name ?? __('Hostess');
                    @endphp
                    @if(count($parsedScript) > 0)
                        @foreach($parsedScript as $index => $line)
                        <div class="flex gap-4 {{ $line['speaker'] === 'HOST A' ? '' : 'flex-row-reverse' }} group animate-fade-in" style="animation-delay: {{ $index * 50 }}ms">
                            {{-- Avatar --}}
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center shadow-lg {{ $line['speaker'] === 'HOST A' ? 'bg-gradient-to-br from-[#3b82f6] to-[#1d4ed8]' : 'bg-gradient-to-br from-[#ec4899] to-[#be185d]' }}">
                                    <span class="text-white text-xs font-bold">{{ $line['speaker'] === 'HOST A' ? mb_substr($hostAName, 0, 1) : mb_substr($hostBName, 0, 1) }}</span>
                                </div>
                            </div>
                            
                            {{-- Bubble --}}
                            <div class="flex-1 max-w-[85%]">
                                <div class="flex items-center gap-2 mb-1 {{ $line['speaker'] === 'HOST A' ? '' : 'flex-row-reverse' }}">
                                    <span class="text-xs font-bold {{ $line['speaker'] === 'HOST A' ? 'text-[#3b82f6]' : 'text-[#ec4899]' }}">
                                        {{ $line['speaker'] === 'HOST A' ? $hostAName : $hostBName }}
                                    </span>
                                </div>
                                <div class="p-4 rounded-2xl text-[15px] leading-relaxed shadow-sm {{ $line['speaker'] === 'HOST A' ? 'bg-[#252525] text-gray-200 rounded-tr-none' : 'bg-[#2a2a2a] text-gray-300 rounded-tl-none' }}">
                                    {{ $line['text'] }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="prose prose-invert max-w-none text-right">
                            {!! nl2br(e($podcast->script)) !!}
                        </div>
                    @endif
                @elseif($podcast->isFailed())
                    <div class="flex flex-col items-center justify-center h-full text-center opacity-50">
                        <p class="text-red-400">{{ $podcast->error_message }}</p>
                    </div>
                @else
                    {{-- Loading State --}}
                    <div class="flex flex-col items-center justify-center h-full space-y-4">
                        <div class="relative">
                            <div class="w-16 h-16 rounded-full border-4 border-[#2a2a2a] border-t-[#8b5cf6] animate-spin"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path></svg>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="text-white font-medium text-lg">{{ __('Crafting your episode...') }}</h3>
                            <p class="text-gray-500 text-sm mt-1">{{ __('Our AI hosts are reviewing the script') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #1c1c1c;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #333;
        border-radius: 3px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #444;
    }
    
    .audio-bar.playing {
        animation: audioWave 0.8s ease-in-out infinite;
    }
    
    @keyframes audioWave {
        0%, 100% { height: 8px; opacity: 0.4; }
        50% { height: 24px; opacity: 1; }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
    }

    /* Speaker Animation */
    .speaking-active {
        opacity: 1 !important;
        transform: scale(1.1) !important;
        box-shadow: 0 0 30px currentColor;
    }

    #avatar-host-a.speaking-active {
        border-color: #3b82f6;
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.4);
    }

    #avatar-host-b.speaking-active {
        border-color: #ec4899;
        box-shadow: 0 0 30px rgba(236, 72, 153, 0.4);
    }
</style>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const podcastId = "{{ techEncrypt($podcast->id) }}";
    const status = "{{ $podcast->status }}";
    const CSRF_TOKEN = '{{ csrf_token() }}';
    
    // Poll for status if processing or pending
    if (status === 'processing' || status === 'pending') {
        pollStatus();
    }

    async function pollStatus() {
        try {
            const response = await fetch(`{{ route('user.podcast.status', ['id' => ':id']) }}`.replace(':id', podcastId), {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                }
            });

            const data = await response.json();

            if (data.status === 'success') {
                if (data.podcast.status === 'completed' || data.podcast.status === 'failed') {
                    window.location.reload();
                } else {
                    setTimeout(pollStatus, 3000);
                }
            }
        } catch (error) {
            console.error('Polling error:', error);
            setTimeout(pollStatus, 5000);
        }
    }

    // Copy script functionality
    const copyBtn = document.getElementById('copy-script-btn');
    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            const script = @json($podcast->script ?? '');
            navigator.clipboard.writeText(script).then(() => {
                // Simple toast notification
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 animate-fade-in';
                toast.textContent = "{{ __('Script copied to clipboard') }}";
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 2000);
            });
        });
    }

    // Delete functionality
    const deleteBtn = document.getElementById('delete-btn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            if(confirm("{{ __('Are you sure you want to delete this episode?') }}")) {
                fetch("{{ route('user.podcast.delete') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                    },
                    body: JSON.stringify({ id: podcastId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.href = "{{ route('user.podcast.index') }}";
                    }
                });
            }
        });
    }

    // Audio Player functionality
    const audio = document.getElementById('podcast-audio');
    const playBtn = document.getElementById('play-btn');
    const playIcon = document.getElementById('play-icon');
    const pauseIcon = document.getElementById('pause-icon');
    const rewindBtn = document.getElementById('rewind-btn');
    const forwardBtn = document.getElementById('forward-btn');
    const progressBar = document.getElementById('progress-bar');
    const progress = document.getElementById('progress');
    const currentTimeEl = document.getElementById('current-time');
    const audioBars = document.querySelectorAll('.audio-bar');
    
    // Speaker Animation Logic
    const scriptData = @json($parsedScript ?? []);
    let scriptSegments = [];
    const wordsPerSecond = 2.5; // Avg speaking rate

    // Pre-calculate segments based on word count
    let currentSegTime = 0;
    scriptData.forEach(line => {
        const wordCount = line.text.split(' ').length;
        const duration = Math.max(2, wordCount / wordsPerSecond); // Min 2 seconds
        scriptSegments.push({
            speaker: line.speaker,
            start: currentSegTime,
            end: currentSegTime + duration
        });
        currentSegTime += duration;
    });

    if (audio && playBtn) {
        // Adjust segments when metadata is loaded to match actual duration
        audio.addEventListener('loadedmetadata', function() {
            if (audio.duration && currentSegTime > 0) {
                const scaleFactor = audio.duration / currentSegTime;
                scriptSegments = scriptSegments.map(seg => ({
                    speaker: seg.speaker,
                    start: seg.start * scaleFactor,
                    end: seg.end * scaleFactor
                }));
            }
        });

        playBtn.addEventListener('click', function() {
            if (audio.paused) {
                audio.play();
            } else {
                audio.pause();
            }
        });

        audio.addEventListener('play', function() {
            playIcon.classList.add('hidden');
            pauseIcon.classList.remove('hidden');
            audioBars.forEach(bar => bar.classList.add('playing'));
        });

        audio.addEventListener('pause', function() {
            playIcon.classList.remove('hidden');
            pauseIcon.classList.add('hidden');
            audioBars.forEach(bar => bar.classList.remove('playing'));
            
            // Remove active states
            document.getElementById('avatar-host-a').classList.remove('speaking-active');
            document.getElementById('avatar-host-b').classList.remove('speaking-active');
        });

        audio.addEventListener('timeupdate', function() {
            if (audio.duration) {
                const progressPercent = (audio.currentTime / audio.duration) * 100;
                if (progress) progress.style.width = progressPercent + '%';
                
                const minutes = Math.floor(audio.currentTime / 60);
                const seconds = Math.floor(audio.currentTime % 60);
                if (currentTimeEl) currentTimeEl.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

                // Update Speaker Animation
                const t = audio.currentTime;
                const activeSegment = scriptSegments.find(seg => t >= seg.start && t < seg.end);
                
                const hostA = document.getElementById('avatar-host-a');
                const hostB = document.getElementById('avatar-host-b');
                
                hostA.classList.remove('speaking-active');
                hostB.classList.remove('speaking-active');
                
                if (activeSegment) {
                    if (activeSegment.speaker === 'HOST A') {
                        hostA.classList.add('speaking-active');
                    } else {
                        hostB.classList.add('speaking-active');
                    }
                }
            }
        });

        if (progressBar) {
            progressBar.addEventListener('click', function(e) {
                const rect = progressBar.getBoundingClientRect();
                const clickX = e.clientX - rect.left;
                const width = rect.width;
                const percent = clickX / width;
                audio.currentTime = percent * audio.duration;
            });
        }

        if (rewindBtn) {
            rewindBtn.addEventListener('click', function() {
                audio.currentTime = Math.max(0, audio.currentTime - 10);
            });
        }

        if (forwardBtn) {
            forwardBtn.addEventListener('click', function() {
                audio.currentTime = Math.min(audio.duration, audio.currentTime + 10);
            });
        }

        audio.addEventListener('ended', function() {
            playIcon.classList.remove('hidden');
            pauseIcon.classList.add('hidden');
            audioBars.forEach(bar => bar.classList.remove('playing'));
            if (progress) progress.style.width = '0%';
            if (currentTimeEl) currentTimeEl.textContent = '0:00';
            
            document.getElementById('avatar-host-a').classList.remove('speaking-active');
            document.getElementById('avatar-host-b').classList.remove('speaking-active');
        });
    }
});
</script>
@endsection
