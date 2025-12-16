@extends('layouts.user_master')
@section('page_title', __('Create Audio Ad'))

@push('styles')
<style>
    /* Enhanced selection styles for all cards */
    .selection-card {
        position: relative;
        transition: all 0.2s ease;
    }
    .selection-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15);
    }
    input:checked + .selection-card {
        border-color: #8b5cf6 !important;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(168, 85, 247, 0.1) 100%) !important;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2), 0 4px 12px rgba(139, 92, 246, 0.25);
    }
    input:checked + .selection-card::before {
        content: '';
        position: absolute;
        top: 8px;
        right: 8px;
        width: 20px;
        height: 20px;
        background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    input:checked + .selection-card::after {
        content: '✓';
        position: absolute;
        top: 8px;
        right: 8px;
        width: 20px;
        height: 20px;
        color: white;
        font-size: 12px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    /* Pulse animation for selected items */
    @keyframes selectedPulse {
        0%, 100% { box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2), 0 4px 12px rgba(139, 92, 246, 0.25); }
        50% { box-shadow: 0 0 0 5px rgba(139, 92, 246, 0.3), 0 4px 16px rgba(139, 92, 246, 0.35); }
    }
    input:checked + .selection-card {
        animation: selectedPulse 2s ease-in-out;
    }
</style>
@endpush

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
            
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-[#7c3aed] to-[#a855f7] flex items-center justify-center text-white shadow-lg shadow-purple-500/25">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                        <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
                    </svg>
                </div>
                <div>
                    <p class="tracking-[0.2em] uppercase text-purple-600 dark:text-purple-400 font-medium text-xs mb-1">
                        {{ __('AI AUDIO ADS') }}
                    </p>
                    <h1 class="text-2xl font-bold text-color-14 dark:text-white leading-tight">
                        {{ __('Create Professional Audio Ad') }}
                    </h1>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form id="audio-ad-form" class="space-y-6">
            @csrf
            
            {{-- Ad Text Section --}}
            <div class="bg-white dark:bg-color-3A rounded-2xl border border-color-DF dark:border-color-47 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-color-14 dark:text-white">{{ __('Advertisement Content') }}</h3>
                        <p class="text-sm text-color-89 dark:text-color-DF">{{ __('Enter your ad text or product description') }}</p>
                    </div>
                </div>

                {{-- Title (Optional) --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-color-14 dark:text-white mb-2">
                        {{ __('Title') }} <span class="text-color-89">({{ __('Optional') }})</span>
                    </label>
                    <input type="text" name="title" id="title"
                           class="w-full px-4 py-3 rounded-xl border border-color-DF dark:border-color-47 bg-color-F6 dark:bg-color-29 text-color-14 dark:text-white placeholder-color-89 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                           placeholder="{{ __('e.g., Summer Sale Ad') }}">
                </div>

                {{-- Ad Text --}}
                <div>
                    <label class="block text-sm font-medium text-color-14 dark:text-white mb-2">
                        {{ __('Ad Text') }} <span class="text-red-500">*</span>
                    </label>
                    <textarea name="ad_text" id="ad_text" rows="5" required
                              class="w-full px-4 py-3 rounded-xl border border-color-DF dark:border-color-47 bg-color-F6 dark:bg-color-29 text-color-14 dark:text-white placeholder-color-89 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all resize-none"
                              placeholder="{{ __('Enter your advertisement text, product features, or let AI generate a script for you...') }}"></textarea>
                    <p class="mt-2 text-xs text-color-89 dark:text-color-DF">
                        {{ __('Tip: Short descriptions will be enhanced by AI. Longer texts will be used as-is.') }}
                    </p>
                </div>
            </div>

            {{-- Product & Style Section --}}
            <div class="bg-white dark:bg-color-3A rounded-2xl border border-color-DF dark:border-color-47 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-color-14 dark:text-white">{{ __('Product & Style') }}</h3>
                        <p class="text-sm text-color-89 dark:text-color-DF">{{ __('Customize the ad style and target') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Product Type --}}
                    <div>
                        <label class="block text-sm font-medium text-color-14 dark:text-white mb-3">
                            {{ __('Product Type') }}
                        </label>
                        <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto pr-2">
                            @foreach($productTypes as $value => $label)
                            <label class="relative cursor-pointer">
                                <input type="radio" name="product_type" value="{{ $value }}" 
                                       class="peer sr-only" {{ $loop->first ? 'checked' : '' }}>
                                <div class="selection-card text-center p-3 rounded-xl border-2 border-color-DF dark:border-color-47 bg-color-F6 dark:bg-color-29 transition-all">
                                    <span class="text-sm font-medium text-color-14 dark:text-white">{{ $label }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Ad Style --}}
                    <div>
                        <label class="block text-sm font-medium text-color-14 dark:text-white mb-3">
                            {{ __('Ad Style') }}
                        </label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($styles as $value => $label)
                            <label class="relative cursor-pointer">
                                <input type="radio" name="ad_style" value="{{ $value }}" 
                                       class="peer sr-only" {{ $value === 'professional' ? 'checked' : '' }}>
                                <div class="selection-card text-center p-3 rounded-xl border-2 border-color-DF dark:border-color-47 bg-color-F6 dark:bg-color-29 transition-all">
                                    <span class="text-sm font-medium text-color-14 dark:text-white">{{ $label }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Platform & Duration Section --}}
            <div class="bg-white dark:bg-color-3A rounded-2xl border border-color-DF dark:border-color-47 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-color-14 dark:text-white">{{ __('Platform & Duration') }}</h3>
                        <p class="text-sm text-color-89 dark:text-color-DF">{{ __('Where will your ad be played?') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Target Platform --}}
                    <div>
                        <label class="block text-sm font-medium text-color-14 dark:text-white mb-2">
                            {{ __('Target Platform') }}
                        </label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($platforms as $value => $label)
                            <label class="relative cursor-pointer">
                                <input type="radio" name="target_platform" value="{{ $value }}" 
                                       class="peer sr-only" {{ $value === 'radio' ? 'checked' : '' }}>
                                <div class="selection-card flex items-center gap-2 p-3 rounded-xl border-2 border-color-DF dark:border-color-47 bg-color-F6 dark:bg-color-29 transition-all">
                                    @if($value === 'radio')
                                    <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    @elseif($value === 'youtube')
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                    @elseif($value === 'social_media')
                                    <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
                                    @else
                                    <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/></svg>
                                    @endif
                                    <span class="text-sm font-medium text-color-14 dark:text-white">{{ $label }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Duration --}}
                    <div>
                        <label class="block text-sm font-medium text-color-14 dark:text-white mb-2">
                            {{ __('Duration') }}
                        </label>
                        <div class="flex gap-2">
                            @foreach($durations as $value => $label)
                            <label class="relative cursor-pointer flex-1">
                                <input type="radio" name="target_duration" value="{{ $value }}" 
                                       class="peer sr-only" {{ $value === 30 ? 'checked' : '' }}>
                                <div class="selection-card text-center p-3 rounded-xl border-2 border-color-DF dark:border-color-47 bg-color-F6 dark:bg-color-29 transition-all">
                                    <span class="block text-lg font-bold text-color-14 dark:text-white">{{ $value }}{{ __('s') }}</span>
                                    <span class="text-xs text-color-89">{{ explode(' - ', $label)[1] ?? '' }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Voice Selection Section --}}
            <div class="bg-white dark:bg-color-3A rounded-2xl border border-color-DF dark:border-color-47 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-color-14 dark:text-white">{{ __('Voice Selection') }}</h3>
                        <p class="text-sm text-color-89 dark:text-color-DF">{{ __('Choose the voice for your ad - click speaker to preview') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($voices as $voiceId => $voice)
                    <label class="relative cursor-pointer">
                        <input type="radio" name="voice_id" value="{{ $voiceId }}" 
                               class="peer sr-only" {{ $loop->first ? 'checked' : '' }}>
                        <div class="selection-card p-4 rounded-xl border-2 border-color-DF dark:border-color-47 bg-color-F6 dark:bg-color-29 transition-all">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full {{ $voice['gender'] === 'female' ? 'bg-pink-100 dark:bg-pink-900/30' : 'bg-blue-100 dark:bg-blue-900/30' }} flex items-center justify-center">
                                        <svg class="w-5 h-5 {{ $voice['gender'] === 'female' ? 'text-pink-500' : 'text-blue-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="block font-semibold text-color-14 dark:text-white">{{ $voice['name'] }}</span>
                                        <span class="text-xs text-color-89 dark:text-color-DF">{{ $voice['gender'] === 'female' ? __('Female') : __('Male') }}</span>
                                    </div>
                                </div>
                                {{-- Preview Button --}}
                                <button type="button" 
                                        onclick="event.preventDefault(); event.stopPropagation(); previewVoice(this, '{{ $voiceId }}', '{{ $voice['name'] }}')"
                                        class="preview-btn w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center hover:bg-purple-200 dark:hover:bg-purple-800/50 transition-all group"
                                        title="{{ __('Preview voice') }}">
                                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400 play-icon" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400 stop-icon hidden" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 6h12v12H6z"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-xs text-color-89 dark:text-color-DF line-clamp-2">{{ $voice['description'] }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>
                
                {{-- Voice Preview Status --}}
                <div id="voice-preview-status" class="mt-3 hidden">
                    <div class="flex items-center gap-2 p-3 bg-purple-50 dark:bg-purple-900/20 rounded-xl">
                        <div class="w-6 h-6 rounded-full bg-purple-500 flex items-center justify-center animate-pulse">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 9v6h4l5 5V4L7 9H3z"/>
                            </svg>
                        </div>
                        <span id="voice-preview-text" class="text-sm text-purple-700 dark:text-purple-300">{{ __('Playing...') }}</span>
                        <button type="button" onclick="stopAllAudio()" class="mr-auto text-purple-600 hover:text-purple-800 text-sm font-medium">
                            {{ __('Stop') }}
                        </button>
                    </div>
                </div>
            </div>

            {{-- Background Music Section --}}
            <div class="bg-white dark:bg-color-3A rounded-2xl border border-color-DF dark:border-color-47 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-pink-600 dark:text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-color-14 dark:text-white">{{ __('Background Music') }}</h3>
                        <p class="text-sm text-color-89 dark:text-color-DF">{{ __('Click speaker to preview music') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($musicOptions as $value => $label)
                    <label class="relative cursor-pointer">
                        <input type="radio" name="background_music" value="{{ $value }}" 
                               class="peer sr-only" {{ $value === 'none' ? 'checked' : '' }}>
                        <div class="selection-card text-center p-4 rounded-xl border-2 border-color-DF dark:border-color-47 bg-color-F6 dark:bg-color-29 transition-all">
                            <div class="flex items-center justify-center gap-3 mb-2">
                                @if($value === 'none')
                                <svg class="w-6 h-6 text-color-89" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/></svg>
                                @else
                                {{-- Music Preview Button - Bigger and Left --}}
                                <button type="button" 
                                        onclick="event.preventDefault(); event.stopPropagation(); previewMusic(this, '{{ $value }}', '{{ $label }}')"
                                        class="music-preview-btn w-10 h-10 rounded-full bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center hover:bg-pink-200 dark:hover:bg-pink-800/50 transition-all hover:scale-110"
                                        title="{{ __('Preview music') }}">
                                    <svg class="w-5 h-5 text-pink-600 dark:text-pink-400 play-icon" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                    <svg class="w-5 h-5 text-pink-600 dark:text-pink-400 stop-icon hidden" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 6h12v12H6z"/>
                                    </svg>
                                </button>
                                <svg class="w-6 h-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                                @endif
                            </div>
                            <span class="text-sm font-medium text-color-14 dark:text-white">{{ $label }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>

                {{-- Music Volume (shown when music is selected) --}}
                <div id="music-volume-container" class="mt-4 hidden">
                    <label class="block text-sm font-medium text-color-14 dark:text-white mb-2">
                        {{ __('Music Volume') }}
                    </label>
                    <input type="range" name="music_volume" id="music_volume" 
                           min="0" max="1" step="0.1" value="0.2"
                           class="w-full h-2 bg-color-DF dark:bg-color-47 rounded-lg appearance-none cursor-pointer accent-purple-500">
                    <div class="flex justify-between text-xs text-color-89 mt-1">
                        <span>{{ __('Quiet') }}</span>
                        <span id="volume-value" class="text-purple-500 font-medium">20%</span>
                        <span>{{ __('Loud') }}</span>
                    </div>
                </div>
            </div>

            {{-- Generate Button --}}
            <div class="pt-4">
                <button type="submit" 
                        id="generate-btn"
                        class="group w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-[#7c3aed] via-[#8b5cf6] to-[#a855f7] p-[1px] transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/30 hover:scale-[1.02] active:scale-[0.98]">
                    <div class="relative flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-[#7c3aed] via-[#8b5cf6] to-[#a855f7] rounded-[11px]">
                        {{-- Shine effect --}}
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -skew-x-12 translate-x-[-200%] group-hover:translate-x-[200%] transition-transform duration-1000"></div>
                        
                        <span id="btn-text" class="text-base font-semibold text-white">
                            {{ __('Generate Audio Ad') }}
                        </span>
                        <svg id="btn-icon" class="w-5 h-5 text-white transition-transform duration-300 group-hover:-translate-x-1 rtl:rotate-180 rtl:group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                        
                        <!-- Loading Spinner (Hidden by default) -->
                        <svg id="btn-spinner" class="hidden w-5 h-5 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </button>
                
                <p class="mt-4 text-center text-sm text-color-89">
                    <svg class="inline-block w-4 h-4 mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ __('Generation typically takes 30-60 seconds') }}
                </p>
            </div>
        </form>
    </div>
    
    {{-- Audio Preview Player (Hidden) --}}
    <audio id="preview-audio" style="display: none;"></audio>
</main>

<script>
// Audio preview - Simple and Direct
let previewAudio = null;
let currentPreviewBtn = null;

const voiceSamples = {
    'EXAVITQu4vr4xnSDxMaL': '/public/audio/voices/sarah.mp3',
    'CwhRBWXzGAHq8TQ4Fs17': '/public/audio/voices/roger.mp3',
    'JBFqnCBsd6RMkjVDRZzb': '/public/audio/voices/george.mp3',
    'XB0fDUnXU5powFXDhCwa': '/public/audio/voices/charlotte.mp3',
    'pFZP5JQG7iQjIQuC4Bku': '/public/audio/voices/lily.mp3',
    'TX3LPaxmHKxFdv7VOQHJ': '/public/audio/voices/liam.mp3'
};

const musicSamples = {
    'upbeat': '/public/audio/music/upbeat.mp3',
    'corporate': '/public/audio/music/corporate.mp3',
    'emotional': '/public/audio/music/emotional.mp3',
    'calm': '/public/audio/music/calm.mp3',
    'energetic': '/public/audio/music/energetic.mp3'
};

function stopPreview() {
    if (previewAudio) {
        previewAudio.pause();
        previewAudio.currentTime = 0;
    }
    if (currentPreviewBtn) {
        const playIcon = currentPreviewBtn.querySelector('.play-icon');
        const stopIcon = currentPreviewBtn.querySelector('.stop-icon');
        if (playIcon) playIcon.classList.remove('hidden');
        if (stopIcon) stopIcon.classList.add('hidden');
    }
    const status = document.getElementById('voice-preview-status');
    if (status) status.classList.add('hidden');
    currentPreviewBtn = null;
}

function previewVoice(btn, voiceId, voiceName) {
    event.preventDefault();
    event.stopPropagation();
    
    const url = voiceSamples[voiceId];
    if (!url) return;
    
    // If same button, stop
    if (currentPreviewBtn === btn) {
        stopPreview();
        return;
    }
    
    stopPreview();
    currentPreviewBtn = btn;
    
    // Update icons
    const playIcon = btn.querySelector('.play-icon');
    const stopIcon = btn.querySelector('.stop-icon');
    if (playIcon) playIcon.classList.add('hidden');
    if (stopIcon) stopIcon.classList.remove('hidden');
    
    // Show status
    const status = document.getElementById('voice-preview-status');
    const statusText = document.getElementById('voice-preview-text');
    if (status) {
        status.classList.remove('hidden');
        if (statusText) statusText.textContent = 'جاري التشغيل: ' + voiceName;
    }
    
    // Play
    previewAudio = new Audio(url);
    previewAudio.volume = 0.8;
    previewAudio.onended = stopPreview;
    previewAudio.onerror = stopPreview;
    previewAudio.play();
}

function previewMusic(btn, musicType, musicName) {
    event.preventDefault();
    event.stopPropagation();
    
    const url = musicSamples[musicType];
    if (!url) return;
    
    // If same button, stop
    if (currentPreviewBtn === btn) {
        stopPreview();
        return;
    }
    
    stopPreview();
    currentPreviewBtn = btn;
    
    // Update icons
    const playIcon = btn.querySelector('.play-icon');
    const stopIcon = btn.querySelector('.stop-icon');
    if (playIcon) playIcon.classList.add('hidden');
    if (stopIcon) stopIcon.classList.remove('hidden');
    
    // Play (10 seconds max)
    previewAudio = new Audio(url);
    previewAudio.volume = 0.5;
    previewAudio.onended = stopPreview;
    previewAudio.onerror = stopPreview;
    previewAudio.play();
    
    setTimeout(stopPreview, 10000);
}

function stopAllAudio() {
    stopPreview();
}
</script>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('audio-ad-form');
    const generateBtn = document.getElementById('generate-btn');
    const btnText = document.getElementById('btn-text');
    const btnIcon = document.getElementById('btn-icon');
    const btnSpinner = document.getElementById('btn-spinner');
    const musicRadios = document.querySelectorAll('input[name="background_music"]');
    const volumeContainer = document.getElementById('music-volume-container');
    const volumeSlider = document.getElementById('music_volume');
    const volumeValue = document.getElementById('volume-value');

    // Update volume display
    if (volumeSlider && volumeValue) {
        volumeSlider.addEventListener('input', function() {
            volumeValue.textContent = Math.round(this.value * 100) + '%';
        });
    }

    // Show/hide volume slider based on music selection
    musicRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value !== 'none') {
                volumeContainer.classList.remove('hidden');
            } else {
                volumeContainer.classList.add('hidden');
            }
        });
    });

    // Form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Validate
        const adText = document.getElementById('ad_text').value.trim();
        if (adText.length < 10) {
            alert('{{ __("Please enter at least 10 characters for the ad text") }}');
            return;
        }

        // Show loading state
        generateBtn.disabled = true;
        btnText.textContent = '{{ __("Generating...") }}';
        btnIcon.classList.add('hidden');
        btnSpinner.classList.remove('hidden');

        try {
            const formData = new FormData(form);
            const response = await fetch('{{ route("user.audio-ads.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (data.status === 'success' && data.redirect) {
                window.location.href = data.redirect;
            } else {
                throw new Error(data.message || '{{ __("Failed to create audio ad") }}');
            }
        } catch (error) {
            console.error('Error:', error);
            alert(error.message || '{{ __("An error occurred. Please try again.") }}');
            
            // Reset button
            generateBtn.disabled = false;
            btnText.textContent = '{{ __("Generate Audio Ad") }}';
            btnIcon.classList.remove('hidden');
            btnSpinner.classList.add('hidden');
        }
    });
});
</script>
@endpush
