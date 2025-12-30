<div class="space-y-12">
    @push('title', $pageTitle)
    @push('meta')
    <meta name="description" content="{{ $pageDescription }}">
    @endpush

    {{-- Slider Section with Popular Posts Overlay --}}
    <livewire:slider lazy />

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

                    <div class="min-h-[300px]">
                        <livewire:home-latest-posts lazy />
                    </div>

                    <div class="mt-8 text-center">
                        <a wire:navigate href="{{ route('berita.index') }}" class="inline-flex items-center px-6 py-2.5 border border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400 font-medium rounded-full hover:bg-blue-600 hover:text-white dark:hover:bg-blue-500 dark:hover:text-white transition-all duration-300">
                            Lihat Semua Berita <i class="bi bi-arrow-right-short ml-2 text-xl"></i>
                        </a>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 space-y-8">
                    {{-- Banner & Visitor Stats --}}
                    <div class="space-y-6">
                        <livewire:banner lazy />
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
                    <livewire:home-agendas lazy />
                </div>

                {{-- Pengumuman Section --}}
                <div class="lg:col-span-1">
                    <livewire:home-pengumuman lazy />
                </div>
            </div>
        </div>
    </section>

    {{-- External Links Section --}}
    <section id="external-links" class="pb-12 bg-white dark:bg-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:external-links lazy />
        </div>
    </section>
</div>