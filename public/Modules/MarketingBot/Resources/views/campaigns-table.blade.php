<div class="campaigns-table">
    <section class="rounded-xl bg-white dark:bg-color-3A border border-color-89/10 overflow-hidden" id="campaigns-table-section">
        <!-- Table Skeleton -->
        <div class="table-skeleton animate-pulse">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-color-DF dark:bg-color-47 text-color-14 dark:text-white">
                    <tr>
                        <th class="min-w-[260px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            {{ __('Campaign Name') }}
                        </th>
                        <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            {{ __('Status') }}
                        </th>
                        <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            {{ __('Training') }}
                        </th>
                        <th class="min-w-[140px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            {{ __('Schedule') }}
                        </th>
                        <th class="min-w-[140px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            {{ __('Channel') }}
                        </th>
                        <th class="text-center font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-color-3A divide-y divide-light-secondary/10 dark:divide-dark-secondary/10">
                    @for($i = 0; $i < 5; $i++)
                    <tr class="border-t border-color-89/10">
                        <td class="px-6 py-5">
                            <div class="flex items-center">
                                <div class="h-3 w-3 bg-gray-200 dark:bg-gray-700 rounded-full animate-pulse me-3"></div>
                                <div class="h-5 bg-gray-200 dark:bg-gray-700 rounded animate-pulse w-48"></div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded-full animate-pulse w-20"></div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded-full animate-pulse w-16"></div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded animate-pulse w-24"></div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 bg-gray-200 dark:bg-gray-700 rounded-lg animate-pulse"></div>
                                <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded animate-pulse w-16"></div>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <div class="h-8 w-8 bg-gray-200 dark:bg-gray-700 rounded-lg animate-pulse"></div>
                                <div class="h-8 w-8 bg-gray-200 dark:bg-gray-700 rounded-lg animate-pulse"></div>
                                <div class="h-8 w-8 bg-gray-200 dark:bg-gray-700 rounded-lg animate-pulse"></div>
                            </div>
                        </td>
                    </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Actual Table (Hidden initially) -->
        <div class="table-content{{ isset($is_ajax) && $is_ajax ? '' : ' hidden' }}">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead
                            class="bg-color-DF dark:bg-color-47 text-color-14 dark:text-white"
                    >
                    <tr>
                        <th
                                class="min-w-[260px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider"
                        >
                            {{ __('Campaign Name') }}
                        </th>
                        <th
                                class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider"
                        >
                            {{ __('Status') }}
                        </th>
                        <th
                                class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider"
                        >
                            {{ __('Training') }}
                        </th>
                        <th
                                class="min-w-[140px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider"
                        >
                            {{ __('Schedule') }}
                        </th>
                        <th
                                class="min-w-[140px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider"
                        >
                            {{ __('Channel') }}
                        </th>
                        <th
                                class="text-center font-semibold px-6 py-5 text-xs uppercase tracking-wider"
                        >
                            {{ __('Actions') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody id="campaigns-table-body"
                           class="bg-white dark:bg-color-3A divide-y divide-light-secondary/10 dark:divide-dark-secondary/10">
                @forelse ( $campaigns as $campaign )
                    <tr id="campaign-row-{{ $campaign->id }}"
                        class="border-t border-color-89/10 hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-purple-50/50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20">
                        <td class="px-6 py-5">
                            <div class="flex items-center">
                                <div
                                        class="h-3 w-3 shrink-0 bg-yellow-400 rounded-full me-3 animate-pulse"
                                ></div>
                                <span
                                        class="font-semibold text-color-14 dark:text-white text-base"
                                >
                                        {{ $campaign->title }}
                                    </span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            @if ( $campaign->status == 'scheduled' )
                                <span
                                        class="border border-white/10 backdrop-sepia-50 w-fit flex items-center rounded-xl bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 px-3 py-1.5 text-xs font-semibold">
                                        <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="2"
                                                stroke="currentColor"
                                                class="h-4 w-4 me-1.5"
                                        >
                                            <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                            />
                                        </svg>
                                    {{ ucfirst($campaign->status) }}
                                    </span>
                            @elseif ( $campaign->status == 'published' )
                                <span
                                        class="border-white/10 backdrop-sepia-50 w-fit flex items-center rounded-xl bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-3 py-1.5 text-xs font-semibold">
                                        <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="2"
                                                stroke="currentColor"
                                                class="h-4 w-4 me-1.5"
                                        >
                                            <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                            />
                                        </svg>
                                    {{ ucfirst($campaign->status) }}
                                    </span>
                            @else
                                <span class="border border-white/10 backdrop-sepia-50 w-fit flex items-center rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 px-3 py-1.5 text-xs font-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 me-1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                        </svg>
                                    {{ ucfirst($campaign->status) }}
                                        </span>
                            @endif
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            @php
                                $trainingStatus = $campaign->trained_materials_count > 0 ? 'Trained' : 'Not Trained';
                            @endphp
                            <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium {{ $trainingStatus == 'Trained' ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-color-F6 dark:bg-color-47 text-color-14 dark:text-white' }}"
                            >
                                    {{ $trainingStatus }}
                                </span>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-color-89 font-medium">
                            {{ $campaign->schedule_at?->diffForHumans() ?? '--' }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                @if ($campaign->channel == 'whatsapp')
                                    <div
                                            class="h-8 w-8 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                        <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 50 50"
                                                width="16px"
                                                height="16px"
                                                class="text-green-600 dark:text-green-400"
                                        >
                                            <path
                                                    fill="currentColor"
                                                    d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 29.079097 3.1186875 32.88588 4.984375 36.208984 L 2.0371094 46.730469 A 1.0001 1.0001 0 0 0 3.2402344 47.970703 L 14.210938 45.251953 C 17.434629 46.972929 21.092591 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 21.278025 46 17.792121 45.029635 14.761719 43.333984 A 1.0001 1.0001 0 0 0 14.033203 43.236328 L 4.4257812 45.617188 L 7.0019531 36.425781 A 1.0001 1.0001 0 0 0 6.9023438 35.646484 C 5.0606869 32.523592 4 28.890107 4 25 C 4 13.390466 13.390466 4 25 4 z M 16.642578 13 C 16.001539 13 15.086045 13.23849 14.333984 14.048828 C 13.882268 14.535548 12 16.369511 12 19.59375 C 12 22.955271 14.331391 25.855848 14.613281 26.228516 L 14.615234 26.228516 L 14.615234 26.230469 C 14.588494 26.195329 14.973031 26.752191 15.486328 27.419922 C 15.999626 28.087653 16.717405 28.96464 17.619141 29.914062 C 19.422612 31.812909 21.958282 34.007419 25.105469 35.349609 C 26.554789 35.966779 27.698179 36.339417 28.564453 36.611328 C 30.169845 37.115426 31.632073 37.038799 32.730469 36.876953 C 33.55263 36.755876 34.456878 36.361114 35.351562 35.794922 C 36.246248 35.22873 37.12309 34.524722 37.509766 33.455078 C 37.786772 32.688244 37.927591 31.979598 37.978516 31.396484 C 38.003976 31.104927 38.007211 30.847602 37.988281 30.609375 C 37.969311 30.371148 37.989581 30.188664 37.767578 29.824219 C 37.302009 29.059804 36.774753 29.039853 36.224609 28.767578 C 35.918939 28.616297 35.048661 28.191329 34.175781 27.775391 C 33.303883 27.35992 32.54892 26.991953 32.083984 26.826172 C 31.790239 26.720488 31.431556 26.568352 30.914062 26.626953 C 30.396569 26.685553 29.88546 27.058933 29.587891 27.5 C 29.305837 27.918069 28.170387 29.258349 27.824219 29.652344 C 27.819619 29.649544 27.849659 29.663383 27.712891 29.595703 C 27.284761 29.383815 26.761157 29.203652 25.986328 28.794922 C 25.2115 28.386192 24.242255 27.782635 23.181641 26.847656 L 23.181641 26.845703 C 21.603029 25.455949 20.497272 23.711106 20.148438 23.125 C 20.171937 23.09704 20.145643 23.130901 20.195312 23.082031 L 20.197266 23.080078 C 20.553781 22.728924 20.869739 22.309521 21.136719 22.001953 C 21.515257 21.565866 21.68231 21.181437 21.863281 20.822266 C 22.223954 20.10644 22.02313 19.318742 21.814453 18.904297 L 21.814453 18.902344 C 21.828863 18.931014 21.701572 18.650157 21.564453 18.326172 C 21.426943 18.001263 21.251663 17.580039 21.064453 17.130859 C 20.690033 16.232501 20.272027 15.224912 20.023438 14.634766 L 20.023438 14.632812 C 19.730591 13.937684 19.334395 13.436908 18.816406 13.195312 C 18.298417 12.953717 17.840778 13.022402 17.822266 13.021484 L 17.820312 13.021484 C 17.450668 13.004432 17.045038 13 16.642578 13 z M 16.642578 15 C 17.028118 15 17.408214 15.004701 17.726562 15.019531 C 18.054056 15.035851 18.033687 15.037192 17.970703 15.007812 C 17.906713 14.977972 17.993533 14.968282 18.179688 15.410156 C 18.423098 15.98801 18.84317 16.999249 19.21875 17.900391 C 19.40654 18.350961 19.582292 18.773816 19.722656 19.105469 C 19.863021 19.437122 19.939077 19.622295 20.027344 19.798828 L 20.027344 19.800781 L 20.029297 19.802734 C 20.115837 19.973483 20.108185 19.864164 20.078125 19.923828 C 19.867096 20.342656 19.838461 20.445493 19.625 20.691406 C 19.29998 21.065838 18.968453 21.483404 18.792969 21.65625 C 18.639439 21.80707 18.36242 22.042032 18.189453 22.501953 C 18.016221 22.962578 18.097073 23.59457 18.375 24.066406 C 18.745032 24.6946 19.964406 26.679307 21.859375 28.347656 C 23.05276 29.399678 24.164563 30.095933 25.052734 30.564453 C 25.940906 31.032973 26.664301 31.306607 26.826172 31.386719 C 27.210549 31.576953 27.630655 31.72467 28.119141 31.666016 C 28.607627 31.607366 29.02878 31.310979 29.296875 31.007812 L 29.298828 31.005859 C 29.655629 30.601347 30.715848 29.390728 31.224609 28.644531 C 31.246169 28.652131 31.239109 28.646231 31.408203 28.707031 L 31.408203 28.708984 L 31.410156 28.708984 C 31.487356 28.736474 32.454286 29.169267 33.316406 29.580078 C 34.178526 29.990889 35.053561 30.417875 35.337891 30.558594 C 35.748225 30.761674 35.942113 30.893881 35.992188 30.894531 C 35.995572 30.982516 35.998992 31.07786 35.986328 31.222656 C 35.951258 31.624292 35.8439 32.180225 35.628906 32.775391 C 35.523582 33.066746 34.975018 33.667661 34.283203 34.105469 C 33.591388 34.543277 32.749338 34.852514 32.4375 34.898438 C 31.499896 35.036591 30.386672 35.087027 29.164062 34.703125 C 28.316336 34.437036 27.259305 34.092596 25.890625 33.509766 C 23.114812 32.325956 20.755591 30.311513 19.070312 28.537109 C 18.227674 27.649908 17.552562 26.824019 17.072266 26.199219 C 16.592866 25.575584 16.383528 25.251054 16.208984 25.021484 L 16.207031 25.019531 C 15.897202 24.609805 14 21.970851 14 19.59375 C 14 17.077989 15.168497 16.091436 15.800781 15.410156 C 16.132721 15.052495 16.495617 15 16.642578 15 z"
                                            />
                                        </svg>
                                    </div>
                                @else
                                    <div
                                            class="h-8 w-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                        <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 50 50"
                                                width="16px"
                                                height="16px"
                                                class="text-blue-600 dark:text-blue-400"
                                        >
                                            <path
                                                    fill="currentColor"
                                                    d="M 25 2 C 12.309288 2 2 12.309297 2 25 C 2 37.690703 12.309288 48 25 48 C 37.690712 48 48 37.690703 48 25 C 48 12.309297 37.690712 2 25 2 z M 25 4 C 36.609833 4 46 13.390175 46 25 C 46 36.609825 36.609833 46 25 46 C 13.390167 46 4 36.609825 4 25 C 4 13.390175 13.390167 4 25 4 z M 34.087891 14.035156 C 33.403891 14.035156 32.635328 14.193578 31.736328 14.517578 C 30.340328 15.020578 13.920734 21.992156 12.052734 22.785156 C 10.984734 23.239156 8.9960938 24.083656 8.9960938 26.097656 C 8.9960938 27.432656 9.7783594 28.3875 11.318359 28.9375 C 12.146359 29.2325 14.112906 29.828578 15.253906 30.142578 C 15.737906 30.275578 16.25225 30.34375 16.78125 30.34375 C 17.81625 30.34375 18.857828 30.085859 19.673828 29.630859 C 19.666828 29.798859 19.671406 29.968672 19.691406 30.138672 C 19.814406 31.188672 20.461875 32.17625 21.421875 32.78125 C 22.049875 33.17725 27.179312 36.614156 27.945312 37.160156 C 29.021313 37.929156 30.210813 38.335938 31.382812 38.335938 C 33.622813 38.335938 34.374328 36.023109 34.736328 34.912109 C 35.261328 33.299109 37.227219 20.182141 37.449219 17.869141 C 37.600219 16.284141 36.939641 14.978953 35.681641 14.376953 C 35.210641 14.149953 34.672891 14.035156 34.087891 14.035156 z M 34.087891 16.035156 C 34.362891 16.035156 34.608406 16.080641 34.816406 16.181641 C 35.289406 16.408641 35.530031 16.914688 35.457031 17.679688 C 35.215031 20.202687 33.253938 33.008969 32.835938 34.292969 C 32.477938 35.390969 32.100813 36.335938 31.382812 36.335938 C 30.664813 36.335938 29.880422 36.08425 29.107422 35.53125 C 28.334422 34.97925 23.201281 31.536891 22.488281 31.087891 C 21.863281 30.693891 21.201813 29.711719 22.132812 28.761719 C 22.899812 27.979719 28.717844 22.332938 29.214844 21.835938 C 29.584844 21.464938 29.411828 21.017578 29.048828 21.017578 C 28.923828 21.017578 28.774141 21.070266 28.619141 21.197266 C 28.011141 21.694266 19.534781 27.366266 18.800781 27.822266 C 18.314781 28.124266 17.56225 28.341797 16.78125 28.341797 C 16.44825 28.341797 16.111109 28.301891 15.787109 28.212891 C 14.659109 27.901891 12.750187 27.322734 11.992188 27.052734 C 11.263188 26.792734 10.998047 26.543656 10.998047 26.097656 C 10.998047 25.463656 11.892938 25.026 12.835938 24.625 C 13.831938 24.202 31.066062 16.883437 32.414062 16.398438 C 33.038062 16.172438 33.608891 16.035156 34.087891 16.035156 z"
                                            />
                                        </svg>
                                    </div>
                                @endif
                                <span
                                        class="text-color-14 dark:text-white font-medium"
                                >{{ ucfirst($campaign->channel) }}</span
                                >
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <!-- Sparkles Button -->
                                <a
                                        href="{{ route('user.marketing-bot.campaigns.materials', ['id' => $campaign->id, 'orderBy' => 'newest']) }}"
                                        aria-label="{{ __('View campaign materials') }}"
                                        class="p-2 h-8 w-8 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 text-white flex items-center justify-center hover:from-purple-600 hover:to-pink-600 shadow-sm hover:shadow-pink-200 dark:hover:shadow-pink-900/50 transform hover:scale-105 transition duration-200 ease-in-out"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M5 3v4M3 5h4M19 3v4m-2-2h4M5 17v4M3 19h4m10 0h4m-2-2v4M9.75 8.75l-1.5 4.5 4.5 1.5 1.5-4.5-4.5-1.5zm4.5 6l-1.5 4.5 4.5 1.5 1.5-4.5-4.5-1.5z" />
                                    </svg>
                                </a>

                                <!-- Edit Button -->
                                <a
                                        href="javascript:void(0)"
                                        data-campaign-id="{{ $campaign->id }}"
                                        aria-label="{{ __('Edit campaign') }}"
                                        class="p-2 h-8 w-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center hover:from-blue-600 hover:to-blue-700 shadow-sm hover:shadow-blue-200 dark:hover:shadow-blue-900/50 transform hover:scale-105 transition duration-200 ease-in-out"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.651 1.651a2.121 2.121 0 010 3.001l-9.193 9.193a2.121 2.121 0 01-1.061.577l-3.388.678a.75.75 0 01-.887-.887l.678-3.388a2.121 2.121 0 01.577-1.061l9.193-9.193a2.121 2.121 0 013.001 0z" />
                                    </svg>
                                </a>

                                <!-- Delete Button -->
                                <button
                                        data-target="modal2"
                                        data-id="{{ $campaign->id }}"
                                        aria-label="{{ __('Delete campaign') }}"
                                        class="openModalBtn p-2 h-8 w-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white flex items-center justify-center hover:from-red-600 hover:to-red-700 shadow-sm hover:shadow-red-200 dark:hover:shadow-red-900/50 transform hover:scale-105 transition duration-200 ease-in-out"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <svg class="mx-auto mt-10" xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                <g clip-path="url(#clip0_2698_2638)">
                                <path d="M38.6467 13.4583H5.35361C4.07374 13.4583 3.03613 14.4958 3.03613 15.7757V30.9319H40.9641V15.7757C40.9641 14.4959 39.9265 13.4583 38.6467 13.4583Z" fill="#FF9A00"/>
                                <path d="M8.8972 0C7.26421 0 5.94043 1.32378 5.94043 2.95677V41.0432C5.94043 42.6762 7.26421 44 8.8972 44H35.1026C36.7356 44 38.0594 42.6762 38.0594 41.0432V9.11745C38.0594 8.52337 37.8234 7.95369 37.4034 7.53354L30.5258 0.655961C30.1057 0.235984 29.5359 0 28.9419 0L8.8972 0Z" fill="#F5F5F5"/>
                                <path d="M37.4035 7.53367L32.8447 2.97485L32.8284 10.622C32.8274 11.102 33.2163 11.4918 33.6963 11.4918C34.1757 11.4918 34.5642 11.8804 34.5642 12.3597V41.0434C34.5642 42.6763 33.2404 44.0001 31.6074 44.0001H35.1027C36.7357 44.0001 38.0594 42.6763 38.0594 41.0434V12.1156V9.11749C38.0596 8.52341 37.8236 7.95373 37.4035 7.53367Z" fill="#EAEAEA"/>
                                <path d="M37.4033 7.5335L30.5257 0.655926C30.3342 0.464457 30.1114 0.311746 29.8696 0.20166V5.23279C29.8696 6.86577 31.1934 8.18955 32.8264 8.18955H37.8575C37.7475 7.94772 37.5948 7.72497 37.4033 7.5335Z" fill="#A8D0D5"/>
                                <path d="M16.3243 21.9575L15.7131 20.5742C15.3422 19.7349 14.511 19.1934 13.5934 19.1934H5.35361C4.07374 19.1934 3.03613 20.2309 3.03613 21.5108V41.6824C3.03613 42.9623 4.07366 43.9999 5.35361 43.9999H38.6467C39.9265 43.9999 40.9641 42.9624 40.9641 41.6824V25.6559C40.9641 24.376 39.9266 23.3384 38.6467 23.3384H18.4441C17.5264 23.3384 16.6952 22.7969 16.3243 21.9575Z" fill="#FFB541"/>
                                <path d="M12.187 20.5742L12.7982 21.9575C13.1691 22.7968 14.0003 23.3383 14.918 23.3383H18.444C17.5263 23.3382 16.6952 22.7968 16.3243 21.9575L15.7131 20.5742C15.3422 19.7349 14.511 19.1934 13.5934 19.1934H10.0674C10.985 19.1934 11.8161 19.7349 12.187 20.5742Z" fill="#FFA812"/>
                                <path d="M38.6468 23.3384H35.1209C36.4006 23.3385 37.4381 24.376 37.4381 25.6559V41.6825C37.4381 42.9624 36.4006 44 35.1206 44H38.6467C39.9266 44 40.9642 42.9625 40.9642 41.6825V25.6558C40.9643 24.3759 39.9267 23.3384 38.6468 23.3384Z" fill="#FFA812"/>
                                <path d="M16.6176 4.86731H10.0499C9.68309 4.86731 9.38574 4.56997 9.38574 4.20319C9.38574 3.83641 9.68309 3.53906 10.0499 3.53906H16.6176C16.9844 3.53906 17.2818 3.83641 17.2818 4.20319C17.2818 4.56997 16.9845 4.86731 16.6176 4.86731Z" fill="#3693BD"/>
                                <path d="M16.6176 8.86121H10.0499C9.68309 8.86121 9.38574 8.56387 9.38574 8.19708C9.38574 7.8303 9.68309 7.53296 10.0499 7.53296H16.6176C16.9844 7.53296 17.2818 7.8303 17.2818 8.19708C17.2818 8.56387 16.9845 8.86121 16.6176 8.86121Z" fill="#3693BD"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_2698_2638">
                                <rect width="44" height="44" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>
                            <p class="text-color-14 dark:text-white text-center font-medium font-Figtree text-20 mt-6">{{ __('No data found')}}</p>
                            <p class="text-center font-medium text-color-89 text-15 px-5 py-3 font-Figtree mt-3 md:w-[450px] mx-auto">{{ __('Looks like you did not train any data yet.')}}</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </section>




    <!-- Edit Campaign Modal -->
    <div
            id="editCampaignModal"
            class="sweet-modal fixed inset-0 hidden bg-color-14/50 backdrop-blur-[4px] flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 p-4">
        <!-- Modal Box - Made smaller -->
        <div
                class="modalBox max-w-md w-full min-w-[300px] bg-white dark:bg-color-3A rounded-xl relative transform transition-all duration-300 scale-0 opacity-0 max-h-[80vh] overflow-y-auto"
        >
            <!-- Close Button -->
            <button type="button"
                    class="closeModalBtn absolute top-4 right-4 text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 z-10"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal Content -->
            <div class="p-5">
                <h2 class="text-xl font-bold text-color-14 dark:text-white mb-4">
                    {{ __('Edit Campaign') }}
                </h2>

                <!-- Campaign Form -->
                <div class="rounded-xl p-4 mb-4">
                    <form class="space-y-4" id="edit-campaign-form">
                        @csrf
                        <input type="hidden" id="edit_campaign_id" name="id" />

                        <!-- Campaign Title -->
                        <div class="space-y-1.5">
                            <label class="flex items-center gap-2 text-sm text-color-14 dark:text-white font-medium">
                                {{ __('Campaign Title') }}
                                <svg
                                        class="w-4 h-4 text-color-89 mb-0.5"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                >
                                    <path
                                            fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd"
                                    />
                                </svg>
                            </label>
                            <input
                                    required
                                    id="edit_campaign_title"
                                    name="title"
                                    type="text"
                                    placeholder="Enter campaign title..."
                                    class="form-control w-full p-3 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-lg text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-color-14 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                        </div>

                        <!-- End Date -->
                        <div class="space-y-1.5">
                            <label class="block text-sm font-medium text-color-14 dark:text-white mb-2">
                                {{ __('End Date') }}
                            </label>
                            <input
                                    id="edit_end_date"
                                    name="ends_at"
                                    type="date"
                                    class="form-control w-full px-3 py-2 rounded-lg text-color-14 dark:text-white bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition ease-out duration-200"
                            />
                            <p id="end_date_disabled_message" class="text-xs text-color-89 mt-1 hidden">
                               {{ __('End date cannot be modified for completed campaigns.') }}
                            </p>
                        </div>

                        <!-- Options -->
                        <div class="space-y-3">
                            <!-- AI Reply Option -->
                            <div
                                    class="flex items-center justify-between px-4 py-3 rounded-xl bg-blue-50/50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800"
                            >
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-blue-100 dark:bg-blue-800 rounded-xl">
                                        <svg
                                                class="w-5 h-5 text-blue-600 dark:text-blue-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                        >
                                            <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                                                />
                                            </svg>
                                        </div>
                                        <span class="font-medium text-color-14 dark:text-white" >{{ __('AI Reply') }}</span>
                                        
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" id="edit_ai_reply" name="ai_reply" />
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
                                        ></div>
                                    </label>
                                </div>

                                <div
                                    id="aiReplyOptions"
                                    class="hidden space-y-4 p-4 mt-3 rounded-2xl bg-blue-50/50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-color-14 dark:text-white mb-2"
                                                >{{ __('Chat Provider') }}</label
                                            >
                                            <select
                                                class="select block w-full mt-[3px] text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control"
                                                name="chat_provider" id="chatProvider">
                                                @foreach ($chatProviders as $key => $provider)
                                                    <option value="{{ $key }}"> {{ ucwords($key) }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-color-14 dark:text-white mb-2"
                                                >{{ __('Chat Model') }}</label
                                            >
                                            @foreach ($chatProviders as $key => $provider)
                                                <div class="ProviderOptions {{ $key . '_div' }} {{ $loop->index == 0 ? '' : 'hidden' }}">
                                                    <select
                                                        class="select block w-full mt-[3px] text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control"
                                                        name="chat_model" id="chatModel">
                                                            @foreach($provider as $model)
                                                                <option value="{{ $model }}" data-provider="{{ $key }}"> {{ ucwords($model) }} </option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-color-14 dark:text-white mb-2"
                                                >{{ __('Embedding Provider') }}</label
                                            >
                                            <select
                                                class="select block w-full mt-[3px] text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control"
                                                name="embedding_provider" id="embeddingProvider">
                                                @foreach ($embeddingProviders as $key => $provider)
                                                    <option value="{{ $key }}"> {{ ucwords($key) }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-color-14 dark:text-white mb-2"
                                                >{{ __('Embedding Model') }}</label
                                            >
                                            @foreach ($embeddingProviders as $key => $provider)
                                                <div class="EmbeddingProviderOptions {{ $key . '_div' }} {{ $loop->index == 0 ? '' : 'hidden' }}">
                                                    <select
                                                        class="select block w-full mt-[3px] text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control"
                                                        name="embedding_model" id="embeddingModel">
                                                            @foreach($provider as $model)
                                                                <option value="{{ $model }}" data-provider="{{ $key }}"> {{ ucwords($model) }} </option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            <!-- Schedule Campaign Option -->
                            <div
                                    class="flex items-center justify-between px-4 py-3 rounded-xl bg-purple-50/50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800"
                            >
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-purple-100 dark:bg-purple-800 rounded-xl">
                                        <svg
                                                class="w-5 h-5 text-purple-600 dark:text-purple-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                        >
                                            <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>
                                    </div>
                                    <span class="font-medium text-color-14 dark:text-white">
                                    {{ __('Schedule Campaign') }}
                                </span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input
                                            type="checkbox"
                                            class="sr-only peer"
                                            id="edit_schedule_toggle"
                                            name="schedule"
                                    />
                                    <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"
                                    ></div>
                                </label>
                            </div>

                            <!-- Schedule Options (Hidden by default) -->
                            <div
                                    id="edit_schedule_options"
                                    class="hidden space-y-3 p-3 rounded-xl bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 border border-purple-200 dark:border-purple-800"
                            >
                                <div class="grid grid-cols-1 gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-color-14 dark:text-white mb-1">
                                            {{ __('Date') }}
                                        </label>
                                        <input
                                                id="edit_schedule_date"
                                                name="schedule_date"
                                                type="date"
                                                class="w-full px-2 py-1.5 rounded-lg text-color-14 dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 focus:border-purple-500 focus:ring-1 focus:ring-purple-200 dark:focus:ring-purple-800 transition-all duration-300 text-sm"
                                        />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-color-14 dark:text-white mb-1">
                                            {{ __('Time') }}
                                        </label>
                                        <input
                                                id="edit_schedule_time"
                                                name="schedule_time"
                                                type="time"
                                                class="w-full px-2 py-1.5 rounded-lg text-color-14 dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 focus:border-purple-500 focus:ring-1 focus:ring-purple-200 dark:focus:ring-purple-800 transition-all duration-300 text-sm"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex gap-2 pt-3">
                            <button
                                    type="button"
                                    class="closeModalBtn flex-1 flex items-center justify-center rounded-lg text-sm text-center bg-gray-500 hover:bg-gray-600 text-white px-4 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                            >
                                {{ __('Cancel') }}
                            </button>
                            <button
                                    type="submit"
                                    class="flex-1 flex items-center justify-center rounded-lg text-sm text-center magic-bg hover:shadow-lg text-white px-4 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                            >
                                <svg class="w-4 h-4 animate-spin text-white hidden loader-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="mx-1">{{ __('Update') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Campaign Modal -->
    <div
            id="modal2"
            class="sweet-modal fixed inset-0 hidden bg-color-14/50 backdrop-blur-[4px] flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 p-4">
        <div
                class="modalBox max-w-[600px] min-w-[300px] bg-white dark:bg-color-3A rounded-xl py-7 relative transform transition-all duration-300 scale-0 opacity-0">
            <!-- Close Button -->
            <button type="button"
                    class="closeModalBtn absolute top-4 right-4 text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal Content -->
            <div class="px-7">
                <h5 class="max-w-[300px] text-xl text-color-14 dark:text-white text-center font-medium mb-0.5">
                    {{ __('Are you sure you want to delete this campaign?') }}
                </h5>
                <div class="flex justify-center gap-3 mt-6">
                    <button type="button" class="delete-campaign w-full flex items-center justify-center rounded-[6px] text-sm text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200">
                        <span>{{ __('Delete') }}</span>
                        <svg class="loader animate-spin h-5 w-5 ml-2 hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                    <button type="button" class="closeModalBtn w-full flex items-center justify-center rounded-[6px] text-sm text-center bg-color-14 hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200">
                        <span>{{ __('Cancel') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    {{ $campaigns->onEachSide(1)->links('site.layout.partials.pagination') }}
</div>