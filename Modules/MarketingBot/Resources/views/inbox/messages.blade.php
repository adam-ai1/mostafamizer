@include('marketingbot::inbox.skeleton.skeleton-message')

@if(isset($messages) && (is_array($messages) ? count($messages) > 0 : $messages->count() > 0))
    <div class="p-5 h-[calc(100vh-184px)] overflow-y-auto space-y-6 message-container hidden flex flex-col">

        @foreach ($messages as $message)
        <!-- Marketing Message with Image -->
        @if(isset($message->bot_reply) && $message->message_type == 'template')
            @php 
                $variables = json_decode($message->bot_reply, true);
            @endphp
            
            @if(is_array($variables) && !empty($variables))
            <div class="bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 border border-orange-200 dark:border-orange-700/50 rounded-2xl p-5 w-72 ml-auto">
                <div class="flex items-start space-x-4">
                    <div class="flex-1">
                        @foreach ($variables as $template)
                            @if(!isset($template['type']))
                                @continue
                            @endif
                            {{-- Header Section --}}
                            @if($template['type'] === 'HEADER')
                                @if($template['format'] === 'TEXT')
                                    @php
                                        $headerText = $template['text'] ?? '';
                                        if (isset($template['example']['header_text']) && is_array($template['example']['header_text']) && isset($template['example']['header_text'][0])) {
                                            foreach ($template['example']['header_text'] as $index => $value) {
                                                $placeholder = '{{' . ($index + 1) . '}}';
                                                $headerText = str_replace($placeholder, '<strong id="' . strtolower($template['type']) . '-variable-' . $index . '-preview">' . $value . '</strong>', $headerText);
                                            }
                                        }
                                    @endphp
                                    <h3 class="mb-3 text-base font-semibold text-gray-900 dark:text-white">
                                        {!! $headerText !!}
                                    </h3>
                                @endif

                                @if(in_array($template['format'], ['IMAGE', 'DOCUMENT', 'VIDEO']))
                                    @php
                                        $file = '';
                                        if (isset($template['example']['header_handle']) && is_array($template['example']['header_handle']) && isset($template['example']['header_handle'][0])) {
                                            $file = $template['example']['header_handle'][0];
                                        }
                                    @endphp
                                    @if($file)
                                        <img src="{{ $file }}" alt="template media" class="w-full h-auto rounded-lg mb-4">
                                    @endif
                                @endif
                            @endif

                            {{-- Body Section --}}
                            @if($template['type'] === 'BODY')
                                @php
                                    $bodyText = $template['text'] ?? '';
                                    if (isset($template['example']['body_text']) && is_array($template['example']['body_text']) && isset($template['example']['body_text'][0]) && is_array($template['example']['body_text'][0])) {
                                        foreach ($template['example']['body_text'][0] as $index => $value) {
                                            $placeholder = '{{' . ($index + 1) . '}}';
                                            $bodyText = str_replace($placeholder, '<strong id="' . strtolower($template['type']) . '-variable-' . $index . '-preview">' . $value . '</strong>', $bodyText);
                                        }
                                    }
                                @endphp
                                <p class="mb-3 text-sm text-gray-800 dark:text-gray-200 leading-relaxed whitespace-pre-line">
                                    {!! $bodyText !!}
                                </p>
                            @endif

                            {{-- Footer Section --}}
                            @if($template['type'] === 'FOOTER')
                                <p class="mb-3 text-xs text-gray-500 dark:text-gray-400 italic">
                                    {{ $template['text'] }}
                                </p>
                            @endif

                            {{-- Buttons Section --}}
                            @if($template['type'] === 'BUTTONS' && isset($template['buttons']) && is_array($template['buttons']))
                                <div class="mb-4 space-y-2">
                                    @foreach($template['buttons'] as $button)
                                        <button class="w-full flex items-center justify-center gap-2 py-2.5 px-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            @if ($button['type'] == "URL")
                                                <svg class="h-4 w-4 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                </svg>
                                            @elseif ($button['type'] == "COPY_CODE")
                                                <svg class="h-4 w-4 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                            @else
                                                <svg class="h-4 w-4 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                                </svg>
                                            @endif
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $button['text'] }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach

                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-xs text-orange-600 dark:text-orange-400 font-medium bg-orange-100 dark:bg-orange-900/50 px-3 py-1 rounded-full">
                                {{ isset($message->reply_by) ? ucwords(str_replace('_', ' ', $message->reply_by)) : 'User' }} • {{ $message->created_at->diffForHumans() }}
                            </span>
                            <div class="flex items-center gap-1.5">
                                <div class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-ping"></div>
                                <span class="text-xs text-orange-500 font-medium">{{ __('Hot Deal') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endif
        <!-- Bot Response / Original Flash Sale Message -->
        @if(isset($message->bot_reply) && $message->message_type != 'template' && !in_array($message->error_type, ['subscription_error', 'system_error']))
        <div
            class="bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 border border-orange-200 dark:border-orange-700/50 rounded-2xl p-5 ml-auto w-auto max-w-2xl block">
            <div class="flex items-start space-x-4">
                <div class="flex-1 min-w-0">
                    @php
                        $imageUrl = null;
                        if ($message->relationLoaded('metas')) {
                            $imageMeta = $message->metas->where('key', 'image_url')->first();
                            $imageUrl = $imageMeta ? $imageMeta->value : null;
                        } else {
                            $imageUrl = $message->getMeta('image_url');
                        }
                    @endphp
                    @if($imageUrl)
                        <img src="{{ $imageUrl }}" alt="campaign image" class="w-full h-auto rounded-lg mb-4">
                    @endif
                    <div
                        class="text-sm text-gray-800 dark:text-gray-200 leading-relaxed break-words overflow-wrap-anywhere h-auto [&_strong]:font-semibold [&_h1]:text-base [&_h2]:text-sm [&_h3]:text-sm [&_h1]:font-bold [&_h2]:font-bold [&_h3]:font-bold [&_h1]:mb-2 [&_h2]:mb-2 [&_h3]:mb-2 [&_ul]:list-disc [&_ul]:ml-4 [&_ul]:my-2 [&_ul]:space-y-1 [&_li]:ml-2 [&_pre]:bg-gray-100 [&_pre]:dark:bg-gray-800 [&_pre]:p-3 [&_pre]:rounded [&_pre]:overflow-x-auto [&_pre]:my-2 [&_pre]:text-xs [&_code]:bg-gray-100 [&_code]:dark:bg-gray-800 [&_code]:px-1 [&_code]:py-0.5 [&_code]:rounded [&_code]:text-xs [&_pre_code]:bg-transparent [&_pre_code]:p-0 [&_pre_code]:text-xs [&_p]:mb-2 [&_ol]:list-decimal [&_ol]:ml-4 [&_ol]:my-2 [&_ol]:space-y-1"
                    >
                        {!! formatBotReply($message->bot_reply) !!}
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <span
                            class="text-xs text-orange-600 dark:text-orange-400 font-medium bg-orange-100 dark:bg-orange-900/50 px-3 py-1 rounded-full"
                        >
                            {{ isset($message->reply_by) ? ucwords(str_replace('_', ' ', $message->reply_by)) : 'User' }} • {{ $message->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(isset($message->user_reply))
            <!-- Customer Response -->
            <div class="flex items-start gap-4 animate-fade-in">
                <img
                    src="{{ asset('Modules/MarketingBot/Resources/assets/images/profile_default_img.png') }}"
                    alt="User"
                    class="shrink-0 w-12 h-12 rounded-full object-cover border border-gray-200 dark:border-gray-600"
                />
                <div
                    class="bg-white dark:bg-gray-700 rounded-2xl rounded-tl-md px-6 py-4 max-w-xs border border-gray-200 dark:border-gray-600"
                >
                    <p class="text-sm text-gray-900 dark:text-white font-medium">
                        {{ $message->user_reply }}
                    </p>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            
            @php
                // Only show errors after the last user message
                $lastUserMessage = $messages->where('user_reply', '!=', null)->last();
                $isLastUserMessage = $lastUserMessage && $lastUserMessage->id === $message->id;
                
                if ($isLastUserMessage) {
                    // Check if user is admin
                    $isAdmin = subscription('isAdminSubscribed', auth()->id());
                    
                    // Check if subscription is valid (not reached word limit)
                    $hasValidSubscription = false;
                    if (!$isAdmin) {
                        $validation = subscription('isValidSubscription', auth()->id(), 'word');
                        $hasValidSubscription = $validation['status'] === 'success';
                    }
                    
                    // Get system messages (both subscription and system errors)
                    $systemMessages = $messages
                        ->where('reply_by', 'system')
                        ->whereNotNull('bot_reply')
                        ->filter(function ($msg) {
                            return $msg->getMeta('error_type') === 'subscription_error' ||
                                   $msg->getMeta('error_type') === 'system_error';
                        });

                    // Get subscription error (if not admin AND subscription is invalid)
                    $subscriptionError = null;
                    if (!$isAdmin && !$hasValidSubscription) {
                        $subscriptionError = $systemMessages
                            ->filter(fn($msg) => $msg->getMeta('error_type') === 'subscription_error')
                            ->last();
                    }

                    // Get system error (always check, regardless of subscription)
                    $systemError = $systemMessages
                        ->where('id', '>', $message->id)
                        ->filter(fn($msg) => $msg->getMeta('error_type') === 'system_error')
                        ->last();
                }
            @endphp
            
            @if($isLastUserMessage && $subscriptionError)
                <!-- Subscription Error: Show with Upgrade button -->
                <div class="flex items-start gap-4 mt-3 ml-16">
                    <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-700/50 rounded-xl px-4 py-3 max-w-sm">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-orange-600 dark:text-orange-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 dark:text-white font-medium mb-2">
                                    {{ $subscriptionError->bot_reply }}
                                </p>
                                <a href="{{ route('user.package') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-semibold text-white bg-color-14 dark:bg-white dark:text-color-14 px-4 py-2 rounded-lg hover:opacity-90 transition-opacity">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    {{ __('Upgrade Plan') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            @if($isLastUserMessage && $systemError)
                <!-- System Error: Show without Upgrade button -->
                <div class="flex items-start gap-4 mt-3 ml-16">
                    <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-700/50 rounded-xl px-4 py-3 max-w-sm">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-orange-600 dark:text-orange-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 dark:text-white font-medium">
                                    {{ $systemError->bot_reply }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        @endforeach
    </div>
@endif

<!-- Empty State for Messages (shown by JavaScript when needed) -->
<div id="messages-empty-state" class="hidden p-5 h-[calc(100vh-184px)] overflow-y-auto flex flex-col items-center justify-center">
    <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
    </svg>
    <p class="text-gray-600 dark:text-gray-400 text-sm font-medium mb-1">{{ __('No messages yet') }}</p>
    <p class="text-gray-500 dark:text-gray-500 text-xs text-center max-w-xs">{{ __('Start the conversation by sending a message') }}</p>
</div>
