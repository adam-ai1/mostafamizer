@php
    $hasMonthlyBilling = array_key_exists('monthly', $billingCycles ?? []);
@endphp

<div class="xl:flex justify-between items-center w-full gap-5">
    <div class="flex items-center border border-color-DF dark:border-[#474746] rounded-xl bg-white dark:bg-[#474746] relative overflow-hidden nav-scroller-wrapper">
        <div class="nav-scroller relative overflow-x-auto scroll-hide overflow-y-hidden whitespace-nowrap">
            <ul class="nav nav-tabs flex justify-around float-left px-1.5 items-center whitespace-nowrap flex-row list-none py-1.5 nav-scroller-content relative w-min min-w-full">
                @foreach($billingCycles as $key => $value)
                    <li class="nav-item nav-scroller-item" role="presentation">
                        <button
                            class="nav-link-activity nav-link rounded-lg block font-normal text-color-14 dark:text-white text-15 px-6 py-[7px] {{ ($hasMonthlyBilling && $key == 'monthly') || (!$hasMonthlyBilling && $loop->first) ? 'active' : '' }}" data-val="{{ $key }}">
                            {{ $value }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <button type="button" class="nav-scroller-btn nav-scroller-btn--left bg-white dark:bg-[#474746] px-1.5 absolute top-0 bottom-0 left-0">
            <svg class="text-color-89 dark:text-white neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                <g clip-path="url(#clip0_360_1562)">
                    <path d="M8.25 8.78063L5.46862 5.625L8.25 2.46937L7.39372 1.5L3.75 5.625L7.39372 9.75L8.25 8.78063Z" fill="currentColor" />
                </g>
                <defs>
                    <clipPath id="clip0_360_1562">
                        <rect width="12" height="12" fill="white" transform="matrix(-1 0 0 1 12 0)" />
                    </clipPath>
                </defs>
            </svg>
        </button>

        <button type="button" class="nav-scroller-btn nav-scroller-btn--right bg-white dark:bg-[#474746] px-1.5 absolute top-0 bottom-0 right-0">
            <svg class="text-color-89 dark:text-white neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                <g clip-path="url(#clip0_360_1559)">
                    <path d="M3.75 8.78063L6.53138 5.625L3.75 2.46937L4.60628 1.5L8.25 5.625L4.60628 9.75L3.75 8.78063Z" fill="currentColor" />
                </g>
                <defs>
                    <clipPath id="clip0_360_1559">
                        <rect width="12" height="12" fill="white" />
                    </clipPath>
                </defs>
            </svg>
        </button>
    </div>
</div>
