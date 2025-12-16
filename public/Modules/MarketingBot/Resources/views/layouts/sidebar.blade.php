<div>
    <!-- Mobile overlay (hidden by default) -->
    <div id="sidebar-overlay" 
        class="fixed inset-0 bg-black/40 z-40 hidden xl:hidden"
        onclick="toggleSidebar(false)">
    </div>
    
    <aside id="sidebar"
        class="invisible xl:visible fixed xl:static top-0 start-0 h-full shrink-0 w-[270px] bg-color-F9 dark:bg-color-3A -translate-x-full translate-x-full xl:translate-x-0 transition-transform duration-300 ease-in-out z-50 sidebar-scrollbar xl:overflow-auto xl:h-[calc(100vh-56px)] border-e border-e-color-DF dark:border-e-color-47"
    >
        <div
            class="pl-5 pr-4 py-3 border-b border-b-color-DF dark:border-b-color-47 flex justify-between items-center"
        >
            <span class="text-[22px] font-[600] text-dark-1 dark:text-white font-redhat">
             {{ __('Marketing Bot') }}
            </span>
            <!-- Close button (mobile only) -->
            <button class="xl:hidden bg-color-14 dark:bg-white text-white dark:text-color-14 h-6 w-6 flex items-center justify-center rounded-[4px] shadow-lg" onclick="toggleSidebar(false)">
                <svg class="ltr:rotate-0 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><g><path d="M4.96094 2.91699H7.58594L4.66927 7.00033L7.58594 11.0837H4.96094L2.04427 7.00033L4.96094 2.91699Z" fill="currentColor"></path><path d="M10.043 2.91699H12.668L9.7513 7.00033L12.668 11.0837H10.043L7.1263 7.00033L10.043 2.91699Z" fill="currentColor"></path></g><defs><clipPath id="clip0_12889_4648"><rect width="14" height="14" fill="white" transform="matrix(-1 0 0 1 14 0)"></rect></clipPath></defs></svg>
            </button>
        </div>
        <!-- Navigation -->
        <nav class="py-4">
            <a href="{{ route('user.marketing-bot.template') }}"
                class="{{ activeSidebarMenu(route('user.marketing-bot.template'))['class'] }} relative group/item min-h-[48px] py-2 w-full  flex items-center gap-3 pl-5 pr-4 hover:bg-white dark:hover:bg-color-47 transition duration-200 ease-out justify-start text-color-14 dark:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20" fill="none">
                    <g clip-path="url(#clip0_15297_8138)">
                        <path
                            d="M18.332 2.5H19.9989V8.33324H18.332V2.5Z"
                            fill="currentColor"
                        ></path>
                        <path
                            d="M15 0H16.6668V8.33321H15V0Z"
                            fill="currentColor"
                        ></path>
                        <path
                            d="M11.668 5H13.3346V8.33328H11.668V5Z"
                            fill="currentColor"
                        ></path>
                        <path
                            d="M10 10V0C4.47731 0 0 4.47731 0 10C0 15.5226 4.47731 20.0001 10 20.0001C15.5226 20.0001 20.0001 15.5226 20.0001 10H10ZM8.33321 1.83372V10.4883L3.55148 15.2702C2.37484 13.833 1.66683 11.9978 1.66683 10C1.66683 5.97572 4.53453 2.60868 8.33321 1.83372ZM10 18.3332C8.00171 18.3332 6.16703 17.6252 4.72984 16.4486L9.51157 11.6667H18.1656C17.3918 15.4655 14.0242 18.3332 10 18.3332Z"
                            fill="currentColor"
                        ></path>
                    </g>
                    <defs>
                        <clipPath id="clip0_15297_8138">
                            <rect width="20" height="20" fill="white"></rect>
                        </clipPath>
                    </defs>
                </svg>
                <span class="leading-tight"> {{ __('Dashboard') }} </span>
            </a>
            <a href="{{ route('user.marketing-bot.inbox') }}"
                class="{{ activeSidebarMenu(route('user.marketing-bot.inbox'))['class'] }} relative group/item min-h-[48px] py-2 w-full flex items-center gap-3 pl-5 pr-4 hover:bg-white dark:hover:bg-color-47 transition duration-200 ease-out justify-start text-color-14 dark:text-white"
                >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    height="20px"
                    width="20px"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z"
                    />
                </svg>

                <span class="leading-tight"> {{ __('Inbox') }}</span>
            </a>

            <a href="{{ route('user.marketing-bot.campaigns.index', ['orderBy' => 'newest']) }}"
                class="{{ activeSidebarMenu(route('user.marketing-bot.campaigns.index'), route('user.marketing-bot.campaigns.whatsapp-campaign.create'), route('user.marketing-bot.campaigns.telegram-campaign.create'), route('user.marketing-bot.campaigns.materials', ['id' => request()->id ?? 1 ]))['class'] }} relative group/item min-h-[48px] py-2 w-full flex items-center gap-3 pl-5 pr-4 hover:bg-white dark:hover:bg-color-47 transition duration-200 ease-out justify-start text-color-14 dark:text-white"
                >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"><g><path d="M392.48 207.019c10.145-6.384 17.405-16.2 20.525-27.842 3.279-12.24 1.596-25.025-4.74-35.999-12.768-22.115-40.775-30.056-63.18-18.249L302.48 51.135c-5.635-9.76-14.766-16.75-25.711-19.683-10.946-2.933-22.35-1.445-32.108 4.191-9.76 5.635-16.75 14.766-19.683 25.71-2.21 8.247-1.907 16.754.786 24.622-20.237 50.998-63.067 103.007-121.217 147.376a9.987 9.987 0 0 0-2.969-1.358 9.998 9.998 0 0 0-7.588.999l-54.366 31.389c-18.29 10.56-31.392 27.68-36.892 48.206s-2.714 41.904 7.847 60.194c14.682 25.43 41.408 39.662 68.855 39.662 13.453 0 27.08-3.42 39.544-10.616l3.112-1.796 59.956 78.279c4.142 5.408 9.917 8.591 16.705 9.206.771.07 1.534.104 2.29.104 5.898 0 11.319-2.108 15.792-6.166l16.512-14.983c9.188-8.339 10.45-22.073 2.935-31.946l-56.375-74.069c66.96-27.689 132.806-38.539 186.665-30.623 8.159 9.337 19.911 14.462 31.93 14.461a42.077 42.077 0 0 0 21.093-5.662c20.212-11.669 27.162-37.606 15.492-57.819zm-1.536-53.841c3.665 6.348 4.639 13.743 2.741 20.823-1.736 6.481-5.693 11.981-11.218 15.678l-27.372-47.41c12.835-6.308 28.594-1.657 35.849 10.909zM79.401 392.447c-20.527-.001-40.521-10.647-51.503-29.666-7.889-13.664-9.966-29.651-5.848-45.017 4.117-15.366 13.909-28.173 27.573-36.062l45.706-26.389 59.354 102.805-45.706 26.389a58.966 58.966 0 0 1-29.576 7.94zm140.503 59.213-16.511 14.982c-.873.792-1.674 1.061-2.843.954-1.174-.106-1.91-.512-2.627-1.447l-58.366-76.203 26.162-15.105 54.646 71.797a3.71 3.71 0 0 1-.461 5.022zm-50.71-108.411-53.732-93.067c55.971-42.465 98.706-92.056 122.336-141.775l115.346 199.786c-54.873-4.396-119.19 7.817-183.95 35.056zm240.398-21.939c-10.664 6.158-24.343 2.489-30.499-8.171L246.488 83.46c-6.155-10.662-2.489-24.343 8.172-30.498a22.057 22.057 0 0 1 11.061-2.972c1.954 0 3.926.258 5.871.779 5.785 1.55 10.604 5.231 13.567 10.365l132.604 229.678c6.156 10.662 2.49 24.343-8.171 30.498zm10.875-185.177c-2.762-4.783-1.123-10.899 3.66-13.66l40.144-23.177c4.783-2.762 10.899-1.122 13.66 3.66 2.762 4.783 1.123 10.899-3.66 13.66l-40.144 23.177a9.996 9.996 0 0 1-13.66-3.66zm-46.28-64.405 24.448-42.346c2.761-4.782 8.876-6.423 13.66-3.66 4.783 2.761 6.422 8.877 3.66 13.66l-24.448 42.346a9.997 9.997 0 0 1-13.66 3.66c-4.784-2.761-6.422-8.877-3.66-13.66zM512 198.417c0 5.523-4.478 10-10 10h-48.896c-5.522 0-10-4.477-10-10s4.478-10 10-10H502c5.522 0 10 4.477 10 10z" fill="currentColor"></path></g></svg>

                <span class="leading-tight"> {{ __('Campaign') }}</span>
            </a>

            @php
                $channelPreferences = getMarketingBotChannelPreferences();
                $whatsappEnabled = $channelPreferences['whatsapp_enabled'];
                $telegramEnabled = $channelPreferences['telegram_enabled'];
            @endphp

            <!-- Start Whatsapp (with nested menu) -->
            @if($whatsappEnabled)
            <button
                onclick="toggleMenu('submenu-whatsapp', this)"
                class="{{ activeSidebarMenu(route('user.marketing-bot.templates.index'), route('user.marketing-bot.contacts'), route('user.marketing-bot.segments'))['class'] }} menu-btn relative min-h-[48px] py-2 w-full flex items-center gap-3 pl-5 pr-4 hover:bg-white dark:hover:bg-color-47 transition duration-200 ease-out text-color-14 dark:text-white justify-between">
                <div class="flex items-center gap-3">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 50 50"
                        width="20px"
                        height="20px"
                    >
                        <path
                            fill="currentColor"
                            d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 29.079097 3.1186875 32.88588 4.984375 36.208984 L 2.0371094 46.730469 A 1.0001 1.0001 0 0 0 3.2402344 47.970703 L 14.210938 45.251953 C 17.434629 46.972929 21.092591 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 21.278025 46 17.792121 45.029635 14.761719 43.333984 A 1.0001 1.0001 0 0 0 14.033203 43.236328 L 4.4257812 45.617188 L 7.0019531 36.425781 A 1.0001 1.0001 0 0 0 6.9023438 35.646484 C 5.0606869 32.523592 4 28.890107 4 25 C 4 13.390466 13.390466 4 25 4 z M 16.642578 13 C 16.001539 13 15.086045 13.23849 14.333984 14.048828 C 13.882268 14.535548 12 16.369511 12 19.59375 C 12 22.955271 14.331391 25.855848 14.613281 26.228516 L 14.615234 26.228516 L 14.615234 26.230469 C 14.588494 26.195329 14.973031 26.752191 15.486328 27.419922 C 15.999626 28.087653 16.717405 28.96464 17.619141 29.914062 C 19.422612 31.812909 21.958282 34.007419 25.105469 35.349609 C 26.554789 35.966779 27.698179 36.339417 28.564453 36.611328 C 30.169845 37.115426 31.632073 37.038799 32.730469 36.876953 C 33.55263 36.755876 34.456878 36.361114 35.351562 35.794922 C 36.246248 35.22873 37.12309 34.524722 37.509766 33.455078 C 37.786772 32.688244 37.927591 31.979598 37.978516 31.396484 C 38.003976 31.104927 38.007211 30.847602 37.988281 30.609375 C 37.969311 30.371148 37.989581 30.188664 37.767578 29.824219 C 37.302009 29.059804 36.774753 29.039853 36.224609 28.767578 C 35.918939 28.616297 35.048661 28.191329 34.175781 27.775391 C 33.303883 27.35992 32.54892 26.991953 32.083984 26.826172 C 31.790239 26.720488 31.431556 26.568352 30.914062 26.626953 C 30.396569 26.685553 29.88546 27.058933 29.587891 27.5 C 29.305837 27.918069 28.170387 29.258349 27.824219 29.652344 C 27.819619 29.649544 27.849659 29.663383 27.712891 29.595703 C 27.284761 29.383815 26.761157 29.203652 25.986328 28.794922 C 25.2115 28.386192 24.242255 27.782635 23.181641 26.847656 L 23.181641 26.845703 C 21.603029 25.455949 20.497272 23.711106 20.148438 23.125 C 20.171937 23.09704 20.145643 23.130901 20.195312 23.082031 L 20.197266 23.080078 C 20.553781 22.728924 20.869739 22.309521 21.136719 22.001953 C 21.515257 21.565866 21.68231 21.181437 21.863281 20.822266 C 22.223954 20.10644 22.02313 19.318742 21.814453 18.904297 L 21.814453 18.902344 C 21.828863 18.931014 21.701572 18.650157 21.564453 18.326172 C 21.426943 18.001263 21.251663 17.580039 21.064453 17.130859 C 20.690033 16.232501 20.272027 15.224912 20.023438 14.634766 L 20.023438 14.632812 C 19.730591 13.937684 19.334395 13.436908 18.816406 13.195312 C 18.298417 12.953717 17.840778 13.022402 17.822266 13.021484 L 17.820312 13.021484 C 17.450668 13.004432 17.045038 13 16.642578 13 z M 16.642578 15 C 17.028118 15 17.408214 15.004701 17.726562 15.019531 C 18.054056 15.035851 18.033687 15.037192 17.970703 15.007812 C 17.906713 14.977972 17.993533 14.968282 18.179688 15.410156 C 18.423098 15.98801 18.84317 16.999249 19.21875 17.900391 C 19.40654 18.350961 19.582292 18.773816 19.722656 19.105469 C 19.863021 19.437122 19.939077 19.622295 20.027344 19.798828 L 20.027344 19.800781 L 20.029297 19.802734 C 20.115837 19.973483 20.108185 19.864164 20.078125 19.923828 C 19.867096 20.342656 19.838461 20.445493 19.625 20.691406 C 19.29998 21.065838 18.968453 21.483404 18.792969 21.65625 C 18.639439 21.80707 18.36242 22.042032 18.189453 22.501953 C 18.016221 22.962578 18.097073 23.59457 18.375 24.066406 C 18.745032 24.6946 19.964406 26.679307 21.859375 28.347656 C 23.05276 29.399678 24.164563 30.095933 25.052734 30.564453 C 25.940906 31.032973 26.664301 31.306607 26.826172 31.386719 C 27.210549 31.576953 27.630655 31.72467 28.119141 31.666016 C 28.607627 31.607366 29.02878 31.310979 29.296875 31.007812 L 29.298828 31.005859 C 29.655629 30.601347 30.715848 29.390728 31.224609 28.644531 C 31.246169 28.652131 31.239109 28.646231 31.408203 28.707031 L 31.408203 28.708984 L 31.410156 28.708984 C 31.487356 28.736474 32.454286 29.169267 33.316406 29.580078 C 34.178526 29.990889 35.053561 30.417875 35.337891 30.558594 C 35.748225 30.761674 35.942113 30.893881 35.992188 30.894531 C 35.995572 30.982516 35.998992 31.07786 35.986328 31.222656 C 35.951258 31.624292 35.8439 32.180225 35.628906 32.775391 C 35.523582 33.066746 34.975018 33.667661 34.283203 34.105469 C 33.591388 34.543277 32.749338 34.852514 32.4375 34.898438 C 31.499896 35.036591 30.386672 35.087027 29.164062 34.703125 C 28.316336 34.437036 27.259305 34.092596 25.890625 33.509766 C 23.114812 32.325956 20.755591 30.311513 19.070312 28.537109 C 18.227674 27.649908 17.552562 26.824019 17.072266 26.199219 C 16.592866 25.575584 16.383528 25.251054 16.208984 25.021484 L 16.207031 25.019531 C 15.897202 24.609805 14 21.970851 14 19.59375 C 14 17.077989 15.168497 16.091436 15.800781 15.410156 C 16.132721 15.052495 16.495617 15 16.642578 15 z"
                        />
                    </svg>
                    <span class="leading-tight"> {{ __('WhatsApp') }} </span>
                </div>
                <svg id="arrow-whatsapp" class="w-4 h-4 transition-transform"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="submenu-whatsapp" class="submenu hidden flex-col border-s border-gray-300 dark:border-gray-600 ms-7 mt-1 ps-4">
                <a href="{{ route('user.marketing-bot.templates.index') }}" class="{{ activeMenu(route('user.marketing-bot.templates.index'))['class'] }} h-[40px] flex items-center text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-color-29 rounded-s-md px-3 font-medium">{{ __('Templates') }}</a>
                <a href="{{ route('user.marketing-bot.contacts', ['orderBy' => 'newest']) }}" class="{{ activeMenu(route('user.marketing-bot.contacts'))['class'] }} h-[40px] flex items-center text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-color-29 rounded-s-md px-3 font-medium">{{ __('Contacts') }}</a>
                <a href="{{ route('user.marketing-bot.segments', ['orderBy' => 'newest']) }}" class="{{ activeMenu(route('user.marketing-bot.segments'))['class'] }} h-[40px] flex items-center text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-color-29 rounded-s-md px-3 font-medium">{{ __('Segments') }}</a>
            </div>
            @endif
            <!-- End Whatsapp -->

            <!-- Start Telegram (with nested menu) -->
            @if($telegramEnabled)
            <button
                onclick="toggleMenu('submenu-telegram', this)"
                class="{{ activeSidebarMenu(route('user.marketing-bot.subscribers'), route('user.marketing-bot.groups'))['class'] }} menu-btn relative min-h-[48px] py-2 w-full flex items-center gap-3 pl-5 pr-4 hover:bg-white dark:hover:bg-color-47 transition duration-200 ease-out text-color-14 dark:text-white justify-between">
                <div class="flex items-center gap-3">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 50 50"
                        width="20px"
                        height="20px"
                    >
                        <path
                            fill="currentColor"
                            d="M 25 2 C 12.309288 2 2 12.309297 2 25 C 2 37.690703 12.309288 48 25 48 C 37.690712 48 48 37.690703 48 25 C 48 12.309297 37.690712 2 25 2 z M 25 4 C 36.609833 4 46 13.390175 46 25 C 46 36.609825 36.609833 46 25 46 C 13.390167 46 4 36.609825 4 25 C 4 13.390175 13.390167 4 25 4 z M 34.087891 14.035156 C 33.403891 14.035156 32.635328 14.193578 31.736328 14.517578 C 30.340328 15.020578 13.920734 21.992156 12.052734 22.785156 C 10.984734 23.239156 8.9960938 24.083656 8.9960938 26.097656 C 8.9960938 27.432656 9.7783594 28.3875 11.318359 28.9375 C 12.146359 29.2325 14.112906 29.828578 15.253906 30.142578 C 15.737906 30.275578 16.25225 30.34375 16.78125 30.34375 C 17.81625 30.34375 18.857828 30.085859 19.673828 29.630859 C 19.666828 29.798859 19.671406 29.968672 19.691406 30.138672 C 19.814406 31.188672 20.461875 32.17625 21.421875 32.78125 C 22.049875 33.17725 27.179312 36.614156 27.945312 37.160156 C 29.021313 37.929156 30.210813 38.335938 31.382812 38.335938 C 33.622813 38.335938 34.374328 36.023109 34.736328 34.912109 C 35.261328 33.299109 37.227219 20.182141 37.449219 17.869141 C 37.600219 16.284141 36.939641 14.978953 35.681641 14.376953 C 35.210641 14.149953 34.672891 14.035156 34.087891 14.035156 z M 34.087891 16.035156 C 34.362891 16.035156 34.608406 16.080641 34.816406 16.181641 C 35.289406 16.408641 35.530031 16.914688 35.457031 17.679688 C 35.215031 20.202687 33.253938 33.008969 32.835938 34.292969 C 32.477938 35.390969 32.100813 36.335938 31.382812 36.335938 C 30.664813 36.335938 29.880422 36.08425 29.107422 35.53125 C 28.334422 34.97925 23.201281 31.536891 22.488281 31.087891 C 21.863281 30.693891 21.201813 29.711719 22.132812 28.761719 C 22.899812 27.979719 28.717844 22.332938 29.214844 21.835938 C 29.584844 21.464938 29.411828 21.017578 29.048828 21.017578 C 28.923828 21.017578 28.774141 21.070266 28.619141 21.197266 C 28.011141 21.694266 19.534781 27.366266 18.800781 27.822266 C 18.314781 28.124266 17.56225 28.341797 16.78125 28.341797 C 16.44825 28.341797 16.111109 28.301891 15.787109 28.212891 C 14.659109 27.901891 12.750187 27.322734 11.992188 27.052734 C 11.263188 26.792734 10.998047 26.543656 10.998047 26.097656 C 10.998047 25.463656 11.892938 25.026 12.835938 24.625 C 13.831938 24.202 31.066062 16.883437 32.414062 16.398438 C 33.038062 16.172438 33.608891 16.035156 34.087891 16.035156 z"
                        />
                    </svg>
                    <span class="leading-tight"> {{ __('Telegram') }} </span>
                </div>
                <svg id="arrow-telegram" class="w-4 h-4 transition-transform"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="submenu-telegram" class="submenu hidden flex-col border-s border-gray-300 dark:border-gray-600 ms-7 mt-1 ps-4">
                <a href="{{ route('user.marketing-bot.subscribers') }}" class="{{ activeMenu(route('user.marketing-bot.subscribers'))['class'] }} h-[40px] flex items-center text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-color-29 rounded-s-md px-3 font-medium">{{ __('Subscribers') }}</a>
                <a href="{{ route('user.marketing-bot.groups') }}" class="{{ activeMenu(route('user.marketing-bot.groups'))['class'] }} h-[40px] flex items-center text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-color-29 rounded-s-md px-3 font-medium">{{ __('Groups') }}</a>
            </div>
            @endif
            <!-- End Telegram -->
            @if($whatsappEnabled || $telegramEnabled)
            <a
                class="{{ activeSidebarMenu(route('user.marketing-bot.settings'))['class'] }} relative group/item min-h-[48px] py-2 w-full flex items-center gap-2 pl-5 pr-4 hover:bg-white dark:hover:bg-color-47 transition duration-200 ease-out justify-start text-color-14 dark:text-white"
                href="{{ route('user.marketing-bot.settings') }}">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    height="20px"
                    width="20px"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                    />
                </svg>

                <span class="leading-tight"> {{ __('Settings') }} </span>
            </a>
            @endif
        </nav>
    </aside>

    <!-- Mobile menu button -->
    <button id="mobile-menu-btn" class="xl:hidden relative top-4 start-4 mb-1 bg-color-14 dark:bg-white text-white dark:text-color-14 h-6 w-6 flex items-center justify-center rounded-[4px] shadow-lg z-0" onclick="toggleSidebar(true)">
        <svg xmlns="http://www.w3.org/2000/svg" class="ltr:rotate-180 rtl:rotate-0" width="14" height="14" viewBox="0 0 14 14" fill="none"><g><path d="M4.96094 2.91699H7.58594L4.66927 7.00033L7.58594 11.0837H4.96094L2.04427 7.00033L4.96094 2.91699Z" fill="currentColor"></path><path d="M10.043 2.91699H12.668L9.7513 7.00033L12.668 11.0837H10.043L7.1263 7.00033L10.043 2.91699Z" fill="currentColor"></path></g><defs><clipPath id="clip0_12889_4648"><rect width="14" height="14" fill="white" transform="matrix(-1 0 0 1 14 0)"></rect></clipPath></defs></svg>
    </button>
</div>
