<div class="bg-gray-50 dark:bg-zinc-900 min-h-screen">
    @push('title', $pageTitle)
    @push('meta')
    <meta name="description" content="{{ $pageDescription }}">
    @endpush

    <x-page-header title="Sambutan Pimpinan" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="container mx-auto px-4 py-8">
            @if($sambutan)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        @if($pengaturan?->foto_pimpinan)
                        <div class="w-full md:w-1/3 flex-shrink-0">
                            <img src="{{ asset('storage/' . $pengaturan->foto_pimpinan) }}"
                                alt="{{ $pengaturan->kepala_instansi }}"
                                class="w-full h-auto rounded-lg shadow-md object-cover">
                            <div class="mt-4 text-center">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $pengaturan->kepala_instansi }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">{{ $pengaturan->jabatan_pimpinan }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="w-full md:w-2/3">
                            <h2 class="text-2xl md:text-3xl font-bold mb-6 text-gray-900 dark:text-white border-b pb-4">
                                {{ $sambutan->judul }}
                            </h2>
                            <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                                {!! $sambutan->isi_sambutan !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8 text-center">
                <p class="text-gray-600 dark:text-gray-400">Belum ada sambutan pimpinan.</p>
            </div>
            @endif
        </div>
    </div>
</div>