@extends('layouts.user_master')
@section('page_title', __('Segments'))

@section('content')

    <main class="w-[68.9%] 5xl:w-[85.9%] pt-[56px] dark:bg-[#292929] flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF">
        <div class="xl:flex h-full subscription-main bg-color-F6 dark:bg-color-29">
            <!-- Start Sidebar -->
        @include('marketingbot::layouts.sidebar')
        <!-- End Sidebar -->
            <div
                    class="w-full max-w-[1280px] mx-auto px-5 sidebar-scrollbar xl:h-[calc(100vh-56px)] xl:overflow-auto pt-[21px] sm:pt-6 pb-[56px]">
                <div
                        class="flex flex-col gap-4 2xl:flex-row 2xl:items-center 2xl:justify-between mb-8"
                >
                    <div class="flex items-center gap-4">
                        <div>
                            <h1
                                    class="text-color-14 text-24 font-semibold font-RedHat dark:text-white wrap-anywhere"
                            >
                                {{ __('Segments') }}
                            </h1>
                            <p
                                    class="text-color-89 text-sm font-medium wrap-anywhere mt-1 max-w-md"
                            >
                                {{ __('Group Segments and run campaigns that reach the right audience.') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <a
                                href="#"
                                data-target="modal1"
                                class="openModalBtn flex items-center rounded-[6px] text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
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
                            <span>{{ __('Add Segment') }}</span>
                        </a>

                        <!-- Start Add Segment Modal  -->
                        <div
                                id="modal1"
                                class="sweet-modal fixed inset-0 hidden bg-color-14/50 backdrop-blur-[4px] flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 p-4"
                        >
                            <!-- Modal Box -->
                            <div
                                    class="modalBox max-w-[600px] bg-white dark:bg-color-3A rounded-xl py-7 relative transform transition-all duration-300 scale-0 opacity-0"
                            >
                                <!-- Add Segment Form -->
                                <form id="addSegmentForm" class="px-7" action="{{ route('user.marketing-bot.segments.store') }}" method="POST">
                                    @csrf
                                    <h5
                                            class="text-lg text-color-14 dark:text-white text-left font-medium mb-0.5"
                                    >
                                        {{ __('Create a Segment') }}
                                    </h5>
                                    <p class="text-xs text-color-89 text-left font-medium mb-5">
                                        {{ __('Create a new segment for your whatsapp.') }}
                                    </p>
                                    <div class="relative z-5 w-full flex flex-col mb-3">
                                        <input
                                                type="text"
                                                name="segment_name"
                                                required
                                                placeholder="{{ __('Enter segment name') }}"
                                                class="form-control max-h-[200px] min-w-[320px] p-3 dark:bg-color-33 dark:border-color-47 text-sm font-normal text-left focus:outline-none active:outline-none hover:border-gray-1 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 dark:text-white w-full bg-color-F6 rounded-xl border border-color-DF text-color-89 mb-2"
                                        >
                                        <div id="segment_name_error" class="text-red-500 text-xs mb-3 hidden"></div>
                                    </div>
                                    <div class="flex gap-4">
                                        <button type="button" class="closeModalBtn flex items-center justify-center w-full rounded-[6px] text-[15px] text-center bg-color-14 hover:shadow-lg text-white px-5 py-2 font-medium hover:opacity-90 transition-all duration-200">
                                            <span>{{ __('Cancel') }}</span>
                                        </button>
                                        <!-- Add Segment Modal Save button -->
                                        <button type="submit" class="flex items-center justify-center w-full rounded-[6px] text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2 font-medium hover:opacity-90 transition-all duration-200">
                                            <span>{{ __('Save') }}</span>
                                            <svg class="loader animate-spin h-5 w-5 ml-2 hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Add Segment Modal  -->
                    </div>
                </div>

                <!-- Start Table -->

                <!-- Filters and Search -->
                <div class="bg-white dark:bg-color-3A border border-color-89/10 rounded-xl px-4 sm:px-6 py-4 mb-4 transition-colors">
                    <div class="flex items-center justify-between gap-4">
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
                                        type="text"
                                        id="searchInput"
                                        onkeyup="searchSegments(this)"
                                        placeholder="{{ __('Search by name...') }}"
                                        class="max-w-md pl-10 pr-4 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-dark-1 dark:text-white focus:outline-none w-full transition"
                                />
                            </div>
                        </div>

                        <!-- Right Section (Buttons) -->
                        <a href="{{ route('user.marketing-bot.segments.export') }}"
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
                <div id="segments-table-container">
                    @include('marketingbot::segments-table')
                </div>
                <!-- End Table -->

                <!-- Segments Table Skeleton -->
                @include('marketingbot::skeleton.segments-table-skeleton')

            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/marketing-bot-utils.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/segment.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/segment-search.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/segments-skeleton.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
@endsection
