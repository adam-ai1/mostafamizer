<div class="group-table table-content{{ isset($is_ajax) && $is_ajax ? '' : ' hidden' }}">
    <!-- Table -->
    <section
        class="rounded-xl bg-white dark:bg-color-3A border border-color-89/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead
                    class="bg-light-icon dark:bg-dark-icon text-color-14 dark:text-white"
                >
                    <tr>
                        <th
                            class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider"
                        >
                            {{ __('ID') }}
                        </th>
                        <th
                            class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider"
                        >
                            {{ __('Name') }}
                        </th>
                        <th
                            class="text-end font-semibold px-6 py-5 text-xs uppercase tracking-wider"
                        >
                            {{ __('Actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="bg-white dark:bg-color-3A divide-y divide-light-secondary/10 dark:divide-dark-secondary/10"
                >

                @forelse ($groups as $group)
                    <tr id="group-row-{{ $group->id }}"
                        class="border-t border-color-89/10 hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-purple-50/50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20">
                        <td class="px-6 py-3 text-color-89 font-semibold whitespace-nowrap">
                            #{{ $loop->index + 1 }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-color-14 dark:text-white">
                            {{ $group->name }}
                        </td>
                        <td class="px-6 py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <!-- Delete Button -->
                                <button
                                data-id="{{ $group->id }}"
                                data-target="modal1"
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
                                <p class="text-color-14 dark:text-white text-center font-medium font-Figtree text-20 mt-6">{{ __('No groups found')}}</p>
                                <p class="text-center font-medium text-color-89 text-15 px-5 py-3 font-Figtree mt-3 md:w-[450px] mx-auto">{{ __('Looks like you did not add any groups yet.') }}</p>
                            </td>
                        </tr>
                    @endforelse

                    <!-- Start Delete Modal  -->
                    <div
                        id="modal1"
                        class="sweet-modal fixed inset-0 hidden bg-color-14/50 backdrop-blur-[4px] flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 p-4"
                    >
                        <!-- Modal Box -->
                        <div
                            class="modalBox max-w-[600px] min-w-[300px] bg-white dark:bg-color-3A rounded-xl py-7 relative transform transition-all duration-300 scale-0 opacity-0"
                        >
                            <div class="px-7">
                                <h5
                                    class="max-w-[300px] text-xl text-color-14 dark:text-white text-center font-medium mb-0.5"
                                >
                                    {{ __('Are you sure you want to delete this item?') }}
                                </h5>
                                <div class="flex justify-center gap-3 mt-6">
                                    <button
                                        class="delete-group w-full flex items-center justify-center rounded-[6px] text-sm text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                                    >
                                        <span>{{ __('Delete') }}</span>
                                        <svg class="loader animate-spin h-5 w-5 ml-2 hidden" xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 72 72" fill="none">
                                            <mask id="path-1-inside-1_1032_3036" fill="white">
                                                <path d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z"></path>
                                            </mask>
                                            <path d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z" stroke="url(#paint0_linear_1032_3036)" stroke-width="24" mask="url(#path-1-inside-1_1032_3036)"></path>
                                            <defs>
                                                <linearGradient id="paint0_linear_1032_3036" x1="46.8123" y1="63.1382" x2="21.8195" y2="6.73779" gradientUnits="userSpaceOnUse">
                                                    <stop offset="0" stop-color="#E60C84"></stop>
                                                    <stop offset="1" stop-color="#FFCF4B"></stop>
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </button>
                                    <button
                                        class="closeModalBtn w-full flex items-center justify-center rounded-[6px] text-sm text-center bg-color-14 hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                                    >
                                        <span>{{ __('Cancel') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete Modal  -->
                </tbody>
            </table>
        </div>
    </section>

    <!-- Pagination -->
    {{ $groups->onEachSide(1)->links('site.layout.partials.pagination') }}

    <!-- End Table -->
</div>