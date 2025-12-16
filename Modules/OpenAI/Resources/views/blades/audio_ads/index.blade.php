@extends('layouts.user_master')
@section('page_title', __('Audio Ads'))

@section('content')
<main class="w-full lg:pt-[88px] pt-20 px-4 lg:px-8 pb-12 overflow-hidden main-content flex flex-col h-screen font-Figtree bg-color-F6 dark:bg-color-29 text-color-14 dark:text-white" dir="rtl">
    
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <p class="tracking-[0.2em] uppercase text-color-47 dark:text-[#8b5cf6] font-medium text-xs mb-2">
                {{ __('AI AUDIO ADS') }}
            </p>
            <h1 class="text-3xl font-bold text-color-14 dark:text-white leading-tight">
                {{ __('Your Audio Advertisements') }}
            </h1>
        </div>
        
        @if($availability['available'])
        <a href="{{ route('user.audio-ads.create') }}" 
           class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white transition-all duration-200 bg-gradient-to-r from-[#7c3aed] via-[#8b5cf6] to-[#a855f7] font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 hover:opacity-90 shadow-lg hover:shadow-purple-500/25">
            <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            {{ __('Create New Ad') }}
        </a>
        @endif
    </div>

    {{-- Info Card --}}
    @if($availability['available'])
    <div class="mb-8 relative overflow-hidden rounded-2xl bg-white dark:bg-color-3A border border-color-DF dark:border-color-47 p-6 shadow-sm">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-purple-500/10 blur-3xl rounded-full pointer-events-none"></div>
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 relative z-10">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-[#7c3aed] to-[#a855f7] flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                        <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-color-14 dark:text-white font-semibold text-lg">
                        {{ __('Professional Audio Ads') }}
                    </h3>
                    <p class="text-color-89 dark:text-color-DF text-sm mt-1">
                        {{ __('Create stunning audio advertisements with AI voices') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="mb-8 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl p-5 flex items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
        <p class="text-red-600 dark:text-red-400 text-sm font-medium">{{ $availability['error'] }}</p>
    </div>
    @endif

    {{-- Audio Ads Grid --}}
    <div class="flex-1 overflow-y-auto custom-scrollbar pb-20">
        @if($audioAds->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6">
            @foreach($audioAds as $audioAd)
            <div class="group relative bg-white dark:bg-color-3A border border-color-DF dark:border-color-47 rounded-2xl p-5 hover:border-purple-400 dark:hover:border-purple-500 transition-all duration-300 hover:shadow-xl flex flex-col h-full shadow-sm">
                
                {{-- Status & Platform Badge --}}
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-2">
                        {{-- Platform Icon --}}
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 dark:from-purple-900/30 dark:to-purple-800/20 flex items-center justify-center border border-purple-200 dark:border-purple-700/50">
                            @if($audioAd->target_platform === 'radio')
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            @elseif($audioAd->target_platform === 'youtube')
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            @elseif($audioAd->target_platform === 'social_media')
                            <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                            </svg>
                            @else
                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                            </svg>
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] uppercase tracking-wider text-color-89 dark:text-color-DF font-semibold">
                                {{ \Modules\OpenAI\Entities\AudioAd::getPlatformOptions()[$audioAd->target_platform] ?? $audioAd->target_platform }}
                            </span>
                            <span class="text-xs text-color-14 dark:text-white">{{ $audioAd->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    {{-- Status Badge --}}
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold {{ $audioAd->getStatusBadgeClass() }} uppercase tracking-wide">
                        @if($audioAd->status === 'processing')
                        <svg class="animate-spin -ml-1 mr-1.5 h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        @endif
                        {{ $audioAd->getStatusLabel() }}
                    </span>
                </div>

                {{-- Title & Content --}}
                <div class="mb-4 flex-1">
                    <h3 class="text-color-14 dark:text-white font-bold text-base mb-2 line-clamp-2 leading-snug group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                        {{ $audioAd->title ?? Str::limit($audioAd->ad_text, 50) }}
                    </h3>
                    <p class="text-color-89 dark:text-color-DF text-sm line-clamp-2 leading-relaxed">
                        {{ Str::limit($audioAd->ad_text, 100) }}
                    </p>
                </div>

                {{-- Voice & Duration Info --}}
                <div class="flex items-center gap-3 mb-4 text-xs text-color-89 dark:text-color-DF">
                    <span class="flex items-center gap-1.5 bg-color-F6 dark:bg-color-29 px-2 py-1 rounded-lg">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ $audioAd->voice_name }}
                    </span>
                    <span class="flex items-center gap-1.5 bg-color-F6 dark:bg-color-29 px-2 py-1 rounded-lg">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $audioAd->target_duration }}{{ __('s') }}
                    </span>
                </div>

                {{-- Audio Player (if ready) --}}
                @if($audioAd->isReady())
                <div class="mb-4 bg-color-F6 dark:bg-color-29 rounded-xl p-3">
                    <audio controls class="w-full h-10" style="height: 40px;">
                        <source src="{{ route('user.audio-ads.stream', ['id' => techEncrypt($audioAd->id)]) }}" type="audio/mpeg">
                    </audio>
                </div>
                @endif

                {{-- Footer / Actions --}}
                <div class="pt-4 border-t border-color-DF dark:border-color-47 flex items-center justify-between mt-auto">
                    @if($audioAd->isReady())
                    <div class="flex items-center gap-2 text-xs text-color-89 dark:text-color-DF font-mono">
                        <span class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            {{ $audioAd->getFormattedDuration() }}
                        </span>
                    </div>
                    @else
                    <div class="text-xs text-color-89 dark:text-color-DF italic">
                        {{ __('Generating audio...') }}
                    </div>
                    @endif

                    <div class="flex items-center gap-1">
                        {{-- View Button --}}
                        <a href="{{ route('user.audio-ads.show', ['id' => techEncrypt($audioAd->id)]) }}"
                           class="p-2.5 rounded-xl text-color-89 dark:text-color-DF hover:text-purple-600 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-all"
                           title="{{ __('View') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>

                        {{-- Download Button --}}
                        @if($audioAd->isReady())
                        <a href="{{ route('user.audio-ads.download', ['id' => techEncrypt($audioAd->id)]) }}"
                           class="p-2.5 rounded-xl text-color-89 dark:text-color-DF hover:text-green-600 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all"
                           title="{{ __('Download') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                        </a>
                        @endif

                        {{-- Delete Button --}}
                        <button onclick="deleteAudioAd('{{ techEncrypt($audioAd->id) }}')" 
                                class="p-2.5 rounded-xl text-color-89 dark:text-color-DF hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all"
                                title="{{ __('Delete') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $audioAds->links() }}
        </div>
        @else
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-purple-100 to-purple-50 dark:from-purple-900/30 dark:to-purple-800/20 flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-purple-500">
                    <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                    <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                    <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-color-14 dark:text-white mb-2">{{ __('No Audio Ads Yet') }}</h3>
            <p class="text-color-89 dark:text-color-DF mb-6 max-w-sm">{{ __('Create your first professional audio advertisement with AI-powered voices.') }}</p>
            
            @if($availability['available'])
            <a href="{{ route('user.audio-ads.create') }}" 
               class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white transition-all duration-200 bg-gradient-to-r from-[#7c3aed] via-[#8b5cf6] to-[#a855f7] rounded-xl hover:opacity-90 shadow-lg hover:shadow-purple-500/25">
                <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ __('Create Your First Ad') }}
            </a>
            @endif
        </div>
        @endif
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
            location.reload();
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
</script>
@endpush
