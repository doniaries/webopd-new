<div class="bg-gray-50 dark:bg-zinc-900 min-h-screen">
    @push('title', $pageTitle)
    @push('meta')
    <meta name="description" content="{{ $pageDescription }}">
    @endpush

    <x-page-header title="Struktur Organisasi" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Header Section --}}
        <div class="text-center mb-16">
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                Dinas Komunikasi dan Informatika Kabupaten Sijunjung
            </p>
        </div>

        {{-- Table Container --}}
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-zinc-700/50 text-xs uppercase font-semibold text-gray-900 dark:text-white">
                        <tr>
                            <th scope="col" class="px-6 py-4">No</th>
                            <th scope="col" class="px-6 py-4">Nama Bagian / Bidang</th>
                            <th scope="col" class="px-6 py-4">Pimpinan</th>
                            <th scope="col" class="px-6 py-4">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($strukturOrganisasi as $index => $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/30 transition-colors">
                            <td class="px-6 py-4 font-medium">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($item->pimpinan)
                                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 text-xs font-bold">
                                        {{ substr($item->pimpinan, 0, 1) }}
                                    </div>
                                    <span class="font-medium">{{ $item->pimpinan }}</span>
                                    @else
                                    <span class="text-gray-400">-</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                                {{ $item->description ?? '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="bi bi-inbox text-3xl"></i>
                                    <p>Belum ada data struktur organisasi</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>