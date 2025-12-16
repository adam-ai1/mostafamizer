@extends('layouts.user_master')
@section('page_title', __(':x Campaigns', ['x' => __('Telegram')]))

@section('content')
@php
    $channelPreferences = getMarketingBotChannelPreferences();
@endphp
     <main class="w-[68.9%] 5xl:w-[85.9%] pt-[56px] dark:bg-[#292929] flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF">
        <div class="xl:flex h-full subscription-main bg-color-F6 dark:bg-color-29">
            <!-- Start Sidebar -->
            @include('marketingbot::layouts.sidebar')
            <!-- End Sidebar -->

            <div class="w-full xl:h-[calc(100vh-56px)] overflow-y-auto relative bg-color-F9 dark:bg-color-29 pb-8">
                <!-- Left section -->
                <div class="w-full 6xl:max-w-[420px] 7xl:max-w-[488px] 8xl:max-w-[495px] mx-left">
                    <!-- Header -->

                    @if($channelPreferences['whatsapp_enabled'])
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
                                class="app-tab flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-medium text-[#25D366] hover:bg-white/40 dark:hover:bg-white/5 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-1 focus-visible:ring-green-400 transition transform"
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
                                <span> {{ __('WhatsApp') }}</span>
                            </a>

                            <!-- Telegram Button -->
                            <a
                                href="{{ route('user.marketing-bot.campaigns.telegram-campaign.create') }}"
                                role="tab"
                                aria-selected="false"
                                data-app="telegram"
                                class="app-tab flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-white dark:bg-color-14 font-medium text-[#0088cc] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-1 focus-visible:ring-blue-400 transition transform active:scale-[0.99]"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                </svg>
                                <span> {{ __('Telegram') }}</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    <div class="mb-4 7xl:ps-[36px] p-5">
                        <h1
                            class="font-redhat text-2xl font-bold bg-gradient-to-r from-[#0088cc] to-[#229ed9] bg-clip-text text-transparent"
                        >
                            {{ __('Telegram Campaign') }}
                        </h1>
                        <p class="mt-[6px] text-color-89 text-15 font-medium">
                            {{ __('Create and manage your Telegram marketing campaigns with ease.') }}
                        </p>
                    </div>

                    <!-- Campaign Form -->
                    <div class="glass-morphism dark:glass-morphism-dark 7xl:ps-[36px] p-5">
                        <form class="space-y-8" id="campaign-form">
                            @csrf
                            <input type="hidden" name="channel" value="telegram" />
                            <!-- Campaign Title -->
                            <div class="space-y-1.5">
                                <label
                                    class="flex items-center gap-2 text-sm text-color-14 dark:text-white"
                                >
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
                                    type="text"
                                    name="title"
                                    placeholder="Enter campaign title..."
                                    required
                                    class="form-control w-full p-4 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-color-14 dark:text-white"
                                />
                            </div>

                            <!-- Content -->
                            <div class="space-y-1">
                                <div class="flex items-center justify-between">
                                    <label class="text-sm text-color-14 dark:text-white">{{ __('Content') }}</label>
                                </div>
                                <textarea
                                    name="content"
                                    required
                                    rows="6"
                                    placeholder="Type the message you want to send to contacts"
                                    class="form-control w-full p-2.5 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-color-14 dark:text-white resize-none"
                                ></textarea>
                            </div>

                            <!-- Custom Image -->
                            <div class="space-y-1">
                                <div class="flex items-center justify-between">
                                    <label
                                        class="text-sm text-color-14 dark:text-white"
                                        > {{ __('Select Image') }} </label
                                    >
                                </div>
                                <div class="relative w-full h-32 border-2 border-dashed border-color-DF dark:border-color-47 rounded-xl cursor-pointer hover:border-[#25D366] dark:hover:border-[#25D366] transition-all duration-300 bg-white dark:bg-color-33 group overflow-hidden">

                                    <!-- Hidden File Input -->
                                    <input class=" hidden" name="image" type="file" id="imageUpload" accept="image/*"/>

                                    <!-- Label (Click to Upload) -->
                                    <label for="imageUpload" id="uploadLabel" class="flex items-center justify-center w-full h-full text-center cursor-pointer">
                                        <div>
                                            <svg
                                                class="w-8 h-8 mx-auto mb-2 text-gray-400 group-hover:text-whatsapp transition-colors duration-300"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                                />
                                            </svg>
                                            <p class="text-sm text-color-89">
                                                <span class="font-semibold text-[#25D366]">{{ __('Choose File') }}</span>
                                                {{ __('or drag it here') }} <br />
                                                {{ __('(Max file size: :x MB)', ['x' => preference('file_size')]) }}
                                            </p>
                                        </div>
                                    </label>

                                    <!-- Image Preview -->
                                    <img id="previewImgSection" class="absolute inset-0 w-full h-full object-cover hidden rounded-xl" />

                                    <!-- Delete Button -->
                                    <button type="button" id="deleteImg" class="absolute top-2 right-2 bg-black/60 text-white p-1 rounded-full hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-4 h-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label
                                    class="block text-sm font-medium text-color-14 dark:text-white mb-2"> {{ __('End Date') }} </label>
                                <input
                                    name="end_date"
                                    required
                                    type="date"
                                    class="form-control w-full px-3 py-2 rounded-xl text-color-14 dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-800 transition-all duration-300"
                                />
                            </div>

                            <!-- Groups -->
                            <div class="space-y-1.5 campaign-form">
                                <div class="flex items-center justify-between">
                                    <label
                                        class="text-sm text-color-14 dark:text-white"
                                        >{{ __('Select Group') }}</label
                                    >
                                    <button
                                        type="button"
                                        id="groups-select-all"
                                        class="text-sm text-color-14 dark:text-white"
                                    >
                                       {{__('Select All') }}
                                    </button>
                                </div>
                                <div class="relative">
                                    <button
                                        type="button"
                                        id="groups-button"
                                        class="px-3 w-full bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-color-14 dark:text-whit voice-type-dropdown h-12">
                                        <div
                                            class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 mt-1 voice-type-dropdown w-full">
                                            <div class="flex justify-center items-center gap-2 w-full">
                                                <div
                                                    class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 voice-type-dropdown w-full">
                                                    <div class="flex justify-center items-center gap-2 avatar-information">
                                                        <input type="hidden" name="groups" id="groups-hidden-input" value="" />
                                                        <p class="line-clamp-single" id="groups-display">{{ __('Select Group') }}</p>
                                                    </div>
                                                    <span class="w-4 h-4 groups-arrow transition-transform duration-200">
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
                                        id="groups-dropdown"
                                        data-base-url="">
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
                                                    id="groups-search"
                                                    placeholder=""
                                                    class="pl-10 pr-10 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-dark-1 dark:text-white focus:outline-none w-full transition"
                                                    />
                                                    <div id="groups-loader" class="hidden absolute right-3 top-1/2 -translate-y-1/2">
                                                        <svg class="animate-spin h-4 w-4 text-color-14 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto sidebar-scrollbar max-h-[180px] mt-4 avatar-container" id="groups-container">
                                            @foreach ($groups as $group)
                                                <div class="px-4 py-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer flex items-center gap-3 transition-colors duration-150"
                                                    data-id="{{ $group->id }}"
                                                    data-name="{{ htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8') }}">
                                                    <div class="relative flex items-center">
                                                        <input type="checkbox"
                                                               class="group-checkbox w-4 h-4 rounded border-color-DF dark:border-color-47 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-0 cursor-pointer transition-all duration-150"
                                                               value="{{ $group->id }}">
                                                    </div>
                                                    <span class="flex-1 font-medium">{{ $group->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Subscribers -->
                            <div class="space-y-1.5 campaign-form">
                                <div class="flex items-center justify-between">
                                    <label
                                        class="text-sm text-color-14 dark:text-white"
                                        >{{ __('Select Subscriber') }}</label
                                    >
                                    <button
                                        type="button"
                                        id="subscribers-select-all"
                                        class="text-sm text-color-14 dark:text-white"
                                    >
                                        {{ __('Select All') }}
                                    </button>
                                </div>
                                <div class="relative">
                                    <button
                                        type="button"
                                        id="subscribers-button"
                                        class="px-3 w-full bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-color-14 dark:text-whit voice-type-dropdown h-12">
                                        <div
                                            class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 mt-1 voice-type-dropdown w-full">
                                            <div class="flex justify-center items-center gap-2 w-full">
                                                <div
                                                    class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 voice-type-dropdown w-full">
                                                    <div class="flex justify-center items-center gap-2 avatar-information">
                                                        <input type="hidden" name="subscribers" id="subscribers-hidden-input" value="" />
                                                        <p class="line-clamp-single" id="subscribers-display">{{ __('Select Subscriber') }}</p>
                                                    </div>
                                                    <span class="w-4 h-4 subscribers-arrow transition-transform duration-200">
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
                                        id="subscribers-dropdown"
                                        data-base-url="">
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
                                                    id="subscribers-search"
                                                    placeholder=""
                                                    class="pl-10 pr-10 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-dark-1 dark:text-white focus:outline-none w-full transition"
                                                    />
                                                    <div id="subscribers-loader" class="hidden absolute right-3 top-1/2 -translate-y-1/2">
                                                        <svg class="animate-spin h-4 w-4 text-color-14 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto sidebar-scrollbar max-h-[180px] mt-4 avatar-container" id="subscribers-container">
                                            @foreach ($subscribers as $subscriber)
                                                <div class="px-4 py-2.5 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer flex items-center gap-3 transition-colors duration-150"
                                                    data-id="{{ $subscriber->id }}"
                                                    data-name="{{ htmlspecialchars($subscriber->name ?? $subscriber->phone ?? 'Subscriber ' . $subscriber->id, ENT_QUOTES, 'UTF-8') }}">
                                                    <div class="relative flex items-center">
                                                        <input type="checkbox"
                                                               class="subscriber-checkbox w-4 h-4 rounded border-color-DF dark:border-color-47 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-0 cursor-pointer transition-all duration-150"
                                                               value="{{ $subscriber->id }}">
                                                    </div>
                                                    <span class="flex-1 font-medium">{{ $subscriber->name ?? $subscriber->phone ?? 'Subscriber ' . $subscriber->id }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Options -->
                            <div class="space-y-4">
                                <div
                                    class="flex items-center justify-between px-4 py-3 rounded-xl bg-blue-50/50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800"
                                >
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

                            <!-- Send Button -->
                            <button
                                type="submit"
                                class="w-full bg-gradient-to-r from-[#0088cc] to-[#229ed9] text-white font-semibold py-4 px-6 rounded-xl active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-3 group"
                            >
                                <svg class="w-5 h-5 animate-spin text-white hidden loader-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="button-name"> {{ __('Start Campaign') }} </span>
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
                        </form>
                    </div>
                </div>

                <!-- Right section (fixed mock preview) -->
                <div class="6xl:fixed 6xl:h-[calc(100vh-58px)] p-4 w-full max-w-full 6xl:max-w-[470px] 7xl:max-w-[540px] 8xl:max-w-[612px] bottom-0 end-4">
                    <div 
                        class="flex flex-col justify-end h-full p-5 bg-transparent bg-no-repeat rounded-xl bg-cover bg-right-bottom bg-white dark:bg-color-33" 
                        style="background-image: url('{{ asset('Modules/Marketingbot/Resources/assets/images/gradient-bg-of-pattern.svg')}}')">
                        <div class="flex justify-center">
                            <div class="relative">
                                <!-- Phone Frame -->
                                <div class="w-80 h-[640px] bg-gradient-to-b from-gray-800 to-gray-900 rounded-[3rem] p-3 phone-shadow">
                                    <div class="w-full h-full bg-gray-100 dark:bg-gray-800 rounded-[2.5rem] overflow-hidden relative">
                                        <!-- Phone Header -->
                                        <div class="bg-gradient-to-br from-[#0088cc] to-[#229ed9] p-4 flex items-center justify-between text-white">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="font-semibold">{{ __('Username') }}</div>
                                                    <div class="text-xs opacity-90 flex items-center gap-1">
                                                        {{ __('last seen recently') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex gap-2">
                                                <button class="p-1.5 hover:bg-white/10 rounded-full transition-colors duration-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                    </svg>
                                                </button>
                                                <button class="p-1.5 hover:bg-white/10 rounded-full transition-colors duration-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Chat Area -->
                                        <div class="flex-1 p-4 bg-gradient-to-b from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 h-[calc(100%-180px)] relative overflow-hidden">
                                            <!-- Preview Message -->
                                            <div class="relative">
                                                <div class="bg-white dark:bg-gray-600 rounded-2xl rounded-bl-sm p-4 max-w-[85%] shadow-lg border-l-4 border-[#0088cc]">
                                                    <img id="previewImg" class="rounded-lg mb-2" src="{{ asset('Modules/MarketingBot/Resources/assets/images/bot-marketing.png') }}" alt="campaign-banner">
                                                    <p id="previewText" class="text-gray-800 dark:text-gray-200 text-sm leading-relaxed break-words">
                                                        {{__('This is what your campaign will look like.') }}
                                                    </p>
                                                    <div class="flex items-center justify-end mt-3 gap-1">
                                                        <span class="text-xs text-gray-500 dark:text-gray-400">09:30 AM</span>
                                                        <svg class="w-4 h-4 text-[#0088cc]" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Chat Input -->
                                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-100 dark:bg-gray-800">
                                            <div class="flex items-center justify-center gap-2">
                                                <div
                                                    class="flex items-center bg-white dark:bg-gray-700 rounded-full p-2"
                                                >
                                                    <button
                                                        class="p-1 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                                                    >
                                                        <svg
                                                            class="w-5 h-5"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.01M15 10h1.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                            />
                                                        </svg>
                                                    </button>
                                                    <input
                                                        type="text"
                                                        placeholder="Write a message..."
                                                        class="flex-1 !bg-transparent border-none outline-none text-sm text-gray-700 dark:text-gray-300 placeholder-gray-500 dark:placeholder-gray-400"
                                                        disabled
                                                    />
                                                    <button class="p-1 text-gray-500 dark:text-gray-400">
                                                        <svg
                                                            class="w-5 h-5"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <button class="shrink-0 flex items-center justify-center p-2 rounded-full bg-gradient-to-br from-[#0088cc] to-[#229ed9] text-white shadow-lg hover:bg-green-600 active:scale-95 transition">
                                                    <svg class="w-5 h-5 rtl:rotate-180" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </main>
@endsection

@section('js')
    <script type="text/javascript">
        let route = "{{ route('user.marketing-bot.campaigns.telegram-campaign.store') }}";
    </script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/marketing-bot-utils.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/campaign.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/groups-dropdown.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/subscribers-dropdown.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/telegram-dropdowns.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
@endsection