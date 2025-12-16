@extends('layouts.user_master')
@section('page_title', __('Presentation Studio'))
@section('css')
    <style>
        .presentation-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .presentation-card:hover {
            transform: translateY(-3px);
        }
        .create-btn {
            background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
        }
        .create-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
    </style>
@endsection
@section('content')
<div class="w-[68.9%] 7xl:w-[83.9%] dark:bg-[#292929] flex flex-col flex-1 border-s dark:border-[#474746] border-color-DF h-screen">
    <div class="subscription-main flex xl:flex-row flex-col xl:h-full md:overflow-auto sidebar-scrollbar md:h-screen overflow-x-hidden">
        <div class="lg:pt-[88px] pt-20 9xl:px-[245px] 7xl:px-[135px] 5xl:px-[67px] px-5 pb-28 overflow-auto main-content flex flex-col flex-1 font-Figtree bg-color-F6 dark:bg-[#292929] border-s dark:border-[#474746] border-color-DF">
            
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-6 h-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <p class="text-color-14 text-24 font-semibold font-RedHat dark:text-white">
                            {{ __('My Presentations') }}
                        </p>
                    </div>
                    <p class="text-color-89 text-[13px] leading-5 font-medium font-Figtree">
                        {{ __('Create and manage your AI-generated presentations') }}
                    </p>
                </div>
                <a href="{{ route('presentation.create') }}" class="create-btn inline-flex items-center gap-2 px-5 py-3 rounded-xl text-white font-semibold text-sm transition-all">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    {{ __('Create Presentation') }}
                </a>
            </div>

            @if($presentations->isEmpty())
            {{-- Empty State --}}
            <div class="bg-white dark:bg-color-3A rounded-xl p-12 shadow-sm">
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="w-24 h-24 rounded-full bg-color-F6 dark:bg-[#292929] flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-color-89" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="text-color-14 dark:text-white font-semibold text-lg mb-2">{{ __('No Presentations Yet') }}</h4>
                    <p class="text-color-89 text-sm mb-6 max-w-sm">{{ __('Create your first AI-powered presentation in minutes') }}</p>
                    <a href="{{ route('presentation.create') }}" class="create-btn inline-flex items-center gap-2 px-6 py-3 rounded-xl text-white font-semibold text-sm transition-all">
                        {{ __('Create Your First Presentation') }}
                    </a>
                </div>
            </div>
            @else
            {{-- Presentations Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($presentations as $presentation)
                <div class="presentation-card bg-white dark:bg-color-3A rounded-xl p-5 shadow-sm">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-11 h-11 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);">
                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="px-3 py-1 bg-color-F6 dark:bg-[#292929] rounded-full text-xs font-medium text-color-14 dark:text-white">
                            {{ $presentation->slides_count }} {{ __('Slides') }}
                        </span>
                    </div>
                    
                    <h5 class="font-semibold text-color-14 dark:text-white mb-3 truncate" title="{{ $presentation->topic }}">
                        {{ Str::limit($presentation->topic, 50) }}
                    </h5>
                    
                    <div class="flex items-center gap-4 mb-4 text-xs text-color-89">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            {{ ucfirst($presentation->style) }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $presentation->created_at->diffForHumans() }}
                        </span>
                    </div>
                    
                    <div class="flex gap-2">
                        <a href="{{ route('presentation.show', $presentation->id) }}" class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2 border border-purple-500 text-purple-500 rounded-lg text-sm font-medium hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            {{ __('View') }}
                        </a>
                        <a href="{{ route('presentation.download', $presentation->id) }}" class="inline-flex items-center justify-center p-2 border border-color-89 dark:border-color-47 text-color-89 rounded-lg hover:bg-color-F6 dark:hover:bg-[#292929] transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6 flex justify-center">
                {{ $presentations->links() }}
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
