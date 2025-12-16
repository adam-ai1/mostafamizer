@extends('layouts.user_master')
@section('page_title', __('Audio Ad') . ' - ' . ($audioAd->title ?? __('View')))

@section('content')
<main class="w-full lg:pt-[88px] pt-20 px-4 lg:px-8 pb-12 main-content font-Figtree bg-color-F6 dark:bg-color-29 text-color-14 dark:text-white min-h-screen" dir="rtl">
    
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="mb-8">
            <a href="{{ route('user.audio-ads.index') }}" class="inline-flex items-center gap-2 text-color-89 dark:text-color-DF hover:text-purple-600 dark:hover:text-purple-400 transition-colors mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="rtl:rotate-180">
                    <path d="M19 12H5"></path>
                    <path d="M12 19l-7-7 7-7"></path>
                </svg>
                {{ __('Back to Audio Ads') }}
            </a>
        </div>

        {{-- Main Card --}}
        <div class="bg-white dark:bg-color-3A rounded-3xl border border-color-DF dark:border-color-47 overflow-hidden shadow-xl">
            
            {{-- Header Section with Gradient --}}
            <div class="relative bg-gradient-to-r from-[#7c3aed] via-[#8b5cf6] to-[#a855f7] p-8 text-white">
                {{-- Decorative Elements --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full blur-2xl -ml-24 -mb-24"></div>
                
                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                                    <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                                    <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white/70 text-sm mb-1">{{ __('Audio Advertisement') }}</p>
                                <h1 class="text-2xl font-bold">{{ $audioAd->title ?? __('Audio Ad') }}</h1>
                            </div>
                        </div>
                        
                        {{-- Status Badge --}}
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-white/20 backdrop-blur-sm">
                            @if($audioAd->status === 'completed')
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Ready') }}
                            @elseif($audioAd->status === 'processing')
                            <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ __('Processing') }}
                            @elseif($audioAd->status === 'failed')
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Failed') }}
                            @else
                            {{ $audioAd->getStatusLabel() }}
                            @endif
                        </span>
                    </div>

                    {{-- Quick Stats --}}
                    <div class="flex flex-wrap gap-4 mt-6">
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm">{{ $audioAd->target_duration }}{{ __('s') }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="text-sm">{{ $audioAd->voice_name }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm">{{ $platforms[$audioAd->target_platform] ?? $audioAd->target_platform }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm">{{ $audioAd->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Audio Player Section --}}
            @if($audioAd->isReady())
            <div class="p-8 border-b border-color-DF dark:border-color-47">
                <h3 class="font-semibold text-color-14 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ __('Listen to Your Ad') }}
                </h3>
                
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-2xl p-6">
                    <audio controls class="w-full" id="audio-player" preload="auto">
                        <source src="{{ route('user.audio-ads.stream', ['id' => techEncrypt($audioAd->id)]) }}" type="audio/mpeg">
                        {{ __('Your browser does not support the audio element.') }}
                    </audio>
                    
                    @if($audioAd->actual_duration)
                    <p class="text-sm text-color-89 dark:text-color-DF mt-3 text-center">
                        {{ __('Duration:') }} {{ $audioAd->getFormattedDuration() }}
                    </p>
                    @endif
                </div>

                {{-- Download Button --}}
                <div class="mt-4 flex justify-center">
                    <a href="{{ route('user.audio-ads.download', ['id' => techEncrypt($audioAd->id)]) }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold hover:from-green-600 hover:to-emerald-600 transition-all shadow-lg hover:shadow-green-500/25">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        {{ __('Download MP3') }}
                    </a>
                </div>
            </div>
            @elseif($audioAd->status === 'processing')
            <div class="p-8 border-b border-color-DF dark:border-color-47">
                <div class="text-center py-8">
                    <div class="w-16 h-16 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center mx-auto mb-4">
                        <svg class="animate-spin w-8 h-8 text-purple-500" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-color-14 dark:text-white mb-2">{{ __('Generating Your Audio Ad...') }}</h3>
                    <p class="text-color-89 dark:text-color-DF">{{ __('This usually takes 30-60 seconds. The page will refresh automatically.') }}</p>
                </div>
            </div>
            @elseif($audioAd->status === 'failed')
            <div class="p-8 border-b border-color-DF dark:border-color-47">
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-red-700 dark:text-red-400 mb-2">{{ __('Generation Failed') }}</h3>
                            <p class="text-red-600 dark:text-red-300 text-sm">{{ $audioAd->error_message ?? __('An unknown error occurred during generation.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Ad Details --}}
            <div class="p-8 space-y-6">
                {{-- Ad Text / Script --}}
                <div>
                    <h3 class="font-semibold text-color-14 dark:text-white mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        {{ __('Ad Script') }}
                    </h3>
                    <div class="bg-color-F6 dark:bg-color-29 rounded-xl p-5 border border-color-DF dark:border-color-47">
                        <p class="text-color-14 dark:text-white leading-relaxed whitespace-pre-wrap">{{ $audioAd->generated_script ?? $audioAd->ad_text }}</p>
                    </div>
                </div>

                {{-- Details Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Voice Info --}}
                    <div class="bg-color-F6 dark:bg-color-29 rounded-xl p-5 border border-color-DF dark:border-color-47">
                        <h4 class="text-sm font-medium text-color-89 dark:text-color-DF mb-3">{{ __('Voice') }}</h4>
                        <div class="flex items-center gap-3">
                            @php
                                $voiceInfo = $voices[$audioAd->voice_id] ?? null;
                            @endphp
                            <div class="w-12 h-12 rounded-full {{ ($voiceInfo['gender'] ?? 'male') === 'female' ? 'bg-pink-100 dark:bg-pink-900/30' : 'bg-blue-100 dark:bg-blue-900/30' }} flex items-center justify-center">
                                <svg class="w-6 h-6 {{ ($voiceInfo['gender'] ?? 'male') === 'female' ? 'text-pink-500' : 'text-blue-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-color-14 dark:text-white">{{ $audioAd->voice_name }}</p>
                                <p class="text-sm text-color-89 dark:text-color-DF">{{ $voiceInfo['description'] ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Style Info --}}
                    <div class="bg-color-F6 dark:bg-color-29 rounded-xl p-5 border border-color-DF dark:border-color-47">
                        <h4 class="text-sm font-medium text-color-89 dark:text-color-DF mb-3">{{ __('Ad Style') }}</h4>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-color-14 dark:text-white">{{ $styles[$audioAd->ad_style] ?? $audioAd->ad_style }}</p>
                                <p class="text-sm text-color-89 dark:text-color-DF">{{ __('Tone & Feel') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Platform Info --}}
                    <div class="bg-color-F6 dark:bg-color-29 rounded-xl p-5 border border-color-DF dark:border-color-47">
                        <h4 class="text-sm font-medium text-color-89 dark:text-color-DF mb-3">{{ __('Target Platform') }}</h4>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                @if($audioAd->target_platform === 'radio')
                                <svg class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                @elseif($audioAd->target_platform === 'youtube')
                                <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                @elseif($audioAd->target_platform === 'social_media')
                                <svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
                                @else
                                <svg class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/></svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-semibold text-color-14 dark:text-white">{{ $platforms[$audioAd->target_platform] ?? $audioAd->target_platform }}</p>
                                <p class="text-sm text-color-89 dark:text-color-DF">{{ __('Optimized for this platform') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Music Info --}}
                    <div class="bg-color-F6 dark:bg-color-29 rounded-xl p-5 border border-color-DF dark:border-color-47">
                        <h4 class="text-sm font-medium text-color-89 dark:text-color-DF mb-3">{{ __('Background Music') }}</h4>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center">
                                @if($audioAd->background_music === 'none')
                                <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/></svg>
                                @else
                                <svg class="w-6 h-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-semibold text-color-14 dark:text-white">{{ $musicOptions[$audioAd->background_music] ?? $audioAd->background_music }}</p>
                                @if($audioAd->background_music !== 'none')
                                <p class="text-sm text-color-89 dark:text-color-DF">{{ __('Volume:') }} {{ intval($audioAd->music_volume * 100) }}%</p>
                                @else
                                <p class="text-sm text-color-89 dark:text-color-DF">{{ __('Voice only') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="px-8 py-6 bg-color-F6 dark:bg-color-29 border-t border-color-DF dark:border-color-47 flex flex-wrap gap-4 justify-between items-center">
                <a href="{{ route('user.audio-ads.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-purple-500 text-purple-600 dark:text-purple-400 font-semibold hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-all">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    {{ __('Create New Ad') }}
                </a>

                <button onclick="deleteAudioAd('{{ techEncrypt($audioAd->id) }}')"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-red-500 text-red-600 dark:text-red-400 font-semibold hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    {{ __('Delete') }}
                </button>
            </div>
        </div>
    </div>
</main>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white dark:bg-color-3A rounded-2xl p-6 max-w-sm mx-4 shadow-2xl border border-color-DF dark:border-color-47">
        <div class="text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500">
                    <path d="M3 6h18"></path>
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-color-14 dark:text-white mb-2">{{ __('Delete Audio Ad?') }}</h3>
            <p class="text-color-89 dark:text-color-DF text-sm mb-6">{{ __('This action cannot be undone. The audio file will be permanently deleted.') }}</p>
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 rounded-xl border border-color-DF dark:border-color-47 text-color-14 dark:text-white font-medium hover:bg-color-F6 dark:hover:bg-color-29 transition-colors">
                    {{ __('Cancel') }}
                </button>
                <button onclick="confirmDelete()" class="flex-1 px-4 py-2.5 rounded-xl bg-red-500 text-white font-medium hover:bg-red-600 transition-colors">
                    {{ __('Delete') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let deleteId = null;

function deleteAudioAd(id) {
    deleteId = id;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
    deleteId = null;
}

function confirmDelete() {
    if (!deleteId) return;
    
    fetch('{{ route("user.audio-ads.delete") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id: deleteId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = '{{ route("user.audio-ads.index") }}';
        } else {
            alert(data.message || '{{ __("Failed to delete") }}');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('{{ __("An error occurred") }}');
    })
    .finally(() => {
        closeDeleteModal();
    });
}

// Close modal on backdrop click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Auto-refresh for processing status
@if($audioAd->status === 'processing')
setTimeout(function() {
    location.reload();
}, 5000);
@endif
</script>
@endpush
