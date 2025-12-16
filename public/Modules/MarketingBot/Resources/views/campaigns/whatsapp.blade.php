@extends('layouts.user_master')
@section('page_title', __(':x Campaigns', ['x' => __('Whatsapp')]))

@section('content')
@php
    $channelPreferences = getMarketingBotChannelPreferences();
@endphp
<main class="w-[68.9%] 5xl:w-[85.9%] pt-[56px] dark:bg-[#292929] flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF">
    <div class="xl:flex h-full subscription-main bg-color-F6 dark:bg-color-29">
        <!-- Start Sidebar -->
        @include('marketingbot::layouts.sidebar')

        <div class="w-full xl:h-[calc(100vh-56px)] overflow-y-auto relative bg-color-F9 dark:bg-color-29 pb-8">
            <!-- Left section -->
            <div class="w-full 6xl:max-w-[420px] 7xl:max-w-[488px] 8xl:max-w-[495px]">
                <!-- Header -->

                    @if($channelPreferences['telegram_enabled'])
                    <!-- Toggle Tabs: WhatsApp / Telegram -->
                    <div class="ps-5 7xl:ps-[36px] pt-8 pb-4">
                        <div id="chat-toggle" role="tablist" aria-label="Choose messaging app"
                            class="inline-flex rounded-full bg-gray-300/40 dark:bg-color-47 p-1 gap-1 shadow-sm">
                            <!-- WhatsApp Button -->
                            <a
                                href="{{ route('user.marketing-bot.campaigns.whatsapp-campaign.create') }}"
                                role="tab"
                                aria-selected="true"
                                data-app="whatsapp"
                                class="app-tab flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-medium bg-white dark:bg-color-14 text-[#25D366] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-1 focus-visible:ring-green-400 transition transform"
                            >
                                <svg
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.106"
                                    />
                                </svg>
                                <span>{{ __('WhatsApp') }}</span>
                            </a>

                            <!-- Telegram Button -->
                            <a
                                href="{{ route('user.marketing-bot.campaigns.telegram-campaign.create') }}"
                                role="tab"
                                aria-selected="false"
                                data-app="telegram"
                                class="app-tab flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-medium text-[#0088cc] hover:bg-white/40 dark:hover:bg-white/5 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-1 focus-visible:ring-blue-400 transition transform active:scale-[0.99]"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                </svg>
                                <span>{{ __('Telegram') }}</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    <div class="mb-4 7xl:ps-[36px] p-5">
                        <h1
                            class="font-redhat text-2xl font-bold bg-gradient-to-r from-[#25D366] to-[#128C7E] bg-clip-text text-transparent"
                        >
                            {{ __('WhatsApp Campaign') }}
                        </h1>
                        <p class="mt-[6px] text-color-89 text-15 font-medium">
                            {{ __('Create a campaign and send it now or schedule for later to engage your audience.') }}
                        </p>
                    </div>

                    <div class="px-5 pt-1 pb-[30px]">
                        <div class="ml-6 sm:ml-[45px] mr-[11px] sm:mr-[29px] p-4">

                            <!-- Stepper -->
                            <div class="flex items-center StepperParent">
                                <div class="Stepper">
                                    <div class="flex items-center text-gray-500 relative empty-circle hidden">
                                        <div class="flex items-center justify-center rounded-full h-6 w-6 py-1 bg-gradient-to-r from-rose-400 via-fuchsia-500 to-indigo-500">
                                            <p class="flex items-center justify-center text-11 text-[#474746] bg-white dark:bg-[#3A3A39] dark:text-white font-medium font-Figtree h-[22px] w-[22px] py-1 rounded-full">1 </p>
                                        </div>
                                        <div class="absolute top-0 -ml-[52px] text-center mt-8 w-32 text-xs font-medium font-Figtree text-[#474746] dark:text-[#DFDFDF]">{{ __('Titles and Campaign') }}</div>
                                    </div>
                                    <div class="flex items-center relative full-circle">
                                        <div class="flex items-center justify-center rounded-full h-6 w-6 py-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="12" fill="url(#paint0_linear_10431_5608)"></circle>
                                                <path d="M17.9398 7.91788C14.8844 10.7218 12.508 14.5819 11.7788 16.4428C11.7662 16.4931 11.7033 16.5434 11.6404 16.5434C11.6279 16.556 11.6279 16.556 11.6153 16.556C11.565 16.556 11.5147 16.5434 11.4896 16.5057L7.00077 11.9414C6.96305 11.9037 8.321 10.6967 8.38387 10.7469L10.8483 12.6833C11.8039 11.5517 14.1677 8.99921 17.4495 7C17.5123 7 17.9901 7.7167 17.9901 7.7167C18.0153 7.77957 17.9901 7.86758 17.9398 7.91788Z" fill="white"></path>
                                                <defs>
                                                <linearGradient id="paint0_linear_10431_5608" x1="4.15256" y1="2.35886" x2="23.0334" y2="17.727" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#FFF1BF"></stop>
                                                <stop offset="0.2947" stop-color="#EC458D"></stop>
                                                <stop offset="0.393" stop-color="#E14591"></stop>
                                                <stop offset="0.561" stop-color="#C6469D"></stop>
                                                <stop offset="0.7784" stop-color="#9A49B1"></stop>
                                                <stop offset="1" stop-color="#664CC9"></stop>
                                                </linearGradient>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="absolute top-0 -ml-[52px] text-center mt-8 w-32 text-12 font-medium font-Figtree text-color-14 dark:text-white">{{ __('Titles and Campaign') }}</div>
                                    </div>
                                </div>
                                <div class="flex-auto h-px bg-gradient-to-r from-[#EC458D] via-[#664CC9] to-[#FFF1BF]"></div>
                                
                                <div class="Stepper">
                                    <div class="flex items-center text-gray-500 relative empty-circle">
                                        <div class="flex items-center justify-center rounded-full h-6 w-6 py-1 bg-gradient-to-r from-rose-400 via-fuchsia-500 to-indigo-500">
                                            <p class="flex items-center justify-center text-11 text-[#474746] bg-white dark:bg-[#3A3A39] dark:text-white font-medium font-Figtree h-[22px] w-[22px] py-1 rounded-full"> 2 </p>
                                        </div>
                                        <div class="absolute top-0 -ml-[52px] text-center mt-8 w-32 text-12 font-medium font-Figtree text-[#474746] dark:text-[#DFDFDF]">{{ __('Variables') }}</div>
                                    </div>
                                    <div class="flex items-center relative full-circle hidden">
                                        <div class="flex items-center justify-center rounded-full h-6 w-6 py-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="12" fill="url(#paint0_linear_10431_5608)"></circle>
                                                <path d="M17.9398 7.91788C14.8844 10.7218 12.508 14.5819 11.7788 16.4428C11.7662 16.4931 11.7033 16.5434 11.6404 16.5434C11.6279 16.556 11.6279 16.556 11.6153 16.556C11.565 16.556 11.5147 16.5434 11.4896 16.5057L7.00077 11.9414C6.96305 11.9037 8.321 10.6967 8.38387 10.7469L10.8483 12.6833C11.8039 11.5517 14.1677 8.99921 17.4495 7C17.5123 7 17.9901 7.7167 17.9901 7.7167C18.0153 7.77957 17.9901 7.86758 17.9398 7.91788Z" fill="white"></path>
                                                <defs>
                                                <linearGradient id="paint0_linear_10431_5608" x1="4.15256" y1="2.35886" x2="23.0334" y2="17.727" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#FFF1BF"></stop>
                                                <stop offset="0.2947" stop-color="#EC458D"></stop>
                                                <stop offset="0.393" stop-color="#E14591"></stop>
                                                <stop offset="0.561" stop-color="#C6469D"></stop>
                                                <stop offset="0.7784" stop-color="#9A49B1"></stop>
                                                <stop offset="1" stop-color="#664CC9"></stop>
                                                </linearGradient>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="absolute top-0 -ml-[52px] text-center mt-8 w-32 text-12 font-medium font-Figtree text-color-14 dark:text-white">{{ __('Variables') }}</div>
                                    </div>
                                </div>

                                <div class="flex-auto h-px bg-gradient-to-r from-[#EC458D] via-[#664CC9] to-[#FFF1BF]"></div>
                                
                                <div class="Stepper">
                                    <div class="flex items-center text-gray-500 relative empty-circle">
                                        <div class="flex items-center justify-center rounded-full h-6 w-6 py-1 bg-gradient-to-r from-rose-400 via-fuchsia-500 to-indigo-500">
                                            <p class="flex items-center justify-center text-11 text-[#474746] bg-white dark:bg-[#3A3A39] dark:text-white font-medium font-Figtree h-[22px] w-[22px] py-1 rounded-full">3</p>
                                        </div>
                                        <div class="absolute top-0 -ml-[52px] text-center mt-8 w-32 text-xs font-medium font-Figtree text-[#474746] dark:text-[#DFDFDF]">{{ __('Finalize') }}</div>
                                    </div>
                                    <div class="flex items-center relative full-circle hidden">
                                        <div class="flex items-center justify-center rounded-full h-6 w-6 py-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="12" fill="url(#paint0_linear_10431_5608)"></circle>
                                                <path d="M17.9398 7.91788C14.8844 10.7218 12.508 14.5819 11.7788 16.4428C11.7662 16.4931 11.7033 16.5434 11.6404 16.5434C11.6279 16.556 11.6279 16.556 11.6153 16.556C11.565 16.556 11.5147 16.5434 11.4896 16.5057L7.00077 11.9414C6.96305 11.9037 8.321 10.6967 8.38387 10.7469L10.8483 12.6833C11.8039 11.5517 14.1677 8.99921 17.4495 7C17.5123 7 17.9901 7.7167 17.9901 7.7167C18.0153 7.77957 17.9901 7.86758 17.9398 7.91788Z" fill="white"></path>
                                                <defs>
                                                <linearGradient id="paint0_linear_10431_5608" x1="4.15256" y1="2.35886" x2="23.0334" y2="17.727" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#FFF1BF"></stop>
                                                <stop offset="0.2947" stop-color="#EC458D"></stop>
                                                <stop offset="0.393" stop-color="#E14591"></stop>
                                                <stop offset="0.561" stop-color="#C6469D"></stop>
                                                <stop offset="0.7784" stop-color="#9A49B1"></stop>
                                                <stop offset="1" stop-color="#664CC9"></stop>
                                                </linearGradient>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="absolute top-0 -ml-[52px] text-center mt-8 w-32 text-12 font-medium font-Figtree text-color-14 dark:text-white">{{ __('Finalize') }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Stepper -->
                        </div>
                    </div>

                    <!-- Campaign Form -->
                    <div class="glass-morphism dark:glass-morphism-dark 7xl:ps-[36px] p-5">
                        <form class="space-y-8" id="campaign-form">
                            @csrf
                            <input type="hidden" name="channel" value="whatsapp" />
                            <!-- Campaign Title -->
                            <div class="space-y-1.5 campaign-form">
                                <label class="flex items-center gap-2 text-sm text-color-14 dark:text-white">
                                    {{ __('Campaign Title') }}
                                    <svg
                                        class="w-4 h-4 text-color-89 mb-0.5"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </label>
                                <input
                                    required
                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                    name="title"
                                    type="text"
                                    placeholder="Enter campaign title..."
                                    class="form-control w-full p-4 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-color-14 dark:text-white"
                                />
                            </div>

                            <!-- Campaign Template -->
                            <div class="space-y-1.5 campaign-form">
                                <div class="flex items-center justify-between">
                                    <label
                                        class="text-sm text-color-14 dark:text-white"
                                        >{{ __('Select Template') }}</label
                                    >
                                </div>
                                <div class="relative">
                                    <button
                                        type="button"
                                        class="px-3 w-full bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-color-14 dark:text-whit voice-type-dropdown h-12">
                                        <div
                                            class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 mt-1 voice-type-dropdown w-full">
                                            <div class="flex justify-center items-center gap-2 w-full">
                                                <div
                                                    class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 voice-type-dropdown w-full">
                                                    <div class="flex justify-center items-center gap-2 avatar-information">
                                                        <input type="hidden" name="template" id="template" value="" />
                                                        <p class="line-clamp-single" id="template-name">{{ __('Choose Template') }}</p>
                                                    </div>
                                                    <span class="w-4 h-4">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 16 16" fill="none">
                                                            <g clip-path="url(#clip0_9797_5972)">
                                                                <path
                                                                    d="M4.2925 5L8.5 8.7085L12.7075 5L14 6.1417L8.5 11L3 6.1417L4.2925 5Z"
                                                                    fill="#898989" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_9797_5972">
                                                                    <rect width="16" height="16" fill="white"
                                                                        transform="translate(16) rotate(90)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                    <div
                                        class="hidden origin-top-right top-13 min-w-[320px] w-full p-4 absolute mx-auto border border-color-89 dark:border-color-47 rounded-lg bg-white dark:bg-color-29 z-50 voice-dropdown-content pt-3 pb-2">
                                        <div class=" w-full mt-4 xl:mt-0">
                                            <div class="flex justify-end">
                                                <div class="relative flex-1">
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
                                                    id="template-search-input"
                                                    placeholder="Search templates..."
                                                    class="pl-10 pr-10 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-dark-1 dark:text-white focus:outline-none w-full transition"
                                                    />
                                                    <div id="template-search-loader" class="hidden absolute right-3 top-1/2 -translate-y-1/2">
                                                        <svg class="animate-spin h-4 w-4 text-color-14 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto sidebar-scrollbar max-h-[180px] mt-4 avatar-container" id="template-list-container" data-next="{{ $templates->nextPageUrl() }}" data-base-url="{{ route('user.marketing-bot.campaigns.whatsapp-campaign.create') }}">
                                            @include('marketingbot::campaigns.partials.template-items', ['templates' => $templates])
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Campaign Ends On -->
                            <div class="space-y-1 campaign-form">
                                <label
                                    class="block text-sm font-medium text-color-14 dark:text-white mb-2"> {{ __('Campaign Ends On') }} </label>
                                <input
                                    required
                                    name="end_date"
                                    type="date"
                                    class="form-control w-full px-3 py-2 rounded-xl text-color-14 dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-800 transition-all duration-300"
                                />
                            </div>

                            <!-- Segments -->
                            <div class="space-y-1.5 campaign-form">
                                <div class="flex items-center justify-between">
                                    <label
                                        class="text-sm text-color-14 dark:text-white"
                                        >{{ __('Select Segment') }}</label
                                    >
                                    <button
                                        type="button"
                                        id="segments-select-all"
                                        class="text-sm text-color-14 dark:text-white"
                                    >
                                       {{__('Select All') }}
                                    </button>
                                </div>
                                <div class="relative">
                                    <button
                                        type="button"
                                        id="segments-button"
                                        class="px-3 w-full bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-color-14 dark:text-whit voice-type-dropdown h-12">
                                        <div
                                            class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 mt-1 voice-type-dropdown w-full">
                                            <div class="flex justify-center items-center gap-2 w-full">
                                                <div
                                                    class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 voice-type-dropdown w-full">
                                                    <div class="flex justify-center items-center gap-2 avatar-information">
                                                        <input type="hidden" name="segments" id="segments-hidden-input" value="" />
                                                        <p class="line-clamp-single" id="segments-display">{{ __('Select Segment') }}</p>
                                                    </div>
                                                    <span class="w-4 h-4 segments-arrow transition-transform duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 16 16" fill="none">
                                                            <g clip-path="url(#clip0_9797_5972)">
                                                                <path
                                                                    d="M4.2925 5L8.5 8.7085L12.7075 5L14 6.1417L8.5 11L3 6.1417L4.2925 5Z"
                                                                    fill="#898989" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_9797_5972">
                                                                    <rect width="16" height="16" fill="white"
                                                                        transform="translate(16) rotate(90)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                    <div
                                        class="hidden origin-top-right top-13 min-w-[320px] w-full p-4 absolute mx-auto border border-color-89 dark:border-color-47 rounded-lg bg-white dark:bg-color-29 z-50 voice-dropdown-content pt-3 pb-2"
                                        id="segments-dropdown"
                                        data-base-url="{{ route('user.marketing-bot.segments.dropdown') }}">
                                        <div class=" w-full mt-4 xl:mt-0">
                                            <div class="flex justify-end">
                                                <div class="relative flex-1">
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
                                                    id="segments-search"
                                                    placeholder=""
                                                    class="pl-10 pr-10 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-dark-1 dark:text-white focus:outline-none w-full transition"
                                                    />
                                                    <div id="segments-loader" class="hidden absolute right-3 top-1/2 -translate-y-1/2">
                                                        <svg class="animate-spin h-4 w-4 text-color-14 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto sidebar-scrollbar max-h-[180px] mt-4 avatar-container" id="segments-container">
                                            <!-- Segments will be loaded here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contacts -->
                            <div class="space-y-1.5 campaign-form">
                                <div class="flex items-center justify-between">
                                    <label
                                        class="text-sm text-color-14 dark:text-white"
                                        >{{ __('Select Contact List') }}</label
                                    >
                                    <button
                                        type="button"
                                        id="contacts-select-all"
                                        class="text-sm text-color-14 dark:text-white"
                                    >
                                        {{ __('Select All') }}
                                    </button>
                                </div>
                                <div class="relative">
                                    <button
                                        type="button"
                                        id="contacts-button"
                                        class="px-3 w-full bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-color-14 dark:text-whit voice-type-dropdown h-12">
                                        <div
                                            class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 mt-1 voice-type-dropdown w-full">
                                            <div class="flex justify-center items-center gap-2 w-full">
                                                <div
                                                    class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 voice-type-dropdown w-full">
                                                    <div class="flex justify-center items-center gap-2 avatar-information">
                                                        <input type="hidden" name="contacts" id="contacts-hidden-input" value="" />
                                                        <p class="line-clamp-single" id="contacts-display">{{ __('Select Contact List') }}</p>
                                                    </div>
                                                    <span class="w-4 h-4 contacts-arrow transition-transform duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 16 16" fill="none">
                                                            <g clip-path="url(#clip0_9797_5972)">
                                                                <path
                                                                    d="M4.2925 5L8.5 8.7085L12.7075 5L14 6.1417L8.5 11L3 6.1417L4.2925 5Z"
                                                                    fill="currentColor" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_9797_5972">
                                                                    <rect width="16" height="16" fill="white"
                                                                        transform="translate(16) rotate(90)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                    <div
                                        class="hidden origin-top-right top-13 min-w-[320px] w-full p-4 absolute mx-auto border border-color-89 dark:border-color-47 rounded-lg bg-white dark:bg-color-29 z-50 voice-dropdown-content pt-3 pb-2"
                                        id="contacts-dropdown"
                                        data-base-url="{{ route('user.marketing-bot.contacts.dropdown') }}">
                                        <div class=" w-full mt-4 xl:mt-0">
                                            <div class="flex justify-end">
                                                <div class="relative flex-1">
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
                                                    id="contacts-search"
                                                    placeholder=""
                                                    class="pl-10 pr-10 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-dark-1 dark:text-white focus:outline-none w-full transition"
                                                    />
                                                    <div id="contacts-loader" class="hidden absolute right-3 top-1/2 -translate-y-1/2">
                                                        <svg class="animate-spin h-4 w-4 text-color-14 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto sidebar-scrollbar max-h-[180px] mt-4 avatar-container" id="contacts-container">
                                            <!-- Contacts will be loaded here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Options -->
                            <div class="space-y-4 final-form hidden">
                                <div
                                    class="flex items-center justify-between px-4 py-3 rounded-xl bg-blue-50/50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-blue-100 dark:bg-blue-800 rounded-xl">
                                            <svg
                                                class="w-5 h-5 text-blue-600 dark:text-blue-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                                                />
                                            </svg>
                                        </div>
                                        <span class="font-medium text-color-14 dark:text-white" >{{ __('AI Reply') }}</span>
                                        
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" id="aiReplyToggle" name="ai_reply" />
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
                                        ></div>
                                    </label>
                                </div>

                                <div
                                    id="aiReplyOptions"
                                    class="hidden space-y-4 p-4 rounded-2xl bg-blue-50/50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-color-14 dark:text-white mb-2"
                                                >{{ __('Chat Provider') }}</label
                                            >
                                            <select
                                                class="select block w-full mt-[3px] text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control"
                                                name="chat_provider" id="chatProvider">
                                                @foreach ($chatProviders as $key => $provider)
                                                    <option value="{{ $key }}"> {{ ucwords($key) }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-color-14 dark:text-white mb-2"
                                                >{{ __('Chat Model') }}</label
                                            >
                                            @foreach ($chatProviders as $key => $provider)
                                                <div class="ProviderOptions {{ $key . '_div' }} {{ $loop->index == 0 ? '' : 'hidden' }}">
                                                    <select
                                                        class="select block w-full mt-[3px] text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control"
                                                        name="chat_model" id="chatModel">
                                                            @foreach($provider as $model)
                                                                <option value="{{ $model }}" data-provider="{{ $key }}"> {{ ucwords($model) }} </option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-color-14 dark:text-white mb-2"
                                                >{{ __('Embedding Provider') }}</label
                                            >
                                            <select
                                                class="select block w-full mt-[3px] text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control"
                                                name="embedding_provider" id="embeddingProvider">
                                                @foreach ($embeddingProviders as $key => $provider)
                                                    <option value="{{ $key }}"> {{ ucwords($key) }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-color-14 dark:text-white mb-2"
                                                >{{ __('Embedding Model') }}</label
                                            >
                                            @foreach ($embeddingProviders as $key => $provider)
                                                <div class="EmbeddingProviderOptions {{ $key . '_div' }} {{ $loop->index == 0 ? '' : 'hidden' }}">
                                                    <select
                                                        class="select block w-full mt-[3px] text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control"
                                                        name="embedding_model" id="embeddingModel">
                                                            @foreach($provider as $model)
                                                                <option value="{{ $model }}" data-provider="{{ $key }}"> {{ ucwords($model) }} </option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center justify-between px-4 py-3 rounded-xl bg-purple-50/50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800"
                                >
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="p-2 bg-purple-100 dark:bg-purple-800 rounded-xl"
                                        >
                                            <svg
                                                class="w-5 h-5 text-purple-600 dark:text-purple-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                />
                                            </svg>
                                        </div>
                                        <span class="font-medium text-color-14 dark:text-white"
                                            >{{ __('Schedule Campaign') }}</span
                                        >
                                    </div>
                                    <label
                                        class="relative inline-flex items-center cursor-pointer"
                                    >
                                        <input
                                            type="checkbox"
                                            class="sr-only peer"
                                            id="scheduleToggle"
                                            name="schedule"
                                            
                                        />
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"
                                        ></div>
                                    </label>
                                </div>

                                <!-- Schedule Options (Hidden by default) -->
                                <div
                                    id="scheduleOptions"
                                    class="hidden space-y-4 p-4 rounded-2xl bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 border border-purple-200 dark:border-purple-800"
                                >
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-color-14 dark:text-white mb-2"
                                                >{{ __('Date') }}</label
                                            >
                                            <input
                                                name="schedule_date"
                                                type="date"
                                                class="w-full px-3 py-2 rounded-xl text-color-14 dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-800 transition-all duration-300"
                                            />
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-color-14 dark:text-white mb-2"
                                                >{{ __('Time') }}</label
                                            >
                                            <input
                                                name="schedule_time"
                                                type="time"
                                                class="w-full px-3 py-2 rounded-xl text-color-14 dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-800 transition-all duration-300"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="hidden variable-form">
                                @include('marketingbot::campaigns.variables')
                            </div>

                            <!-- Send Button -->
                            <button
                                type="button"

                                data-step="1"
                                class="step-button w-full bg-gradient-to-r from-[#25D366] to-[#128C7E] text-white font-semibold py-4 px-6 rounded-xl active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-3 group">

                                <span class="button-name"> {{ __('Next') }} </span>
                                <svg
                                    class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300 rotate-90 rtl:-rotate-90 arrow-icon"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                    />
                                </svg>
                            </button>

                            <button
                                type="button"
                                data-step="0"
                                class="hidden step-button back-button w-full bg-gradient-to-r from-[#E0E0E0] to-[#B0B0B0] text-gray-800 font-semibold py-4 px-6 rounded-xl active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-3 group">

                                <svg
                                    class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-300 -rotate-90 rtl:rotate-90 arrow-icon"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                    />
                                </svg>

                                <span>{{ __('Back') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Right section (fixed mock preview) -->
                <div class="preview-section">
                    @include('marketingbot::campaigns.preview')
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@section('js')
    <script type="text/javascript">
        let route = "{{ route('user.marketing-bot.campaigns.whatsapp-campaign.store') }}";
    </script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/marketing-bot-utils.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/campaign.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/template-search.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/segments-dropdown.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/contacts-dropdown.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/whatsapp-dropdowns.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
@endsection