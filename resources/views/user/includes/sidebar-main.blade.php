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
    $menus = ['features' => [], 'history' => [], 'common' => []];
    foreach ($allMenus['features'] as $item) {
        if ($item['access']) {
            $menus[$item['type'] === 'feature' ? 'features' : ($item['type'] === 'history' ? 'history' : 'common')][] = $item;
        }
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
        <div class="sidebar-links sidebar-accordion middle-sidebar-scroll overflow-y-scroll">
            <ul class="mt-3">
                {{-- Render all menu groups --}}
                @foreach (['features', 'history', 'common'] as $type)
                    @if(count($menus[$type]) > 0)
                        @if(!$loop->first)
                            <li class="w-[52px] div-border border dark:border-[#474746] border-t border-color-DF ml-5 my-3.5"></li>
                        @endif
                        
                        @foreach ($menus[$type] as $item)
                            <li>
                                <a href="{{ $item['route'] }}">
                                    <div class="{{ $item['menu']['class'] }} main-menu flex items-center gap-3 w-full py-3 pl-5 pr-[15px] text-left text-color-14 text-base leading-6 font-normal menus-height">
                                        {!! $item['icon'] !!}
                                        <p class="transion-hide accordion-menus">
                                            <span class="dark:text-white">{{ $item['name'] }}</span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
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
