<div class="space-y-12">
    @push('title', $pageTitle)
    @push('meta')
    <meta name="description" content="{{ $pageDescription }}">
    @endpush

    {{-- Slider Section --}}
    <livewire:slider />

    {{-- Berita Section --}}
    <section id="berita-informasi" class="bg-white dark:bg-zinc-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                {{-- Berita Terbaru Column --}}
                <div class="lg:col-span-3">
                    <div class="flex items-center mb-6">
                        <div class="h-8 w-1 bg-red-600 rounded-full mr-3"></div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Berita Terkini</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach ($recentPosts as $post)
                        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 h-full flex flex-col group">
                            <a href="{{ route('berita.show', $post->slug) }}" class="block relative aspect-video overflow-hidden">
                                @if ($post->foto_utama_url && !str_contains($post->foto_utama_url, 'placeholder'))
                                <img src="{{ $post->foto_utama_url }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                @else
                                <div class="w-full h-full bg-gray-200 dark:bg-zinc-700 flex items-center justify-center">
                                    <i class="bi bi-image text-4xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                                @endif

                                <div class="absolute bottom-0 left-0 p-3 w-full bg-gradient-to-t from-black/80 to-transparent">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-blue-600 rounded-md">
                                        {{ $post->tags->first()->name ?? 'Berita' }}
                                    </span>
                                </div>
                            </a>

                            <div class="p-5 flex-1 flex flex-col">
                                <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-3 space-x-3">
                                    <span class="flex items-center">
                                        <i class="bi bi-calendar3 mr-1"></i>
                                        {{ $post->created_at->format('d M Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="bi bi-person-fill mr-1"></i>
                                        {{ $post->user->name ?? 'Admin' }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    <a href="{{ route('berita.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($post->content), 100) }}
                                </p>

                                <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <span class="flex items-center">
                                        <i class="bi bi-eye mr-1"></i> {{ $post->views ?? 0 }} Dilihat
                                    </span>
                                    <a href="{{ route('berita.show', $post->slug) }}" class="text-blue-600 dark:text-blue-400 font-medium hover:underline">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('berita.index') }}" class="inline-flex items-center px-6 py-2.5 border border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400 font-medium rounded-full hover:bg-blue-600 hover:text-white dark:hover:bg-blue-500 dark:hover:text-white transition-all duration-300">
                            Lihat Semua Berita <i class="bi bi-arrow-right-short ml-2 text-xl"></i>
                        </a>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 space-y-8">
                    {{-- Banner & Visitor Stats --}}
                    <div class="space-y-6">
                        <livewire:banner />
                        <livewire:visitor-stats />
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Agenda & Pengumuman Section --}}
    <section id="agenda-pengumuman" class="py-12 bg-blue-50 dark:bg-zinc-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Agenda Section --}}
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 h-full">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="h-6 w-1 bg-blue-600 rounded-full mr-3"></div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Agenda Kegiatan</h2>
                            </div>
                            <a href="{{ route('agenda.index') }}" class="text-sm text-blue-600 dark:text-blue-400 font-medium hover:underline flex items-center">
                                Lihat Semua <i class="bi bi-arrow-right ml-1"></i>
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-zinc-800 dark:text-gray-300 border-b border-gray-100 dark:border-gray-700">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 rounded-tl-lg">Tanggal</th>
                                        <th scope="col" class="px-4 py-3">Kegiatan</th>
                                        <th scope="col" class="px-4 py-3 text-center">Status</th>
                                        <th scope="col" class="px-4 py-3 text-center">Waktu</th>
                                        <th scope="col" class="px-4 py-3 text-center rounded-tr-lg">Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @forelse($agendas as $agenda)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition-colors">
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="font-medium text-gray-900 dark:text-white">
                                                {{ \Carbon\Carbon::parse($agenda->dari_tanggal)->translatedFormat('d M Y') }}
                                            </div>
                                            @if ($agenda->sampai_tanggal && $agenda->sampai_tanggal != $agenda->dari_tanggal)
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                s.d. {{ \Carbon\Carbon::parse($agenda->sampai_tanggal)->translatedFormat('d M Y') }}
                                            </div>
                                            @else
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                {{ \Carbon\Carbon::parse($agenda->dari_tanggal)->diffForHumans() }}
                                            </div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="font-medium text-gray-900 dark:text-white line-clamp-2 mb-1">
                                                {{ $agenda->nama_agenda }}
                                            </div>
                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                <i class="bi bi-geo-alt text-blue-500 mr-1.5"></i>
                                                <span class="truncate max-w-[200px]">{{ $agenda->tempat ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-center whitespace-nowrap">
                                            @php
                                            $status = $agenda->status ?? 'Mendatang';
                                            $badgeClass = match ($status) {
                                            'Berlangsung' => 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300',
                                            'Selesai' => 'bg-gray-100 text-gray-800 dark:bg-gray-700/50 dark:text-gray-300',
                                            default => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300',
                                            };
                                            @endphp
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                                {{ $status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-center whitespace-nowrap text-gray-600 dark:text-gray-300">
                                            {{ $agenda->waktu_mulai ? \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') : '-' }}
                                            -
                                            {{ $agenda->waktu_selesai ? \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') : '-' }}
                                        </td>
                                        <td class="px-4 py-4 text-center whitespace-nowrap">
                                            <a href="{{ route('agenda.show', $agenda->slug) }}" class="inline-flex items-center justify-center p-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                            <i class="bi bi-calendar-x text-3xl mb-3 block opacity-50"></i>
                                            Belum ada agenda kegiatan mendatang
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Pengumuman Section --}}
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 h-full flex flex-col">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="h-6 w-1 bg-yellow-400 rounded-full mr-3"></div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Pengumuman</h2>
                            </div>
                            <a href="{{ route('pengumuman.index') }}" class="text-sm text-blue-600 dark:text-blue-400 font-medium hover:underline flex items-center">
                                Lihat Semua <i class="bi bi-arrow-right ml-1"></i>
                            </a>
                        </div>

                        <div class="flex-1 space-y-4">
                            @forelse($pengumuman as $item)
                            <div class="group relative bg-yellow-50 dark:bg-yellow-900/10 rounded-lg p-4 border border-yellow-100 dark:border-yellow-900/30 hover:shadow-md transition-all duration-300">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center text-yellow-600 dark:text-yellow-400 group-hover:scale-110 transition-transform duration-300">
                                            <i class="bi bi-megaphone-fill"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                                <i class="bi bi-clock mr-1"></i> {{ $item->published_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <h3 class="font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                            <a href="{{ route('pengumuman.show', $item->slug) }}" class="before:absolute before:inset-0">
                                                {{ $item->judul }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2 mb-3">
                                            {{ Str::limit(strip_tags($item->isi), 80) }}
                                        </p>
                                        <div class="text-xs font-semibold text-yellow-600 dark:text-yellow-400 group-hover:translate-x-1 transition-transform inline-flex items-center">
                                            Baca Selengkapnya <i class="bi bi-arrow-right ml-1"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-10 px-4 bg-gray-50 dark:bg-zinc-800/50 rounded-lg border border-dashed border-gray-200 dark:border-gray-700">
                                <div class="h-16 w-16 bg-gray-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="bi bi-bell-slash text-2xl text-gray-400"></i>
                                </div>
                                <h4 class="text-gray-900 dark:text-white font-medium mb-1">Belum Ada Pengumuman</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada pengumuman yang tersedia saat ini.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- External Links Section --}}
    <section id="external-links" class="pb-12 bg-white dark:bg-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:external-links />
        </div>
    </section>
</div>