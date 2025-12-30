<div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <x-page-header title="Dokumen & Download" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search and Filter -->
        <div class="mb-8 flex flex-col md:flex-row gap-4 items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="w-full md:w-96 relative">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari dokumen..."
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="bi bi-search text-gray-400"></i>
                </div>
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan {{ $dokumens->count() }} dari {{ $dokumens->total() }} dokumen
            </div>
        </div>

        <!-- Document List -->
        <div class="space-y-4">
            @forelse($dokumens as $dokumen)
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 dark:border-gray-700 group">
                <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                    <!-- Icon/Cover -->
                    <div class="flex-shrink-0">
                        @if($dokumen->cover)
                        <img src="{{ asset('storage/' . $dokumen->cover) }}" alt="{{ $dokumen->nama_dokumen }}" class="w-16 h-20 object-cover rounded-lg shadow-sm">
                        @else
                        <div class="w-16 h-20 bg-blue-50 dark:bg-blue-900/30 rounded-lg flex items-center justify-center text-blue-500 dark:text-blue-400">
                            <i class="bi bi-file-earmark-text text-3xl"></i>
                        </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="flex-grow min-w-0">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            {{ $dokumen->nama_dokumen }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                            {{ $dokumen->deskripsi }}
                        </p>
                        <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                            <span class="flex items-center gap-1.5 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                <i class="bi bi-calendar3"></i>
                                {{ $dokumen->tahun_terbit ? $dokumen->tahun_terbit->format('Y') : '-' }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i class="bi bi-download"></i>
                                {{ number_format($dokumen->downloads) }} kali diunduh
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i class="bi bi-eye"></i>
                                {{ number_format($dokumen->views) }} kali dilihat
                            </span>
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="flex-shrink-0 mt-4 md:mt-0 w-full md:w-auto">
                        <button wire:click="download({{ $dokumen->id }})"
                            wire:loading.attr="disabled"
                            wire:target="download({{ $dokumen->id }})"
                            class="w-full md:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 disabled:opacity-75 disabled:cursor-wait text-white text-sm font-medium rounded-lg transition-colors shadow-sm shadow-blue-200 dark:shadow-none min-w-[140px]">

                            <!-- Loading Spinner -->
                            <svg wire:loading wire:target="download({{ $dokumen->id }})" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>

                            <!-- Default Icon -->
                            <i wire:loading.remove wire:target="download({{ $dokumen->id }})" class="bi bi-cloud-arrow-down text-lg"></i>

                            <!-- Text -->
                            <span wire:loading.remove wire:target="download({{ $dokumen->id }})">Download</span>
                            <span wire:loading wire:target="download({{ $dokumen->id }})">Proses...</span>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                    <i class="bi bi-folder2-open text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Tidak ada dokumen ditemukan</h3>
                <p class="text-gray-500 dark:text-gray-400">Cobalah kata kunci pencarian yang lain.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $dokumens->links() }}
        </div>
    </div>
</div>