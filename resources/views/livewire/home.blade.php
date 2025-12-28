<div class="space-y-12">
    @push('title', $pageTitle)
    @push('meta')
    <meta name="description" content="{{ $pageDescription }}">
    @endpush

    {{-- Slider Section with Popular Posts Overlay --}}
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
                                @if ($post->foto_utama)
                                <img src="{{ asset('storage/' . $post->foto_utama) }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                    onerror="this.onerror=null; this.src='https://placehold.co/600x400/e2e8f0/64748b?text=No+Image';">
                                @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 dark:from-zinc-700 dark:to-zinc-800 flex items-center justify-center">
                                    <i class="bi bi-image text-4xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                                @endif

                                <div class="absolute bottom-0 left-0 p-3 w-full bg-gradient-to-t from-black/80 to-transparent">
                                    @php
                                    $tagName = $post->tags->first()->name ?? 'Berita';
                                    $colors = [
                                    'bg-blue-600',
                                    'bg-red-600',
                                    'bg-green-600',
                                    'bg-yellow-600',
                                    'bg-purple-600',
                                    'bg-pink-600',
                                    'bg-indigo-600',
                                    'bg-teal-600',
                                    'bg-orange-600',
                                    'bg-cyan-600',
                                    ];
                                    // Generate a consistent index based on the tag name string
                                    $colorIndex = crc32($tagName) % count($colors);
                                    $bgClass = $colors[$colorIndex];
                                    @endphp
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-white {{ $bgClass }} rounded-md shadow-sm">
                                        {{ $tagName }}
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
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Infografis Section --}}
    @if($infografis->count() > 0)
    <section id="infografis" class="relative py-16 overflow-hidden bg-gray-900 border-t border-gray-800">
        {{-- Blurred Background --}}
        <div class="absolute inset-0 z-0 opacity-30 select-none pointer-events-none" aria-hidden="true">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-gray-900 z-10"></div>
            <div x-data="{ activeImage: '' }"
                x-effect="activeImage = '{{ asset('storage/' . $infografis[0]->gambar) }}'"
                @infografis-change.window="activeImage = $event.detail.image"
                class="w-full h-full">
                <img :src="activeImage" class="w-full h-full object-cover filter blur-3xl transition-opacity duration-1000">
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-data="{
                activeSlide: 0,
                slides: {{ $infografis->map(fn($i) => ['id' => $i->id, 'image' => asset('storage/' . $i->gambar), 'title' => $i->judul]) }},
                totalSlides: {{ $infografis->count() }},
                modalOpen: false,
                previewImage: '',
                autoplayInterval: null,
                
                init() {
                   this.startAutoplay();
                   this.$watch('activeSlide', value => {
                       this.$dispatch('infografis-change', { image: this.slides[value].image });
                   });
                },
                startAutoplay() {
                    this.stopAutoplay(); // Clear any existing interval first
                    if (this.totalSlides > 1) {
                        this.autoplayInterval = setInterval(() => {
                            this.next();
                        }, 5000);
                    }
                },
                stopAutoplay() {
                    clearInterval(this.autoplayInterval);
                },
                next() {
                    this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
                },
                prev() {
                    this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
                },
                getSlideClass(index) {
                    if (index === this.activeSlide) return 'z-20 scale-100 opacity-100 translate-x-0';
                    
                    let prev = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
                    let next = (this.activeSlide + 1) % this.totalSlides;
                    
                    // Show previous slide on left
                    if (index === prev) return 'z-10 scale-90 opacity-60 -translate-x-[60%] cursor-pointer';
                    // Show next slide on right
                    if (index === next) return 'z-10 scale-90 opacity-60 translate-x-[60%] cursor-pointer';
                    
                    // Hide others
                    return 'z-0 scale-75 opacity-0 pointer-events-none invisible';
                },

                openModal(image) {
                    this.previewImage = image;
                    this.modalOpen = true;
                    this.stopAutoplay();
                },
                closeModal() {
                    this.modalOpen = false;
                    this.startAutoplay();
                }
            }"
                x-init="init()"
                @mouseenter="stopAutoplay()"
                @mouseleave="startAutoplay()"
                class="flex flex-col items-center">

                <!-- Main Slider Area -->
                <div class="relative w-full max-w-5xl h-[300px] md:h-[450px] flex items-center justify-center perspective-1000">
                    <template x-for="(slide, index) in slides" :key="slide.id">
                        <div class="absolute w-[80%] md:w-[60%] h-full rounded-xl shadow-2xl transition-all duration-700 ease-in-out transform origin-center flex items-center justify-center bg-gray-800 border border-gray-700/50"
                            :class="getSlideClass(index)"
                            @click="if(index !== activeSlide) { activeSlide = index } else { openModal(slide.image) }">

                            <img :src="slide.image"
                                :alt="slide.title"
                                class="w-full h-full object-contain rounded-xl bg-gray-900/50">

                            <div x-show="index === activeSlide"
                                class="absolute bottom-4 left-0 right-0 text-center px-4"
                                x-transition:enter="transition delay-300 duration-500"
                                x-transition:enter-start="opacity-0 translate-y-4"
                                x-transition:enter-end="opacity-100 translate-y-0">
                                <h3 class="text-white text-sm md:text-lg font-bold drop-shadow-md bg-black/40 backdrop-blur-sm inline-block px-4 py-1 rounded-full" x-text="slide.title"></h3>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Controls & Progress -->
                <div class="mt-8 flex items-center space-x-6">
                    <button @click="prev()" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-500 transition-colors shadow-lg shadow-blue-600/20">
                        <i class="bi bi-chevron-left"></i>
                    </button>

                    <!-- Progress Bar -->
                    <div class="w-48 h-1 bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500 transition-all duration-500"
                            :style="`width: ${((activeSlide + 1) / totalSlides) * 100}%`"></div>
                    </div>

                    <button @click="next()" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-500 transition-colors shadow-lg shadow-blue-600/20">
                        <i class="bi bi-chevron-right"></i>
                    </button>

                    <div class="text-white font-mono text-xl font-bold">
                        <span x-text="(activeSlide + 1).toString().padStart(2, '0')"></span>
                    </div>
                </div>

                <!-- Preview Modal -->
                <!-- Preview Modal (Teleported to Body) -->
                <template x-teleport="body">
                    <div x-show="modalOpen"
                        style="display: none;"
                        class="fixed inset-0 z-[100000] flex items-center justify-center bg-black/95 backdrop-blur-md p-4"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        @keydown.escape.window="closeModal()"
                        @click="closeModal()">

                        <div class="relative w-full h-full flex flex-col items-center justify-center p-4 py-8 cursor-pointer" @click.self="closeModal()">
                            <div class="relative flex-1 w-full flex items-center justify-center overflow-hidden"
                                x-data="{ 
                                 zoom: 1, 
                                 panX: 0, 
                                 panY: 0, 
                                 isDragging: false, 
                                 startX: 0, 
                                 startY: 0 
                             }"
                                @mousedown.prevent="if(zoom > 1) { isDragging = true; startX = $event.clientX - panX; startY = $event.clientY - panY; }"
                                @mousemove.window="if(isDragging) { panX = $event.clientX - startX; panY = $event.clientY - startY; }"
                                @mouseup.window="isDragging = false"
                                @mouseup.window="isDragging = false">

                                <img :src="previewImage"
                                    class="max-w-full max-h-[95vh] w-auto h-auto object-contain transition-transform duration-200 rounded-lg shadow-2xl"
                                    :class="{ 'cursor-grab': zoom > 1 && !isDragging, 'cursor-grabbing': isDragging, 'cursor-zoom-in': zoom === 1 }"
                                    :style="`transform: scale(${zoom}) translate(${panX}px, ${panY}px); transition: ${isDragging ? 'none' : 'transform 0.2s ease-out'}`"
                                    @click.stop="if(zoom === 1) { zoom = 2 } else { zoom = 1; panX = 0; panY = 0 }">
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>
    @endif

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