<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 h-full animate-pulse">
        <div class="flex items-center justify-between mb-6">
            <div class="h-6 w-48 bg-gray-200 dark:bg-gray-700 rounded"></div>
            <div class="h-4 w-20 bg-gray-200 dark:bg-gray-700 rounded"></div>
        </div>

        <div class="space-y-4">
            @for ($i = 0; $i < 5; $i++)
                <div class="flex items-center space-x-4 py-3 border-b border-gray-100 dark:border-gray-800">
                <div class="w-24 h-4 bg-gray-200 dark:bg-gray-700 rounded flex-shrink-0"></div>
                <div class="flex-1 space-y-2">
                    <div class="h-4 w-3/4 bg-gray-200 dark:bg-gray-700 rounded"></div>
                    <div class="h-3 w-1/2 bg-gray-200 dark:bg-gray-700 rounded"></div>
                </div>
                <div class="w-20 h-6 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
        </div>
        @endfor
    </div>
</div>
</div>