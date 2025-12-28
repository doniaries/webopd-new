<div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 h-full animate-pulse">
    <div class="flex items-center justify-between mb-6">
        <div class="h-6 w-40 bg-gray-200 dark:bg-gray-700 rounded"></div>
        <div class="h-4 w-20 bg-gray-200 dark:bg-gray-700 rounded"></div>
    </div>

    <div class="space-y-6">
        @for ($i = 0; $i < 4; $i++)
            <div class="flex items-start space-x-4">
            <div class="h-10 w-10 bg-gray-200 dark:bg-gray-700 rounded-full flex-shrink-0"></div>
            <div class="flex-1 space-y-2">
                <div class="h-4 w-full bg-gray-200 dark:bg-gray-700 rounded"></div>
                <div class="h-3 w-5/6 bg-gray-200 dark:bg-gray-700 rounded"></div>
            </div>
    </div>
    @endfor
</div>
</div>