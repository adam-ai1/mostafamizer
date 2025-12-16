<link rel="stylesheet" href="{{ asset('public/assets/css/user/sidebar.min.css') }}">
<div id="overlay" class="fixed z-[90] top-0 left-0 bg-darken-4"></div>
@php
    $subscription = Modules\Subscription\Entities\PackageSubscription::with(['package'])->where('user_id', Auth::user()->id)->first();

    if ($subscription != NULL) {
        $subscriptionMeta = Modules\Subscription\Entities\PackageSubscriptionMeta::where('package_subscription_id', $subscription->id)->where('type', 'feature_word')->get();
        $creditLimit = $subscriptionMeta->where('key', 'value')->first()->value;
        $creditUsed = $subscriptionMeta->where('key', 'usage')->first()->value;
        $creditPercentage = $creditLimit == 0 ? 0 : round( (($creditLimit  - $creditUsed) * 100) / $creditLimit );
    }
    
    $currentPackage = session()->get('memberPackageData');
    $sessionUserId = $currentPackage['packageUser'] ?? auth()->user()->id;

    $allMenus = (new \Modules\OpenAI\Services\ContentService())->allFeatures(['slug' => request('slug'), 'id' => request('id')]);
    $dashboard = $allMenus['dashboard'];
    $voxchat = $allMenus['voxchat'] ?? null;

    $categorizedMenus = [];
    $categoryOrder = $allMenus['category_order'] ?? [
        'Content Creation',
        'Content Analysis',
        'Visual Studio',
        'Video Studio',
        'Voice & Audio',
        'AI Conversational Tools',
        'Marketing Tools',
        'AI Influencer',
        'System Management',
        'Other'
    ];

    foreach ($allMenus['features'] as $item) {
        $category = $item['category'] ?? 'Other';
        $categorizedMenus[$category][] = $item;
    }

