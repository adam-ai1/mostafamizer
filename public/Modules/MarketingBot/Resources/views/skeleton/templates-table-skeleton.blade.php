<div class="table-skeleton hidden">
    <!-- Table -->
    <section class="rounded-xl bg-white dark:bg-color-3A border border-color-89/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-light-icon dark:bg-dark-icon text-color-14 dark:text-white">
                    <tr>
                        <th class="min-w-[260px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                        <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-20 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                        <th class="min-w-[140px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                        <th class="min-w-[140px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-12 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                        <th class="min-w-[140px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-20 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                        <th class="text-center font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-color-3A divide-y divide-light-secondary/10 dark:divide-dark-secondary/10">
                    @for($i = 0; $i < 8; $i++)
                        <tr class="border-t border-color-89/10">
                            <td class="px-6 py-5">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-gray-200 dark:bg-gray-700 rounded-full animate-pulse mr-3"></div>
                                    <div class="h-4 w-32 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-color-14 dark:text-white">
                                <div class="h-4 w-24 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                            </td>
                            <td class="px-6 py-5 text-color-14 dark:text-white">
                                <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                            </td>
                            <td class="px-6 py-5 text-color-14 dark:text-white">
                                <div class="h-4 w-20 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                            </td>
                            <td class="px-6 py-5 text-color-14 dark:text-white">
                                <div class="h-4 w-18 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <div class="h-8 w-8 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                                    <div class="h-8 w-8 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </section>
</div>
