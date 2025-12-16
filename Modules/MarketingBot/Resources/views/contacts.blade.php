@extends('layouts.user_master')
@section('page_title', __('Contacts'))

@section('css')
    <link rel="stylesheet" href="{{ asset('Modules/MarketingBot/Resources/assets/plugin/intl-tel-input/css/intlTelInput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Modules/MarketingBot/Resources/assets/css/custom-intel-tel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Modules/MarketingBot/Resources/assets/css/segment-dropdown.min.css') }}">
@endsection

@section('content')
    <main class="w-[68.9%] 5xl:w-[85.9%] pt-[56px] dark:bg-[#292929] flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF">
        <div class="xl:flex h-full subscription-main bg-color-F6 dark:bg-color-29">
            <!-- Start Sidebar -->
        @include('marketingbot::layouts.sidebar')
        <!-- End Sidebar -->

            <div class="w-full max-w-[1280px] mx-auto px-5 sidebar-scrollbar xl:h-[calc(100vh-56px)] xl:overflow-auto pt-[21px] sm:pt-6 pb-[56px]">
                <div class="flex flex-col gap-4 2xl:flex-row 2xl:items-center 2xl:justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <div>
                            <h1 class="text-color-14 text-24 font-semibold font-RedHat dark:text-white wrap-anywhere">
                                {{ __('WhatsApp Contacts') }}
                            </h1>
                            <p class="text-color-89 text-sm font-medium wrap-anywhere mt-1">
                                {{ __('Manage your contact list efficiently') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 flex-wrap">
                        <form action="{{ route('user.marketing-bot.contact.import') }}" method="POST" enctype="multipart/form-data" class="relative flex items-center gap-3" id="importForm">
                            @csrf
                            <input type="file" name="file" id="csvFileInput" accept="text/csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required
                                   class="hidden">
                            <div id="fileInfoDisplay" class="flex items-center gap-3 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition-all duration-200 hidden">
                                <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-gradient-to-br from-blue-50 to-purple-50 dark:from-blue-900/30 dark:to-purple-900/30 ring-1 ring-blue-100 dark:ring-blue-800/50">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col min-w-0 flex-1">
                                    <span id="fileNameDisplay" class="text-sm font-medium text-color-14 dark:text-white truncate"></span>
                                    <span class="text-xs text-color-89 dark:text-gray-400 mt-0.5">{{ __('CSV File') }}</span>
                                </div>
                                <button type="button" id="changeFileBtn" class="flex-shrink-0 ml-1 p-1.5 rounded-md text-color-89 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-200" title="{{ __('Remove file') }}" aria-label="{{ __('Remove file') }}">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <button type="button" id="importBtn"
                                    class="flex items-center gap-2 rounded-[6px] text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                                <span id="importBtnText">{{ __('Import') }}</span>
                            </button>
                            <button type="submit" id="importSubmitBtn"
                                    class="flex items-center gap-2 rounded-[6px] text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200 hidden">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                <span>{{ __('Import') }}</span>
                            </button>
                            <a id="sampleDownloadBtn" href="{{ asset('public/dist/downloads/contacts.csv') }}" download="contacts.csv"
                               class="flex items-center gap-2 rounded-[6px] text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                <span id="sampleDownloadBtnText">{{ __('Sample Download') }}</span>
                            </a>
                        </form>
                        <button data-target="modal7" type="button"
                           class="openModalBtn flex items-center rounded-[6px] text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200">
                            <svg class="size-5 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 height="20px" width="20px" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>{{ __('Add Contact') }}</span>
                        </button>

                        <!-- Start Add contact Modal  -->
                        <div id="modal7" class="sweet-modal fixed inset-0 hidden bg-color-14/50 backdrop-blur-[4px] flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 p-4">
                            <!-- Modal Box -->
                            <div class="modalBox max-w-[600px] w-full bg-white dark:bg-color-3A rounded-xl py-7 relative transform transition-all duration-300 scale-0 opacity-0">
                                <div class="px-7">
                                    <div class="mb-5">
                                        <h5 class="text-lg text-color-14 dark:text-white font-medium">
                                            {{ __('Contact Add') }}
                                        </h5>
                                    </div>
                                    <form id="contactForm">
                                        @csrf
                                        <input type="hidden" id="contactId" name="id" value="">

                                        <!-- Contact Name Field -->
                                        <div class="space-y-1.5 mb-4">
                                            <label for="contactName" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                                {{ __('Contact Name') }} <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" id="contactName" name="name" tabindex="1"
                                                   class="form-control w-full px-4 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 text-color-14 dark:text-white focus:outline-none focus:border-blue-500"
                                                   required aria-required="true">
                                            <div class="error-message text-red-500 text-xs mt-1 hidden" id="name-error"></div>
                                        </div>

                                        <!-- Phone Number Field with intl-tel-input -->
                                        <div class="space-y-1.5 mb-4">
                                            <label for="contactPhone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                                {{ __('Phone Number') }} <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative phone-input-wrapper">
                                                <input type="tel" id="contactPhone" name="phone" tabindex="2"
                                                    class="form-control w-full px-4 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 text-color-14 dark:text-white focus:outline-none focus:border-blue-500"
                                                    required aria-required="true">
                                                <input type="hidden" id="dialCode" name="dial_code">
                                                <input type="hidden" id="countryCode" name="country_code">
                                                <input type="hidden" id="fullPhone" name="full_phone">
                                            </div>
                                            <div class="error-message text-red-500 text-xs mt-1 hidden" id="phone-error"></div>
                                        </div>

                                        <!-- Segment Field -->
                                        @if($segments->count() > 0)
                                            <div class="space-y-1.5 mb-6">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                                    {{ __('Select Segment') }}
                                                </label>
                                                <div class="relative">
                                                    <button type="button" id="segmentDropdownBtn"
                                                            class="px-4 w-full bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-lg text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-color-14 dark:text-white voice-type-dropdown min-h-[48px] max-h-[120px] overflow-y-auto flex items-center justify-between">
                                                        <div class="flex items-center flex-wrap gap-1.5 flex-1 min-w-0 py-2">
                                                            <span id="selectedSegment" class="line-clamp-single text-color-89 dark:text-gray-400">{{ __('Select Segment') }}</span>
                                                            <div id="selectedSegmentsTags" class="hidden flex flex-wrap gap-1.5 items-center"></div>
                                                            <span id="selectedCountBadge" class="hidden text-xs text-color-89 dark:text-gray-400 font-medium"></span>
                                                        </div>
                                                        <span class="w-4 h-4 flex-shrink-0 ml-2 transition-transform duration-200" id="dropdownArrow">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" class="text-color-89 dark:text-gray-400">
                                                                <g clip-path="url(#clip0_9797_5972)">
                                                                    <path d="M4.2925 5L8.5 8.7085L12.7075 5L14 6.1417L8.5 11L3 6.1417L4.2925 5Z" fill="currentColor" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_9797_5972">
                                                                        <rect width="16" height="16" fill="white" transform="translate(16) rotate(90)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                    <input type="hidden" name="segment_ids[]" id="selectedSegmentIds" value="">
                                                    <input type="hidden" id="selectSegmentText" value="{{ __('Select Segment') }}">
                                                    <div id="segmentDropdown" class="hidden origin-top-right top-13 w-full p-4 absolute mx-auto border border-color-89 dark:border-color-47 rounded-lg bg-white dark:bg-color-29 z-50 voice-dropdown-content pt-3 pb-2">
                                                        <div class="w-full">
                                                            <div class="relative">
                                                                <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-color-14 dark:text-white pointer-events-none"
                                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                                </svg>
                                                                <input type="text" id="segmentSearch" placeholder="{{ __('Search segment...') }}"
                                                                    class="pl-10 pr-4 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-dark-1 dark:text-white focus:outline-none w-full transition" />
                                                            </div>
                                                        </div>
                                                        <div class="overflow-auto sidebar-scrollbar max-h-[180px] mt-4" id="segmentList">
                                                            @foreach($segments->take(preference('row_per_page')) as $segment)
                                                                <div class="segment-option px-4 py-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer flex items-center gap-3 transition-colors duration-150"
                                                                    data-id="{{ $segment->id }}" data-name="{{ $segment->name }}">
                                                                    <div class="relative flex items-center">
                                                                        <input type="checkbox" class="segment-checkbox w-4 h-4 rounded border-color-DF dark:border-color-47 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-0 cursor-pointer transition-all duration-150" value="{{ $segment->id }}" data-name="{{ $segment->name }}">
                                                                    </div>
                                                                    <span class="flex-1 font-medium">{{ $segment->name }}</span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="error-message text-red-500 text-xs mt-1 hidden" id="segment_ids-error"></div>
                                            </div>
                                        @endif

                                        <!-- Buttons -->
                                        <div class="flex gap-4">
                                            <button type="button"
                                                    class="closeModalBtn flex items-center justify-center w-full rounded-[6px] text-[15px] text-center bg-color-14 hover:shadow-lg text-white px-5 py-2 font-medium hover:opacity-90 transition-all duration-200">
                                                <span>{{ __('Cancel') }}</span>
                                            </button>
                                            <button type="submit" form="contactForm" id="saveContactBtn"
                                                    class="flex items-center justify-center w-full rounded-[6px] text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2 font-medium hover:opacity-90 transition-all duration-200">
                                                <span id="saveBtnText">{{ __('Save') }}</span>
                                                <div id="saveBtnLoader" class="hidden">
                                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Add contact Modal  -->
                    </div>
                </div>

                <!-- Filters and Search -->
                <div class="bg-white dark:bg-color-3A border border-color-89/10 rounded-xl px-4 sm:px-6 py-4 mb-4 transition-colors">
                    <div class="flex items-center justify-between gap-4">
                        <!-- Search -->
                        <div class="relative flex-1">
                            <div class="flex items-center relative max-w-md">
                                <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-color-14 dark:text-white pointer-events-none"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input type="text" id="searchContacts" onkeyup="searchContacts(this)" placeholder="{{ __('Search by name...') }}"
                                       class="max-w-md pl-10 pr-4 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-dark-1 dark:text-white focus:outline-none w-full transition" />
                            </div>
                        </div>

                        <a href="{{ route('user.marketing-bot.contact.export') }}"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm rounded-lg whitespace-nowrap border border-color-DF dark:border-color-47 hover:border-color-89 dark:hover:border-color-89 bg-white dark:bg-color-33 text-gray-700 dark:text-gray-200 focus:outline-none transition w-auto justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            {{ __('Export CSV') }}
                        </a>
                    </div>
                </div>

                <!-- Table Container -->
                <div id="contacts-table-container">
                    @include('marketingbot::contacts-table')
                </div>

                <!-- Contacts Table Skeleton -->
                @include('marketingbot::skeleton.contacts-table-skeleton')
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('Modules/MarketingBot/Resources/assets/plugin/intl-tel-input/js/intlTelInput.min.js') }}"></script>
    <script>
        const utilsScriptLoadingPath = "{{ asset('Modules/MarketingBot/Resources/assets/plugin/intl-tel-input/js/utils.min.js') }}";
    </script>

    <script>
        // Define route URLs and session messages for contacts.js
        const contactRoute = "{{ route('user.marketing-bot.contacts') }}";
        const storeContactUrl = "{{ route('user.marketing-bot.contacts.store') }}";
        const updateContactUrl = "{{ route('user.marketing-bot.contacts.update', ':id') }}";
        const getContactUrl = "{{ route('user.marketing-bot.contacts.show', ':id') }}";
        const deleteContactUrl = "{{ route('user.marketing-bot.contacts.delete', ':id') }}";
    </script>

    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/marketing-bot-utils.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/contact-table-search.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/contacts.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/contacts-skeleton.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>

@endsection
