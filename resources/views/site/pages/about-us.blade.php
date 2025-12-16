@extends('layouts.site_master')

@section('page_title', __('من نحن'))

@section('css')
<style>
    .about-hero-light {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #6B73FF 100%);
    }
    
    .dark .about-hero-light {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
    }
    
    .about-hero-light::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    
    .gradient-text {
        background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .gradient-text-light {
        background: linear-gradient(90deg, #4F46E5 0%, #7C3AED 50%, #EC4899 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Light mode cards */
    .card-light {
        background: white;
        border: 1px solid #e5e7eb;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }
    
    .dark .card-light {
        background: linear-gradient(145deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.02) 100%);
        border: 1px solid rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
    }
    
    .icon-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    /* Light mode stat cards */
    .stat-card-light {
        background: linear-gradient(145deg, #f3f4f6 0%, #ffffff 100%);
        border: 1px solid #e5e7eb;
    }
    
    .dark .stat-card-light {
        background: linear-gradient(145deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border: 1px solid rgba(102, 126, 234, 0.2);
    }
    
    .glow-effect {
        box-shadow: 0 0 60px rgba(102, 126, 234, 0.2);
    }
    
    .dark .glow-effect {
        box-shadow: 0 0 60px rgba(102, 126, 234, 0.3);
    }
    
    .floating {
        animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    .pulse-dot {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.1); }
    }
    
    /* Light mode sections */
    .section-light {
        background: #f9fafb;
    }
    
    .dark .section-light {
        background: #111827;
    }
    
    .section-white {
        background: #ffffff;
    }
    
    .dark .section-white {
        background: #030712;
    }
</style>
@endsection

@section('content')
<div class="font-Figtree">
    
    <!-- Hero Section -->
    <section class="about-hero-light min-h-[70vh] flex items-center justify-center relative overflow-hidden">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 dark:bg-purple-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-white/10 dark:bg-blue-500/20 rounded-full blur-3xl"></div>
        
        <div class="container mx-auto px-6 py-20 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 bg-white/20 dark:bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 mb-8">
                <span class="w-2 h-2 bg-green-400 rounded-full pulse-dot"></span>
                <span class="text-white text-sm font-medium">{{ __('نصنع المستقبل.. كلمة بكلمة، وبكسل ببكسل') }}</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                {{ __('نحن') }} <span class="text-yellow-300 dark:text-yellow-400">Voxcraft</span>
            </h1>
            
            <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                {{ __('استوديو إبداعي جيلُه الجديد هو الذكاء الاصطناعي') }}
            </p>
            
            <div class="flex flex-wrap justify-center gap-4 mt-12">
                <a href="{{ url('/user/register') }}" class="group inline-flex items-center gap-3 bg-white hover:bg-gray-100 text-purple-700 font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <span>{{ __('ابدأ رحلتك الآن') }}</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="section-light py-24">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <div class="inline-flex items-center gap-2 text-purple-600 dark:text-purple-400 mb-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                        <span class="font-semibold text-sm uppercase tracking-wider">{{ __('قصتنا') }}</span>
                    </div>
                    
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-8 leading-tight">
                        {{ __('هل تخيلت يوماً أن تمتلك') }}
                        <span class="gradient-text-light dark:gradient-text">{{ __('عصاً سحرية') }}</span>
                        {{ __('تحول أفكارك إلى واقع؟') }}
                    </h2>
                    
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                        {{ __('في Voxcraft Studio، حولنا هذا الخيال إلى حقيقة. بدأنا بشغف بسيط: كيف يمكن للتكنولوجيا أن تجعل القصص أكثر إلهاماً؟') }}
                    </p>
                    
                    <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                        {{ __('واليوم، نحن نقود ثورة في كيفية كتابة، تصميم، وإنتاج المحتوى الرقمي باستخدام أحدث تقنيات الذكاء الاصطناعي.') }}
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-4 md:gap-8 mt-10">
                        <div class="stat-card-light rounded-xl p-5 text-center min-w-[100px]">
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-1">+10K</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('مستخدم نشط') }}</div>
                        </div>
                        <div class="stat-card-light rounded-xl p-5 text-center min-w-[100px]">
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-1">+1M</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('محتوى مُنشأ') }}</div>
                        </div>
                        <div class="stat-card-light rounded-xl p-5 text-center min-w-[100px]">
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-1">99%</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('رضا العملاء') }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="order-1 lg:order-2 relative">
                    <div class="relative rounded-3xl overflow-hidden glow-effect bg-gradient-to-br from-purple-100 to-blue-100 dark:from-purple-600/20 dark:to-blue-600/20 p-8 flex items-center justify-center min-h-[350px]">
                        <svg class="w-40 h-40 text-purple-500 dark:text-purple-400 floating" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 bg-purple-600 rounded-2xl p-4 shadow-xl floating" style="animation-delay: 0.5s;">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    
                    <div class="absolute -bottom-4 -left-4 bg-blue-600 rounded-2xl p-4 shadow-xl floating" style="animation-delay: 1s;">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Philosophy Section -->
    <section class="section-white py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-purple-50/50 to-transparent dark:from-purple-900/10 dark:to-transparent"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center max-w-4xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 text-purple-600 dark:text-purple-400 mb-4">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold text-sm uppercase tracking-wider">{{ __('فلسفتنا') }}</span>
                </div>
                
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    <span class="gradient-text-light dark:gradient-text">Voxcraft</span> = {{ __('حرفة الصوت والتعبير') }}
                </h2>
                
                <p class="text-xl text-gray-600 dark:text-gray-400 leading-relaxed">
                    {{ __('نحن نمنح علامتك التجارية صوتاً مسموعاً وحضوراً مرئياً لا يُنسى. نمزج بين خيال الفنان ومنطق الخوارزميات لنقدم لك محتوى سابقاً لعصره.') }}
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="card-light rounded-3xl p-8 hover:transform hover:scale-105 transition-all duration-300">
                    <div class="icon-box w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('كتابة إبداعية') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ __('محتوى تسويقي وإبداعي مدعوم بالبيانات والذكاء الاصطناعي، مُصمم لجذب جمهورك وتحقيق أهدافك.') }}</p>
                    
                    <ul class="mt-6 space-y-3">
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ __('مقالات ومدونات') }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ __('نصوص إعلانية') }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ __('سكريبتات فيديو') }}</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Card 2 -->
                <div class="card-light rounded-3xl p-8 hover:transform hover:scale-105 transition-all duration-300 md:-mt-8">
                    <div class="icon-box w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('تصميم بصري') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ __('تصميم جرافيك وفنون بصرية مُولدة بالذكاء الاصطناعي، تجعل علامتك التجارية تتألق.') }}</p>
                    
                    <ul class="mt-6 space-y-3">
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ __('صور احترافية') }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ __('شعارات وهويات') }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ __('تصاميم سوشيال') }}</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Card 3 -->
                <div class="card-light rounded-3xl p-8 hover:transform hover:scale-105 transition-all duration-300">
                    <div class="icon-box w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.414a5 5 0 001.414 1.414m2.828-9.9a9 9 0 0112.728 0"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('حلول صوتية') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ __('حلول صوتية وفيديو مبتكرة تنقل رسالتك بوضوح وتأثير لا مثيل له.') }}</p>
                    
                    <ul class="mt-6 space-y-3">
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ __('تحويل النص لصوت') }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ __('بودكاست AI') }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ __('إعلانات صوتية') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-purple-600 via-purple-700 to-indigo-700 py-20 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%27100%27 height=%27100%27 viewBox=%270 0 100 100%27%3E%3Cg fill-rule=%27evenodd%27%3E%3Cg fill=%27%23ffffff%27 fill-opacity=%270.05%27%3E%3Cpath opacity=%27.5%27 d=%27M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z%27/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        </div>
        
        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                {{ __('جاهز لصناعة المستقبل؟') }}
            </h2>
            <p class="text-xl text-white/90 max-w-2xl mx-auto mb-10">
                {{ __('انضم إلى آلاف المبدعين الذين يستخدمون Voxcraft لتحويل أفكارهم إلى واقع') }}
            </p>
            
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ url('/user/register') }}" class="group inline-flex items-center gap-3 bg-white hover:bg-gray-100 text-purple-700 font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-xl">
                    <span>{{ __('أنشئ حسابك مجاناً') }}</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('site.page', ['slug' => 'contact-us']) }}" class="inline-flex items-center gap-3 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white font-semibold py-4 px-8 rounded-xl border border-white/30 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <span>{{ __('تواصل معنا') }}</span>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
