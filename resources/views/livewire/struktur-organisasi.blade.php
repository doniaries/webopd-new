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

        {{-- Org Chart Container --}}
        <div class="relative overflow-x-auto pb-12">
            <div class="min-w-[1000px] flex flex-col items-center">

                {{-- Level 1: Kepala Dinas --}}
                @if($kepalaDinas)
                <div class="flex justify-center mb-12 relative z-10">
                    <div class="w-64 bg-white dark:bg-zinc-800 rounded-xl shadow-lg border-l-4 border-blue-600 p-6 text-center transform hover:-translate-y-1 transition-transform duration-300">
                        <div class="w-20 h-20 mx-auto bg-gray-200 dark:bg-zinc-700 rounded-full mb-4 overflow-hidden border-2 border-white dark:border-zinc-600 shadow-sm">
                            <img src="{{ $kepalaDinas->image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($kepalaDinas->pimpinan).'&background=0D8ABC&color=fff' }}"
                                alt="{{ $kepalaDinas->pimpinan }}"
                                class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-bold text-gray-900 dark:text-white text-lg mb-1">{{ $kepalaDinas->name }}</h3>
                        <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">{{ $kepalaDinas->pimpinan }}</p>
                    </div>
                    {{-- Connector to Level 2 --}}
                    <div class="absolute -bottom-12 left-1/2 w-0.5 h-12 bg-gray-300 dark:bg-gray-600"></div>
                </div>
                @endif

                {{-- Level 2: Sekretariat & Jabatan Fungsional (Placeholder) --}}
                <div class="flex justify-center gap-16 mb-12 relative w-full">
                    {{-- Horizontal Connector Line --}}
                    <div class="absolute -top-12 left-1/2 w-0.5 h-12 bg-gray-300 dark:bg-gray-600"></div>
                    <!-- Removing full width horizontal line for now, relying on vertical connections -->

                    {{-- Sekretariat Group --}}
                    @if($sekretariat)
                    <div class="flex flex-col items-center relative">
                        {{-- Connection Line from Top --}}
                        <div class="h-8 w-px bg-gray-300 dark:bg-gray-600 absolute -top-8 left-1/2"></div>

                        {{-- Connector to Right (Simulating Hierarchy) --}}
                        <div class="absolute -top-8 left-1/2 w-[350px] h-px bg-gray-300 dark:bg-gray-600"></div>
                        <div class="absolute -top-8 right-0 h-8 w-px bg-gray-300 dark:bg-gray-600"></div>


                        <div class="w-60 bg-white dark:bg-zinc-800 rounded-xl shadow-md border-l-4 border-green-500 p-5 text-center mb-8 relative z-10">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-1">{{ $sekretariat->name }}</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $sekretariat->pimpinan }}</p>
                            {{-- Connector to Sub Bagian --}}
                            <div class="absolute -bottom-8 left-1/2 w-px h-8 bg-gray-300 dark:bg-gray-600"></div>
                        </div>

                        {{-- Sub Bagian Tata Usaha --}}
                        @if($subBagianTataUsaha)
                        <div class="w-56 bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 text-center">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 text-sm mb-1">{{ $subBagianTataUsaha->name }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $subBagianTataUsaha->pimpinan }}</p>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                {{-- Level 3: Bidang-Bidang --}}
                <div class="grid grid-cols-4 gap-6 mb-16 relative w-full px-4">
                    {{-- Central Connector --}}
                    <div class="absolute -top-16 left-1/2 w-px h-16 bg-gray-300 dark:bg-gray-600 transform -translate-x-1/2"></div>
                    <div class="absolute -top-0 left-[12%] right-[12%] h-px bg-gray-300 dark:bg-gray-600"></div>

                    @foreach($bidang as $item)
                    <div class="flex flex-col items-center relative pt-8">
                        {{-- Connector to Horizontal Line --}}
                        <div class="absolute top-0 left-1/2 w-px h-8 bg-gray-300 dark:bg-gray-600"></div>

                        <div class="w-full bg-white dark:bg-zinc-800 rounded-xl shadow-md border-t-4 border-yellow-500 p-5 text-center h-full hover:shadow-lg transition-shadow duration-300">
                            <div class="mb-3">
                                <div class="w-12 h-12 mx-auto bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center text-yellow-600 dark:text-yellow-400">
                                    @if($item->image)
                                    <img src="{{ $item->image_url }}" class="w-8 h-8 object-contain">
                                    @else
                                    <i class="bi bi-diagram-3-fill text-xl"></i>
                                    @endif
                                </div>
                            </div>
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm mb-2 min-h-[40px] flex items-center justify-center">{{ $item->name }}</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2 min-h-[32px]">{{ $item->pimpinan }}</p>
                            <p class="text-[10px] text-gray-400 dark:text-gray-500 line-clamp-3 leading-relaxed">{{ $item->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Level 4: UPTD --}}
                @if($uptd)
                <div class="flex flex-col items-center relative">
                    {{-- Connector from Bidang Level --}}
                    <div class="h-12 w-px bg-gray-300 dark:bg-gray-600 mb-0"></div>

                    <div class="w-72 bg-white dark:bg-zinc-800 rounded-xl shadow-md border-l-4 border-purple-500 p-5 text-center mb-8 relative z-10">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-1">{{ $uptd->name }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{ $uptd->pimpinan }}</p>
                        <p class="text-[10px] text-gray-400 dark:text-gray-500">{{ $uptd->description }}</p>

                        {{-- Connector to Sub Bagian UPTD --}}
                        @if($subBagianUptd)
                        <div class="absolute -bottom-8 left-1/2 w-px h-8 bg-gray-300 dark:bg-gray-600"></div>
                        @endif
                    </div>

                    @if($subBagianUptd)
                    <div class="w-64 bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 text-center">
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 text-sm mb-1">{{ $subBagianUptd->name }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $subBagianUptd->pimpinan }}</p>
                    </div>
                    @endif
                </div>
                @endif

            </div>
        </div>

    </div>
</div>