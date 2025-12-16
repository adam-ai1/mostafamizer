@extends('layouts.user_master')
@section('page_title', $presentation->topic)
@section('css')
    <style>
        #slidePoints li {
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            position: relative;
            padding-inline-start: 2rem;
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
            font-size: 1.5rem;
        }
        .slide-thumbnail {
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        .slide-thumbnail:hover {
            transform: translateY(-2px);
        }
        .slide-thumbnail.active {
            border-color: #8b5cf6;
        }
        .create-btn {
            background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
        }
    </style>
@endsection
@section('content')
<div class="w-[68.9%] 7xl:w-[83.9%] dark:bg-[#292929] flex flex-col flex-1 border-s dark:border-[#474746] border-color-DF h-screen">
    <div class="subscription-main flex xl:flex-row flex-col xl:h-full md:overflow-auto sidebar-scrollbar md:h-screen overflow-x-hidden">
        <div class="lg:pt-[88px] pt-20 9xl:px-[245px] 7xl:px-[135px] 5xl:px-[67px] px-5 pb-28 overflow-auto main-content flex flex-col flex-1 font-Figtree bg-color-F6 dark:bg-[#292929] border-s dark:border-[#474746] border-color-DF">
            
            {{-- Header --}}
            <div class="bg-white dark:bg-color-3A rounded-xl shadow-sm mb-6">
                <div class="p-5 border-b border-color-DF dark:border-color-47">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);">
                                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-color-14 dark:text-white text-lg">{{ Str::limit($presentation->topic, 60) }}</h3>
                                <p class="text-color-89 text-sm">{{ $presentation->slides_count }} {{ __('Slides') }} • {{ ucfirst($presentation->style) }} • {{ $presentation->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('presentation.download', $presentation->id) }}" class="inline-flex items-center gap-2 px-4 py-2 border border-color-89 dark:border-color-47 rounded-lg text-color-14 dark:text-white hover:bg-color-F6 dark:hover:bg-[#292929] transition-colors text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                {{ __('Download') }}
                            </a>
                            <a href="{{ route('presentation.create') }}" class="create-btn inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white text-sm font-medium transition-all hover:opacity-90">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                {{ __('New Presentation') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="p-5">
                    {{-- Slide Navigation --}}
                    <div class="flex items-center justify-between mb-5">
                        <span id="slideInfo" class="text-color-89 text-sm">{{ __('Slide') }} 1 {{ __('of') }} {{ $presentation->slides_count }}</span>
                        <div class="flex gap-2">
                            <button class="inline-flex items-center gap-1.5 px-3 py-2 border border-color-89 dark:border-color-47 rounded-lg text-color-89 hover:bg-color-F6 dark:hover:bg-[#292929] transition-colors text-sm disabled:opacity-50" id="prevSlide" disabled>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                {{ __('Previous') }}
                            </button>
                            <button class="inline-flex items-center gap-1.5 px-3 py-2 border border-color-89 dark:border-color-47 rounded-lg text-color-89 hover:bg-color-F6 dark:hover:bg-[#292929] transition-colors text-sm disabled:opacity-50" id="nextSlide">
                                {{ __('Next') }}
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Slide Content --}}
                    <div class="bg-color-F6 dark:bg-[#292929] rounded-xl p-6 mb-5 min-h-[300px]">
                        <h2 id="slideTitle" class="text-xl font-bold text-purple-600 dark:text-purple-400 mb-5"></h2>
                        <ul id="slidePoints" class="text-color-14 dark:text-white text-base leading-relaxed"></ul>
                        <div id="visualSuggestion" class="mt-6 p-4 bg-white dark:bg-color-3A rounded-lg border-s-4 border-blue-500">
                            <small class="text-color-89 block mb-1 font-semibold">{{ __('Visual Suggestion:') }}</small>
                            <span id="visualText" class="text-sm text-color-14 dark:text-white"></span>
                        </div>
                    </div>

                    {{-- Speaker Notes --}}
                    <div class="bg-white dark:bg-color-3A rounded-xl p-5 border border-color-DF dark:border-color-47 mb-6">
                        <h6 class="font-bold text-color-14 dark:text-white flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            {{ __('Speaker Notes') }}
                        </h6>
                        <p id="speakerNotes" class="text-color-89 text-sm leading-relaxed"></p>
                    </div>

                    {{-- Slide Thumbnails --}}
                    <div>
                        <h6 class="font-bold text-color-14 dark:text-white mb-4">{{ __('All Slides') }}</h6>
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3" id="slideThumbnails"></div>
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
    const slides = @json($presentation->slides);
    let currentSlideIndex = 0;
    
    const prevSlide = document.getElementById('prevSlide');
    const nextSlide = document.getElementById('nextSlide');
    const slideInfo = document.getElementById('slideInfo');
    const thumbnailsContainer = document.getElementById('slideThumbnails');
    
    showSlide(0);
    renderThumbnails();
    
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
        
        document.querySelectorAll('.slide-thumbnail').forEach((thumb, i) => {
            thumb.classList.toggle('active', i === index);
        });
    }
    
    function renderThumbnails() {
        thumbnailsContainer.innerHTML = '';
        
        slides.forEach((slide, index) => {
            const div = document.createElement('div');
            div.innerHTML = `
                <div class="slide-thumbnail bg-white dark:bg-color-3A rounded-lg p-3 border border-color-DF dark:border-color-47 ${index === 0 ? 'active' : ''}" data-index="${index}">
                    <div class="text-xs text-color-89 mb-1">{{ __('Slide') }} ${index + 1}</div>
                    <div class="text-sm font-medium text-color-14 dark:text-white truncate">${slide.title}</div>
                </div>
            `;
            
            div.querySelector('.slide-thumbnail').addEventListener('click', function() {
                currentSlideIndex = index;
                showSlide(index);
            });
            
            thumbnailsContainer.appendChild(div);
        });
    }
});
</script>
@endsection
