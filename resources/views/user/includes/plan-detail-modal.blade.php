<div class="fixed z-index-999999 hidden items-center inset-0 bg-color-14 bg-opacity-50 overflow-y-auto upgradePlan-allPlans-modal">
    <div class="m-auto">
        <div class="relative my-5 z-index-999999 md:px-5 px-3 py-5 sm:w-[520px] w-max rounded-xl bg-white dark:bg-[#3A3A39] modal-h modal-box-shadow transition-all ease-in-out billing-modal-main" id="billing-modal-main">
            <svg class="absolute top-2.5 right-2.5 text-color-14 dark:text-white modal-close-btn p-[1px] cursor-pointer modal-cross" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.00749 3.00773C3.41754 2.59768 4.08236 2.59768 4.49241 3.00773L8.99995 7.51527L13.5075 3.00773C13.9175 2.59768 14.5824 2.59768 14.9924 3.00773C15.4025 3.41778 15.4025 4.08261 14.9924 4.49266L10.4849 9.0002L14.9924 13.5077C15.4025 13.9178 15.4025 14.5826 14.9924 14.9927C14.5824 15.4027 13.9175 15.4027 13.5075 14.9927L8.99995 10.4851L4.49241 14.9927C4.08236 15.4027 3.41754 15.4027 3.00749 14.9927C2.59744 14.5826 2.59744 13.9178 3.00749 13.5077L7.51503 9.0002L3.00749 4.49266C2.59744 4.08261 2.59744 3.41778 3.00749 3.00773Z" fill="currentColor"/>
            </svg>
            <div class="upgradePlan-allPlans-container">
                <p class="font-Figtree text-color-14 dark:text-white text-20 font-semibold text-left border-b border-color-DF dark:border-color-47 pb-3">
                    {{ __("Plan Details") }}</p>
                <div class="mt-6 mb-7">
                    <div class="grid xxs:grid-cols-2 bg-color-F6 dark:bg-color-47 p-5 rounded-lg gap-4">
                        <div>
                            <p class="text-color-89 font-semibold text-16 font-Figtree">{{ __("Plan") }}</p>
                            <p class="mt-1.5 heading-1 xs:text-28 text-lg font-semibold font-Figtree xxs:w-[130px] sm:w-full modal-package-name"></p>
                        </div>

                        <div>
                            <p class="text-color-89 font-semibold text-16 font-Figtree">{{ __("Amount") }}</p>
                            <div class="flex items-end">
                                <p class="mt-1.5 text-color-14 dark:text-white xs:text-28 text-lg font-semibold font-Figtree xxs:w-[130px] sm:w-full modal-selling-price">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 mt-6 sub-modal-rtl h-80 pr-6 overflow-auto sidebar-scrollbar modal-plan">

                    </div>
                </div>
                @php
                    $activePackage = $activePackage ?? [];
                    $useCheckoutRoute =
                        $activePackage && preference('apply_coupon_subscription') &&
                        (
                            (isset($activePackage['sale_price'][$activeSubscription?->billing_cycle])
                                && $activePackage['sale_price'][$activeSubscription?->billing_cycle] > 0
                                && !$activePackage['trial_day'])
                            || ($activePackage['trial_day'] && subscription('isUsedTrial', $activePackage['id']))
                        );
                @endphp

                @if ($useCheckoutRoute)
                    <form action="{{ route('user.subscription.checkout') }}" method="GET" class="plan-form">
                @else
                    <form action="{{ route('user.subscription.store') }}" method="POST" class="button-need-disable">
                        @csrf
                @endif
                    <div class="current-subscription-plan-modal">
                        <input type="hidden" name="package_id" value="{{ $activePackage->id }}">
                        <input type="hidden" name="sending_url" value="{{ techEncrypt(route('user.subscription.store')) }}">
                        <input type="hidden" name="billing_cycle" value="{{ $activeSubscription?->billing_cycle }}">
                    </div>
                    <button type="submit" class="font-Figtree text-white font-semibold text-15 py-[11px] px-10 bg-color-14 rounded-xl flex justify-center items-center gap-3 modal-btn plan-modal-btn">{{ __("Update") }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
