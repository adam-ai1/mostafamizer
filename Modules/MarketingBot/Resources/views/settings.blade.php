@extends('layouts.user_master')
@section('page_title', __('Settings'))

@section('content')
<main class="w-[68.9%] 5xl:w-[85.9%] pt-[56px] dark:bg-[#292929] flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF">
    <div class="xl:flex h-full subscription-main bg-color-F6 dark:bg-color-29">
        <!-- Start Sidebar -->
        @include('marketingbot::layouts.sidebar')
        <!-- End Sidebar -->

            <div
                class="sidebar-scrollbar xl:overflow-auto xl:h-[calc(100vh-56px)] w-full">
                <div class="max-w-[1280px] mx-auto px-5 pt-[21px] sm:pt-6 pb-[56px]">
                    <div
                        class="flex flex-col gap-4 2xl:flex-row 2xl:items-center 2xl:justify-between mb-12"
                    >
                        <div class="flex items-center gap-4">
                            <div>
                                <h1
                                    class="text-color-14 text-24 font-semibold font-RedHat dark:text-white wrap-anywhere"
                                >
                                    {{ __('Marketing Bot Settings') }}
                                </h1>
                                <p
                                    class="text-color-89 text-sm font-medium wrap-anywhere mt-1"
                                >
                                    
                                
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-6" id="bot-accordion">
                        {{-- WhatsApp --}}
                        @if(isset($settings['whatsapp']) && $settings['whatsapp'] != 'off')
                            @php $meta = json_decode($user->getMeta('whatsapp') ?? '{}', false); @endphp
                            <details class="bg-white dark:bg-color-3A rounded-xl overflow-hidden group" {{ empty($settings['telegram']) || $settings['telegram']=='off' ? 'open' : '' }}>
                                <summary class="cursor-pointer select-none p-6 border-b border-gray-200 dark:border-color-47 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-gradient-to-r from-[#25D366] to-[#128C7E] rounded-xl">
                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="text-xl font-semibold text-colo-14 dark:text-white">{{ __('WhatsApp') }}</h2>
                                            <p class="text-sm text-color-89">{{ __('Configure your WhatsApp marketing integration.') }}</p>
                                        </div>
                                    </div>

                                    <svg class="w-5 h-5 text-color-89 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </summary>

                                <form id="whatsapp-form" class="p-6 space-y-6">
                                    @csrf
                                    <input type="hidden" name="type" value="whatsapp">

                                    <div class="grid grid-cols-1 gap-6">
                                        <div class="space-y-1.5">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('WhatsApp SID') }}</label>
                                            <input required name="whatsapp_sid" id="whatsapp_sid" type="text" value="{{ config('openAI.is_demo') ? '********************' : ($meta->whatsapp_sid ?? '') }}"
                                                class="form-control w-full px-4 py-3 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl placeholder:text-color-89 text-color-14 dark:text-white">
                                        </div>

                                        <div class="space-y-1.5">
                                            <label class="block text-sm text-color-14 dark:text-white font-medium">{{ __('WhatsApp Token') }}</label>
                                            <div class="relative">
                                                <input type="password" name="whatsapp_token" required id="whatsapp_token" value="{{ config('openAI.is_demo') ? '********************' : ($meta->whatsapp_token ?? '') }}"
                                                    class="form-control w-full px-4 py-3 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl pr-10 placeholder:text-color-89 text-color-14 dark:text-white">
                                                <button type="button" class="toggle-password-btn absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                    <!-- eye icons kept as-is -->
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    <svg class="hidden w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" width="24" height="24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.5 12c2.036 3.76 5.723 6.25 10.5 6.25 1.69 0 3.29-.33 4.75-.93m3.27-2.02A10.45 10.45 0 0 0 22.5 12a10.477 10.477 0 0 0-2.48-3.777M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3.53 6.47L5.47 5.47" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="space-y-1.5">
                                            <label class="block text-sm text-color-14 dark:text-white font-medium">{{ __('Phone Number ID') }}</label>
                                            <input required type="tel" name="phone_number" id="phone_number" value="{{ config('openAI.is_demo') ? '********************' : ($meta->phone_number ?? '') }}"
                                                class="form-control w-full px-4 py-3 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl placeholder:text-color-89 text-color-14 dark:text-white">
                                        </div>
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="flex items-center gap-2 text-sm text-color-14 dark:text-white font-medium">
                                            <span>{{ __('Webhook URL') }}</span>
                                            @if(isset($meta->webhook_connected) && $meta->webhook_connected)
                                            <span id="whatsapp-webhook-status" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                {{ __('Connected') }}
                                            </span>
                                            @else
                                            <span id="whatsapp-webhook-status" class="hidden"></span>
                                            @endif
                                        </label>
                                        <div class="flex">
                                            <input type="url" readonly name="webhook_url" id="webhook_url" value="{{ route('whatsapp.webhook') }}"
                                                class="form-control flex-1 px-4 py-3 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-s-xl placeholder:text-color-89 text-color-14 dark:text-white">
                                            <button type="button" class="copy-webhook-btn px-4 py-3 bg-gray-50 dark:bg-color-47 border border-l-0 border-color-DF dark:border-color-47 rounded-e-lg hover:bg-gray-300 dark:hover:bg-color-89 dark:text-white transition-colors flex items-center justify-center">
                                                <svg class="copy-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                </svg>
                                                <svg class="check-icon w-5 h-5 hidden text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <button type="submit" class="w-full bg-gradient-to-r from-[#25D366] to-[#128C7E] text-white font-semibold py-3 px-4 rounded-xl active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-3 group">
                                        {{ __('Save') }}
                                        <svg class="w-5 h-5 animate-spin text-white loader hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </button>
                                </form>
                            </details>
                        @endif

                        {{-- Telegram --}}
                        @if(isset($settings['telegram']) && $settings['telegram'] != 'off')
                            @php $meta = json_decode($user->getMeta('telegram') ?? '{}', false); @endphp
                            <details class="bg-white dark:bg-color-3A rounded-xl overflow-hidden group">
                                <summary class="cursor-pointer select-none p-6 border-b border-gray-200 dark:border-color-47 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-gradient-to-r from-[#0088cc] to-[#229ed9] rounded-xl">
                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="text-xl font-semibold text-colo-14 dark:text-white">{{ __('Telegram') }}</h2>
                                            <p class="text-sm text-color-89">{{ __('Configure your Telegram marketing integration.') }}</p>
                                        </div>
                                    </div>

                                    <svg class="w-5 h-5 text-color-89 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </summary>

                                <form id="telegram-form" class="p-6 space-y-6">
                                    @csrf
                                    <input type="hidden" name="type" value="telegram">

                                    <div class="space-y-1.5">
                                        <label class="block text-sm text-color-14 dark:text-white font-medium">{{ __('Access Token') }}</label>
                                        <div class="relative">
                                            <input type="password" name="telegram_token" required id="telegram_token" value="{{ config('openAI.is_demo') ? '********************' : ($meta->telegram_token ?? '') }}"
                                                class="form-control w-full px-4 py-3 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl pr-10 placeholder:text-color-89 text-color-14 dark:text-white">
                                            <button type="button" class="toggle-password-btn absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                <!-- eye icons kept -->
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                <svg class="hidden w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" width="24" height="24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.5 12c2.036 3.76 5.723 6.25 10.5 6.25 1.69 0 3.29-.33 4.75-.93m3.27-2.02A10.45 10.45 0 0 0 22.5 12a10.477 10.477 0 0 0-2.48-3.777M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3.53 6.47L5.47 5.47" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="block text-sm text-color-14 dark:text-white font-medium">{{ __('Secret Token') }}</label>
                                        <div class="relative">
                                            <input type="password" name="secret_token" required id="secret_token" value="{{ config('openAI.is_demo') ? '********************' : ($meta->secret_token ?? '') }}"
                                                class="form-control w-full px-4 py-3 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl pr-10 placeholder:text-color-89 text-color-14 dark:text-white">
                                            <button type="button" class="toggle-password-btn absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                <!-- eye icons kept -->
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                <svg class="hidden w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" width="24" height="24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.5 12c2.036 3.76 5.723 6.25 10.5 6.25 1.69 0 3.29-.33 4.75-.93m3.27-2.02A10.45 10.45 0 0 0 22.5 12a10.477 10.477 0 0 0-2.48-3.777M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3.53 6.47L5.47 5.47" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="flex items-center gap-2 text-sm text-color-14 dark:text-white font-medium">
                                            <span>{{ __('Webhook URL') }}</span>
                                            @if(isset($meta->webhook_connected) && $meta->webhook_connected)
                                            <span id="telegram-webhook-status" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                {{ __('Connected') }}
                                            </span>
                                            @else
                                            <span id="telegram-webhook-status" class="hidden"></span>
                                            @endif
                                        </label>
                                        <div class="flex">
                                            <input type="url" readonly name="webhook_url" id="telegram_webhook_url"
                                                value="{{ route('telegram.webhook', ['id' => techEncrypt(auth()->user()->id)]) }}"
                                                class="form-control flex-1 px-4 py-3 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-s-xl placeholder:text-color-89 text-color-14 dark:text-white">
                                            <button type="button" class="copy-webhook-btn px-4 py-3 bg-gray-50 dark:bg-color-47 border border-l-0 border-color-DF dark:border-color-47 rounded-e-lg hover:bg-gray-300 dark:hover:bg-color-89 dark:text-white transition-colors flex items-center justify-center">
                                                <svg class="copy-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                </svg>
                                                <svg class="check-icon w-5 h-5 hidden text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <button type="submit" class="w-full bg-gradient-to-r from-[#0088cc] to-[#229ed9] text-white font-semibold py-3 px-4 rounded-xl active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-3 group">
                                        {{ __('Save')}}
                                        <svg class="w-5 h-5 animate-spin text-white loader hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </button>
                                </form>
                            </details>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@section('js')
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/marketing-bot-utils.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script type="text/javascript">
        var route = "{{ route('user.marketing-bot.store-settings') }}";
    </script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/settings.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
@endsection
