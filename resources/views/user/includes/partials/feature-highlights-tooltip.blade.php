<div class="flex items-center gap-1.5">
    <span class="text-base text-gray-900 dark:text-white font-semibold">{{ __('Feature Highlights') }}</span>
    <div class="relative">
        <span class="inline-block group relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 cursor-pointer" fill="none" viewBox="0 0 20 20">
                <circle cx="10" cy="10" r="9" stroke="#bcbcbc" stroke-width="2" fill="none"/>
                <path d="M10 7.5a1 1 0 100-2 1 1 0 000 2zM10 9.5v4" stroke="#bcbcbc" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <div class="absolute left-1/2 -translate-x-1/2 top-full pt-2 w-64 z-50 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-opacity duration-200">
                <div class="bg-white border border-gray-200 rounded-xl shadow-2xl max-h-56 overflow-y-auto p-4 flex flex-col gap-2">
                    <div class="mb-3">
                        <span class="block text-[13px] text-gray-500 font-semibold leading-tight">
                            {{ __('What’s included in your plan:') }}
                        </span>
                    </div>
                    <ul class="flex flex-col gap-2">
                        @foreach($supportedFeatures ?? [] as $supportedFeature)
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
