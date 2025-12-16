@extends('layouts.user_master')
@section('page_title', __('Telegram Groups'))

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
                                {{ __(' Telegram groups') }}
                            </h1>
                            <p
                                class="text-color-89 text-sm font-medium wrap-anywhere mt-1 max-w-md"
                            >
                                {{ __('Organize Telegram audiences to run smarter, personalized campaigns.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Start Table -->

                <!-- Filters and Search -->
                <div class="bg-white dark:bg-color-3A border border-color-89/10 rounded-xl px-4 sm:px-6 py-4 mb-4 transition-colors">
                    <div class="flex items-center ljustify-between gap-4">
                        <!-- Search -->
                        <div class="relative flex-1">
                            <div class="flex items-center relative max-w-md">
                                <svg
                                    class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-color-14 dark:text-white pointer-events-none"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input
                                    id="subscriber-search"
                                    onkeyup="searchGroups(this)"
                                    type="text"
                                    placeholder="{{ __('Search by name...') }}"
                                    class="max-w-md pl-10 pr-4 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-dark-1 dark:text-white focus:outline-none w-full transition"
                                />
                            </div>
                        </div>
                        
                        <!-- Right Section (Buttons) -->
                        <a href="{{ route('user.marketing-bot.groups.export') }}"
                            class="flex items-center gap-2 px-4 py-2.5 text-sm rounded-lg whitespace-nowrap border border-color-DF dark:border-color-47 hover:border-color-89 dark:hover:border-color-89 bg-white dark:bg-color-33 text-gray-700 dark:text-gray-200 focus:outline-none transition w-auto justify-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            {{ __('Export CSV') }}
                        </a>
                    </div>
                </div>

                <!-- Table Container -->
                <div id="groups-table-container">
                    @include('marketingbot::telegram.group-table')
                </div>

                <!-- Groups Table Skeleton -->
                @include('marketingbot::skeleton.groups-table-skeleton')
                
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/marketing-bot-utils.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/segment.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/segment-search.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/groups-skeleton.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
@endsection