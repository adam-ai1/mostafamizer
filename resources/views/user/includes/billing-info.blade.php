<div class="mt-10">
    <p class="font-semibold text-color-14 dark:text-white text-20 pb-3">{{ __('Billing & Payment') }}</p>
    <div class="border-b border-color-DF dark:border-[#474746]"></div>
</div>
<div class="mt-6">
    <div class="bg-color-F6 dark:bg-color-3A rounded-xl p-6 8xl:w-[66.5%] subscription-profile-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="font-Figtree text-color-14 dark:text-white text-20 font-semibold">
                    {{ auth()->user()->name }}</p>
                <p class="font-Figtree text-15 text-color-89 font-medium pt-2">
                    {{ config('openAI.is_demo') ? 'xxxxxxx@xx.xx' : auth()->user()->email }}</p>
            </div>
            <img class="w-[67px] h-[67px] rounded-full pr-0.5" src="{{ auth()->user()->fileUrl() }}" alt="{{ __('Image') }}">
        </div>
        <div class="mt-11 flex flex-wrap items-center gap-4 justify-start 6xl:w-[500px] 4xl:w-[450px] xl:w-[400px]">
            <div>
                <p class="font-normal text-13 font-Figtree text-color-14 dark:text-white">
                    {{ __('Billing Price') }}</p>
                <p class="font-semibold text-16 font-Figtree text-color-14 dark:text-white pt-1">
                    {{ isset($activeSubscription) ? formatNumber($activeSubscription->amount_billed) : '0.00' }}
                </p>
            </div>
            <div>
                <p class="font-normal text-13 font-Figtree text-color-14 dark:text-white">
                    {{ __('Billing Cycle') }}</p>
                <p class="font-semibold text-16 font-Figtree text-color-14 dark:text-white pt-1">
                    {{ isset($activeSubscription) ? (($activeSubscription->billing_cycle == 'days' ? $activeSubscription->duration . ' ' : '') . ucFirst($activeSubscription->billing_cycle)) : '...' }}
                </p>
            </div>
            <div>
                <p class="font-normal text-13 font-Figtree text-color-14 dark:text-white">
                    {{ __('Payment Status') }}</p>
                <p class="font-semibold text-16 font-Figtree text-color-14 dark:text-white pt-1">
                    {{ isset($activeSubscription) ? ucFirst($activeSubscription->payment_status) : '...' }}
                </p>
            </div>
            @if (isset($activeSubscription) && (subscription('isTrialMode', $activeSubscription->id) || ($activeSubscription->status != 'Pending' && $activeSubscription->billing_cycle != 'lifetime')))
                <div>
                    <p class="font-normal text-13 font-Figtree text-color-14 dark:text-white">
                        {{ $activeSubscription->status == 'Cancel' ? __('Expired Date') : __('Next Billing Date') }}</p>
                    <p class="font-semibold text-16 font-Figtree text-color-14 dark:text-white pt-1">
                        {{ timezoneFormatDate($activeSubscription->next_billing_date) }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
