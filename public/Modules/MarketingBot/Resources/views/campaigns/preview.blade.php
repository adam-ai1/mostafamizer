{{-- @php
    $variable = json_decode($templates[0]->components, true);
@endphp --}}

<div class="6xl:fixed 6xl:h-[calc(100vh-58px)] p-4 w-full max-w-full 6xl:max-w-[470px] 7xl:max-w-[540px] 8xl:max-w-[612px] bottom-0 end-4">
    <div class="flex flex-col justify-end h-full p-5 bg-transparent bg-no-repeat rounded-xl bg-cover bg-right-bottom bg-white dark:bg-color-33" style="background-image: url('{{ asset('Modules/Marketingbot/Resources/assets/images/gradient-bg-of-pattern.svg')}}')">
        <div class="flex justify-center">
            <div class="relative">
                <!-- Phone Frame -->
                <div
                    class="w-80 h-[640px] bg-gradient-to-b from-gray-800 to-gray-900 rounded-[3rem] p-3 shadow-lg"
                >
                    <div
                        class="w-full h-full bg-gray-100 dark:bg-gray-800 rounded-[2.5rem] overflow-hidden relative"
                    >
                        <!-- Phone Header -->
                        <div
                            class="bg-[#25d366] p-4 flex items-center justify-between text-white"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center"
                                >
                                    <svg
                                        class="w-6 h-6"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.106"
                                        />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">{{ __('Phone Number') }}</div>
                                    <div
                                        class="text-xs opacity-90 flex items-center gap-1"
                                    >
                                        <div
                                            class="w-2 h-2 bg-green-400 rounded-full"
                                        ></div>
                                        {{ __('online') }}
                                        
                                    </div>
                                </div>
                            </div>
                            <button
                                class="p-2 hover:bg-white/10 rounded-full transition-colors duration-300"
                            >
                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                    />
                                </svg>
                            </button>
                        </div>

                        <!-- Chat Area -->
                        <div
                            class="flex-1 p-4 bg-gradient-to-b from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 h-[calc(100%-180px)] relative overflow-hidden"
                        >
                        <!-- Preview Message -->
                        @if(!isset($variable))
                            <div class="relative">
                                <div class="bg-white dark:bg-gray-600 rounded-2xl rounded-bl-sm p-4 max-w-[85%] shadow-lg">
                                    <img id="previewImg" class="rounded-lg mb-2" src="{{ asset('Modules\MarketingBot\Resources\assets\images\bot-marketing.png') }}" alt="campaign-banner">

                                    <p
                                        id="previewText"
                                        class="text-gray-800 dark:text-gray-200 text-sm leading-relaxed break-words"
                                    >
                                        {{ __('This is what your campaign will look like.') }}
                                    </p>
                                    <div class="flex items-center justify-end mt-3 gap-1">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ __('9:30 PM') }}</span>
                                        <svg
                                        class="w-4 h-4 text-blue-500"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        >
                                        <path
                                            fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"
                                        />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="relative">
                                <div class="bg-white dark:bg-gray-600 rounded-2xl rounded-tl-sm p-4 max-w-md mx-auto shadow-lg">
                                    <div class="bg-white rounded-lg shadow-sm overflow-hidden template-container">
                                        @foreach ($variable as $key => $template)
                                            {{-- Header Section --}}
                                            @if(isset($template) && $template['type'] === 'HEADER')
                                                <div class="template-header px-4 pt-3">
                                                    @if($template['format'] === 'TEXT')
                                                        @php
                                                            $headerText = $template['text'];
                                                            // Replace {{1}} with example value
                                                            if (isset($template['example']['header_text'][0])) {
                                                                foreach ($template['example']['header_text'] as $index => $value) {
                                                                    $placeholder = '{{' . ($index + 1) . '}}';
                                                                    $headerText = str_replace($placeholder, '<strong id="' . strtolower($template['type']) . '-variable-' . $index  . '-preview' . '">' . $value . '</strong>', $headerText);
                                                                }
                                                            }
                                                        @endphp
                                                        <h3 class="text-sm font-semibold text-gray-900">
                                                            {!! $headerText !!}
                                                        </h3>
                                                    @endif

                                                    @if(in_array($template['format'], ['IMAGE', 'DOCUMENT', 'VIDEO']))
                                                       @php
                                                            $file = $template['example']['header_handle'][0] ?? '';
                                                            $previewId = strtolower($template['type']) . '-variable-' . $key . '-preview';
                                                        @endphp
                                                        <div id="{{ $previewId }}" class="file-preview-container">
                                                            @if($file)
                                                                @if($template['format'] === 'IMAGE')
                                                                    <img class="w-full h-auto rounded-lg" src="{{ $file }}" alt="campaign">
                                                                @elseif($template['format'] === 'VIDEO')
                                                                    <video class="w-full h-auto rounded-lg" src="{{ $file }}" controls></video>
                                                                @elseif($template['format'] === 'DOCUMENT')
                                                                    <iframe class="w-full h-64 rounded-lg" src="{{ $file }}" frameborder="0"></iframe>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif

                                            {{-- Body Section --}}
                                            @if(isset($template) && $template['type'] === 'BODY')
                                                <div class="template-body px-4 py-3 bg-white">
                                                    @php
                                                        $bodyText = $template['text'];
                                                        // Replace placeholders with example values
                                                        if (isset($template['example']['body_text'][0])) {
                                                            foreach ($template['example']['body_text'][0] as $index => $value) {
                                                                $placeholder = '{{' . ($index + 1) . '}}';
                                                                $bodyText = str_replace($placeholder, '<strong class="font-medium text-gray-900" id="' . strtolower($template['type']) . '-variable-' . $index  . '-preview' . '">' . $value . '</strong>', $bodyText);
                                                            }
                                                        }
                                                    @endphp
                                                    <p class="text-[13px] text-gray-800 leading-relaxed whitespace-pre-line">{!! $bodyText !!}</p>
                                                    
                                                    {{-- Timestamp --}}
                                                    <div class="flex justify-end mt-1">
                                                        <span class="text-[11px] text-gray-400">{{ now()->format('H:i') }}</span>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Buttons Section --}}
                                            @if(isset($template) && $template['type'] === 'BUTTONS')
                                                <div class="template-buttons border-t border-gray-200">
                                                    @foreach($template['buttons'] as $index => $button)
                                                        <div class="flex items-center justify-center gap-2 py-3 px-4 {{ $index > 0 ? 'border-t border-gray-200' : '' }} hover:bg-gray-50 cursor-pointer transition-colors">
                                                            @if ($button['type'] == "URL")
                                                                <img class="h-[18px] w-[18px]" src="{{ asset('Modules\MarketingBot\Resources\assets\images\open.png') }}" alt="Open"/>
                                                            @elseif ($button['type'] == "COPY_CODE")
                                                                <svg class="h-[18px] w-[18px] text-[#00a5f4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                                </svg>
                                                            @else
                                                                <svg class="h-[18px] w-[18px] text-[#00a5f4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                                                </svg>
                                                            @endif
                                                            
                                                            <span class="text-[14px] font-medium text-[#00a5f4]">{{ $button['text'] }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        </div>

                        <!-- Chat Input -->
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 bg-gray-100 dark:bg-gray-800">
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
                                        placeholder="Type a message"
                                        class="flex-1 !bg-transparent outline-none border-none text-sm text-gray-700 dark:text-gray-300 placeholder-gray-500 dark:placeholder-gray-400"
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
                                <button class="shrink-0 flex items-center justify-center p-2 rounded-full bg-green-500 text-white shadow-lg hover:bg-green-600 active:scale-95 transition">
                                    <svg
                                        class="w-5 h-5"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z"
                                            clip-rule="evenodd"
                                        />
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