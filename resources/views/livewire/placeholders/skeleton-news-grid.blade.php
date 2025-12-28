<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-pulse">
        @for ($i = 0; $i < 6; $i++)
            <div class="bg-white dark:bg-zinc-800 rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700 h-full flex flex-col">
            <div class="aspect-video bg-gray-200 dark:bg-gray-700 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent translate-x-[-100%] animate-[shimmer_2s_infinite]"></div>
            </div>
            <div class="p-5 flex-1 flex flex-col space-y-4">
                <div class="h-4 w-1/3 bg-gray-200 dark:bg-gray-700 rounded"></div>
                <div class="h-6 w-full bg-gray-200 dark:bg-gray-700 rounded"></div>
                <div class="h-4 w-full bg-gray-200 dark:bg-gray-700 rounded"></div>
                <div class="h-4 w-2/3 bg-gray-200 dark:bg-gray-700 rounded"></div>
                <div class="mt-auto pt-4 flex justify-between items-center">
                    <div class="h-3 w-16 bg-gray-200 dark:bg-gray-700 rounded"></div>
                    <div class="h-3 w-20 bg-gray-200 dark:bg-gray-700 rounded"></div>
                </div>
            </div>
    </div>
    @endfor
</div>
</div>