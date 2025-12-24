<div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
        <i class="bi bi-graph-up text-green-600 mr-2"></i> Statistik Pengunjung
    </h3>

    <div class="grid grid-cols-2 gap-4">
        {{-- Hari Ini --}}
        <div class="p-3 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800/50">
            <div class="text-xs text-green-600 dark:text-green-400 font-medium mb-1">Hari Ini</div>
            <div class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($today ?? 0) }}</div>
        </div>

        {{-- Bulan Ini --}}
        <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800/50">
            <div class="text-xs text-blue-600 dark:text-blue-400 font-medium mb-1">Bulan Ini</div>
            <div class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($month ?? 0) }}</div>
        </div>

        {{-- Online --}}
        <div class="p-3 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-100 dark:border-yellow-800/50">
            <div class="text-xs text-yellow-600 dark:text-yellow-400 font-medium mb-1 flex items-center">
                <span class="relative flex h-2 w-2 mr-1.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                </span>
                Online
            </div>
            <div class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($online ?? 0) }}</div>
        </div>

        {{-- IP --}}
        <div class="p-3 rounded-lg bg-gray-50 dark:bg-zinc-700/50 border border-gray-100 dark:border-gray-600/50">
            <div class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">IP Anda</div>
            <div class="text-sm font-bold text-gray-900 dark:text-white truncate" title="{{ $ip }}">
                {{ $ip }}
            </div>
        </div>
    </div>
</div>