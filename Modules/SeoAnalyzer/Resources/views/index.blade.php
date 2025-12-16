@extends('layouts.user_master')
@section('page_title', __('SEO Analyzer'))
@section('css')
    <style>
        .seo-card {
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
        }
        .seo-icon {
            background: linear-gradient(135deg, #f97316 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .analyze-btn {
            background: linear-gradient(135deg, #f97316 0%, #f59e0b 100%);
        }
        .analyze-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        .metric-bar {
            background: linear-gradient(135deg, #f97316 0%, #f59e0b 100%);
        }
        .insights-panel {
            background: #0f172a;
            color: #e5e7eb;
            border-color: #1f2937;
        }
        .insight-card {
            background: #111827;
            color: #f9fafb;
            border-color: #1f2937;
        }
        .insight-label {
            color: #9ca3af;
        }
        .insight-note {
            color: #cbd5e1;
        }
        .prose h1, .prose h2, .prose h3, .prose h4 {
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .prose h1 { font-size: 1.5rem; font-weight: 700; }
        .prose h2 { font-size: 1.25rem; font-weight: 600; }
        .prose h3 { font-size: 1.1rem; font-weight: 600; }
        .prose p { margin-bottom: 1rem; line-height: 1.7; }
        .prose ul, .prose ol { margin-bottom: 1rem; padding-inline-start: 1.5rem; }
        .prose li { margin-bottom: 0.5rem; }
        .prose strong { font-weight: 600; }
    </style>
@endsection
@section('content')
<div class="w-[68.9%] 7xl:w-[83.9%] dark:bg-[#292929] flex flex-col flex-1 border-s dark:border-[#474746] border-color-DF h-screen">
    <div class="subscription-main flex xl:flex-row flex-col xl:h-full md:overflow-auto sidebar-scrollbar md:h-screen overflow-x-hidden">
        <div class="lg:pt-[88px] pt-20 9xl:px-[245px] 7xl:px-[135px] 5xl:px-[67px] px-5 pb-28 overflow-auto main-content flex flex-col flex-1 font-Figtree bg-color-F6 dark:bg-[#292929] border-s dark:border-[#474746] border-color-DF">
            
            {{-- Page Title --}}
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-6 h-6 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <p class="text-color-14 text-24 font-semibold font-RedHat dark:text-white">
                    {{ __('SEO Analyzer') }}
                </p>
            </div>
            <p class="text-color-89 text-[13px] leading-5 font-medium font-Figtree mb-6">
                {{ __('Get comprehensive SEO analysis and recommendations for any website.') }}
            </p>

            <div class="flex flex-col lg:flex-row gap-6">
                {{-- Input Form --}}
                <div class="lg:w-2/5 w-full">
                    <div class="bg-white dark:bg-color-3A rounded-xl p-6 shadow-sm">
                        <form id="seoForm">
                            @csrf
                            
                            {{-- URL Input --}}
                            <div class="mb-5">
                                <label for="url" class="font-Figtree text-color-14 font-medium leading-6 text-base dark:text-white flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    {{ __('Website URL') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="url" 
                                       name="url" 
                                       id="url" 
                                       class="w-full px-4 py-3 border border-color-89 dark:border-color-47 rounded-xl bg-white dark:bg-[#333332] text-color-14 dark:text-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all text-sm"
                                       placeholder="https://example.com"
                                       required>
                                <p class="text-color-89 text-xs mt-2">{{ __('Enter the full URL including https://') }}</p>
                            </div>

                            {{-- Analysis Type --}}
                            <div class="mb-5">
                                <label for="analysis_type" class="font-Figtree text-color-14 font-medium leading-6 text-base dark:text-white flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    {{ __('Analysis Type') }}
                                </label>
                                <select name="analysis_type" 
                                        id="analysis_type" 
                                        class="w-full px-4 py-3 border border-color-89 dark:border-color-47 rounded-xl bg-white dark:bg-[#333332] text-color-14 dark:text-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all text-sm">
                                    <option value="full">{{ __('Full SEO Analysis') }}</option>
                                    <option value="keywords">{{ __('Keyword Analysis') }}</option>
                                    <option value="meta">{{ __('Meta Tags Analysis') }}</option>
                                    <option value="content">{{ __('Content Analysis') }}</option>
                                    <option value="technical">{{ __('Technical SEO Analysis') }}</option>
                                </select>
                            </div>

                            {{-- Info Cards --}}
                            <div class="grid grid-cols-2 gap-3 mb-6">
                                <div class="p-3 bg-color-F6 dark:bg-[#292929] rounded-lg">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="w-6 h-6 rounded-full bg-orange-100 dark:bg-orange-900/30 text-orange-500 flex items-center justify-center">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                                        </span>
                                        <span class="text-xs font-medium text-color-14 dark:text-white">{{ __('SEO Score') }}</span>
                                    </div>
                                    <p class="text-[10px] text-color-89">{{ __('Overall SEO rating') }}</p>
                                </div>
                                <div class="p-3 bg-color-F6 dark:bg-[#292929] rounded-lg">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="w-6 h-6 rounded-full bg-green-100 dark:bg-green-900/30 text-green-500 flex items-center justify-center">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                        </span>
                                        <span class="text-xs font-medium text-color-14 dark:text-white">{{ __('Keywords') }}</span>
                                    </div>
                                    <p class="text-[10px] text-color-89">{{ __('Keyword suggestions') }}</p>
                                </div>
                                <div class="p-3 bg-color-F6 dark:bg-[#292929] rounded-lg">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-500 flex items-center justify-center">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                                        </span>
                                        <span class="text-xs font-medium text-color-14 dark:text-white">{{ __('Meta Tags') }}</span>
                                    </div>
                                    <p class="text-[10px] text-color-89">{{ __('Meta optimization') }}</p>
                                </div>
                                <div class="p-3 bg-color-F6 dark:bg-[#292929] rounded-lg">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="w-6 h-6 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-500 flex items-center justify-center">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                        </span>
                                        <span class="text-xs font-medium text-color-14 dark:text-white">{{ __('Technical') }}</span>
                                    </div>
                                    <p class="text-[10px] text-color-89">{{ __('Technical issues') }}</p>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" 
                                    id="analyzeBtn"
                                    class="analyze-btn w-full py-3 px-4 rounded-xl text-white font-semibold text-sm flex items-center justify-center gap-2 transition-all">
                                <span class="btn-text flex items-center gap-2">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    {{ __('Analyze SEO') }}
                                </span>
                                <span class="btn-loading hidden items-center gap-2">
                                    <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ __('Analyzing...') }}
                                </span>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Results Panel --}}
                <div class="lg:w-3/5 w-full">
                    <div class="bg-white dark:bg-color-3A rounded-xl shadow-sm h-full">
                        <div class="p-4 border-b border-color-DF dark:border-color-47 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #f97316 0%, #f59e0b 100%);">
                                    <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-color-14 dark:text-white">{{ __('Analysis Results') }}</h3>
                                    <p class="text-xs text-color-89" id="analysisUrl"></p>
                                </div>
                            </div>
                            <button id="copyBtn" class="hidden p-2 hover:bg-color-F6 dark:hover:bg-[#292929] rounded-lg transition-colors" onclick="copyResults()">
                                <svg class="w-5 h-5 text-color-89" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-6 min-h-[400px] max-h-[600px] overflow-y-auto sidebar-scrollbar">
                            {{-- Empty State --}}
                            <div id="emptyState" class="flex flex-col items-center justify-center h-full py-12">
                                <div class="w-20 h-20 rounded-full bg-color-F6 dark:bg-[#292929] flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-color-89" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-color-14 dark:text-white font-semibold mb-2">{{ __('No Analysis Yet') }}</h4>
                                <p class="text-color-89 text-sm text-center">{{ __('Enter a URL and click analyze to get SEO insights') }}</p>
                            </div>

                            {{-- Results Content --}}
                            <div id="resultsContent" class="hidden">
                                <div id="insightsPanel" class="space-y-4 mb-6 hidden insights-panel rounded-xl border p-4">
                                    <div class="p-4 rounded-xl border flex flex-col gap-3 bg-color-F6 dark:bg-[#2d2d2c] insights-panel">
                                        <div class="flex flex-wrap items-center gap-2 justify-between">
                                            <div>
                                                <p class="text-[11px] uppercase tracking-[0.14em] insight-label">{{ __('Quick Overview') }}</p>
                                                <p id="insightSummary" class="text-sm font-medium text-white"></p>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#0b1220] border border-color-DF dark:border-color-47 text-xs insight-note">
                                                    <span class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_0_4px_rgba(16,185,129,0.12)]"></span>
                                                    {{ __('AI insights refreshed') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-3 text-white">
                                            <div class="p-3 rounded-lg border insight-card">
                                                <p class="text-[11px] uppercase tracking-[0.14em] insight-label">{{ __('SEO Score') }}</p>
                                                <div class="flex items-end justify-between mt-2">
                                                    <div class="text-2xl font-bold" id="scoreValue">0</div>
                                                    <div class="w-16 h-2 bg-color-F6 dark:bg-[#2d2d2c] rounded-full overflow-hidden">
                                                        <div id="scoreBar" class="h-full metric-bar rounded-full" style="width: 0%"></div>
                                                    </div>
                                                </div>
                                                <p class="text-[11px] insight-label mt-1">{{ __('Composite heuristic score') }}</p>
                                            </div>
                                            <div class="p-3 rounded-lg border insight-card">
                                                <p class="text-[11px] uppercase tracking-[0.14em] insight-label">{{ __('Content Depth') }}</p>
                                                <div class="flex items-end justify-between mt-2">
                                                    <div class="text-xl font-semibold" id="contentValue">0%</div>
                                                    <div class="w-16 h-2 bg-color-F6 dark:bg-[#2d2d2c] rounded-full overflow-hidden">
                                                        <div id="contentBar" class="h-full metric-bar rounded-full" style="width: 0%"></div>
                                                    </div>
                                                </div>
                                                <p class="text-[11px] insight-note mt-1" id="keywordsBadge"></p>
                                            </div>
                                            <div class="p-3 rounded-lg border insight-card">
                                                <p class="text-[11px] uppercase tracking-[0.14em] insight-label">{{ __('Technical Health') }}</p>
                                                <div class="flex items-end justify-between mt-2">
                                                    <div class="text-xl font-semibold" id="technicalValue">0%</div>
                                                    <div class="w-16 h-2 bg-color-F6 dark:bg-[#2d2d2c] rounded-full overflow-hidden">
                                                        <div id="technicalBar" class="h-full metric-bar rounded-full" style="width: 0%"></div>
                                                    </div>
                                                </div>
                                                <p class="text-[11px] insight-note mt-1" id="issuesBadge"></p>
                                            </div>
                                            <div class="p-3 rounded-lg border insight-card">
                                                <p class="text-[11px] uppercase tracking-[0.14em] insight-label">{{ __('Action Items') }}</p>
                                                <div class="flex items-center gap-3 mt-2">
                                                    <div class="text-xl font-semibold" id="actionsValue">0</div>
                                                    <div class="flex-1 h-2 bg-color-F6 dark:bg-[#2d2d2c] rounded-full overflow-hidden">
                                                        <div id="actionsBar" class="h-full metric-bar rounded-full" style="width: 0%"></div>
                                                    </div>
                                                </div>
                                                <p class="text-[11px] insight-note mt-1">{{ __('Counted from recommendations') }}</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap gap-2" id="sectionTags"></div>
                                    </div>
                                </div>
                                <div id="analysisResults" class="prose text-color-14 dark:text-white text-sm leading-relaxed"></div>
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
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('seoForm');
    const analyzeBtn = document.getElementById('analyzeBtn');
    const emptyState = document.getElementById('emptyState');
    const resultsContent = document.getElementById('resultsContent');
    const analysisResults = document.getElementById('analysisResults');
    const analysisUrl = document.getElementById('analysisUrl');
    const copyBtn = document.getElementById('copyBtn');
    
    let currentAnalysis = '';
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const url = document.getElementById('url').value.trim();
        const analysisType = document.getElementById('analysis_type').value;
        
        if (!url) {
            toastMixin.fire({ title: '{{ __("Please enter a valid URL") }}', icon: 'error' });
            return;
        }
        
        setLoading(true);
        
        try {
            const response = await fetch('{{ route("seo-analyzer.analyze") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    url: url,
                    analysis_type: analysisType
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                currentAnalysis = data.data.analysis;
                displayResults(data.data);
                toastMixin.fire({ title: '{{ __("Analysis completed successfully") }}', icon: 'success' });
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
    
    function setLoading(loading) {
        const btnText = analyzeBtn.querySelector('.btn-text');
        const btnLoading = analyzeBtn.querySelector('.btn-loading');
        
        if (loading) {
            analyzeBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            btnLoading.classList.add('flex');
        } else {
            analyzeBtn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoading.classList.add('hidden');
            btnLoading.classList.remove('flex');
        }
    }
    
    function displayResults(data) {
        emptyState.classList.add('hidden');
        resultsContent.classList.remove('hidden');
        copyBtn.classList.remove('hidden');
        
        analysisUrl.textContent = data.url;
        
        const htmlContent = marked.parse(data.analysis);
        analysisResults.innerHTML = htmlContent;

        updateInsights(data.analysis);
    }
    
    window.copyResults = function() {
        if (currentAnalysis) {
            navigator.clipboard.writeText(currentAnalysis).then(() => {
                toastMixin.fire({ title: '{{ __("Results copied to clipboard") }}', icon: 'success' });
            });
        }
    };

    function updateInsights(markdown) {
        const insightsPanel = document.getElementById('insightsPanel');
        const insightSummary = document.getElementById('insightSummary');
        const sectionTags = document.getElementById('sectionTags');
        const summary = deriveMetrics(markdown);

        insightsPanel.classList.remove('hidden');

        setBar('scoreValue', 'scoreBar', summary.score);
        setBar('contentValue', 'contentBar', summary.contentScore, '%');
        setBar('technicalValue', 'technicalBar', summary.technicalScore, '%');
        setBar('actionsValue', 'actionsBar', summary.actionItems, '');

        insightSummary.textContent = summary.summary || '{{ __('Analysis summary extracted from report') }}';
        document.getElementById('keywordsBadge').textContent = summary.keywords > 0 ? `${summary.keywords} {{ __('keyword mentions') }}` : '{{ __('Keywords not highlighted yet') }}';
        document.getElementById('issuesBadge').textContent = summary.headings > 0 ? `${summary.headings} {{ __('sections reviewed') }}` : '{{ __('Add structured sections') }}';

        sectionTags.innerHTML = '';
        summary.sections.slice(0, 8).forEach(section => {
            const tag = document.createElement('span');
            tag.className = 'px-3 py-1 rounded-full text-xs bg-white dark:bg-[#1f1f1f] border border-color-DF dark:border-color-47 text-color-14 dark:text-white flex items-center gap-2';
            tag.innerHTML = `<span class="w-2 h-2 rounded-full bg-orange-500"></span>${section}`;
            sectionTags.appendChild(tag);
        });
    }

    function deriveMetrics(markdown) {
        const bulletMatches = markdown.match(/(^|\n)[\-\*]\s+/g) || [];
        const headingMatches = markdown.match(/^#{1,6}\s+.+/gm) || [];
        const keywordMatches = markdown.match(/\bkeyword(s)?\b/gi) || [];
        const plainText = markdown.replace(/`[^`]*`/g, '');
        const firstLongLine = plainText.split('\n').find(line => line.trim().length > 60) || '';

        const score = Math.min(100, Math.round(55 + headingMatches.length * 3 + bulletMatches.length * 2));
        const contentScore = Math.min(100, Math.round(50 + keywordMatches.length * 5 + bulletMatches.length));
        const technicalScore = Math.min(100, Math.round(50 + bulletMatches.length * 2));

        return {
            score,
            contentScore,
            technicalScore,
            actionItems: bulletMatches.length,
            keywords: keywordMatches.length,
            headings: headingMatches.length,
            summary: firstLongLine.trim().slice(0, 220),
            sections: headingMatches.map(h => h.replace(/^#+\s*/, '')).filter(Boolean)
        };
    }

    function setBar(valueId, barId, value, suffix = '') {
        const valueEl = document.getElementById(valueId);
        const barEl = document.getElementById(barId);
        valueEl.textContent = `${value}${suffix}`;
        const width = Math.min(100, value);
        barEl.style.width = `${width}%`;
    }
});
</script>
@endsection
