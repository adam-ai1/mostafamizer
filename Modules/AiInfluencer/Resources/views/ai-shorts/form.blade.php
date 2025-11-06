@section('css')
    <link rel="stylesheet" href="{{ asset('public/dist/css/site_custom.min.css') }}">
@endsection

@php
    $videoLeft = null;
    if ($userSubscription && in_array($userSubscription->status, ['Active', 'Cancel'])) {
        $videoLeft = $featureLimit['video']['remain'];
        $videoLimit = $featureLimit['video']['limit'];
    }
@endphp
<form id="aishorts-form">
    <div class="px-5 py-[22px] sm:py-8 xl:px-6 xl:pb-[56px] pt-10 font-Figtree">
        <div class="bg-white dark:bg-[#474746] py-7 px-6 rounded-xl mt-5">
            <p class="text-color-14 text-24 font-semibold font-RedHat dark:text-white">
                {{ __('AI Shorts') }}</p>
            <p class="text-color-89 text-13 font-medium font-Figtree mt-2">
                {{ __('State-of-the-art AI image processing for the creation and enhancement of visual content.') }}
            </p>
            @if ($videoLeft && auth()->user()->id == $userId)
                <div class="bg-[#F6F3F2] dark:bg-[#3A3A39] p-3 rounded-xl flex items-center justify-start mt-6 gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <g clip-path="url(#clip0_4514_3509)">
                            <path
                                d="M13.9714 7.00665C13.8679 6.84578 13.6901 6.75015 13.5 6.75015H9.56255V0.562738C9.56255 0.297241 9.37693 0.0677446 9.11706 0.0126204C8.85269 -0.0436289 8.59394 0.0924942 8.48594 0.334366L3.986 10.4592C3.90838 10.6325 3.92525 10.835 4.02875 10.9936C4.13225 11.1533 4.31 11.2501 4.50012 11.2501H8.43757V17.4375C8.43757 17.703 8.62319 17.9325 8.88306 17.9876C8.92244 17.9955 8.96181 18 9.00006 18C9.21831 18 9.42193 17.8729 9.51418 17.6659L14.0141 7.54102C14.0906 7.36664 14.076 7.1664 13.9714 7.00665Z"
                                fill="url(#paint0_linear_4514_3509)" />
                        </g>
                        <defs>
                            <linearGradient id="paint0_linear_4514_3509" x1="10.5204" y1="15.7845" x2="2.32033"
                                y2="5.3758" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#E60C84" />
                                <stop offset="1" stop-color="#FFCF4B" />
                            </linearGradient>
                            <clipPath id="clip0_4514_3509">
                                <rect width="18" height="18" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>

                    <p class="text-color-14 dark:text-white font-Figtree font-normal"> {!! __('Credits Balance: :x video left', [
                        'x' => "<span class='video-credit-remaining font-semibold text-[#E22861] dark:text-[#FCCA19]'>" . ($videoLimit == -1 ? __('Unlimited') : ($videoLeft < 0 ? 0 : $videoLeft)) . '</span>',
                    ]) !!}</p>
                </div>
            @endif

            <div class="w-full gender-container">
            <p class="text-color-14 dark:text-white font-Figtree text-14 font-semibold mt-6 flex items-center gap-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/>
                </svg>
                {{ __('Upload Video') }}
            </p>

            <div class="drop-zone" id="file-upload-container">
                <div class="file-info-container border-color-89 bg-color-F3 dark:bg-color-33 dark:border-color-47 mt-[7px] cursor-pointer text-[13px] leading-[18px] font-normal font-Figtree text-colo-14 wrap-anywhere text-center py-[37px] px-4 border rounded-xl border-dotted hover:scale-[1.01] transition-transform duration-200">
                    <div class="file-info-text justify-center items-center flex gap-2 text-color-14 dark:text-color-89">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99935 2.6665C8.36754 2.6665 8.66602 2.96498 8.66602 3.33317V7.33317H12.666C13.0342 7.33317 13.3327 7.63165 13.3327 7.99984C13.3327 8.36803 13.0342 8.6665 12.666 8.6665H8.66602V12.6665C8.66602 13.0347 8.36754 13.3332 7.99935 13.3332C7.63116 13.3332 7.33268 13.0347 7.33268 12.6665V8.6665H3.33268C2.96449 8.6665 2.66602 8.36803 2.66602 7.99984C2.66602 7.63165 2.96449 7.33317 3.33268 7.33317H7.33268V3.33317C7.33268 2.96498 7.63116 2.6665 7.99935 2.6665Z" fill="currentColor"/>
                        </svg>
                        <p>{{ __('Click or drag an video here') }}</p>
                    </div>
                </div>

                <div>
                    <input type="file" id="file_input" name="video" required class="form-control drop-zone__input hidden" value="">
                </div>
            </div>

            <div id="imgFile-container" class="flex justify-between items-center gap-[11px] gap-y-1 flex-wrap">
            </div>

            <div id="error-message" class="error-message hidden font-Figtree text-[11px] text-[#FF4500] font-medium">
                {{ __('invalid files') }}
            </div>
        </div>


            <div class="flex items-center my-6 gap-4">
                <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                <div class="text-gray-500 text-sm font-medium px-2">OR</div>
                <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
            </div>

            <!-- Link Input Section -->
            <div class="mb-6">
                <div class="flex items-center gap-2 text-sm font-semibold mb-3 text-color-14 dark:text-white font-Figtree">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path d="M10.59,13.41C11,13.8 11,14.4 10.59,14.81C10.2,15.2 9.6,15.2 9.19,14.81L7.79,13.41L7.79,16C7.79,16.6 7.39,17 6.79,17C6.19,17 5.79,16.6 5.79,16L5.79,13.41L4.39,14.81C4,15.2 3.4,15.2 3,14.81C2.6,14.4 2.6,13.8 3,13.41L6.79,9.62L10.59,13.41M21.7,8.35C21.3,8.75 20.7,8.75 20.29,8.35L18.89,6.95L18.89,16C18.89,16.6 18.49,17 17.89,17C17.29,17 16.89,16.6 16.89,16L16.89,6.95L15.49,8.35C15.1,8.75 14.5,8.75 14.08,8.35C13.68,7.95 13.68,7.35 14.08,6.95L17.89,3.16L21.7,6.95C22.1,7.35 22.1,7.95 21.7,8.35Z"/>
                    </svg>
                    {{ __('Paste Video Link') }}
                </div>
                
                <div class="relative link-icon">
                    <svg class="link-icon absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 fill-indigo-500" viewBox="0 0 24 24">
                        <path d="M3.9,12C3.9,10.29 5.29,8.9 7,8.9H11V7H7A5,5 0 0,0 2,12A5,5 0 0,0 7,17H11V15.1H7C5.29,15.1 3.9,13.71 3.9,12M8,13H16V11H8V13M17,7H13V8.9H17C18.71,8.9 20.1,10.29 20.1,12C20.1,13.71 18.71,15.1 17,15.1H13V17H17A5,5 0 0,0 22,12A5,5 0 0,0 17,7Z"/>
                    </svg>
                    <input 
                        type="url" 
                        id="linkInput" 
                        class="w-full pl-12 pr-5 py-3 dark:!text-white border-1 border-gray-200 dark:bg-color-33 dark:!border-color-47 rounded-xl text-base bg-gray-50/50 outline-none focus:bg-white focus:border-gray-200" 
                        placeholder="https://youtube.com/watch?v=... or any video URL"
                    >
                </div>
            </div>

            @if(count($aiProviders))
                <!-- Provider Name -->
                <div class="flex flex-col mt-6 {{ count($aiProviders) == 1 ? 'hidden' : '' }}">
                    <div class="font-normal custom-dropdown-arrow text-14 text-color-2C dark:text-white">
                        <label>{{ __('Choose Provider') }}</label>
                        <select class="select block w-full text-base leading-6 font-medium text-color-2C bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl m-0 focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none" id="provider" name="provider">
                            @foreach ( $providers as $provider)
                                <option value="{{ $provider }}"> {{ ucwords($provider) }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            
            @if (count($aiProviders))
                <p class="mt-6 cursor-pointer AdavanceOption dark:text-white">{{ __('Advance Options') }}</p>
            @endif

            <!-- Option Field -->
            @if(count($aiProviders))
                <div id="ProviderOptionDiv" class="hidden">

                    @foreach ($aiProviders as $provider => $providerOptions)

                        @if (!empty($providerOptions))
                            @php
                                $providerName = str_replace('aishorts_', '', $provider);
                                $fields = $providerOptions;
                            @endphp
                            <div class="gap-6 pt-3 grid grid-cols-2 ProviderOptions {{ $providerName . '_div' }}">
                                @foreach ($fields as $field)
                                    @php
                                        $rulesNotApplied = true;   
                                    @endphp

                                    <!-- If rules applied to any input field -->
                                    @if (isset($rules[$providerName]) && !empty($rules[$providerName]))
                                        <!-- Each Provider rules -->

                                        @foreach ($rules[$providerName] as $ruleKey => $ruleValue)
                                            @if (($field['visibility'] ?? false) && ($field['type'] ?? false) && $field['type'] == 'dropdown')
                                                @if ($ruleKey == $field['name'])
                                                    <!-- Handle regular dropdowns -->
                                                    @php
                                                        $rulesNotApplied = false;
                                                    @endphp

                                                    @foreach ($ruleValue as $rKey => $rValue)
                                                        @if ($field['name'] != 'service' && $field['type'] == 'dropdown')
                                                            <div class="custom-dropdown-arrow font-normal text-14 text-[#141414] dark:text-white {{isset($field['multiple']) && $field['multiple'] === true ? ' col-span-2' : ''}} {{ count($field['value']) <= 1 ? 'hidden' : '' }}"  data-attr="{{ $rKey }}">
                                                                <label>{{ $field['label'] ?? '' }}</label>
                                                                <select class="{{isset($field['multiple']) && $field['multiple'] === true ? 'multi-select ' : ''}} select block w-full mt-[3px] text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control {{ $field['name'] == 'model' ? 'model-class' : ''}}" @if(isset($field['required']) &&  $field['required']) required @endif name="{{ isset($field['multiple']) && $field['multiple'] === true ? $providerName . '[' . $field['name'] . ']' . '['. $rKey .'][]' : $providerName . '[' . $field['name'] . ']' . '['. $rKey .']' }}" id="{{ $providerName . '[' . $field['name'] . ']' . '['. $rKey .']' }}" @if(isset($field['multiple']) && $field['multiple'] === true) multiple data-max-items="{{ $field['max_items'] }}" @endif>
                                                                    @if ($field['value'] ?? false)
                                                                        @foreach (array_intersect($field['value'], $rValue) as $value)
                                                                            @php
                                                                                $isDisabled = $field['name'] === 'size' && !subscription('isAdminSubscribed');
                                                                                $isSelected = isset($field['default_value']) && $field['default_value'] == $value;
                                                                                $label = ucwords(str_replace(['-', '_'], ' ', $value));
                                                                            @endphp
                                                                            <option value="{{ $value }}"
                                                                                {{ $isDisabled ? ( boolval(subscription('getUserSubscription', auth()->id())) && !subscription('isValidResolution',  auth()->id(), $value) ? 'disabled' : '' ) : '' }}
                                                                                {{ $isSelected ? 'selected' : '' }}>
                                                                                {{ $label }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                @else
                                                <!-- Skip additional iterations to prevent duplicate rendering -->
                                                @continue
                                                @endif
                                            @elseif(($field['visibility'] ?? false) && ($field['type'] ?? false) && $field['type'] == 'textarea')
                                                @if ($ruleKey == $field['name'])
                                                    @php
                                                        $rulesNotApplied = false;
                                                    @endphp

                                                    @foreach ($ruleValue as $rKey => $rValue)
                                                        <div data-attr="{{ $rKey }}" {{ !$rValue ? 'hidden' : ''  }} class="col-span-2">
                                                            <div class=" flex gap-2 justify-start items-center font-normal text-14 text-[#141414] dark:text-white">
                                                                <label>{{ $field['label'] ?? '' }}</label>
                                                                @if (!empty($field['value']))
                                                                    <a class="tooltip-info-image relative" title ="{{ __($field['value']) }}" href="javascript: void(0)">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <g clip-path="url(#clip0_18565_11277)">
                                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                    d="M7.99935 2.00033C4.68564 2.00033 1.99935 4.68662 1.99935 8.00033C1.99935 11.314 4.68564 14.0003 7.99935 14.0003C11.3131 14.0003 13.9993 11.314 13.9993 8.00033C13.9993 4.68662 11.3131 2.00033 7.99935 2.00033ZM0.666016 8.00033C0.666016 3.95024 3.94926 0.666992 7.99935 0.666992C12.0494 0.666992 15.3327 3.95024 15.3327 8.00033C15.3327 12.0504 12.0494 15.3337 7.99935 15.3337C3.94926 15.3337 0.666016 12.0504 0.666016 8.00033ZM7.33268 5.33366C7.33268 4.96547 7.63116 4.66699 7.99935 4.66699H8.00602C8.37421 4.66699 8.67268 4.96547 8.67268 5.33366C8.67268 5.70185 8.37421 6.00033 8.00602 6.00033H7.99935C7.63116 6.00033 7.33268 5.70185 7.33268 5.33366ZM7.99935 7.33366C8.36754 7.33366 8.66602 7.63214 8.66602 8.00033V10.667C8.66602 11.0352 8.36754 11.3337 7.99935 11.3337C7.63116 11.3337 7.33268 11.0352 7.33268 10.667V8.00033C7.33268 7.63214 7.63116 7.33366 7.99935 7.33366Z"
                                                                                    fill="currentColor" />
                                                                            </g>
                                                                            <defs>
                                                                                <clipPath id="clip0_18565_11277">
                                                                                    <rect width="16" height="16" fill="white" />
                                                                                </clipPath>
                                                                            </defs>
                                                                        </svg>
                                                                    </a>
                                                                @endif 
                                                            </div>
                                                            <textarea 
                                                                class="dynamic-input peer py-1.5 mt-1.5 text-base overflow-y-scroll middle-sidebar-scroll leading-6 font-light text-color-14 
                                                                dark:text-white bg-white dark:bg-[#333332] bg-clip-padding bg-no-repeat border border-solid border-color-89 dark:!border-color-47 rounded-xl m-0 
                                                                focus:text-color-14 focus:bg-white focus:border-color-89 focus:dark:!border-color-47 focus:outline-none min-h-[auto] w-full px-4 outline-none form-control"
                                                                maxlength="{{ $field['maxlength'] ?? ''   }}" rows="3"
                                                                @if(isset($field['required']) &&  $field['required']) required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" @endif name="{{ $providerName . '[' . $field['name'] . ']' . '['. $rKey .']' }}" 
                                                                id="{{ $providerName . '[' . $field['name'] . ']' . '['. $rKey .']' }}"></textarea>
                                                        </div>
                                                    @endforeach

                                                @endif
                                            @elseif(($field['visibility'] ?? false) && ($field['type'] ?? false) && $field['type'] == 'slider')
                                                @if ($ruleKey == $field['name'])

                                                    @php
                                                        $rulesNotApplied = false;
                                                    @endphp

                                                    @foreach ($ruleValue as $rKey => $rValue)
                                                        @if (!empty($rValue))
                                                            <div data-attr="{{ $rKey }}" {{ empty($rValue) ? 'hidden' : ''  }} class="col-span-2 progress-container">
                                                                <div class="flex gap-2 justify-between items-center font-normal text-14 text-color-2C dark:text-white">
                                                                    <div class="flex gap-2 justify-start items-center ">
                                                                        <label>{{ $field['label'] }}</label>
                                                                        @if (isset($field['tooltip']))
                                                                            <a class="tooltip-info relative"
                                                                                title ="{{ __($field['tooltip']) }}"
                                                                                href="javascript: void(0)">
                                                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <g clip-path="url(#clip0_18565_11277)">
                                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                            d="M7.99935 2.00033C4.68564 2.00033 1.99935 4.68662 1.99935 8.00033C1.99935 11.314 4.68564 14.0003 7.99935 14.0003C11.3131 14.0003 13.9993 11.314 13.9993 8.00033C13.9993 4.68662 11.3131 2.00033 7.99935 2.00033ZM0.666016 8.00033C0.666016 3.95024 3.94926 0.666992 7.99935 0.666992C12.0494 0.666992 15.3327 3.95024 15.3327 8.00033C15.3327 12.0504 12.0494 15.3337 7.99935 15.3337C3.94926 15.3337 0.666016 12.0504 0.666016 8.00033ZM7.33268 5.33366C7.33268 4.96547 7.63116 4.66699 7.99935 4.66699H8.00602C8.37421 4.66699 8.67268 4.96547 8.67268 5.33366C8.67268 5.70185 8.37421 6.00033 8.00602 6.00033H7.99935C7.63116 6.00033 7.33268 5.70185 7.33268 5.33366ZM7.99935 7.33366C8.36754 7.33366 8.66602 7.63214 8.66602 8.00033V10.667C8.66602 11.0352 8.36754 11.3337 7.99935 11.3337C7.63116 11.3337 7.33268 11.0352 7.33268 10.667V8.00033C7.33268 7.63214 7.63116 7.33366 7.99935 7.33366Z"
                                                                                            fill="currentColor" />
                                                                                    </g>
                                                                                    <defs>
                                                                                        <clipPath id="clip0_18565_11277">
                                                                                            <rect width="16" height="16" fill="white" />
                                                                                        </clipPath>
                                                                                    </defs>
                                                                                </svg>
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                    <span class="img-strength">1.8</span>
                                                                </div>

                                                                <input dir="ltr" class="range progress-bar w-full progress-input inputProgress" id="{{ $providerName . '[' . $field['name'] . ']' . '[' . $rKey . ']' }}"
                                                                min="{{ !empty($rValue['min']) ? $rValue['min'] : $field['min'] }}" max="{{ !empty($rValue['max']) ? $rValue['max'] : $field['min'] }}" type="range" name="{{ $providerName . '[' . $field['name'] . ']' . '[' . $rKey . ']' }}"   
                                                                value="{{ $field['value']  }}" step="{{  !empty($rValue['step']) ? $rValue['step'] : $field['step']  }}" />
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                @endif
                                            @endif
                                        @endforeach
                                    @endif

                                    @if ( ($field['visibility'] ?? false) && ($field['type'] ?? false) && $field['type'] == 'slider' && !is_null($field['value']) && $rulesNotApplied)
                                        <div class="col-span-2 progressBar progress-container">
                                            <div class="flex gap-2 justify-between items-center font-normal text-14 text-color-2C dark:text-white">
                                                <div class="flex gap-2 justify-start items-center ">
                                                    <label>{{ $field['label'] }}</label>
                                                    @if (isset($field['tooltip']))
                                                        <a class="tooltip-info relative"
                                                            title ="{{ __($field['tooltip']) }}"
                                                            href="javascript: void(0)">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_18565_11277)">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M7.99935 2.00033C4.68564 2.00033 1.99935 4.68662 1.99935 8.00033C1.99935 11.314 4.68564 14.0003 7.99935 14.0003C11.3131 14.0003 13.9993 11.314 13.9993 8.00033C13.9993 4.68662 11.3131 2.00033 7.99935 2.00033ZM0.666016 8.00033C0.666016 3.95024 3.94926 0.666992 7.99935 0.666992C12.0494 0.666992 15.3327 3.95024 15.3327 8.00033C15.3327 12.0504 12.0494 15.3337 7.99935 15.3337C3.94926 15.3337 0.666016 12.0504 0.666016 8.00033ZM7.33268 5.33366C7.33268 4.96547 7.63116 4.66699 7.99935 4.66699H8.00602C8.37421 4.66699 8.67268 4.96547 8.67268 5.33366C8.67268 5.70185 8.37421 6.00033 8.00602 6.00033H7.99935C7.63116 6.00033 7.33268 5.70185 7.33268 5.33366ZM7.99935 7.33366C8.36754 7.33366 8.66602 7.63214 8.66602 8.00033V10.667C8.66602 11.0352 8.36754 11.3337 7.99935 11.3337C7.63116 11.3337 7.33268 11.0352 7.33268 10.667V8.00033C7.33268 7.63214 7.63116 7.33366 7.99935 7.33366Z"
                                                                        fill="currentColor" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_18565_11277">
                                                                        <rect width="16" height="16" fill="white" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    @endif
                                                </div>
                                                <span class="img-strength">1.8</span>
                                            </div>

                                            <input dir="ltr" class="range progress-bar w-full progress-input inputProgress" id="progress-input"
                                                min="{{ $field['min'] }}" max="{{ $field['max'] }}" type="range" name="{{ $providerName . '[' . $field['name'] . ']' }}" 
                                                value="{{ $field['value']  }}" step="{{ $field['step'] }}" />
                                        </div>
                                    @endif

                                    <!-- General: If rules not applied to any input field -->
                                    @if (($field['visibility'] ?? false) && ($field['type'] ?? false) && $field['type'] == 'dropdown' && $rulesNotApplied)
                                        <div class="custom-dropdown-arrow font-normal text-14 text-[#141414] dark:text-white {{isset($field['multiple']) && $field['multiple'] === true ? ' col-span-2' : ''}} {{ count($field['value']) <= 1 ? 'hidden' : '' }}">
                                            <div class="flex items-center gap-2">
                                                <label>{{ $field['label'] ?? '' }}</label>
                                                @if (isset($field['tooltip']))
                                                    <a class="tooltip-info relative"
                                                        title ="{{ __($field['tooltip']) }}"
                                                        href="javascript: void(0)">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_18565_11277)">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M7.99935 2.00033C4.68564 2.00033 1.99935 4.68662 1.99935 8.00033C1.99935 11.314 4.68564 14.0003 7.99935 14.0003C11.3131 14.0003 13.9993 11.314 13.9993 8.00033C13.9993 4.68662 11.3131 2.00033 7.99935 2.00033ZM0.666016 8.00033C0.666016 3.95024 3.94926 0.666992 7.99935 0.666992C12.0494 0.666992 15.3327 3.95024 15.3327 8.00033C15.3327 12.0504 12.0494 15.3337 7.99935 15.3337C3.94926 15.3337 0.666016 12.0504 0.666016 8.00033ZM7.33268 5.33366C7.33268 4.96547 7.63116 4.66699 7.99935 4.66699H8.00602C8.37421 4.66699 8.67268 4.96547 8.67268 5.33366C8.67268 5.70185 8.37421 6.00033 8.00602 6.00033H7.99935C7.63116 6.00033 7.33268 5.70185 7.33268 5.33366ZM7.99935 7.33366C8.36754 7.33366 8.66602 7.63214 8.66602 8.00033V10.667C8.66602 11.0352 8.36754 11.3337 7.99935 11.3337C7.63116 11.3337 7.33268 11.0352 7.33268 10.667V8.00033C7.33268 7.63214 7.63116 7.33366 7.99935 7.33366Z"
                                                                    fill="currentColor" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_18565_11277">
                                                                    <rect width="16" height="16" fill="white" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                            
                                            <select class="{{isset($field['multiple']) && $field['multiple'] === true ? 'multi-select ' : ''}} select block w-full mt-[3px] text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control {{ $field['name'] == 'model' ? "model-class" : ''}}" @if(isset($field['required']) &&  $field['required']) required @endif name="{{ isset($field['multiple']) && $field['multiple'] === true ? $providerName . '[' . $field['name'] . ']' . '[]' : $providerName . '[' . $field['name'] . ']' }}" id="{{ $providerName . '[' . $field['name'] . ']' }}" @if(isset($field['multiple']) && $field['multiple'] === true) multiple data-max-items="{{ $field['max_items'] }}" @endif>
                                                @if ($field['value'] ?? false)
                                                    @foreach ($field['value'] as $value)
                                                        <option value="{{ $value }}" {{ isset($field['default_value']) && $field['default_value'] == $value ? 'selected' : '' }}> {{ ucwords(str_replace(['-', '_'], ' ', $value)) }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    @endif
                                    
                                    @if (($field['visibility'] ?? false) && ($field['type'] ?? false) && $field['type'] == 'textarea' && $rulesNotApplied)
                                        <div class="col-span-2">
                                            <div class="flex gap-2 justify-start items-center font-normal text-14 text-[#141414] dark:text-white">
                                                <label>{{ $field['label'] ?? '' }}</label>
                                                @if (!empty($field['value']))
                                                    <a class="tooltip-info-image relative" title ="{{ __($field['value']) }}" href="javascript: void(0)">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_18565_11277)">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M7.99935 2.00033C4.68564 2.00033 1.99935 4.68662 1.99935 8.00033C1.99935 11.314 4.68564 14.0003 7.99935 14.0003C11.3131 14.0003 13.9993 11.314 13.9993 8.00033C13.9993 4.68662 11.3131 2.00033 7.99935 2.00033ZM0.666016 8.00033C0.666016 3.95024 3.94926 0.666992 7.99935 0.666992C12.0494 0.666992 15.3327 3.95024 15.3327 8.00033C15.3327 12.0504 12.0494 15.3337 7.99935 15.3337C3.94926 15.3337 0.666016 12.0504 0.666016 8.00033ZM7.33268 5.33366C7.33268 4.96547 7.63116 4.66699 7.99935 4.66699H8.00602C8.37421 4.66699 8.67268 4.96547 8.67268 5.33366C8.67268 5.70185 8.37421 6.00033 8.00602 6.00033H7.99935C7.63116 6.00033 7.33268 5.70185 7.33268 5.33366ZM7.99935 7.33366C8.36754 7.33366 8.66602 7.63214 8.66602 8.00033V10.667C8.66602 11.0352 8.36754 11.3337 7.99935 11.3337C7.63116 11.3337 7.33268 11.0352 7.33268 10.667V8.00033C7.33268 7.63214 7.63116 7.33366 7.99935 7.33366Z"
                                                                    fill="currentColor" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_18565_11277">
                                                                    <rect width="16" height="16" fill="white" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </a>
                                                @endif 
                                            </div>
                                            <textarea 
                                                class="image-textarea questions dynamic-input peer py-1.5 mt-1.5 text-base overflow-y-scroll middle-sidebar-scroll leading-6 font-light text-color-14 
                                                dark:text-white bg-white dark:bg-[#333332] bg-clip-padding bg-no-repeat border border-solid border-color-89 dark:!border-color-47 rounded-xl m-0 
                                                focus:text-color-14 focus:bg-white focus:border-color-89 focus:dark:!border-color-47 focus:outline-none min-h-[auto] w-full px-4 outline-none form-control"
                                                maxlength="{{ $field['maxlength'] ?? ''   }}" rows="3"
                                                @if(isset($field['required']) &&  $field['required']) required @endif name="{{ $providerName . '[' . $field['name'] . ']'}}" 
                                                id="{{ $providerName . '[' . $field['name'] . ']' }}"></textarea>
                                        </div>
                                    @endif

                                    @if (($field['visibility'] ?? false) && ($field['type'] ?? false) && $field['type'] == 'file')
                                    <div {{ isset($field['type']) ? 'data-field=' . $field['name'] : '' }} id="{{ $providerName . '_file' }}" class="col-span-2">
                                    <label class="font-normal text-14 text-color-2C dark:text-white" for="{{ $providerName . '_file' }}">{{ $field['label'] }}</label>
                                        <input id="{{ $providerName . '_file' }}" data-name="{{ $field['name'] }}" class="w-full cursor-pointer rounded-xl border border-color-89 dark:border-color-47 px-3 file:-mx-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit dark:file:!bg-[#474746] file:bg-color-DF file:px-3 file:py-4 file:h-16 h-12 bg-white dark:bg-[#333332] file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] file:text-color-14 dark:file:text-white form-control text-color-14 dark:text-white file:transition-none focus:outline-none focus:dark:!border-color-47" type="file" name="{{ $providerName . '_file' }}">
                                    </div>
                                    @endif

                                    @if (($field['visibility'] ?? false) && ($field['type'] ?? false) && $field['type'] == 'number')
                                        <div class="font-normal text-14 text-color-2C dark:text-white" data-attr="{{ $field['name'] }}">
                                            <div class="flex gap-2 justify-start items-center">
                                                <label>{{ __($field['label']) }}</label>
                                                @if (isset($field['tooltip']))
                                                    <a class="tooltip-info relative"
                                                        title ="{{ __($field['tooltip']) }}"
                                                        href="javascript: void(0)">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_18565_11277)">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M7.99935 2.00033C4.68564 2.00033 1.99935 4.68662 1.99935 8.00033C1.99935 11.314 4.68564 14.0003 7.99935 14.0003C11.3131 14.0003 13.9993 11.314 13.9993 8.00033C13.9993 4.68662 11.3131 2.00033 7.99935 2.00033ZM0.666016 8.00033C0.666016 3.95024 3.94926 0.666992 7.99935 0.666992C12.0494 0.666992 15.3327 3.95024 15.3327 8.00033C15.3327 12.0504 12.0494 15.3337 7.99935 15.3337C3.94926 15.3337 0.666016 12.0504 0.666016 8.00033ZM7.33268 5.33366C7.33268 4.96547 7.63116 4.66699 7.99935 4.66699H8.00602C8.37421 4.66699 8.67268 4.96547 8.67268 5.33366C8.67268 5.70185 8.37421 6.00033 8.00602 6.00033H7.99935C7.63116 6.00033 7.33268 5.70185 7.33268 5.33366ZM7.99935 7.33366C8.36754 7.33366 8.66602 7.63214 8.66602 8.00033V10.667C8.66602 11.0352 8.36754 11.3337 7.99935 11.3337C7.63116 11.3337 7.33268 11.0352 7.33268 10.667V8.00033C7.33268 7.63214 7.63116 7.33366 7.99935 7.33366Z"
                                                                    fill="currentColor" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_18565_11277">
                                                                    <rect width="16" height="16" fill="white" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                            <input
                                                class="w-full px-4 h-12 py-1.5 text-base mt-[3px] leading-6 font-light text-color-14 dark:!text-white bg-white dark:bg-[#333332] bg-clip-padding bg-no-repeat border border-solid border-color-89 dark:!border-color-47 rounded-xl focus:text-color-14 focus:dark:!text-white focus:bg-white focus:border-color-89 focus:outline-none form-control"
                                                @if(isset($field['required']) &&  $field['required']) 
                                                    required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                @endif
                                                value="{{ isset($field['value']) ? $field['value'] : ''}}"
                                                min="{{ $field['min'] }}"
                                                max="{{ $field['max'] }}"
                                                type="number" name="{{  $providerName . '[' . $field['name'] . ']' }}"
                                                id="{{  $providerName . '[' . $field['name'] . ']' }}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

            <div class="mt-6 xl:my-6">
                <button
                    class="magic-bg w-full rounded-xl text-16 text-white font-semibold py-3 flex justify-center items-center gap-3 relative"
                    id="product-shot-creation">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.5002 15C10.1208 16.1837 9.18382 17.1207 8 17.5C9.18382 17.8793 10.1208 18.8163 10.5002 20C10.8795 18.8163 11.8162 17.8793 13 17.5C11.8162 17.1207 10.8795 16.1841 10.5002 15Z"
                            fill="white" />
                        <path
                            d="M13.3909 2C12.8792 4.84754 10.6284 7.09858 7.78125 7.61052C10.6284 8.12224 12.8792 10.3735 13.3909 13.2208C13.9026 10.3733 16.1534 8.12224 19.0005 7.61052C16.1534 7.09858 13.9026 4.84754 13.3909 2Z"
                            fill="white" />
                        <path
                            d="M3.5 9C3.08663 10.7255 1.72561 12.0867 0 12.5C1.72561 12.9133 3.08689 14.2745 3.5 16C3.91337 14.2745 5.27439 12.9133 7 12.5C5.27439 12.0867 3.91337 10.7255 3.5 9Z"
                            fill="white" />
                    </svg> <span>

                        {{ __('Show the Magic') }}
                    </span>
                    <svg class="loader-video animate-spin h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg"
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
            </div>
        </div>
    </div>
</form>