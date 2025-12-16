@extends('layouts.user_master')
@section('page_title', __('AI Duo Podcast'))

@section('content')
<main class="w-full lg:pt-[88px] pt-20 px-4 lg:px-8 pb-12 overflow-hidden main-content flex flex-col h-screen font-Figtree bg-color-F6 dark:bg-color-29 text-color-14 dark:text-white" dir="rtl">
    
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <p class="tracking-[0.2em] uppercase text-color-47 dark:text-[#8b5cf6] font-medium text-xs mb-2">
                {{ __('AI DUO PODCAST') }}
            </p>
            <h1 class="text-3xl font-bold text-color-14 dark:text-white leading-tight">
                {{ __('Your Episodes') }}
            </h1>
        </div>
        
        @if($availability['available'])
        <a href="{{ route('user.podcast.create') }}" 
           class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white transition-all duration-200 magic-bg font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-color-47 hover:opacity-90 shadow-lg">
            <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            {{ __('Create New Episode') }}
        </a>
        @endif
    </div>

    {{-- Subscription Info Card --}}
    @if($availability['available'])
    <div class="mb-8 relative overflow-hidden rounded-2xl bg-white dark:bg-color-3A border border-color-DF dark:border-color-47 p-6 shadow-sm">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-color-47/10 blur-3xl rounded-full pointer-events-none"></div>
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 relative z-10">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl magic-bg flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                        <line x1="12" y1="19" x2="12" y2="23"></line>
                        <line x1="8" y1="23" x2="16" y2="23"></line>
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h3 class="text-color-14 dark:text-white font-semibold text-lg">
                            {{ $availability['tier'] === 'premium' ? __('Premium Plan') : __('Free Plan') }}
                        </h3>
                        @if($availability['tier'] === 'premium')
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-yellow-100 dark:bg-yellow-500/20 text-yellow-600 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-500/20 uppercase tracking-wide">PRO</span>
                        @endif
                    </div>
                    <p class="text-color-89 dark:text-color-DF text-sm mt-1">
                        {{ __('Generate podcasts up to :duration', ['duration' => $availability['duration_limit']]) }}
                    </p>
                </div>
            </div>
            @if($availability['tier'] === 'free')
            <a href="{{ route('user.subscription') }}" class="text-sm font-medium text-color-47 hover:opacity-80 transition-colors flex items-center gap-1">
                {{ __('Upgrade Plan') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
            </a>
            @endif
        </div>
    </div>
    @else
    <div class="mb-8 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl p-5 flex items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
        <p class="text-red-600 dark:text-red-400 text-sm font-medium">{{ $availability['error'] }}</p>
    </div>
    @endif

    {{-- Podcasts Grid --}}
    <div class="flex-1 overflow-y-auto custom-scrollbar pb-20">
        @if($podcasts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($podcasts as $podcast)
            <div class="group relative bg-white dark:bg-color-3A border border-color-DF dark:border-color-47 rounded-2xl p-5 hover:border-color-47 dark:hover:border-color-DF transition-all duration-300 hover:shadow-xl podcast-card flex flex-col h-full shadow-sm" 
                 data-podcast-id="{{ techEncrypt($podcast->id) }}" 
                 data-status="{{ $podcast->status }}">
                
                {{-- Status & Date --}}
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-color-F6 dark:bg-color-29 flex items-center justify-center border border-color-DF dark:border-color-47 group-hover:border-color-47 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-color-89 dark:text-color-DF group-hover:text-color-47 transition-colors">
                                <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                                <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] uppercase tracking-wider text-color-89 dark:text-color-DF font-semibold">{{ __('Episode') }}</span>
                            <span class="text-xs text-color-14 dark:text-white">{{ $podcast->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    @if($podcast->status === 'completed')
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800 uppercase tracking-wide">
                        {{ __('Ready') }}
                    </span>
                    @elseif($podcast->status === 'processing')
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-800 uppercase tracking-wide">
                        <svg class="animate-spin -ml-1 mr-1.5 h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ __('Processing') }}
                    </span>
                    @elseif($podcast->status === 'pending')
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800 uppercase tracking-wide">
                        {{ __('Queue') }}
                    </span>
                    @else
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 uppercase tracking-wide">
                        {{ __('Failed') }}
                    </span>
                    @endif
                </div>

                {{-- Content --}}
                <div class="mb-6 flex-1">
                    <h3 class="text-color-14 dark:text-white font-bold text-lg mb-2 line-clamp-2 leading-snug group-hover:text-color-47 transition-colors">
                        {{ $podcast->title ?? $podcast->topic }}
                    </h3>
                    <p class="text-color-89 dark:text-color-DF text-sm line-clamp-3 leading-relaxed">
                        {{ $podcast->topic }}
                    </p>
                </div>

                {{-- Footer / Actions --}}
                <div class="pt-4 border-t border-color-DF dark:border-color-47 flex items-center justify-between mt-auto">
                    @if($podcast->status === 'completed')
                    <div class="flex items-center gap-3 text-xs text-color-89 dark:text-color-DF font-mono">
                        <span class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            {{ $podcast->formatted_duration }}
                        </span>
                        <span class="w-1 h-1 rounded-full bg-color-DF dark:bg-color-47"></span>
                        <span>{{ number_format($podcast->word_count) }} {{ __('words') }}</span>
                    </div>
                    @else
                    <div class="text-xs text-color-89 dark:text-color-DF italic">
                        {{ __('Waiting for generation...') }}
                    </div>
                    @endif

                    <div class="flex items-center gap-1">
                        {{-- Delete Button --}}
                        <button onclick="deletePodcast('{{ techEncrypt($podcast->id) }}')" 
                                class="p-2.5 rounded-xl text-color-89 dark:text-color-DF hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all"
                                title="{{ __('Delete') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>

                        {{-- View Button --}}
                        <a href="{{ route('user.podcast.show', ['id' => techEncrypt($podcast->id)]) }}" 
                           class="p-2.5 rounded-xl text-color-89 dark:text-color-DF hover:text-color-47 hover:bg-color-F6 dark:hover:bg-color-29 transition-all"
                           title="{{ __('View Details') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                <polyline points="15 3 21 3 21 9"></polyline>
                                <line x1="10" y1="14" x2="21" y2="3"></line>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $podcasts->links() }}
        </div>
        @else
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center h-[50vh] text-center">
            <div class="w-24 h-24 rounded-full bg-white dark:bg-color-3A border border-color-DF dark:border-color-47 flex items-center justify-center mb-6 relative shadow-lg">
                <div class="absolute inset-0 bg-color-47/20 blur-xl rounded-full"></div>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="relative z-10 text-color-47">
                    <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                    <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                    <line x1="12" y1="19" x2="12" y2="23"></line>
                    <line x1="8" y1="23" x2="16" y2="23"></line>
                </svg>
            </div>
            <h3 class="text-color-14 dark:text-white font-bold text-xl mb-2">{{ __('No Episodes Yet') }}</h3>
            <p class="text-color-89 dark:text-color-DF max-w-md mb-8">{{ __('Start your journey by creating your first AI-powered podcast dialogue. It only takes a few minutes.') }}</p>
            
            @if($availability['available'])
            <a href="{{ route('user.podcast.create') }}" 
               class="inline-flex items-center justify-center px-8 py-3 text-sm font-semibold text-white transition-all duration-200 magic-bg rounded-xl hover:opacity-90 shadow-lg">
                {{ __('Create First Episode') }}
            </a>
            @endif
        </div>
        @endif
    </div>
</main>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 3px;
    }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #474746;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #5a5a59;
    }
</style>
@endsection

@section('js')
<script>
    const CSRF_TOKEN = '{{ csrf_token() }}';

    function deletePodcast(id) {
        if(confirm("{{ __('Are you sure you want to delete this episode?') }}")) {
            fetch("{{ route('user.podcast.delete') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.reload();
                } else {
                    alert(data.message || 'Error deleting podcast');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the podcast');
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const pendingPodcasts = document.querySelectorAll('.podcast-card[data-status="pending"], .podcast-card[data-status="processing"]');
        
        if (pendingPodcasts.length > 0) {
            const checkStatus = () => {
                pendingPodcasts.forEach(card => {
                    const id = card.dataset.podcastId;
                    const baseUrl = "{{ route('user.podcast.status', ['id' => 'PLACEHOLDER']) }}";
                    const url = baseUrl.replace('PLACEHOLDER', id);

                    fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success' && (data.podcast.status === 'completed' || data.podcast.status === 'failed')) {
                            window.location.reload();
                        }
                    })
                    .catch(console.error);
                });
            };

            // Poll every 5 seconds
            setInterval(checkStatus, 5000);
        }
    });
</script>
@endsection
