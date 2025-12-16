@extends('layouts.user_master')
@section('page_title', __('Inbox'))

@section('content')
    <main class="w-[68.9%] 5xl:w-[85.9%] pt-[56px] dark:bg-[#292929] flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF">
        <div class="xl:flex h-full subscription-main bg-color-F6 dark:bg-color-29">
            <!-- Start Sidebar -->
            @include('marketingbot::layouts.sidebar')
            <!-- End Sidebar -->
            <!-- inbox -->
            <div id="inbox"
                class="fixed 2xl:static z-50 block 2xl:block 2xl:max-w-[400px] shrink-0 w-[-webkit-fill-available] bg-color-F9 dark:bg-color-3A border-r border-gray-200 dark:border-gray-700">
                <div>
                    <div class="h-[58px] pl-5 pr-4 py-3 border-b border-b-color-DF dark:border-b-color-47 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <h1 class="text-dark-1 dark:text-white font-medium text-lg"> {{__('Messages')}}</h1>
                            @if ( (int) $total_unread_messages > 0)
                                <span id="total-unread-count" class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs px-2 py-1 rounded-full">{{ (int) $total_unread_messages }}</span>
                            @endif
                        </div>
                        <button
                            onclick="toggleInbox()"
                            id="inboxArrow" class="2xl:hidden hrink-0 flex items-center justify-center h-8 w-8 rounded-full hover:bg-white hover:dark:bg-color-33 hover:border hover:border-color-89 outline-none focus:outline-none text-color-14 dark:text-white transition"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Search and Filter -->
                    <div class="flex items-center gap-2.5 mt-3 px-4">
                        <div class="flex-1 relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-color-14 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><g><path d="M16.9221 15.9523L12.8944 11.7633C13.93 10.5322 14.4974 8.98328 14.4974 7.37077C14.4974 3.60329 11.4322 0.538086 7.66472 0.538086C3.89723 0.538086 0.832031 3.60329 0.832031 7.37077C0.832031 11.1383 3.89723 14.2035 7.66472 14.2035C9.07908 14.2035 10.4269 13.7769 11.5792 12.967L15.6376 17.1879C15.8072 17.364 16.0353 17.4612 16.2798 17.4612C16.5113 17.4612 16.7308 17.3729 16.8975 17.2125C17.2516 16.8718 17.2629 16.3067 16.9221 15.9523ZM7.66472 2.32053C10.4495 2.32053 12.715 4.58601 12.715 7.37077C12.715 10.1555 10.4495 12.421 7.66472 12.421C4.87995 12.421 2.61447 10.1555 2.61447 7.37077C2.61447 4.58601 4.87995 2.32053 7.66472 2.32053Z" fill="currentColor"></path></g><defs><clipPath id="clip0_11091_5641"><rect width="16.9231" height="16.9231" fill="white" transform="translate(0.539062 0.538086)"></rect></clipPath></defs></svg>
                            
                            <input
                                id="inbox-search-input"
                                type="text"
                                placeholder="{{ __('Search contacts...') }}"
                                class="w-full h-[44px] p-2.5 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-dark-1 dark:text-white pl-9"
                            />
                        </div>
                        <button id="inbox-filter-toggle-btn" class="flex-shrink-0 flex items-center justify-center h-[44px] w-[44px] rounded-xl bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 hover:border-color-89 dark:hover:border-color-89 outline-none focus:outline-none text-color-14 dark:text-white transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Channel Filter -->
                    <div id="inbox-channel-filter-section" class="px-4 my-3 hidden">
                        <div class="relative w-full custom-select">
                            <button
                                id="inbox-channel-filter-btn"
                                class="select-btn w-full flex justify-between items-center font-medium pl-4 pr-2.5 py-[11px] rounded-lg border border-color-DF dark:border-color-47 hover:border-color-89 dark:hover:border-color-89 bg-white dark:bg-color-33 text-sm text-gray-700 dark:text-gray-200 focus:outline-none transition"
                            >
                                <span class="selected-option" id="inbox-channel-selected">{{ __('All Channel') }}</span>
                                <svg class="w-4 h-4 text-gray-400 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <ul
                                id="inbox-channel-menu"
                                class="select-menu absolute hidden mt-1 w-full bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-lg shadow-lg overflow-hidden z-50"
                            >
                                <li class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer" data-channel="all"> {{ __('All Channel') }}</li>
                                <li class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer" data-channel="whatsapp">WhatsApp</li>
                                <li class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer" data-channel="telegram">Telegram</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Item -->
                <div id="conversation-list-container" 
                     class="overflow-y-auto h-[calc(100vh-241px)] mt-3 space-y-3 px-4"
                     data-current-page="{{ $inboxes->currentPage() }}"
                     data-has-more="{{ $inboxes->hasMorePages() ? 'true' : 'false' }}">
                    @include('marketingbot::inbox.conversation-lists')

                    <!-- Loading indicator -->
                    <div id="conversation-loading" class="hidden py-4 text-center">
                        <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-gray-900 dark:border-white"></div>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Loading more conversations...') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Main chat area -->
            <div class="flex-1 flex flex-col bg-white dark:bg-color-29">
                <!-- Chat Header -->
                <div class="header" id="header-container">
                    @include('marketingbot::inbox.header')
                </div>

                <div id="chat-panel" class="flex-1 flex flex-col relative">
                    <div class="messages flex-1 overflow-y-auto pb-28" id="all-messages">
                        @include('marketingbot::inbox.messages')
                    </div>

                    <!-- Message Input -->
                    <form id="reply-form" class="sticky bottom-0 left-0 right-0 bg-white/95 dark:bg-gray-800/95 border-t border-gray-200 dark:border-gray-700 backdrop-blur">
                        @csrf
                        <input type="hidden" name="conversation_id" id="conversation_id" >
                        <input type="hidden" name="channel" id="channel" >
                        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}" >
                        <div class="p-4">
                            <div class="flex items-end gap-2 rtl:space-x-reverse">
                                <textarea
                                    id="admin-reply"
                                    name="message"
                                    placeholder="{{ __('Message') }}"
                                    class="flex-1 px-4 py-2 bg-gray-100 dark:bg-gray-700 border border-transparent rounded-lg text-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:outline-none resize-none overflow-hidden min-h-[44px] max-h-[180px] h-11 leading-6"
                                ></textarea>
                                <button
                                    id="send-message"
                                    type="submit"
                                    class="bg-[#9163dd]/80 hover:bg-[#9163dd] text-white p-3 rounded-full transition-colors inline-flex items-center justify-center shadow-sm"
                                    aria-label="{{ __('Send message') }}"
                                >
                                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"
                                        ></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/marketing-bot-utils.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script>
        var time = "{{ now()->diffForHumans() }}";

        // Auto-expand textarea and clear after send
        (function () {
            const form = document.getElementById('reply-form');
            const input = document.getElementById('admin-reply');
            if (!form || !input) return;

            const baseHeight = input.scrollHeight;
            const resize = () => {
                input.style.height = 'auto';
                input.style.height = Math.min(input.scrollHeight, 180) + 'px';
            };
            input.addEventListener('input', resize);
            resize();

            form.addEventListener('submit', () => {
                // allow existing AJAX handler to proceed, just clear UI
                setTimeout(() => {
                    input.value = '';
                    resize();
                    const messages = document.getElementById('all-messages');
                    if (messages) messages.scrollTop = messages.scrollHeight;
                }, 0);
            });
        })();
    </script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/inbox.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
@endsection
