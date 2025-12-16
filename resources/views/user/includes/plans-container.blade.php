@php
    $hasMonthlyBilling = array_key_exists('monthly', $billingCycles ?? []);
@endphp

<div class="tab-content mt-6 xl:mt-8" id="tabs-tabContent">
    <div class="tab-pane fade show active" id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab">
        <div class="plan-root 6xl:gap-10 lg:gap-5 gap-6 lg:px-0 md:px-10 px-5 w-full flex flex-wrap justify-center {{count($packages) != 0 ? 'lg:mb-[140px] mb-[90px] 6xl:mt-[60px] mt-11' : ''}}">
            @foreach($packages as $key => $package)
                @foreach ($package['billing_cycle'] as $billing_cycle => $value)
                    @continue($value === 0)
                    @include('user.includes.plan-card', ['package' => $package, 'billing_cycle' => $billing_cycle, 'hasMonthlyBilling' => $hasMonthlyBilling, 'subscription' => $subscription])
                @endforeach
            @endforeach
        </div>
        @include('user.includes.plan-detail-modal')
    </div>
</div>
