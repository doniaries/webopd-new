<div class="py-12 bg-gray-50 dark:bg-gray-900 transition-colors duration-200 min-h-screen relative">
    <!-- Content Loading Overlay -->
    <div wire:loading.flex wire:target="previousPage, nextPage, gotoPage" class="absolute inset-0 z-50 flex items-center justify-center bg-gray-50/50 dark:bg-gray-900/50 backdrop-blur-[1px] transition-all duration-300">
        <div class="flex flex-col items-center bg-white dark:bg-gray-800 p-4 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700">
            <svg class="animate-spin h-8 w-8 text-yellow-500 dark:text-yellow-400 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-xs font-semibold text-gray-600 dark:text-gray-300">Memuat Pengumuman...</span>
        </div>
    </div>

    <div wire:loading.class="opacity-50 pointer-events-none blur-sm" class="transition-all duration-200">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Pengumuman</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Informasi dan pengumuman terbaru</p>
            </div>

            <div class="space-y-6">
                @forelse($pengumuman as $item)
                <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <div class="h-12 w-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center text-yellow-600 dark:text-yellow-400">
                                    <i class="bi bi-megaphone-fill text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-xl font-bold mb-2">
                                    <a href="{{ route('pengumuman.show', $item->slug) }}" class="text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                        {{ $item->judul }}
                                    </a>
                                </h2>
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                                    <i class="bi bi-calendar3 mr-2"></i>
                                    {{ $item->published_at ? $item->published_at->format('d M Y') : '' }}
                                </div>
                                <p class="text-gray-600 dark:text-gray-300">
                                    {{ Str::limit(strip_tags($item->isi), 200) }}
                                </p>
                                <div class="mt-4">
                                    <a href="{{ route('pengumuman.show', $item->slug) }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">
                                        Baca Selengkapnya <i class="bi bi-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="h-16 w-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-bell-slash text-2xl text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Belum Ada Pengumuman</h3>
                    <p class="text-gray-500 dark:text-gray-400">Saat ini belum ada pengumuman yang dapat ditampilkan.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $pengumuman->links() }}
            </div>
        </div>
    </div>
</div>