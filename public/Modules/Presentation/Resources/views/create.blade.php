@extends('layouts.user_master')
@section('page_title', __('Create Presentation'))
@section('css')
    <style>
        .generate-btn {
            background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
        }
        .generate-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        .slide-card {
            display: flex;
            flex-direction: column;
        }
        #slidePoints li {
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            position: relative;
            padding-inline-start: 1.5rem;
        }
        #slidePoints li:last-child {
            border-bottom: none;
        }
        #slidePoints li::before {
            content: "•";
            position: absolute;
            inset-inline-start: 0;
            color: #8b5cf6;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
<div class="w-[68.9%] 7xl:w-[83.9%] dark:bg-[#292929] flex flex-col flex-1 border-s dark:border-[#474746] border-color-DF h-screen">
    <div class="subscription-main flex xl:flex-row flex-col xl:h-full md:overflow-auto sidebar-scrollbar md:h-screen overflow-x-hidden">
        <div class="lg:pt-[88px] pt-20 9xl:px-[245px] 7xl:px-[135px] 5xl:px-[67px] px-5 pb-28 overflow-auto main-content flex flex-col flex-1 font-Figtree bg-color-F6 dark:bg-[#292929] border-s dark:border-[#474746] border-color-DF">
            
            {{-- Page Title --}}
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-6 h-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <p class="text-color-14 text-24 font-semibold font-RedHat dark:text-white">
                    {{ __('Create Presentation') }}
                </p>
            </div>
            <p class="text-color-89 text-[13px] leading-5 font-medium font-Figtree mb-6">
                {{ __('Generate professional presentations with AI') }}
            </p>

            <div class="flex flex-col lg:flex-row gap-6">
                {{-- Input Form --}}
                <div class="lg:w-2/5 w-full">
                    <div class="bg-white dark:bg-color-3A rounded-xl p-6 shadow-sm">
                        <form id="presentationForm">
                            @csrf
                            
                            {{-- Topic Input --}}
                            <div class="mb-5">
                                <label for="topic" class="font-Figtree text-color-14 font-medium leading-6 text-base dark:text-white flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    {{ __('Presentation Topic') }} <span class="text-red-500">*</span>
                                </label>
                                <textarea name="topic" 
                                       id="topic" 
                                       rows="3"
                                       class="w-full px-4 py-3 border border-color-89 dark:border-color-47 rounded-xl bg-white dark:bg-[#333332] text-color-14 dark:text-white focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all text-sm resize-none"
                                       placeholder="{{ __('e.g., Digital Marketing Strategies for 2024') }}"
                                       required></textarea>
                                <p class="text-color-89 text-xs mt-2">{{ __('Describe the topic of your presentation in detail') }}</p>
                            </div>

                            {{-- Slides Count --}}
                            <div class="mb-5">
                                <label for="slides_count" class="font-Figtree text-color-14 font-medium leading-6 text-base dark:text-white flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    {{ __('Number of Slides') }}
                                </label>
                                <select name="slides_count" 
                                        id="slides_count" 
                                        class="w-full px-4 py-3 border border-color-89 dark:border-color-47 rounded-xl bg-white dark:bg-[#333332] text-color-14 dark:text-white focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all text-sm">
                                    <option value="5">5 {{ __('Slides') }}</option>
                                    <option value="8" selected>8 {{ __('Slides') }}</option>
                                    <option value="10">10 {{ __('Slides') }}</option>
                                    <option value="12">12 {{ __('Slides') }}</option>
                                    <option value="15">15 {{ __('Slides') }}</option>
                                    <option value="20">20 {{ __('Slides') }}</option>
                                </select>
                            </div>

                            {{-- Style Selection --}}
                            <div class="mb-5">
                                <label for="style" class="font-Figtree text-color-14 font-medium leading-6 text-base dark:text-white flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                    </svg>
                                    {{ __('Presentation Style') }}
                                </label>
                                <select name="style" 
                                        id="style" 
                                        class="w-full px-4 py-3 border border-color-89 dark:border-color-47 rounded-xl bg-white dark:bg-[#333332] text-color-14 dark:text-white focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all text-sm">
                                    <option value="professional">{{ __('Professional') }}</option>
                                    <option value="creative">{{ __('Creative') }}</option>
                                    <option value="minimal">{{ __('Minimal') }}</option>
                                    <option value="corporate">{{ __('Corporate') }}</option>
                                    <option value="educational">{{ __('Educational') }}</option>
                                </select>
                            </div>

                            {{-- Info Cards --}}
                            <div class="grid grid-cols-2 gap-3 mb-6">
                                <div class="p-3 bg-color-F6 dark:bg-[#292929] rounded-lg">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="w-6 h-6 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-500 flex items-center justify-center">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                        </span>
                                        <span class="text-xs font-medium text-color-14 dark:text-white">{{ __('Slides') }}</span>
                                    </div>
                                    <p class="text-[10px] text-color-89">{{ __('Auto-generated') }}</p>
                                </div>
                                <div class="p-3 bg-color-F6 dark:bg-[#292929] rounded-lg">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="w-6 h-6 rounded-full bg-green-100 dark:bg-green-900/30 text-green-500 flex items-center justify-center">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </span>
                                        <span class="text-xs font-medium text-color-14 dark:text-white">{{ __('Speaker Notes') }}</span>
                                    </div>
                                    <p class="text-[10px] text-color-89">{{ __('Included') }}</p>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" 
                                    id="generateBtn"
                                    class="generate-btn w-full py-3 px-4 rounded-xl text-white font-semibold text-sm flex items-center justify-center gap-2 transition-all">
                                <span class="btn-text flex items-center gap-2">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    {{ __('Generate Presentation') }}
                                </span>
                                <span class="btn-loading hidden items-center gap-2">
                                    <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ __('Generating...') }}
                                </span>
                            </button>
                            <div id="exportRow" class="hidden mt-3 grid grid-cols-2 gap-3">
                                <button type="button" id="exportPdf" class="w-full py-2 px-3 rounded-lg border border-color-89 dark:border-color-47 text-sm text-color-14 dark:text-white hover:bg-color-F6 dark:hover:bg-[#333332] transition">{{ __('Download PDF') }}</button>
                                <button type="button" id="exportJson" class="w-full py-2 px-3 rounded-lg border border-color-89 dark:border-color-47 text-sm text-color-14 dark:text-white hover:bg-color-F6 dark:hover:bg-[#333332] transition">{{ __('Download JSON') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Preview Panel --}}
                <div class="lg:w-3/5 w-full">
                    <div class="bg-white dark:bg-color-3A rounded-xl shadow-sm h-full">
                        <div class="p-4 border-b border-color-DF dark:border-color-47 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);">
                                    <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-color-14 dark:text-white">{{ __('Slide Preview') }}</h3>
                                    <p class="text-xs text-color-89" id="slideInfo"></p>
                                </div>
                            </div>
                            <div class="hidden gap-2" id="slideControls">
                                <button class="p-2 border border-color-89 dark:border-color-47 rounded-lg hover:bg-color-F6 dark:hover:bg-[#292929] transition-colors disabled:opacity-50" id="prevSlide" disabled>
                                    <svg class="w-4 h-4 text-color-89" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button class="p-2 border border-color-89 dark:border-color-47 rounded-lg hover:bg-color-F6 dark:hover:bg-[#292929] transition-colors disabled:opacity-50" id="nextSlide" disabled>
                                    <svg class="w-4 h-4 text-color-89" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-6 min-h-[400px]">
                            {{-- Empty State --}}
                            <div id="emptyState" class="flex flex-col items-center justify-center h-full py-12">
                                <div class="w-20 h-20 rounded-full bg-color-F6 dark:bg-[#292929] flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-color-89" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h4 class="text-color-14 dark:text-white font-semibold mb-2">{{ __('No Presentation Yet') }}</h4>
                                <p class="text-color-89 text-sm text-center">{{ __('Fill in the details and generate your presentation') }}</p>
                            </div>

                            {{-- Slide Content --}}
                            <div id="slideContent" class="hidden">
                                <div class="slide-card bg-color-F6 dark:bg-[#292929] border border-color-DF dark:border-color-47 rounded-xl p-5 mb-4 min-h-[250px]">
                                    <h3 id="slideTitle" class="text-lg font-bold text-purple-600 dark:text-purple-400 mb-4"></h3>
                                    <ul id="slidePoints" class="text-color-14 dark:text-white text-sm mb-4"></ul>
                                    <div id="visualSuggestion" class="mt-auto p-3 bg-white dark:bg-color-3A rounded-lg border-s-4 border-blue-500">
                                        <small class="text-color-89 block mb-1">{{ __('Visual Suggestion:') }}</small>
                                        <span id="visualText" class="text-sm text-color-14 dark:text-white"></span>
                                    </div>
                                </div>
                                <div class="bg-color-F6 dark:bg-[#292929] rounded-xl p-4 border border-color-DF dark:border-color-47">
                                    <small class="text-color-89 block mb-1 font-semibold">{{ __('Speaker Notes:') }}</small>
                                    <p id="speakerNotes" class="text-sm text-color-89"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('presentationForm');
    const generateBtn = document.getElementById('generateBtn');
    const emptyState = document.getElementById('emptyState');
    const slideContent = document.getElementById('slideContent');
    const slideControls = document.getElementById('slideControls');
    const slideInfo = document.getElementById('slideInfo');
    const prevSlide = document.getElementById('prevSlide');
    const nextSlide = document.getElementById('nextSlide');
    const exportRow = document.getElementById('exportRow');
    const exportPdf = document.getElementById('exportPdf');
    const exportJson = document.getElementById('exportJson');
    
    let slides = [];
    let currentSlideIndex = 0;
    let presentationId = null;
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const topic = document.getElementById('topic').value.trim();
        const slidesCount = document.getElementById('slides_count').value;
        const style = document.getElementById('style').value;
        
        if (!topic) {
            toastMixin.fire({ title: '{{ __("Please enter a presentation topic") }}', icon: 'error' });
            return;
        }
        
        setLoading(true);
        
        try {
            const response = await fetch('{{ route("presentation.generate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    topic: topic,
                    slides_count: parseInt(slidesCount),
                    style: style
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                slides = data.data.slides;
                presentationId = data.data.id;
                currentSlideIndex = 0;
                displaySlides();
                toastMixin.fire({ title: '{{ __("Presentation generated successfully!") }}', icon: 'success' });
            } else {
                toastMixin.fire({ title: data.message || '{{ __("An error occurred") }}', icon: 'error' });
            }
        } catch (error) {
            console.error('Error:', error);
            toastMixin.fire({ title: '{{ __("An error occurred. Please try again.") }}', icon: 'error' });
        } finally {
            setLoading(false);
        }
    });
    
    prevSlide.addEventListener('click', function() {
        if (currentSlideIndex > 0) {
            currentSlideIndex--;
            showSlide(currentSlideIndex);
        }
    });
    
    nextSlide.addEventListener('click', function() {
        if (currentSlideIndex < slides.length - 1) {
            currentSlideIndex++;
            showSlide(currentSlideIndex);
        }
    });
    
    function setLoading(loading) {
        const btnText = generateBtn.querySelector('.btn-text');
        const btnLoading = generateBtn.querySelector('.btn-loading');
        
        if (loading) {
            generateBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            btnLoading.classList.add('flex');
        } else {
            generateBtn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoading.classList.add('hidden');
            btnLoading.classList.remove('flex');
        }
    }
    
    function displaySlides() {
        emptyState.classList.add('hidden');
        slideContent.classList.remove('hidden');
        slideControls.classList.remove('hidden');
        slideControls.classList.add('flex');
        exportRow.classList.remove('hidden');
        
        showSlide(0);
    }
    
    function showSlide(index) {
        const slide = slides[index];
        
        document.getElementById('slideTitle').textContent = slide.title;
        
        const pointsList = document.getElementById('slidePoints');
        pointsList.innerHTML = '';
        
        if (Array.isArray(slide.content)) {
            slide.content.forEach(point => {
                const li = document.createElement('li');
                li.textContent = point;
                pointsList.appendChild(li);
            });
        }
        
        document.getElementById('visualText').textContent = slide.visual_suggestion || '';
        document.getElementById('speakerNotes').textContent = slide.speaker_notes || '';
        
        slideInfo.textContent = `{{ __('Slide') }} ${index + 1} {{ __('of') }} ${slides.length}`;
        
        prevSlide.disabled = index === 0;
        nextSlide.disabled = index === slides.length - 1;
    }

    function openExport(format) {
        if (!presentationId) return;
        const url = `{{ url('presentation') }}/${presentationId}/download?format=${format}`;
        window.open(url, '_blank');
    }

    exportPdf.addEventListener('click', () => openExport('pdf'));
    exportJson.addEventListener('click', () => openExport('json'));
});
</script>
@endsection
