@include('marketingbot::inbox.skeleton.skeleton-header')

@if(!empty($contact))
    <div class="flex flex-col justify-center h-[58px] bg-color-F9 dark:bg-color-3A border-b border-gray-200 dark:border-gray-700 px-4 main-header-container">
    <div class="ms-10 xl:ms-0 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <img
                id="chatProfileImg"
                class="rounded-full w-8 h-8 border border-color-89/20 object-contain cursor-pointer"
                src="{{ asset('Modules\MarketingBot\Resources\assets\images\profile_default_img.png') }}"
                alt="Image"
            />
            <!-- Start Chat Details Drawer -->
            <div
                id="chatDrawer"
                class="fixed top-[56px] right-0 h-full w-96 bg-white dark:bg-color-33 shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-[70] overflow-y-auto"
            >
                <!-- Drawer Header -->
                <div class="px-5 py-4 h-[58px] flex justify-between items-center border-b border-b-color-DF dark:border-b-color-47 dark:bg-color-3A">
                    <h2 class="text-lg font-medium text-color-14 dark:text-white">{{ __('Chat Details') }}</h2>
                    <button
                        id="closeChatDrawer"
                        class="text-gray-500 dark:text-gray-300 hover:text-red-500 transition-colors text-md"
                    >
                        ✕
                    </button>
                </div>

                <!-- Drawer Content -->
                <!-- hero -->
                <div class="p-6 text-center relative border-b border-b-color-DF dark:border-b-color-47">
                    <div class="mb-4">
                        <img src="{{ asset('Modules\MarketingBot\Resources\assets\images\profile_default_img.png') }}" 
                            alt="Contact Avatar" 
                            class="w-20 h-20 rounded-full mx-auto border-4 border-white object-cover">
                    </div>
                    @if (!empty($contact))
                        <h2 class="text-xl font-bold text-color-14 dark:text-white mb-1">{{ $contact->phone ? '+' . $contact->phone : $contact->name }}</h2>
                    
                    @else
                    <h2 class="text-xl font-bold text-color-14 dark:text-white mb-1">{{ $segment->name }}</h2>
                    @endif
                    <p class="text-color-89 dark:text-[#B0B0B0] mb-4 text-sm">{{ __('Channel') }} • {{ $contact->channel }}</p>
                </div>
                
                <!-- Contact Details -->
                <div class="p-6 border-b border-b-color-DF dark:border-b-color-47">
                    <h3 class="text-lg font-semibold text-color-14 dark:text-white mb-4">{{ __('Contact Details') }}</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-color-89">{{ __('Name') }}</span>
                            <span class="font-medium text-color-14 dark:text-white">{{ $contact->name }}</span>
                        </div>
                        @if ($contact->phone)
                            <div class="flex justify-between items-center">
                                <span class="text-color-89">{{ __('Phone') }}</span>
                                <span class="font-medium text-color-14 dark:text-white">+{{ $contact->phone }}</span>
                            </div>
                        @endif
                        @if ($contact->email)
                            <div class="flex justify-between items-center">
                                <span class="text-color-89">{{ __('Email') }}</span>
                                <span class="font-medium text-color-14 dark:text-white">{{ $contact->email }}</span>
                            </div>
                        @endif
                        @if ($contact->country_code)
                            <div class="flex justify-between items-center">
                                <span class="text-color-89">{{ __('Country') }}</span>
                                <span class="font-medium text-color-14 dark:text-white">{{ getCountryName($contact->country_code) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Chat Details -->
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-color-14 dark:text-white mb-4">{{ __('Chat Details') }}</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-color-89">{{ __('Created at') }}</span>
                            <span class="font-medium text-color-14 dark:text-white">{{ $chatDetails->created_at->format('d M, Y') }}</span>
                        </div>
                        @if (isset($chatDetails->ai_reply))
                        <div class="flex justify-between items-center">
                            <span class="text-color-89">{{ __('Auto Reply') }}</span>
                            <div class="flex items-center gap-3">
                                <!-- Toggle Switch -->
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" data-url="{{ route('user.marketing-bot.updateAutoReply', $chatDetails->id) }}" data-inbox-id="{{ $chatDetails->id }}" class="sr-only peer" id="auto-reply-toggle" {{ $chatDetails->ai_reply == 'on' ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    <span class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <span class="peer-checked:hidden">OFF</span>
                                        <span class="hidden peer-checked:inline">ON</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        @endif
                        <div class="flex justify-between items-center">
                            <span class="text-color-89">{{ __('Last Activity') }}</span>
                            <span class="font-medium text-color-14 dark:text-white">{{ $chatDetails->last_interaction_at->format('d M, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Drawer Overlay -->
            <div id="chatDrawerOverlay" class="fixed inset-0 bg-black/50 hidden z-[60]"></div>
            <!-- Start Chat Details Drawer -->
            <div>
                <h2 class="text-base font-semibold text-color-14 dark:text-white">
                    {{ $contact->phone ? '+' . $contact->phone : $contact->name }}
                </h2>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button
                data-target="deleteChatModal"
                class="openModalBtn shrink-0 flex items-center justify-center h-8 w-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 shadow-sm hover:shadow-red-200 dark:hover:shadow-red-900/50 transform hover:scale-105 transition duration-200 ease-in-out"
                title="{{ __('Delete Chat') }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>
            <button onclick="toggleInbox()" class="2xl:hidden shrink-0 flex items-center justify-center h-8 w-8 rounded-full hover:bg-white hover:dark:bg-color-33 hover:border hover:border-color-89 outline-none focus:outline-none text-color-14 dark:text-white transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"
                    ></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Delete Chat Modal -->
<div
    id="deleteChatModal"
    class="sweet-modal fixed inset-0 hidden bg-color-14/50 backdrop-blur-[4px] flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 p-4"
>
    <!-- Modal Box -->
    <div
        class="modalBox max-w-[600px] min-w-[300px] bg-white dark:bg-color-3A rounded-xl py-7 relative transform transition-all duration-300 scale-0 opacity-0"
    >
        <div class="px-7">
            <h5
                class="max-w-[300px] text-xl text-color-14 dark:text-white text-center font-medium mb-0.5"
            >
                {{ __('Are you sure you want to delete this chat?') }}
            </h5>
            <div class="flex justify-center gap-3 mt-6">
                <button
                    type="button"
                    class="closeModalBtn w-full flex items-center justify-center rounded-[6px] text-sm text-center border border-color-89 dark:border-color-47 bg-color-F6 dark:bg-color-47 text-color-14 dark:text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                >
                    {{ __('Cancel') }}
                </button>
                <button
                    type="button"
                    data-chat-id="{{ $chatDetails->id ?? '' }}"
                    data-chat-route="{{ isset($chatDetails) && isset($chatDetails->id) ? route('user.marketing-bot.deleteChat', $chatDetails->id) : '#' }}"
                    class="delete-chat w-full flex items-center justify-center rounded-[6px] text-sm text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                >
                    <span>{{ __('Delete') }}</span>
                    <svg class="loader animate-spin h-5 w-5 ml-2 hidden" xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 72 72" fill="none">
                        <mask id="path-1-inside-delete-chat" fill="white">
                            <path d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z"></path>
                        </mask>
                        <path d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z" stroke="url(#paint0_linear_delete_chat)" stroke-width="24" mask="url(#path-1-inside-delete-chat)"></path>
                        <defs>
                            <linearGradient id="paint0_linear_delete_chat" x1="46.8123" y1="63.1382" x2="21.8195" y2="6.73779" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#E60C84"></stop>
                                <stop offset="1" stop-color="#FFCF4B"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    </div>
@endif

<!-- Empty State for Header (shown by JavaScript when needed) -->
<div id="header-empty-state" class="hidden flex flex-col justify-center h-[58px] bg-color-F9 dark:bg-color-3A border-b border-gray-200 dark:border-gray-700 px-4">
    <div class="ms-10 xl:ms-0 flex items-center justify-center">
        <p class="text-gray-500 dark:text-gray-400 text-sm">{{ __('Select a conversation to view messages') }}</p>
    </div>
</div>