<div class="mt-10">
    <p class="font-semibold text-color-14 dark:text-white text-20 pb-3">{{ __('Unsubscribe') }}</p>
    <div class="border-b border-color-DF dark:border-[#474746]"></div>
</div>
<div class="pt-6 pb-24">
    <p class="text-color-14 dark:text-white font-normal font-Figtree text-15 6xl:w-[650px] 4xl:w-[500px] xl:w-[400px]">
        {{ isset($activeSubscription) ? __('Cancelling your subscription will not cause you to lose your current existing credits and plan benefits. But you can subscribe again anytime and get to keep all your saved documents & history.') : __('Cancelling your subscription will not cause you to lose all your credits and plan benefits. But you can subscribe again anytime and get to keep all your saved documents & history.') }}
    </p>
    @if(isset($activeSubscription))
        @php
            $isActiveSubscription = subscription('getUserSubscription', auth()->user()->id)->status == 'Active';
        @endphp

        <a href="javaScript:void(0);" title="{{ $isActiveSubscription ? '' : __('Cancellable plans are limited to only active subscriptions.') }}"
            class="{{ $isActiveSubscription ? '' : 'cancel-tooltip' }} text-color-14 dark:text-white rounded-xl px-[18px] whitespace-nowrap py-[12px] text-15 mt-6 mb-10 flex w-max border border-color-89 dark:border-color-47 bg-color-F6 dark:bg-color-47 font-semibold modal-toggle {{ $isActiveSubscription ? '' : 'cursor-default' }}">{{ __('Cancel Subscription') }}</a>
        <div class="modal {{ $isActiveSubscription ? 'index-modal' : '' }}  absolute z-50 top-0 left-0 right-0 w-full h-full">
            <div class="modal-overlay fixed z-10 top-0 right-0 left-0 w-full h-full">
            </div>
            <div class="modal-wrapper modal-wrapper modal-transition fixed inset-0 z-10">
                <div class="modal-body flex h-full justify-center p-4 text-center items-center sm:p-0">
                    <div class="modal-content modal-transition rounded-xl py-6 md:px-[54px] bg-white dark:bg-color-3A px-8">
                        <p class="text-color-14 font-semibold text-20 font-Figtree dark:text-white text-center">{{ __('Cancel Subscription') }}?</p>
                        <p class="font-Figtree text-color-14 dark:text-white text-15 font-normal mt-3 text-center md:w-[332px]">
                            {{ __('You will not lose any of your existing credits or plan benefits.') }}
                        </p>
                        <div class="flex justify-center items-center mt-7 gap-[16px]">
                            <a href="javaScript:void(0);" class="font-Figtree text-color-14 dark:text-white font-semibold xs:text-15 text-14 py-[11px] xs:px-[42px] px-[30px] border border-color-89 dark:border-color-47 bg-color-F6 dark:bg-color-47 rounded-xl modal-toggle">{{ __("Not Really") }}</a>
                            <a href="{{ route('user.subscription.cancel', ['user_id' => auth()->user()->id]) }}" class="font-Figtree text-white font-semibold xs:text-15 text-14 py-[11px] xs:px-[30px] px-5 bg-color-DFF rounded-xl">{{ __('Yes, Cancel') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <a href="javaScript:void(0);" class="text-color-14 dark:text-white rounded-xl px-[18px] whitespace-nowrap py-[12px] text-15 mt-6 mb-10 flex w-max border border-color-89 dark:border-color-47 bg-color-F6 dark:bg-color-47 font-semibold modal-toggle cursor-default">{{ __('Cancel Subscription') }}</a>
    @endif
</div>
