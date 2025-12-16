@php
    // Reorder features based on predefined order from PackageService
    $orderedFeatures = [];
    $remainingFeatures = $package['features'];

    foreach (Modules\Subscription\Services\PackageService::features() as $key => $value) {
        if (isset($remainingFeatures[$key])) {
            $orderedFeatures[$key] = $remainingFeatures[$key];
            unset($remainingFeatures[$key]);
        }
    }

    $features = $orderedFeatures + $remainingFeatures;
    $supportedFeatures = $package['supported_features'] ?? [];
    $visibleFeatures = array_slice($features, 0, 5);
    $hiddenFeatures = array_slice($features, 5);
@endphp

<div class="{{ $package['parent_class'] }} plan-parent plan-{{ $billing_cycle }} {{ ($hasMonthlyBilling && $billing_cycle == 'monthly') || (!$hasMonthlyBilling && $loop->first) ? '' : 'hidden' }} disable-gradient-border">
    <div class="rounded-[30px] border border-color-89 dark:border-color-47 bg-white dark:bg-color-14 pt-6 pb-5 sub-plan-rtl single-plan-container" data-supported-features="{{ json_encode($supportedFeatures, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) }}">
        @if ($subscription?->package?->id == $package['id'] && $billing_cycle == $subscription?->billing_cycle && $subscription?->package?->renewable)
            <p class="current-plan-text absolute bg-black text-white py-2 rounded-full font-Figtree">{{ __('Current Plan') }}</p>
        @endif
        <p class="text-color-14 dark:text-white text-22 font-medium font-Figtree break-words text-center package-name">{{ $package['name'] }}</p>

        <p class="text-36 font-medium font-RedHat text-color-14 mt-1 text-center billing-cycle">
            @if(($package['discount_price'][$billing_cycle] ?? 0) > 0)
                <span class="plan-price">{{ formatNumber($package['discount_price'][$billing_cycle] ?? 0) }}</span>
            @else
            <span class="text-36 font-bold heading-1 break-all plan-price">{{ ($package['sale_price'][$billing_cycle] ?? 0) == 0 ? __('Free') : formatNumber($package['sale_price'][$billing_cycle] ?? 0) }}</span>
            @endif
            <span class="text-15 billing-text text-color-14 dark:text-white">/{{ ($billing_cycle == 'days' ? $package['duration'] . ' ' : '') . ucfirst($billing_cycle) }}</span>
        </p>

        @php
            $activeIconSvg = '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.02 2.88455C13.366 3.23062 13.366 3.79264 13.02 4.13871L5.93246 11.2262C5.58639 11.5723 5.02437 11.5723 4.6783 11.2262L1.13455 7.68246C0.788483 7.33639 0.788483 6.77437 1.13455 6.4283C1.48062 6.08223 2.04264 6.08223 2.38871 6.4283L5.30676 9.34359L11.7686 2.88455C12.1146 2.53848 12.6767 2.53848 13.0227 2.88455H13.02Z" fill="url(#paint0_linear_%s)"/>
                <defs>
                    <linearGradient id="paint0_linear_%s" x1="8.94006" y1="10.3952" x2="6.55093" y2="2.84747" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E60C84"/>
                        <stop offset="1" stop-color="#FFCF4B"/>
                    </linearGradient>
                </defs>
            </svg>';

            $inactiveIconSvg = '<svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.09014 1.59014C1.46032 1.21995 2.06051 1.21995 2.4307 1.59014L6.5 5.65944L10.5693 1.59014C10.9395 1.21995 11.5397 1.21995 11.9099 1.59014C12.28 1.96032 12.28 2.56051 11.9099 2.9307L7.84056 7L11.9099 11.0693C12.28 11.4395 12.28 12.0397 11.9099 12.4099C11.5397 12.78 10.9395 12.78 10.5693 12.4099L6.5 8.34056L2.4307 12.4099C2.06051 12.78 1.46032 12.78 1.09014 12.4099C0.719954 12.0397 0.719954 11.4395 1.09014 11.0693L5.15944 7L1.09014 2.9307C0.719954 2.56051 0.719954 1.96032 1.09014 1.59014Z" fill="#DF2F2F"/>
            </svg>';
        @endphp
        <div class="features-list flex flex-col gap-[18px] mt-6 6xl:pl-11 lg:pl-5 pl-8 pr-4">
            @if (count($supportedFeatures) > 0)
                <div class="flex items-center gap-1.5">
                    <span class="text-base text-gray-900 dark:text-white font-semibold">{{ __('Feature Highlights') }}</span>
                    <div class="relative">
                        <span class="inline-block group relative">
                            @php
                                $infoIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 cursor-pointer" fill="none" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="9" stroke="#bcbcbc" stroke-width="2" fill="none"/>
                                    <path d="M10 7.5a1 1 0 100-2 1 1 0 000 2zM10 9.5v4" stroke="#bcbcbc" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>';
                            @endphp
                            {!! $infoIconSvg !!}
                            
                            <div class="absolute left-1/2 -translate-x-1/2 top-full pt-2 w-64 z-50 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-opacity duration-200">
                                <div class="bg-white border border-gray-200 rounded-xl shadow-2xl max-h-56 overflow-y-auto p-4 flex flex-col gap-2">
                                    <div class="mb-3">
                                        <span class="block text-[13px] text-gray-500 font-semibold leading-tight">
                                            {{ __('What’s included in your plan:') }}
                                        </span>
                                    </div>
                                    <ul class="flex flex-col gap-2">
                                        @foreach($supportedFeatures as $supportedFeature)
                                            <li class="px-4 py-2 bg-gray-50 rounded-lg border border-gray-100 shadow-sm text-gray-800 font-medium transition-colors hover:bg-indigo-50 hover:border-indigo-200 hover:shadow hover:text-indigo-700">
                                                {{ $supportedFeature }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
            @endif

            @foreach($visibleFeatures as $meta)
                @continue(empty($meta['title']))
                @include('user.includes.partials.feature-item', ['meta' => $meta])
            @endforeach

            @foreach($hiddenFeatures as $meta)
                @continue(empty($meta['title']))
                @include('user.includes.partials.feature-item', ['meta' => $meta, 'isHidden' => true])
            @endforeach

            @if (count($hiddenFeatures) > 0)
                <button type="button" class="text-color-14 dark:text-white text-13 font-regular font-Figtree underline cursor-pointer mt-2 text-left upgrade-allPlans">
                    {{ __('Show All') }}
                </button>
            @endif
        </div>

        @if (preference('apply_coupon_subscription') && ((($package['sale_price'][$billing_cycle] ?? 0) > 0 && !$package['trial_day']) || ($package['trial_day'] && subscription('isUsedTrial', $package['id']))))
            <form action="{{ route('user.subscription.checkout') }}" method="GET" class="plan-disable-btn">
        @else
            <form action="{{ route('user.subscription.store') }}" method="POST" class="plan-disable-btn flex justify-center">
                @csrf
        @endif
            <div class="current-subscription-plan">
                <input type="hidden" name="package_id" value="{{ $package['id'] }}">
                <input type="hidden" name="sending_url" value="{{ techEncrypt(route('user.subscription.store')) }}">
                <input type="hidden" name="billing_cycle" value="{{ $billing_cycle }}">
            </div>
            @php
                $isTrialEligible = auth()->user() && $package['trial_day'] && !subscription('isUsedTrial', $package['id']);
                $isCurrentPlan = $subscription?->package?->id == $package['id'] && $billing_cycle == $subscription?->billing_cycle;
                $isUpgrade = preference('subscription_change_plan') && ($subscription?->package?->sale_price[$subscription?->billing_cycle] ?? 0) < ($package['sale_price'][$billing_cycle] ?? 0);
                $isDowngrade = preference('subscription_change_plan') && preference('subscription_downgrade') && ($subscription?->package?->sale_price[$subscription?->billing_cycle] ?? 0) >= ($package['sale_price'][$billing_cycle] ?? 0);
                $canChangePlan = preference('subscription_change_plan');

                $baseButtonClasses = 'plan-button mt-[34px] text-16 font-semibold py-[13px] px-8 rounded-lg font-Figtree plan-loader submit-btn flex justify-center gap-3';
                $buttonClasses = $baseButtonClasses . ' text-white dark:text-color-14 bg-color-14 dark:bg-white';
                $currentPlanClasses = $baseButtonClasses . ' text-white mx-5 current-plan';
                $changePlanClasses = $baseButtonClasses . ' text-white dark:text-color-14 bg-color-14 dark:bg-white mx-5';
            @endphp

            @if ($isTrialEligible)
                <button type="submit" class="{{ $buttonClasses }}">{{ __('Start :x Days Trial', ['x' => $package['trial_day']]) }}</button>
            @elseif (!$subscription?->package?->id)
                <button type="submit" class="{{ $buttonClasses }}">{{ __('Subscribe') }}</button>
            @elseif ($isCurrentPlan && $subscription?->package?->renewable)
                <button type="submit" class="{{ $currentPlanClasses }}">{{ __('Renew') }}</button>
            @elseif ($isUpgrade)
                <button type="submit" class="{{ $changePlanClasses }}">{{ __('Upgrade') }}</button>
            @elseif ($isDowngrade)
                <button type="submit" class="{{ $changePlanClasses }}">{{ __('Downgrade') }}</button>
            @endif
        </form>
    </div>
</div>
