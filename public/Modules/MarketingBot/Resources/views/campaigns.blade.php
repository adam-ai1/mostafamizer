@extends('layouts.user_master')
@section('page_title', __('Campaigns'))

@section('content')
     <main class="w-[68.9%] 5xl:w-[85.9%] pt-[56px] dark:bg-[#292929] flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF">
        <div class="xl:flex h-full subscription-main bg-color-F6 dark:bg-color-29">
            <!-- Start Sidebar -->
            @include('marketingbot::layouts.sidebar')
            <!-- End Sidebar -->

            <div class="w-full max-w-[1280px] mx-auto px-5 sidebar-scrollbar xl:h-[calc(100vh-56px)] xl:overflow-auto pt-[21px] sm:pt-6 pb-[56px]">
                <div
                    class="flex flex-col gap-4 2xl:flex-row 2xl:items-center 2xl:justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <div>
                            <h1
                                class="text-color-14 text-24 font-semibold font-RedHat dark:text-white wrap-anywhere"
                            >
                                {{ __('Campaigns') }}
                            </h1>
                            <p
                                class="text-color-89 text-sm font-medium wrap-anywhere mt-1"
                            >
                                {{ __('Manage and monitor your marketing campaigns') }}
                                
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        @if($whatsappEnabled || $telegramEnabled)
                            <a
                                href="{{ $whatsappEnabled ? route('user.marketing-bot.campaigns.whatsapp-campaign.create') : route('user.marketing-bot.campaigns.telegram-campaign.create') }}"
                                class="flex items-center rounded-[6px] text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                            >
                                <svg
                                    class="size-5 me-2"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    height="20px"
                                    width="20px"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 4.5v15m7.5-7.5h-15"
                                    />
                                </svg>
                                <span>{{ __('New Campaign') }}</span>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Start KPI Cards -->
                <section
                    class="grid grid-cols-1 sm:grid-cols-2 5xl:grid-cols-4 gap-6 mb-8"
                    id="kpi-cards-section"
                >
                    <!-- KPI Cards Skeleton -->
                    <div class="kpi-cards-skeleton rounded-xl bg-white dark:bg-color-3A p-6 border border-color-89/10 animate-pulse">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-xl bg-gray-200 dark:bg-gray-700"></div>
                            <div class="h-6 w-16 rounded-xl bg-gray-200 dark:bg-gray-700"></div>
                        </div>
                        <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded mb-2"></div>
                        <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded w-3/4"></div>
                    </div>
                    <div class="kpi-cards-skeleton rounded-xl bg-white dark:bg-color-3A p-6 border border-color-89/10 animate-pulse">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-xl bg-gray-200 dark:bg-gray-700"></div>
                            <div class="h-6 w-16 rounded-xl bg-gray-200 dark:bg-gray-700"></div>
                        </div>
                        <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded mb-2"></div>
                        <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded w-3/4"></div>
                    </div>
                    <div class="kpi-cards-skeleton rounded-xl bg-white dark:bg-color-3A p-6 border border-color-89/10 animate-pulse">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-xl bg-gray-200 dark:bg-gray-700"></div>
                            <div class="h-6 w-16 rounded-xl bg-gray-200 dark:bg-gray-700"></div>
                        </div>
                        <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded mb-2"></div>
                        <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded w-3/4"></div>
                    </div>
                    <div class="kpi-cards-skeleton rounded-xl bg-white dark:bg-color-3A p-6 border border-color-89/10 animate-pulse">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-10 w-10 rounded-xl bg-gray-200 dark:bg-gray-700"></div>
                            <div class="h-6 w-16 rounded-xl bg-gray-200 dark:bg-gray-700"></div>
                        </div>
                        <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded mb-2"></div>
                        <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded w-3/4"></div>
                    </div>

                    <!-- Actual KPI Cards (Hidden initially) -->
                    <div class="kpi-cards-content hidden rounded-xl bg-white dark:bg-color-3A p-6 border border-color-89/10">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="h-10 w-10 rounded-xl bg-color-F6 dark:bg-color-47 text-color-14 dark:text-white flex items-center justify-center"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"
                                    />
                                </svg>
                            </div>
                            <div
                                class="text-xs rounded-xl bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-3 py-1.5 font-medium"
                            >
                                {{ __('30 days') }}
                            </div>
                        </div>
                        <div class="text-sm text-color-89 font-medium">
                            {{ __('Active Campaigns') }}
                        </div>
                        <div
                            class="text-3xl lg:text-4xl font-bold mt-2 text-color-14 dark:text-white"
                        >
                            {{ $active }}
                        </div>
                    </div>
                    <div class="kpi-cards-content hidden rounded-xl bg-white dark:bg-color-3A p-6 border border-color-89/10">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="h-10 w-10 rounded-xl bg-color-F6 dark:bg-color-47 text-color-14 dark:text-white flex items-center justify-center"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>
                            </div>
                            <div
                                class="text-xs rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 px-3 py-1.5 font-medium"
                            >
                            {{ __('30 days') }}
                            </div>
                        </div>
                        <div class="text-sm text-color-89 font-medium">
                            {{ __('Scheduled Campaigns') }}
                        </div>
                        <div
                            class="text-3xl lg:text-4xl font-bold mt-2 text-color-14 dark:text-white"
                        >
                            {{ $scheduled  }}
                        </div>
                    </div>
                    <div class="kpi-cards-content hidden rounded-xl bg-white dark:bg-color-3A p-6 border border-color-89/10">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="h-10 w-10 rounded-xl bg-color-F6 dark:bg-color-47 text-color-14 dark:text-white flex items-center justify-center"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"
                                    />
                                </svg>
                            </div>
                                <div
                                    class="text-xs rounded-xl bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-3 py-1.5 font-medium"
                                >
                                    {{ __('30 days') }}
                                </div>
                        </div>
                        <div class="text-sm text-color-89 font-medium">
                            {{ __('Published Campaigns') }}
                        </div>
                        <div
                            class="text-3xl lg:text-4xl font-bold mt-2 text-color-14 dark:text-white"
                        >
                            {{ $published }}
                        </div>
                    </div>
                    <div class="kpi-cards-content hidden rounded-xl bg-white dark:bg-color-3A p-6 border border-color-89/10">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="h-10 w-10 rounded-xl bg-color-F6 dark:bg-color-47 text-color-14 dark:text-white flex items-center justify-center"
                            >
                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                    ></path>
                                </svg>
                            </div>
                            <div
                                class="text-xs rounded-xl px-3 py-1.5 font-medium
                                @if($wowSuccess['trend'] === 'up') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                                @elseif($wowSuccess['trend'] === 'down') bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400
                                @else bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400 @endif"
                            >
                                @if($wowSuccess['wow_growth'] > 0)+@endif{{ $wowSuccess['wow_growth'] }}% WoW
                            </div>
                        </div>
                        <div class="text-sm text-color-89 font-medium">
                            {{ __('Success Rate') }}
                        </div>
                        <div
                            class="text-3xl lg:text-4xl font-bold mt-2 text-color-14 dark:text-white"
                        >
                            {{ $successRate }} %
                        </div>
                    </div>
                </section>
                <!-- End KPI Cards -->


                <!-- Filters and Search -->
                <div class="bg-white dark:bg-color-3A border border-color-89/10 rounded-xl px-4 sm:px-6 py-4 mb-4 transition-colors">
                    <div class="flex flex-col flex-wrap lg:flex-row lg:items-center lg:justify-between gap-4">
                        <!-- Left Section -->
                        <div class="flex flex-col lg:flex-row sm:items-center gap-4 w-full lg:w-auto">
                            <!-- Search -->
                            <div class="relative w-full lg:w-auto flex-1">
                                <svg
                                        class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-color-14 dark:text-white pointer-events-none"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                >
                                    <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>
                                <input
                                        onkeyup="searchCampaigns(this)"
                                        name="search"
                                        type="text"
                                        id="campaign-search"
                                        placeholder="{{ __('Search campaigns...') }}"
                                        class="pl-10 pr-4 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-color-14 dark:text-white focus:outline-none w-full lg:w-64 transition"
                                />
                            </div>

                            <!-- Status Filter -->
                            <div class="relative w-full lg:w-[155px] custom-select">
                                <button
                                        class="select-btn w-full flex justify-between items-center px-4 py-2.5 text-sm rounded-lg border border-color-DF dark:border-color-47 hover:border-color-89 dark:hover:border-color-89 bg-white dark:bg-color-33 text-gray-700 dark:text-gray-200 focus:outline-none transition"
                                >
                                    <span class="selected-option filter-status" data-value="all">{{ __('All Status') }}</span>
                                    <svg
                                            class="w-4 h-4 text-gray-400 dark:text-gray-300"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <ul
                                        class="select-menu absolute hidden mt-1 w-full bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-lg shadow-lg overflow-hidden z-20"
                                >
                                    <li onclick="filterCampaignsByType(this, 'status')" data-value="all" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer">{{ __('All Status')}} </li>
                                    <li onclick="filterCampaignsByType(this, 'status')" data-value="scheduled" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer">{{ __('Scheduled') }}</li>
                                    <li onclick="filterCampaignsByType(this, 'status')" data-value="published" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer">{{ __('Published') }}</li>
                                    <li onclick="filterCampaignsByType(this, 'status')" data-value="running" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer">{{ __('Active') }}</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Right Section (Buttons) -->
                        <div class="flex flex-wrap sm:flex-nowrap items-center gap-3 w-full sm:w-auto">
                            <a href="{{ route('user.marketing-bot.campaigns.campaign.export') }}"
                               class="flex items-center gap-2 px-4 py-2.5 text-sm rounded-lg whitespace-nowrap border border-color-DF dark:border-color-47 hover:border-color-89 dark:hover:border-color-89 bg-white dark:bg-color-33 text-gray-700 dark:text-gray-200 focus:outline-none transition w-full sm:w-auto justify-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                {{ __('Export CSV') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Table Container -->
                <div id="campaigns-table-container">
                    @include('marketingbot::campaigns-table')
                </div>
                
            </div>
        </div>
     </main>
@endsection

@section('js')
    <script type="text/javascript">
        let campaignRoute = "{{ route('user.marketing-bot.campaigns.index') }}";
        let editCampaignRouteTemplate = "{{ route('user.marketing-bot.campaigns.edit', ['id' => '__ID__']) }}";
        let updateCampaignRouteTemplate = "{{ route('user.marketing-bot.campaigns.update', ['id' => '__ID__']) }}";
    </script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/campaign-table-search.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/campaign.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/campaign-skeleton.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/marketing-bot-utils.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
@endsection