@endphp
<nav id="sidenav"
    class="md:pt-14 h-screen sidebar-nav md:sticky z-[100] md:z-50 top-0 left-0 w-[270px] text-color-14 flex flex-col font-Figtree">
    <div class="sidebar-bg-white h-full py-3.5 flex flex-col">
        <div class="sidebar-top relative flex items-center pl-5 dark:border-[#474746] top-option py-3.5 {{ $dashboard['menu']['class'] }} main-menu menus-height">
            <a href="{{ $dashboard['route'] }}" class="flex w-full gap-3 items-center">
                {!! $dashboard['icon'] !!}

                <p class="transion-hide text-base leading-[24px] font-normal text-color-14">
                    <span class="dark:text-white">{{ $dashboard['name'] }}</span>
                </p>
            </a>
            <span class="shrink-btn absolute top-[50%] opacity-1 right-3.5 cursor-pointer hidden md:block">
                <svg class="dark:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none">
                    <rect width="24" height="24" rx="4" fill="#141414" />
                    <g clip-path="url(#clip0_344_741)">
                        <path
                            d="M9.95841 7.91675H12.5834L9.66674 12.0001L12.5834 16.0834H9.95841L7.04174 12.0001L9.95841 7.91675Z"
                            fill="white" />
                        <path
                            d="M15.0417 7.91675H17.6667L14.7501 12.0001L17.6667 16.0834H15.0417L12.1251 12.0001L15.0417 7.91675Z"
                            fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0_344_741">
                            <rect width="14" height="14" fill="white" transform="matrix(-1 0 0 1 19 5)" />
                        </clipPath>
                    </defs>
                </svg>
                <svg class="hidden dark:block neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none">
                    <rect width="24" height="24" rx="4" fill="white" />
                    <g clip-path="url(#clip0_435_902)">
                        <path
                            d="M9.95841 7.91675H12.5834L9.66674 12.0001L12.5834 16.0834H9.95841L7.04174 12.0001L9.95841 7.91675Z"
                            fill="#141414" />
                        <path
                            d="M15.0417 7.91675H17.6667L14.7501 12.0001L17.6667 16.0834H15.0417L12.1251 12.0001L15.0417 7.91675Z"
                            fill="#141414" />
                    </g>
                    <defs>
                        <clipPath id="clip0_435_902">
                            <rect width="14" height="14" fill="white" transform="matrix(-1 0 0 1 19 5)" />
                        </clipPath>
                    </defs>
                </svg>
            </span>

            <div class="close shrink-btn absolute top-[50%] opacity-1 right-3.5 cursor-pointer md:hidden">
                <svg class="dark:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect width="24" height="24" rx="4" fill="#141414" />
                    <g clip-path="url(#clip0_344_741)">
                        <path
                            d="M9.95841 7.91675H12.5834L9.66674 12.0001L12.5834 16.0834H9.95841L7.04174 12.0001L9.95841 7.91675Z"
                            fill="white" />
                        <path
                            d="M15.0417 7.91675H17.6667L14.7501 12.0001L17.6667 16.0834H15.0417L12.1251 12.0001L15.0417 7.91675Z"
                            fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0_344_741">
                            <rect width="14" height="14" fill="white" transform="matrix(-1 0 0 1 19 5)" />
                        </clipPath>
                    </defs>
                </svg>
                <svg class="hidden dark:block neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none">
                    <rect width="24" height="24" rx="4" fill="white" />
                    <g clip-path="url(#clip0_435_902)">
                        <path
                            d="M9.95841 7.91675H12.5834L9.66674 12.0001L12.5834 16.0834H9.95841L7.04174 12.0001L9.95841 7.91675Z"
                            fill="#141414" />
                        <path
                            d="M15.0417 7.91675H17.6667L14.7501 12.0001L17.6667 16.0834H15.0417L12.1251 12.0001L15.0417 7.91675Z"
                            fill="#141414" />
                    </g>
                    <defs>
                        <clipPath id="clip0_435_902">
                            <rect width="14" height="14" fill="white" transform="matrix(-1 0 0 1 19 5)" />
                        </clipPath>
                    </defs>
                </svg>
            </div>
        </div>
        
        {{-- VoxChat - Standalone menu item --}}
        @if($voxchat)
        <div class="voxchat-menu relative flex items-center pl-5 dark:border-[#474746] py-2.5 {{ $voxchat['menu']['class'] }} main-menu">
            <a href="{{ $voxchat['route'] }}" class="flex w-full gap-3 items-center group">
                {!! $voxchat['icon'] !!}
                <div class="transion-hide flex items-center gap-2">
                    <span class="text-base leading-[24px] font-normal text-color-14 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                        {{ $voxchat['name'] }}
                    </span>
                    @if(isset($voxchat['isNew']) && $voxchat['isNew'])
                    <span class="new-badge inline-flex items-center gap-1 px-1.5 py-0.5 bg-gradient-to-r from-[#7c3aed] to-[#a855f7] text-white text-[10px] font-semibold rounded-full shadow-sm">
                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        {{ __('New') }}
                    </span>
                    @endif
                </div>
                <span class="transion-hide text-xs text-gray-400 dark:text-gray-500 mr-auto">{{ $voxchat['description'] ?? '' }}</span>
            </a>
        </div>
        @endif
        
        <div class="sidebar-links sidebar-accordion middle-sidebar-scroll overflow-y-scroll">
            <ul class="mt-3">
                {{-- Render all menu groups --}}
                @php
                    // Check for NEW items in each category
                    $categoryHasNew = [];
                    foreach ($categorizedMenus as $cat => $items) {
                        $categoryHasNew[$cat] = false;
                        foreach ($items as $item) {
                            if (isset($item['isNew']) && $item['isNew']) {
                                $categoryHasNew[$cat] = true;
                                break;
                            }
                        }
                    }
                    
                    // Build category icons array from dynamic categories
                    $categoryIcons = [];
                    if (isset($allMenus['categories'])) {
                        foreach ($allMenus['categories'] as $category) {
                            $categoryIcons[$category['name']] = $category['icon'];
                        }
                    } else {
                        // Fallback to hardcoded icons if categories not available
                        $categoryIcons = [
                            'Content Creation' => '<span class="h-5 w-5 category-svg text-color-14 dark:text-white transition-colors duration-200"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></span>',
                            'Content Analysis' => '<span class="h-5 w-5 category-svg text-color-14 dark:text-white transition-colors duration-200"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></span>',
                            'Visual Studio' => '<span class="h-5 w-5 category-svg text-color-14 dark:text-white transition-colors duration-200"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></span>',
                            'Video Studio' => '<span class="h-5 w-5 category-svg text-color-14 dark:text-white transition-colors duration-200"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></span>',
                            'Voice & Audio' => '<span class="h-5 w-5 category-svg text-color-14 dark:text-white transition-colors duration-200"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/></svg></span>',
                            'AI Conversational Tools' => '<span class="h-5 w-5 category-svg text-color-14 dark:text-white transition-colors duration-200"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg></span>',
                            'Marketing Tools' => '<span class="h-5 w-5 category-svg text-color-14 dark:text-white transition-colors duration-200"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg></span>',
                            'AI Influencer' => '<span class="h-5 w-5 category-svg text-color-14 dark:text-white transition-colors duration-200"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>',
                            'System Management' => '<span class="h-5 w-5 category-svg text-color-14 dark:text-white transition-colors duration-200"><svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg></span>',
                        ];
                    }
                @endphp
                
                @foreach ($categoryOrder as $category)
                    @if(isset($categorizedMenus[$category]) && count($categorizedMenus[$category]) > 0)
                        @php
                            $hasNewItems = isset($categoryHasNew[$category]) && $categoryHasNew[$category];
                        @endphp
                        <li class="mb-1" data-category="{{ $category }}">
                            <button class="category-header relative flex items-center justify-center w-full pl-5 pr-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 group" onclick="toggleSidebarCategory(this)" data-category-name="{{ $category }}">
                                <div class="flex items-center gap-3 flex-1 min-w-0">
                                    {!! $categoryIcons[$category] ?? '' !!}
                                    <div class="transion-hide flex items-center gap-2 flex-1 min-w-0">
                                        <span class="truncate text-base leading-[24px] font-normal text-color-14 dark:text-white" title="{{ __($category) }}">
                                            {{ __($category) }}
                                        </span>
                                        @if($hasNewItems)
                                            <span class="new-badge inline-flex items-center px-1.5 py-0.5 bg-[#E22861] text-white text-[10px] font-semibold rounded flex-shrink-0">
                                                {{ __('New') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <svg class="category-arrow w-4 h-4 transition-transform duration-300 text-gray-400 dark:text-gray-500 flex-shrink-0 transion-hide" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <ul class="category-items overflow-hidden transition-all duration-300 ease-in-out" style="max-height: 0px;">
                                @foreach ($categorizedMenus[$category] as $item)
                                    <li>
                                        <a href="{{ $item['route'] }}" class="block group/item">
                                            <div class="{{ $item['menu']['class'] }} main-menu flex items-center gap-3 w-full py-2.5 pl-12 pr-4 text-sm text-gray-600 dark:text-gray-400 rounded-lg mx-2 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
                                                <span class="flex-shrink-0">
                                                    {!! $item['icon'] !!}
                                                </span>
                                                
                                                <span class="transion-hide accordion-menus flex-1 font-medium dark:text-gray-300">
                                                    {{ $item['name'] }}
                                                </span>
                                                
                                                @php
                                                    // Check if item should show NEW badge
                                                    // JavaScript will handle hiding based on localStorage
                                                    $shouldShowNewBadge = isset($item['isNew']) && $item['isNew'];
                                                @endphp
                                                
                                                @if($shouldShowNewBadge)
                                                    <div class="relative flex items-center group/new-badge">
                                                        <span class="new-badge inline-flex items-center gap-1 px-1.5 py-0.5 bg-gradient-to-r from-[#E22861]/15 to-[#FCCA19]/15 dark:from-[#E22861]/25 dark:to-[#FCCA19]/25 text-[#E22861] dark:text-[#FCCA19] text-[10px] font-semibold rounded-full border border-[#E22861]/40 dark:border-[#FCCA19]/40 transition-all hover:scale-105 shadow-sm" data-item-id="{{ $item['id'] ?? '' }}">
                                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                            </svg>
                                                            {{ __('New') }}
                                                            <!-- Tooltip -->
                                                            <div class="absolute right-0 bottom-full mb-2 opacity-0 invisible group-hover/new-badge:opacity-100 group-hover/new-badge:visible bg-gradient-to-br from-[#fdf6ee] to-[#fef3e8] dark:from-[#242830] dark:to-[#2a2f3a] border border-[#f6e7cc] dark:border-[#393f4d] text-gray-900 dark:text-amber-100 text-xs rounded-lg py-2 px-3 shadow-xl whitespace-nowrap z-50 transition-all duration-200 pointer-events-auto">
                                                                {{ __('What\'s New') }}: {{ $item['description'] ?? $item['name'] }}
                                                                <div class="absolute top-full right-3 -mt-1 w-2 h-2 bg-[#fdf6ee] dark:bg-[#242830] border border-[#f6e7cc] dark:border-[#393f4d] transform rotate-45"></div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                @endif
                                                
                                                @if(isset($item['access']) && $item['access'] === false)
                                                    <div class="lock-badge relative flex items-center group">
                                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-gradient-to-r from-amber-100 to-amber-50 dark:from-[#23272f] dark:to-[#2a2e36] text-amber-700 dark:text-amber-200 text-xs font-semibold rounded-full border border-amber-200 dark:border-[#4c5363] transition-all hover:scale-105 shadow-sm">
                                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                                            </svg>
                                                            <!-- Tooltip -->
                                                            <div class="absolute right-0 bottom-full mb-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible bg-gradient-to-br from-[#fdf6ee] to-[#fef3e8] dark:from-[#242830] dark:to-[#2a2f3a] border border-[#f6e7cc] dark:border-[#393f4d] text-gray-900 dark:text-amber-100 text-xs rounded-lg py-2 px-3 shadow-xl whitespace-nowrap z-50 transition-all duration-200 pointer-events-auto">
                                                                {{ __('Upgrade to unlock this feature') }}
                                                                <div class="absolute top-full right-3 -mt-1 w-2 h-2 bg-[#fdf6ee] dark:bg-[#242830] border border-[#f6e7cc] dark:border-[#393f4d] transform rotate-45"></div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                    </li>  
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
            @if($subscription != NULL && in_array($subscription->status, ['Active', 'Cancel']))
            
                @if (auth()->user()->id == $sessionUserId)
                <div class="bg-color-F6 dark:bg-[#434241] border border-color-DF dark:border-color-47 rounded-xl p-4 mx-5 mt-3 mb-7 plan-card">
                    <div class="flex justify-start items-cetner gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <g clip-path="url(#clip0_5419_1957)">
                            <path d="M12.419 6.22813C12.327 6.08513 12.169 6.00014 12 6.00014H8.50006V0.500211C8.50006 0.264215 8.33506 0.0602174 8.10407 0.0112181C7.86907 -0.0387812 7.63907 0.0822171 7.54307 0.297214L3.54313 9.29709C3.47413 9.45109 3.48913 9.63109 3.58113 9.77208C3.67313 9.91408 3.83112 10.0001 4.00012 10.0001H7.50007V15.5C7.50007 15.736 7.66507 15.94 7.89607 15.989C7.93107 15.996 7.96607 16 8.00007 16C8.19407 16 8.37506 15.887 8.45706 15.703L12.457 6.70313C12.525 6.54813 12.512 6.37013 12.419 6.22813Z" fill="url(#paint0_linear_5419_1957)"/>
                            </g>
                            <defs>
                            <linearGradient id="paint0_linear_5419_1957" x1="9.35152" y1="14.0307" x2="2.06253" y2="4.77849" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#E60C84"/>
                            <stop offset="1" stop-color="#FFCF4B"/>
                            </linearGradient>
                            <clipPath id="clip0_5419_1957">
                            <rect width="16" height="16" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                        <p class="text-color-14 dark:text-white text-sm font-semibold font-Figtree">{{ optional($subscription->package)->name }}</p>
                    </div>
                    <p class="text-color-14 dark:text-white font-Figtree font-normal text-sm mt-2.5">
                        {!! __('You have :x words left in your :y plan', [ 'x' =>  '<span class="total-word-used text-[#E22861] dark:text-[#FCCA19]">' . (ceil($creditUsed)) . '</span>' .  '<span class="credit-limit text-[#E22861] dark:text-[#FCCA19]">/' . ($creditLimit == -1 ? __('Unlimited') : $creditLimit) . '</span>', 'y' => ($subscription->billing_cycle == 'days' ? $subscription->duration . ' ' : '') . $subscription->billing_cycle ]) !!}
                    </p>
                    <div
                        class="relative h-1 w-full bg-white dark:bg-color-3A rounded-[25px] border border-color-DF dark:border-color-47 mt-3">
                        <div
                            class="progress-fill absolute h-1 rounded-[60px] w-[30%]" style="width: {{ ($creditLimit == -1) ? 0 : ((100 - $creditPercentage) > 100 ? 100 : (100 - $creditPercentage)) }}%">
                        </div>
                    </div>
                    <a
                    class="magic-bg rounded-xl text-[13px] text-white justify-center items-center font-semibold py-2 w-full mx-auto flex text-center mt-4 cursor-pointer font-Figtree" href="{{ route('frontend.pricing') }}">
                        <span>
                            {{ __('Upgrade') }}
                        </span>
                    </a>
                </div>
                @endif
            @else
                {{-- No Subscription: Show Upgrade Prompt --}}
                @if (auth()->user()->id == $sessionUserId)
                <div class="bg-color-F6 dark:bg-[#434241] border border-color-DF dark:border-color-47 rounded-xl p-4 mx-5 mt-3 mb-7 plan-card">
                    <div class="flex justify-start items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <g clip-path="url(#clip0_no_sub)">
                            <path d="M12.419 6.22813C12.327 6.08513 12.169 6.00014 12 6.00014H8.50006V0.500211C8.50006 0.264215 8.33506 0.0602174 8.10407 0.0112181C7.86907 -0.0387812 7.63907 0.0822171 7.54307 0.297214L3.54313 9.29709C3.47413 9.45109 3.48913 9.63109 3.58113 9.77208C3.67313 9.91408 3.83112 10.0001 4.00012 10.0001H7.50007V15.5C7.50007 15.736 7.66507 15.94 7.89607 15.989C7.93107 15.996 7.96607 16 8.00007 16C8.19407 16 8.37506 15.887 8.45706 15.703L12.457 6.70313C12.525 6.54813 12.512 6.37013 12.419 6.22813Z" fill="url(#paint0_linear_no_sub)"/>
                            </g>
                            <defs>
                            <linearGradient id="paint0_linear_no_sub" x1="9.35152" y1="14.0307" x2="2.06253" y2="4.77849" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#E60C84"/>
                            <stop offset="1" stop-color="#FFCF4B"/>
                            </linearGradient>
                            <clipPath id="clip0_no_sub">
                            <rect width="16" height="16" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                        <p class="text-color-14 dark:text-white text-sm font-semibold font-Figtree">{{ __('No Active Plan') }}</p>
                    </div>
                    <p class="text-color-14 dark:text-white font-Figtree font-normal text-sm mt-2.5">
                        {{ __('Upgrade to unlock all premium features and remove limits.') }}
                    </p>
                    <a
                    class="magic-bg rounded-xl text-[13px] text-white justify-center items-center font-semibold py-2 w-full mx-auto flex text-center mt-4 cursor-pointer font-Figtree" href="{{ route('user.package') }}">
                        <span>
                            {{ __('Choose a Plan') }}
                        </span>
                    </a>
                </div>
                @endif
            @endif
        </div>
        <div class="sidebar-footer relative mt-auto">
            <div class="w-[52px] div-border border dark:border-[#474746] border-t border-color-DF ml-5 my-3.5">
            </div>
            <div class="flex items-center h-[52px] justify-start pl-5 w-full bottom-0 dash-switch">
                <label for="switch" class="flex items-center cursor-pointer"> 
                    <div class="relative">
                        <input type="checkbox" id="switch" class="sr-only" {{ \Cookie::get('theme_preference') == 'dark' ? 'checked' : '' }} >
                        <div
                            class="block bg-color-DF dark:bg-[#FF774B] border border-color-89 dark:border-[#FF774B] w-9 h-5 rounded-full">
                        </div>
                        <div class="dot absolute left-[2px] top-[2px] bg-white w-4 h-4 rounded-full transition"></div>
                    </div>
                    <div class="ml-3 transion-hide text-color-14 font-normal text-base leading-6 theme-swticher-rtl">
                        <span class="dark:text-[#333332] dark:hidden">{{ __('Dark Mode') }}</span>
                        <span class="dark:text-white text-white dark:flex hidden">{{ __('Light Mode') }}</span>
                    </div>
                </label>
            </div>
        </div>
    </div>
</nav>
