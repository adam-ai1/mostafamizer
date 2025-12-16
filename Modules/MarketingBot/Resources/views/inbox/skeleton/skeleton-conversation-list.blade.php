@for($i = 0; $i < 15; $i++)
    <div class="inbox-conversation-row-skeleton h-full max-h-[72px] w-full py-[14px] rounded-lg bg-white dark:bg-color-33 border border-white dark:border-color-47 animate-pulse">
        <div class="flex gap-3 px-3">
            <!-- Skeleton Icon -->
            <div class="shrink-0 h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700"></div>

            <div class="w-full min-w-0">
                <div class="w-full flex items-center gap-[6px] justify-between">
                    <div class="flex items-center gap-[6px] min-w-0">
                        <div class="flex items-center gap-1">
                            <!-- Skeleton Channel Name -->
                            <div class="h-4 w-16 bg-gray-200 dark:bg-gray-700 rounded"></div>
                        </div>
                    </div>
                    <!-- Skeleton Time -->
                    <div class="h-3 w-12 bg-gray-200 dark:bg-gray-700 rounded flex-shrink-0"></div>
                </div>
                <!-- Skeleton Title -->
                <div class="mt-1 mb-0.5 h-4 w-32 bg-gray-200 dark:bg-gray-700 rounded"></div>
            </div>
        </div>
    </div>
@endfor