@extends('layouts.user_master')
@section('page_title', __('Create AI Duo Podcast'))

@section('content')
<main class="w-full lg:pt-[88px] pt-20 px-4 lg:px-8 pb-12 overflow-hidden main-content flex flex-col min-h-screen font-Figtree bg-color-F6 dark:bg-color-29 text-color-14 dark:text-white">
    <div class="max-w-4xl mx-auto w-full py-8">
    <div class="max-w-4xl mx-auto">
        
        <!-- Page Header -->
        <div class="mb-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-color-14 dark:text-white tracking-tight">
                        {{ __('Create AI Duo Podcast') }}
                    </h1>
                    <p class="mt-2 text-color-89 dark:text-color-89">
                        {{ __('Transform your ideas into engaging two-host conversations powered by AI') }}
                    </p>
                </div>
                <a href="{{ route('user.podcast.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-color-89 dark:text-color-89 hover:text-color-14 dark:hover:text-white bg-white dark:bg-color-47 border border-color-DF dark:border-color-47 rounded-xl transition-all duration-200 hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ __('My Podcasts') }}
                </a>
            </div>
        </div>

        <form id="podcast-form" action="{{ route('user.podcast.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                
                <!-- Topic Card -->
                <div class="bg-white dark:bg-color-3A border border-color-DF dark:border-color-47 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <label for="topic" class="block text-lg font-semibold text-color-14 dark:text-white mb-1">
                                {{ __('Podcast Topic') }}
                            </label>
                            <p class="text-sm text-color-89 dark:text-color-89 mb-4">
                                {{ __('What should your AI hosts discuss? Be specific for better results.') }}
                            </p>
                            <input type="text" 
                                   id="topic" 
                                   name="topic" 
                                   required
                                   class="w-full px-4 py-3.5 text-color-14 dark:text-white bg-color-F6 dark:bg-color-47 border-2 border-transparent focus:border-violet-500 dark:focus:border-violet-400 rounded-xl outline-none transition-all duration-200 placeholder:text-color-89"
                                   placeholder="{{ __('e.g., The Future of AI in Healthcare') }}">
                        </div>
                    </div>
                </div>

                <!-- Source Material Card -->
                <div class="bg-white dark:bg-color-3A border border-color-DF dark:border-color-47 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <label for="source_material" class="block text-lg font-semibold text-color-14 dark:text-white mb-1">
                                {{ __('Source Material') }}
                            </label>
                            <p class="text-sm text-color-89 dark:text-color-89 mb-4">
                                {{ __('Add notes, articles, or key points to guide the conversation. Optional but recommended.') }}
                            </p>
                            <textarea id="source_material" 
                                      name="source_material" 
                                      rows="5"
                                      class="w-full px-4 py-3.5 text-color-14 dark:text-white bg-color-F6 dark:bg-color-47 border-2 border-transparent focus:border-blue-500 dark:focus:border-blue-400 rounded-xl outline-none transition-all duration-200 placeholder:text-color-89 resize-none"
                                      placeholder="{{ __('Paste your research, notes, or talking points here...') }}"></textarea>
                        </div>
                    </div>
                </div>

                <!-- AI Hosts Card -->
                <div class="bg-white dark:bg-color-3A border border-color-DF dark:border-color-47 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-color-14 dark:text-white mb-1">
                                {{ __('Your AI Hosts') }}
                            </h3>
                            <p class="text-sm text-color-89 dark:text-color-89 mb-5">
                                {{ __('Meet your podcast co-hosts who will bring your topic to life.') }}
                            </p>
                            
                            <!-- Hosts Display -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Host A (Main Host) -->
                                <div class="relative group">
                                    <div class="absolute inset-0 bg-gradient-to-r from-violet-500 to-purple-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl"></div>
                                    <div class="relative flex items-center gap-4 p-4 bg-gradient-to-br from-color-F6 to-white dark:from-color-47 dark:to-color-3A border border-color-DF dark:border-color-47 rounded-2xl">
                                        <div class="relative flex-shrink-0">
                                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center shadow-lg">
                                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-2 border-white dark:border-color-3A flex items-center justify-center">
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2">
                                                <input type="text" 
                                                       name="host_a_name" 
                                                       id="host_a_name"
                                                       value="أليكس"
                                                       class="font-semibold text-color-14 dark:text-white bg-transparent border-b border-transparent hover:border-color-DF dark:hover:border-color-47 focus:border-violet-500 dark:focus:border-violet-400 outline-none transition-all w-24"
                                                       maxlength="20">
                                                <button type="button" onclick="document.getElementById('host_a_name').focus()" class="text-color-89 hover:text-violet-500 transition-colors">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <p class="text-xs text-color-89">{{ __('Main Host') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Host B (Co-Host) -->
                                <div class="relative group">
                                    <div class="absolute inset-0 bg-gradient-to-r from-rose-500 to-pink-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl"></div>
                                    <div class="relative flex items-center gap-4 p-4 bg-gradient-to-br from-color-F6 to-white dark:from-color-47 dark:to-color-3A border border-color-DF dark:border-color-47 rounded-2xl">
                                        <div class="relative flex-shrink-0">
                                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center shadow-lg">
                                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-2 border-white dark:border-color-3A flex items-center justify-center">
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2">
                                                <input type="text" 
                                                       name="host_b_name" 
                                                       id="host_b_name"
                                                       value="سارة"
                                                       class="font-semibold text-color-14 dark:text-white bg-transparent border-b border-transparent hover:border-color-DF dark:hover:border-color-47 focus:border-rose-500 dark:focus:border-rose-400 outline-none transition-all w-24"
                                                       maxlength="20">
                                                <button type="button" onclick="document.getElementById('host_b_name').focus()" class="text-color-89 hover:text-rose-500 transition-colors">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <p class="text-xs text-color-89">{{ __('Co-Host') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Generate Button -->
                <div class="pt-4">
                    <button type="submit" 
                            id="generate-btn"
                            class="group w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-[#7c3aed] via-[#8b5cf6] to-[#a855f7] p-[1px] transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/30 hover:scale-[1.02] active:scale-[0.98]">
                        <div class="relative flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-[#7c3aed] via-[#8b5cf6] to-[#a855f7] rounded-[11px]">
                            {{-- Shine effect --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -skew-x-12 translate-x-[-200%] group-hover:translate-x-[200%] transition-transform duration-1000"></div>
                            
                            <span id="btn-text" class="text-base font-semibold text-white">
                                {{ __('Generate Podcast') }}
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
                        {{ __('Generation typically takes 2-3 minutes depending on topic complexity') }}
                    </p>
                </div>

            </div>
        </form>

    </div>
</main>

<style>
@keyframes gradient-x {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

.animate-gradient-x {
    background-size: 200% 200%;
    animation: gradient-x 3s ease infinite;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('podcast-form');
    const btn = document.getElementById('generate-btn');
    const btnText = document.getElementById('btn-text');
    const btnIcon = document.getElementById('btn-icon');
    const btnSpinner = document.getElementById('btn-spinner');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Update button state
        btn.disabled = true;
        btn.classList.add('cursor-not-allowed', 'opacity-80');
        btnText.textContent = '{{ __("Generating...") }}';
        btnIcon.classList.add('hidden');
        btnSpinner.classList.remove('hidden');

        // Collect form data
        const formData = new FormData(form);

        // Submit via AJAX
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if ((data.success || data.status === 'success') && data.redirect) {
                window.location.href = data.redirect;
            } else if (data.error || data.message) {
                toastr.error(data.error || data.message);
                resetButton();
            } else {
                toastr.error('{{ __("An error occurred. Please try again.") }}');
                resetButton();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('{{ __("An error occurred. Please try again.") }}');
            resetButton();
        });
    });

    function resetButton() {
        btn.disabled = false;
        btn.classList.remove('cursor-not-allowed', 'opacity-80');
        btnText.textContent = '{{ __("Generate Podcast") }}';
        btnIcon.classList.remove('hidden');
        btnSpinner.classList.add('hidden');
    }
});
</script>

@endsection
