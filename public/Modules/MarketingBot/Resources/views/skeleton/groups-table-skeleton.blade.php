<div class="group-table table-skeleton hidden">
    <!-- Table -->
    <section class="rounded-xl bg-white dark:bg-color-3A border border-color-89/10 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-light-icon dark:bg-dark-icon text-color-14 dark:text-white">
                        <tr>
                            <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                                <div class="h-4 w-8 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                            </th>
                            <th class="text-start font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                                <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                            </th>
                            <th class="text-end font-semibold px-6 py-5 text-xs uppercase tracking-wider">
                                <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-color-3A divide-y divide-light-secondary/10 dark:divide-dark-secondary/10">
                        @for($i = 0; $i < 8; $i++)
                            <tr class="border-t border-color-89/10">
                                <td class="px-6 py-3 text-color-89 font-semibold whitespace-nowrap">
                                    <div class="h-4 w-6 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 bg-gray-200 dark:bg-gray-700 rounded-full animate-pulse"></div>
                                        <div class="h-4 w-24 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
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
</div>
