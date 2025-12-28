<div class="space-y-6 animate-pulse">
    @for ($i = 0; $i < 4; $i++)
        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700">
        <div class="p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0 mr-4">
                    <div class="h-12 w-12 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                </div>
                <div class="flex-1 space-y-3">
                    <div class="h-6 w-3/4 bg-gray-200 dark:bg-gray-700 rounded"></div>
                    <div class="h-4 w-40 bg-gray-200 dark:bg-gray-700 rounded"></div>
                    <div class="space-y-2 pt-2">
                        <div class="h-4 w-full bg-gray-200 dark:bg-gray-700 rounded"></div>
                        <div class="h-4 w-full bg-gray-200 dark:bg-gray-700 rounded"></div>
                        <div class="h-4 w-2/3 bg-gray-200 dark:bg-gray-700 rounded"></div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endfor
</div>