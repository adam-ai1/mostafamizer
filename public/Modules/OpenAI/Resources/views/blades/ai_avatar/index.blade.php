@extends('layouts.user_master')
@section('page_title', __('AI Avatar'))
@section('css')
    <link rel="stylesheet" media="all" href="{{ asset('Modules/OpenAI/Resources/assets/css/dark.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/plugin/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/datta-able/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/mini-color/css/jquery.minicolors.min.css') }}">
@endsection

@php
    $videoLeft = null;
    if ($userSubscription && in_array($userSubscription->status, ['Active', 'Cancel'])) {
        $videoLeft = $featureLimit['video']['remain'];
        $videoLimit = $featureLimit['video']['limit'];
    }
@endphp

@section('content')

    {{-- main content --}}
    <section
        class="w-[68.9%] 7xl:w-[83.9%] dark:bg-[#292929] flex flex-col flex-1 border-l dark:border-[#474746] border-color-DF h-screen relative">
        <div
            class="subscription-main flex xl:flex-row flex-col xl:h-full md:overflow-auto sidebar-scrollbar md:h-screen overflow-x-hidden">
            <div
                class="lg:pt-[88px] pt-20 9xl:px-[245px] 7xl:px-[135px] 5xl:px-[67px] px-2.5 pb-28 overflow-auto main-content flex flex-col flex-1 font-Figtree bg-color-F6 dark:bg-[#292929] border-l dark:border-[#474746] border-color-DF">
                <p class="text-color-14 text-24 font-semibold font-RedHat dark:text-white">
                    {{ __('AI Avatar!') }}</p>
                <div class="flex flex-wrap justify-between items-center gap-5">
                    <p class="text-color-89 text-[13px] leading-5 font-medium font-Figtree mt-2">
                        {{ __(':x create studio-quality videos with AI avatar. It’s as easy as making a slide deck.', ['x' => preference('company_name')]) }}
                    </p>
                    <div>
                        <a href="{{ route('user.gallery.show') }}"
                            class="flex justify-end items-center gap-2 text-color-14 dark:text-white font-Figtree font-normal leading-[22px] text-sm">
                            {{ __('View All') }}
                            <svg class="neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="12"
                                height="12" viewBox="0 0 12 12" fill="none">
                                <g clip-path="url(#clip0_9805_6003)">
                                    <path d="M3 2.175L6.7085 6L3 9.825L4.1417 11L9 6L4.1417 1L3 2.175Z"
                                        fill="currentColor" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_9805_6003">
                                        <rect width="12" height="12" fill="white"
                                            transform="matrix(1 0 0 -1 0 12)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                </div>
                <form id="ai-avatar-form">
                    <section class="bg-white dark:bg-color-3A rounded-xl mt-5 md:px-6 px-4 pb-5">
                        @if (!is_null($videoLeft) && auth()->id() == $userId)
                            <div class="flex items-center justify-start pt-6 gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                    fill="none">
                                    <g clip-path="url(#clip0_4514_3509)">
                                        <path
                                            d="M13.9714 7.00665C13.8679 6.84578 13.6901 6.75015 13.5 6.75015H9.56255V0.562738C9.56255 0.297241 9.37693 0.0677446 9.11706 0.0126204C8.85269 -0.0436289 8.59394 0.0924942 8.48594 0.334366L3.986 10.4592C3.90838 10.6325 3.92525 10.835 4.02875 10.9936C4.13225 11.1533 4.31 11.2501 4.50012 11.2501H8.43757V17.4375C8.43757 17.703 8.62319 17.9325 8.88306 17.9876C8.92244 17.9955 8.96181 18 9.00006 18C9.21831 18 9.42193 17.8729 9.51418 17.6659L14.0141 7.54102C14.0906 7.36664 14.076 7.1664 13.9714 7.00665Z"
                                            fill="url(#paint0_linear_4514_3509)" />
                                    </g>
                                    <defs>
                                        <linearGradient id="paint0_linear_4514_3509" x1="10.5204" y1="15.7845"
                                            x2="2.32033" y2="5.3758" gradientUnits="userSpaceOnUse">
                                            <stop offset="0" stop-color="#E60C84" />
                                            <stop offset="1" stop-color="#FFCF4B" />
                                        </linearGradient>
                                        <clipPath id="clip0_4514_3509">
                                            <rect width="18" height="18" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <p class="text-color-14 dark:text-white font-Figtree font-normal">
                                    {!! __('Credits Balance: :x videos left', [
                                        'x' =>
                                            "<span class='video-credit-remaining font-semibold dark:text-[#FCCA19]'>" .
                                            ($videoLimit == -1 ? __('Unlimited') : ($videoLeft < 0 ? 0 : $videoLeft)) .
                                            '</span>',
                                    ]) !!}
                                </p>
                            </div>
                        @endif

                        <div
                            class="pt-3 custom-dropdown-arrow font-normal text-14 text-[#141414] dark:text-white {{ count($providers) <= 1 ? 'hidden' : '' }}">
                            <label>{{ __('Provider') }}</label>
                            <select
                                class="select block w-full mt-[3px] text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control"
                                name="provider" id="provider">
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider }}"> {{ ucwords($provider) }} </option>
                                @endforeach
                            </select>
                        </div>

                        <p class="text-color-14 text-24 font-semibold font-RedHat dark:text-white pt-4">
                            {{ __('Avatar') }}</p>
                        <div>
                            <div class="pt-3 flex justify-start flex-wrap gap-4 items-center text-speech">
                                <div
                                    class="font-normal font-Figtree text-14 text-color-14 dark:text-white flex flex-col gap-1.5">
                                    <label>{{ __('Avatar Name') }}</label>
                                    <div class="relative">
                                        <a
                                            class="w-[275px] md:w-[372px] text-[14px] leading-6 font-normal text-color-14 dark:text-white bg-white rounded-xl dark:bg-[#333332] m-0 border-color-89 border flex justify-between items-center gap-2 py-2 px-3 dark:border-color-47 cursor-pointer voice-type-dropdown h-12">
                                            <div
                                                class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 mt-1 voice-type-dropdown w-full">
                                                <div class="flex justify-center items-center gap-2 w-full">
                                                    <img class="w-10 h-8 object-contain rounded-md avatar-image hidden"
                                                        src="{{ asset('public/assets/image/profile-pic.png') }}"
                                                        alt="{{ __('Image') }}">
                                                    <div
                                                        class="text-color-14 dark:text-white flex justify-between items-center gap-1.5 mt-1 voice-type-dropdown w-full">
                                                        <div
                                                            class="flex justify-center items-center gap-2 avatar-information">
                                                            <p class="line-clamp-single w-[150px] md:w-[250px] avatar-name">
                                                                {{ __('All Avatars') }}</p>
                                                            <input type="hidden" name="avatar_id" id="avatar_id"
                                                                value="">
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
                                        </a>
                                        <div
                                            class="hidden origin-top-right top-13 w-[275px] md:w-[372px] p-4 absolute mx-auto border border-color-89 dark:border-color-47 rounded-lg bg-white dark:bg-color-29 z-50 voice-dropdown-content pt-3 pb-2">
                                            <div class="w-full mt-4 xl:mt-0">
                                                <div class="flex justify-end">
                                                    <button class="search-btn text-[#141414] dark:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 20 20" fill="none">
                                                            <g clip-path="url(#clip0_351_1296)">
                                                                <path
                                                                    d="M18.641 17.5848L14.2471 13.0149C15.3768 11.6719 15.9958 9.98217 15.9958 8.22307C15.9958 4.11308 12.652 0.769226 8.54197 0.769226C4.43199 0.769226 1.08813 4.11308 1.08813 8.22307C1.08813 12.333 4.43199 15.6769 8.54197 15.6769C10.0849 15.6769 11.5553 15.2115 12.8124 14.3281L17.2396 18.9326C17.4247 19.1248 17.6736 19.2308 17.9403 19.2308C18.1927 19.2308 18.4322 19.1345 18.6141 18.9595C19.0004 18.5878 19.0127 17.9714 18.641 17.5848ZM8.54197 2.71371C11.5799 2.71371 14.0513 5.18514 14.0513 8.22307C14.0513 11.261 11.5799 13.7324 8.54197 13.7324C5.50405 13.7324 3.03261 11.261 3.03261 8.22307C3.03261 5.18514 5.50405 2.71371 8.54197 2.71371Z"
                                                                    fill="currentColor" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_351_1296">
                                                                    <rect width="18.4615" height="18.4615" fill="white"
                                                                        transform="translate(0.769287 0.769226)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </button>
                                                    <input
                                                        class="search-input w-full bg-white dark:bg-[#474746] py-[13px] text-color-14 dark:text-white rounded-xl text-15 font-normal ltr:pl-12 rtl:pr-12 ltr:pr-3 rtl:pl-3 border border-color-DF dark:border-color-47"
                                                        type="text" placeholder="{{ __('Search Avatar') }}"
                                                        oninput="debouncedSearch(this, '.avatar-list', 'avatar')">
                                                </div>
                                            </div>
                                            <div class="overflow-auto sidebar-scrollbar max-h-[220px] mt-4 avatar-container"
                                                data-next-page-url="{{ $avatars->nextPageUrl() }}">
                                                <div class="grid grid-cols-2 gap-2 mt-4 avatar-list">
                                                    @foreach ($avatars as $avatar)
                                                        <div class="avatar-card flex flex-col gap-2 items-center justify-center rounded cursor-pointer hover:bg-[#f3f3f3] dark:hover:bg-color-43 p-2"
                                                            data-name="{{ $avatar->name }}"
                                                            data-id="{{ $avatar->avatar_id }}"
                                                            data-image="{{ $avatar->image_url }}"
                                                            onclick="selectAvatar(this)">
                                                            <img class="object-cover rounded w-full h-[92px]"src="{{ $avatar->image_url }}"
                                                                alt="{{ __('Image') }}">
                                                            <p
                                                                class="dark:text-white font-medium text-[15px] p-1 leading-[22px] font-Figtree wrap-anywhere text-left line-clamp-single dept-name avatar-name">
                                                                {{ $avatar->name }}
                                                            </p>

                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($avatarOptions as $option)
                                    @if ($option['visibility'] && $option['type'] == 'dropdown' && $option['name'] != 'horizontal_align')
                                        <div
                                            class="font-normal custom-dropdown-arrow text-14 text-color-14 dark:text-white flex flex-col gap-1.5 {{ count($option['value']) <= 1 ? 'hidden' : '' }}">
                                            <div class="flex gap-2 justify-start items-center">
                                                <label>{{ $option['label'] }}</label>
                                            </div>

                                            <select
                                                class="selectg block text-base leading-6 font-medium text-color-14 bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] m-0 focus:text-color-14 focus:bg-white focus:border-color-89 focus:outline-none md:w-[225px] w-[170px]"
                                                id="{{ $option['name'] }}" name="{{ $option['name'] }}">
                                                @foreach ($option['value'] as $value)
                                                    <option
                                                        {{ isset($option['default_value']) && $option['default_value'] == $value ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    @elseif ($option['visibility'] && $option['type'] == 'dropdown' && $option['name'] == 'horizontal_align')

                                        <div
                                            class="horizontal-align-class font-normal custom-dropdown-arrow text-14 text-color-14 dark:text-white flex flex-col gap-1.5 {{ count($option['value']) <= 1 ? 'hidden' : '' }} hidden">
                                            <div class="flex gap-2 justify-start items-center">
                                                <label>{{ $option['label'] }}</label>
                                            </div>

                                            <select
                                                class="selectg block text-base leading-6 font-medium text-color-14 bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] m-0 focus:text-color-14 focus:bg-white focus:border-color-89 focus:outline-none md:w-[225px] w-[170px]"
                                                id="{{ $option['name'] }}" name="{{ $option['name'] }}">
                                                @foreach ($option['value'] as $value)
                                                    <option
                                                        {{ isset($option['default_value']) && $option['default_value'] == $value ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    @elseif ($option['type'] === 'text' && $option['name'] != 'provider' && $option['name'] != 'background_color')
                                        <div class="font-normal text-14 text-color-14 dark:text-white flex flex-col gap-1.5">
                                            <label>{{ __($option['label']) }}</label>
                                            <input type="text" id="{{ $option['name'] }}" name="{{ $option['name'] }}"
                                                value="{{ $option['value'] }}"
                                                class="block text-base leading-6 font-medium text-color-14 bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] focus:text-color-14 focus:bg-white focus:border-color-89 focus:outline-none md:w-[225px] w-[170px]">
                                        </div>
                                    @elseif ($option['type'] === 'text' && $option['name'] == 'background_color')
                                    
                                        <div class="font-normal text-14 text-color-14 dark:text-white flex flex-col gap-1.5">
                                            <label>{{ __($option['label']) }}</label>
                                            <input type="text" id="{{ $option['name'] }}" name="{{ $option['name'] }}"
                                                value="#00b140"
                                                class="block w-full h-12 text-base leading-6 font-medium text-color-14 bg-white bg-clip-padding p-2 bg-no-repeat rounded-xl dark:bg-[#333332] focus:text-color-14 focus:bg-white focus:border-color-89 focus:outline-none md:w-[225px] w-[170px]">
                                        </div>
                                    
                                    @endif
                                @endforeach
                            </div>

                            <p class="text-color-14 text-24 font-semibold font-RedHat dark:text-white pt-4">
                                {{ __('Video') }}</p>
                            <div>
                                <div class="pt-3 flex justify-start flex-wrap gap-4 items-center text-speech">
                                    @foreach ($videoOptions as $option)
                                        @if ($option['visibility'] && $option['type'] == 'dropdown')
                                            <div
                                                class="font-normal custom-dropdown-arrow text-14 text-color-14 dark:text-white flex flex-col gap-1.5 {{ count($option['value']) <= 1 ? 'hidden' : '' }}">
                                                <div class="flex gap-2 justify-start items-center">
                                                    <label>{{ $option['label'] }}</label>
                                                </div>
    
                                                <select
                                                    class="selectg block text-base leading-6 font-medium text-color-14 bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] m-0 focus:text-color-14 focus:bg-white focus:border-color-89 focus:outline-none md:w-[225px] w-[170px]"
                                                    id="{{ $option['name'] }}" name="{{ $option['name'] }}">
                                                    @foreach ($option['value'] as $value)
                                                        <option
                                                            {{ isset($option['default_value']) && $option['default_value'] == $value ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
    
                                            </div>
                                        @elseif ($option['type'] === 'text' && $option['name'] != 'provider')
                                            <div class="font-normal text-14 text-color-14 dark:text-white flex flex-col gap-1.5">
                                                <label>{{ __($option['label']) }}</label>
                                                <input type="text" id="{{ $option['name'] }}" name="{{ $option['name'] }}"
                                                    value="{{ $option['value'] }}"
                                                    class="block text-base leading-6 font-medium text-color-14 bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] focus:text-color-14 focus:bg-white focus:border-color-89 focus:outline-none md:w-[225px] w-[170px]">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            
                            <div class="mt-6">
                                <div class="flex justify-between items-center">
                                    <p class="font-Figtree text-color-14 font-medium leading-6 text-base dark:text-white">
                                        {{ __('Your Text') }}</p>
                                    <p class="text-color-89 font-Figtree font-medium text-[13px] leading-5">
                                        {{ __('Words Limit: :x', ['x' => preference('long_desc_length')]) }} </p>
                                </div>
                                <div id="textFieldsContainer">
                                    <div class="flex gap-3 w-full text-area-content">
                                        <div class="relative valid-parent border grow border-color-89 dark:border-color-47 dark:bg-[#333332] rounded-xl p-2 flex gap-3 mt-1.5"
                                            id="text-area">
                                            <textarea maxlength="{{ preference('long_desc_length') }}" required
                                                class="py-1 text-base overflow-y-scroll middle-sidebar-scroll leading-6 font-light !text-color-14 dark:!text-white bg-white dark:bg-[#333332] bg-clip-padding bg-no-repeat border border-none dark:!border-none mx-auto focus:text-color-14 focus:bg-white focus:border-none focus:dark:!border-none focus:outline-none px-0 outline-none form-control w-full textToSpeechInput"
                                                placeholder="{{ __('Write down the text you want to add in your voice.') }}" rows="4" name="prompt"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button
                            class="magic-bg w-max rounded-lg text-16 text-white font-semibold py-2.5 px-[38px] flex justify-center items-center gap-3 mt-[17px] mx-auto"
                            id="ai-avatar-generation">
                            <span>
                                {{ __('Generate Video') }}
                            </span>
                            <svg class="loader animate-spin h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg"
                                width="72" height="72" viewBox="0 0 72 72" fill="none">
                                <mask id="path-1-inside-1_1032_3036" fill="white">
                                    <path
                                        d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z" />
                                </mask>
                                <path
                                    d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z"
                                    stroke="url(#paint0_linear_1032_3036)" stroke-width="24"
                                    mask="url(#path-1-inside-1_1032_3036)" />
                                <defs>
                                    <linearGradient id="paint0_linear_1032_3036" x1="46.8123" y1="63.1382"
                                        x2="21.8195" y2="6.73779" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#E60C84" />
                                        <stop offset="1" stop-color="#FFCF4B" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </button>
                    </section>
                </form>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mt-5 ai-avatar-list">
                    @foreach ($videos as $video)
                        <div class="bg-white dark:bg-color-43 rounded p-2 video-container"
                            id="video_{{ $video->id }}">
                            <div class="relative">
                                <video class="myVideos">
                                    @if ($video->file_name)
                                        <source
                                            src={{ objectStorage()->url('public//uploads//aiVideos//' . $video->file_name) ?? '' }}
                                            type="video/mp4">
                                    @endif
                                </video>
                                <div class="progress-container absolute" id="progressContainer">
                                    <div class="progress-video-bar" id="progressBar"></div>
                                </div>
                            </div>
                            <div class="flex justify-center items-center gap-2 my-3">
                                <a href="{{ objectStorage()->url('public//uploads//aiVideos//' . $video->file_name) }}"
                                    download="{{ str_replace('.', '', $video->title) }}"
                                    class="file-need-download relative md:w-[34px] md:h-[34px] w-7 h-7 flex items-center m-auto justify-center rounded-lg border border-color-47 dark:border-white text-color-47 dark:text-white image-tooltip-download">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9 2.25C9.41421 2.25 9.75 2.58579 9.75 3V10.1893L12.2197 7.71967C12.5126 7.42678 12.9874 7.42678 13.2803 7.71967C13.5732 8.01256 13.5732 8.48744 13.2803 8.78033L9.53033 12.5303C9.23744 12.8232 8.76256 12.8232 8.46967 12.5303L4.71967 8.78033C4.42678 8.48744 4.42678 8.01256 4.71967 7.71967C5.01256 7.42678 5.48744 7.42678 5.78033 7.71967L8.25 10.1893V3C8.25 2.58579 8.58579 2.25 9 2.25ZM3 12C3.41421 12 3.75 12.3358 3.75 12.75V14.25C3.75 14.4489 3.82902 14.6397 3.96967 14.7803C4.11032 14.921 4.30109 15 4.5 15H13.5C13.6989 15 13.8897 14.921 14.0303 14.7803C14.171 14.6397 14.25 14.4489 14.25 14.25V12.75C14.25 12.3358 14.5858 12 15 12C15.4142 12 15.75 12.3358 15.75 12.75V14.25C15.75 14.8467 15.5129 15.419 15.091 15.841C14.669 16.2629 14.0967 16.5 13.5 16.5H4.5C3.90326 16.5 3.33097 16.2629 2.90901 15.841C2.48705 15.419 2.25 14.8467 2.25 14.25V12.75C2.25 12.3358 2.58579 12 3 12Z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                                <button
                                    class="play-pause rounded-full md:p-4 p-2 bg-color-47 dark:bg-white text-white dark:text-color-43">
                                    <!-- Play SVG Icon -->
                                    <svg class="playIcon neg-transition-scale w-[20px] h-[20px]" width="40"
                                        height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.44906 7.93287C9.49374 7.55428 9.62621 7.19135 9.83592 6.873C10.0456 6.55464 10.3268 6.28965 10.657 6.09914C10.9872 5.90863 11.3573 5.79786 11.7379 5.77564C12.1184 5.75343 12.4989 5.8204 12.8491 5.9712C14.6191 6.72787 18.5857 8.5262 23.6191 11.4312C28.6541 14.3379 32.1957 16.8762 33.7341 18.0279C35.0474 19.0129 35.0507 20.9662 33.7357 21.9545C32.2124 23.0995 28.7141 25.6045 23.6191 28.5479C18.5191 31.4912 14.5991 33.2679 12.8457 34.0145C11.3357 34.6595 9.64573 33.6812 9.44906 32.0529C9.21906 30.1495 8.78906 25.8279 8.78906 19.9912C8.78906 14.1579 9.2174 9.83787 9.44906 7.93287Z"
                                            fill="currentColor" />
                                    </svg>
                                    <!-- Pause SVG Icon -->
                                    <svg class="pauseIcon neg-transition-scale w-[20px] h-[20px]" width="40"
                                        height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                        <path
                                            d="M13.334 4.16699H10.0007C7.69946 4.16699 5.83398 6.03247 5.83398 8.33366V31.667C5.83398 33.9682 7.69946 35.8337 10.0007 35.8337H13.334C15.6352 35.8337 17.5007 33.9682 17.5007 31.667V8.33366C17.5007 6.03247 15.6352 4.16699 13.334 4.16699Z"
                                            fill="currentColor" />
                                        <path
                                            d="M30 4.16699H26.6667C24.3655 4.16699 22.5 6.03247 22.5 8.33366V31.667C22.5 33.9682 24.3655 35.8337 26.6667 35.8337H30C32.3012 35.8337 34.1667 33.9682 34.1667 31.667V8.33366C34.1667 6.03247 32.3012 4.16699 30 4.16699Z"
                                            fill="currentColor" />
                                    </svg>
                                </button>
                                <a href="javascript: void(0)"
                                    class="relative md:w-[34px] md:h-[34px] w-7 h-7 flex items-center m-auto justify-center rounded-lg border border-color-47 dark:border-white text-color-47 dark:text-white modal-toggle image-tooltip-delete gallery-dlt"
                                    id="{{ $video->id }}" type="{{ $video->type }}">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5 1.25C5 0.835786 5.33579 0.5 5.75 0.5H10.25C10.6642 0.5 11 0.835786 11 1.25C11 1.66421 10.6642 2 10.25 2H5.75C5.33579 2 5 1.66421 5 1.25ZM2.74418 2.75H1.25C0.835786 2.75 0.5 3.08579 0.5 3.5C0.5 3.91421 0.835786 4.25 1.25 4.25H2.04834L2.52961 11.4691C2.56737 12.0357 2.59862 12.5045 2.65465 12.8862C2.71299 13.2835 2.80554 13.6466 2.99832 13.985C3.29842 14.5118 3.75109 14.9353 4.29667 15.1997C4.64714 15.3695 5.0156 15.4377 5.41594 15.4695C5.80046 15.5 6.27037 15.5 6.8382 15.5H9.1618C9.72963 15.5 10.1995 15.5 10.5841 15.4695C10.9844 15.4377 11.3529 15.3695 11.7033 15.1997C12.2489 14.9353 12.7016 14.5118 13.0017 13.985C13.1945 13.6466 13.287 13.2835 13.3453 12.8862C13.4014 12.5045 13.4326 12.0356 13.4704 11.469L13.9517 4.25H14.75C15.1642 4.25 15.5 3.91421 15.5 3.5C15.5 3.08579 15.1642 2.75 14.75 2.75H13.2558C13.2514 2.74996 13.2471 2.74996 13.2427 2.75H2.75731C2.75294 2.74996 2.74857 2.74996 2.74418 2.75ZM12.4483 4.25H3.55166L4.0243 11.3396C4.06455 11.9433 4.09238 12.3525 4.13874 12.6683C4.18377 12.9749 4.23878 13.1321 4.30166 13.2425C4.45171 13.5059 4.67804 13.7176 4.95083 13.8498C5.06513 13.9052 5.22564 13.9497 5.53464 13.9742C5.85277 13.9995 6.26289 14 6.86799 14H9.13201C9.73711 14 10.1472 13.9995 10.4654 13.9742C10.7744 13.9497 10.9349 13.9052 11.0492 13.8498C11.322 13.7176 11.5483 13.5059 11.6983 13.2425C11.7612 13.1321 11.8162 12.9749 11.8613 12.6683C11.9076 12.3525 11.9354 11.9433 11.9757 11.3396L12.4483 4.25ZM6.5 6.125C6.91421 6.125 7.25 6.46079 7.25 6.875V10.625C7.25 11.0392 6.91421 11.375 6.5 11.375C6.08579 11.375 5.75 11.0392 5.75 10.625V6.875C5.75 6.46079 6.08579 6.125 6.5 6.125ZM9.5 6.125C9.91421 6.125 10.25 6.46079 10.25 6.875V10.625C10.25 11.0392 9.91421 11.375 9.5 11.375C9.08579 11.375 8.75 11.0392 8.75 10.625V6.875C8.75 6.46079 9.08579 6.125 9.5 6.125Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <div class="modal index-modal absolute z-[9999999999] top-0 left-0 right-0 w-full h-full">
        <div class="modal-overlay fixed z-10 top-0 right-0 left-0 w-full h-full">
        </div>
        <div class="modal-wrapper  modal-wrapper modal-transition fixed inset-0 z-10">
            <div class="modal-body flex h-full justify-center p-4 text-center items-center sm:p-0">
                <div class="modal-content modal-transition rounded-xl py-6 md:px-[54px] bg-white dark:bg-color-3A px-8">
                    <p class="font-Figtree text-color-14 dark:text-white text-16 font-medium text-center">
                        {{ __('Are you sure you want to delete this Item?') }}</p>
                    <div class="flex justify-center items-center mt-7 gap-[16px]">
                        <a href="javascript: void(0)"
                            class="font-Figtree text-color-14 dark:text-white font-semibold text-15 py-[11px] px-[42px] border border-color-89 dark:border-color-47 bg-color-F6 dark:bg-color-47 rounded-xl modal-toggle">
                            {{ __('Cancel') }}</a>
                        <a href="javascript: void(0)"
                            class="font-Figtree text-white font-semibold text-15 py-[11px] px-[30px] modal-toggle bg-color-DFF rounded-xl delete-image">
                            {{ __('Yes, Delete') }} </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end main content --}}
@endsection
@section('js')
    <script src="{{ asset('public/assets/plugin/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('public/datta-able/plugins/mini-color/js/jquery.minicolors.min.js') }}"></script>

    <script>
        var PROMPT_URL = "{{ !empty($promptUrl) ? $promptUrl : '' }}";
        var avatarBackgroundInput = $('#background_color');

    </script>

    <script src="{{ asset('Modules/OpenAI/Resources/assets/js/customer/ai_avatar/custom-dropdown.min.js') }}"></script>
    <script src="{{ asset('Modules/OpenAI/Resources/assets/js/customer/ai_avatar/script.min.js') }}"></script>
    <script src="{{ asset('Modules/OpenAI/Resources/assets/js/custom-tom-select.min.js') }}"></script>
@endsection
