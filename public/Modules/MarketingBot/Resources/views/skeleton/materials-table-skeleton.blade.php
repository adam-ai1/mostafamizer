<div id="materials-table-skeleton" class="table-skeleton hidden">
    <section class="rounded-xl bg-white dark:bg-color-3A border border-color-89/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-color-DF dark:bg-color-47 text-color-14 dark:text-white">
                    <tr>
                        <th class="min-w-[260px] text-start font-semibold pl-3 pr-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                        <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-12 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                        <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-8 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                        <th class="min-w-[140px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-20 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                        <th class="min-w-[140px] text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-12 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                        <th class="text-center font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                            <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-color-3A divide-y divide-light-secondary/10 dark:divide-dark-secondary/10">
                    @for($i = 0; $i < 8; $i++)
                        <tr class="border-t border-color-89/10">
                            <td class="pl-3 pr-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="h-4 w-32 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="h-4 w-12 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="h-4 w-20 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="h-8 w-8 bg-gray-200 dark:bg-gray-700 rounded mx-auto animate-pulse"></div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </section>
</div>
