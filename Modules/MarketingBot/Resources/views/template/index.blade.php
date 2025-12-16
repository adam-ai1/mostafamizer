@extends('layouts.user_master')
@section('page_title', __('Templates'))

@section('content')
    <main class="w-[68.9%] 5xl:w-[85.9%] pt-[56px] dark:bg-[#292929] flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF">
        <div class="xl:flex h-full subscription-main bg-color-F6 dark:bg-color-29">
            <!-- Start Sidebar -->
            @include('marketingbot::layouts.sidebar')

            <div
				class="w-full max-w-[1280px] mx-auto px-5 sidebar-scrollbar xl:h-[calc(100vh-56px)] xl:overflow-auto pt-[21px] sm:pt-6 pb-[56px]"
					>

                <div
                    class="flex flex-col gap-4 2xl:flex-row 2xl:items-center 2xl:justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <div>
                            <h1
                                class="text-color-14 text-24 font-semibold font-RedHat dark:text-white wrap-anywhere"
                            >
                                {{ __('Templates') }}
                            </h1>
                            <p
                                class="text-color-89 text-sm font-medium wrap-anywhere mt-1"
                            >
                                {{ __('Manage your template list efficiently') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                            <button
                                type="button"
                                data-channel="whatsapp"
                                class="template-button flex items-center justify-center rounded-[6px] text-[15px] text-center bg-color-14 hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                            >
                                {{ __('Sync') }}

                                 <svg class="w-5 h-5 animate-spin text-white loader-icon mx-2 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                    </div>
                </div>
                <!-- Filters and Search -->
                <div
                    class="bg-white dark:bg-color-3A border border-color-89/10 rounded-xl px-4 sm:px-6 py-4 mb-4 transition-colors">
                    <div
                        class="flex flex-col flex-wrap lg:flex-row lg:items-center lg:justify-between gap-4"
                    >
                        <!-- Left Section -->
                        <div
                            class="flex flex-col lg:flex-row sm:items-center gap-4 w-full lg:w-auto"
                        >
                            <!-- Search -->
                            <div class="relative w-full lg:w-auto flex items-center justify-center">
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
                                    ></path>
                                </svg>
                                <input
                                    onkeyup="searchTemplates(this)"
                                    name="search"
                                    type="text"
                                    id="template-search"
                                    placeholder="{{ __('Search templates...') }}"
                                    class="pl-10 pr-4 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-color-14 dark:text-white focus:outline-none w-full lg:w-64 transition"
                                />

                                <svg class="w-5 h-5 animate-spin text-black dark:text-white loader-icon hidden absolute right-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="template-table">
                    @include('marketingbot::template.template-table')

                    <!-- Templates Table Skeleton -->
                    @include('marketingbot::skeleton.templates-table-skeleton')
                </div>
            </div>

        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/marketing-bot-utils.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/templates-skeleton.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script type="text/javascript">
        let route = "{{ route('user.marketing-bot.templates.create') }}";
        let user_id = "{{ Auth::user()->id }}";
        let search_route = "{{ route('user.marketing-bot.templates.index') }}";
    </script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/template.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
@endsection