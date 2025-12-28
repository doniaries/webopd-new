<div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-4 border border-gray-100 dark:border-gray-700"
    x-data="{
        activeSlide: 0,
        slidesCount: {{ count($banners) }},
        autoplayInterval: null,
        lightboxOpen: false,
        lightboxImage: '',
        startAutoplay() {
            if (this.slidesCount > 1) {
                this.autoplayInterval = setInterval(() => {
                    this.next();
                }, 5000);
            }
        },
        stopAutoplay() {
            clearInterval(this.autoplayInterval);
        },
        next() {
            this.activeSlide = (this.activeSlide + 1) % this.slidesCount;
        },
        prev() {
            this.activeSlide = (this.activeSlide - 1 + this.slidesCount) % this.slidesCount;
        },
        goTo(index) {
            this.activeSlide = index;
        },
        openLightbox(image) {
            this.lightboxImage = image;
            this.lightboxOpen = true;
            this.stopAutoplay();
            document.body.style.overflow = 'hidden';
        },
        closeLightbox() {
            this.lightboxOpen = false;
            this.startAutoplay();
            document.body.style.overflow = '';
        }
    }"
    x-init="startAutoplay()"
    @mouseenter="stopAutoplay()"
    @mouseleave="startAutoplay()"
    @keydown.escape.window="closeLightbox()">

    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
        <i class="bi bi-images text-blue-600 mr-2"></i> Banner
    </h3>

    <div class="relative w-full aspect-[4/5] mx-auto overflow-hidden rounded-lg bg-gray-100 dark:bg-zinc-700">
        {{-- Slides --}}
        <div class="relative w-full h-full">
            @forelse ($banners as $index => $banner)
            <div x-show="activeSlide === {{ $index }}"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-500 absolute inset-0"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute inset-0 w-full h-full cursor-pointer group"
                @click="openLightbox('{{ $banner->image_url }}')">

                @if($banner->image_url)
                <img src="{{ $banner->image_url }}" alt="{{ $banner->title ?? 'Banner' }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 select-none"
                    oncontextmenu="return false;"
                    draggable="false"
                    loading="lazy">
                @else
                <div class="w-full h-full flex items-center justify-center bg-gray-200 dark:bg-zinc-600 text-gray-400">
                    <i class="bi bi-image text-3xl"></i>
                </div>
                @endif

                {{-- Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <div class="bg-white/30 backdrop-blur-sm p-3 rounded-full transform scale-0 group-hover:scale-100 transition-transform duration-300">
                        <i class="bi bi-zoom-in text-white text-2xl drop-shadow-md"></i>
                    </div>
                </div>

                {{-- Title (Optional, appears on hover) --}}
                @if($banner->title)
                <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 pointer-events-none">
                    <p class="text-white text-sm font-medium truncate drop-shadow-md">{{ $banner->title }}</p>
                </div>
                @endif
            </div>
            @empty
            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 dark:text-gray-500 p-4 text-center absolute inset-0">
                <i class="bi bi-image text-4xl mb-2 opacity-50"></i>
                <p class="text-sm">Tidak ada banner</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination Dots --}}
        @if(count($banners) > 1)
        <div class="absolute bottom-3 left-0 right-0 flex justify-center space-x-2 z-10 pointer-events-none">
            @foreach($banners as $index => $banner)
            <button @click="goTo({{ $index }})"
                class="w-2 h-2 rounded-full transition-all duration-300 focus:outline-none pointer-events-auto"
                :class="activeSlide === {{ $index }} ? 'bg-white w-4' : 'bg-white/50 hover:bg-white/80'">
            </button>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Lightbox Modal -->
    <template x-teleport="body">
        <div x-show="lightboxOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[99999] bg-black/95 backdrop-blur-sm overflow-hidden"
            style="display: none;"
            x-data="{
                scale: 1,
                panning: false,
                startX: 0,
                startY: 0,
                translateX: 0,
                translateY: 0,
                handleScroll(e) {
                    const delta = e.deltaY > 0 ? -0.1 : 0.1;
                    const newScale = Math.max(1, Math.min(4, this.scale + delta));
                    
                    this.scale = newScale;
                    
                    if (this.scale === 1) {
                        this.translateX = 0;
                        this.translateY = 0;
                    }
                },
                startDrag(e) {
                    if(this.scale > 1) {
                        this.panning = true;
                        this.startX = e.clientX - this.translateX;
                        this.startY = e.clientY - this.translateY;
                    }
                },
                drag(e) {
                    if (this.panning) {
                        e.preventDefault();
                        this.translateX = e.clientX - this.startX;
                        this.translateY = e.clientY - this.startY;
                    }
                },
                stopDrag() {
                    this.panning = false;
                },
                reset() {
                    this.scale = 1;
                    this.translateX = 0;
                    this.translateY = 0;
                    this.panning = false;
                }
            }"
            @watch-lightbox-close="reset()">

            <!-- Controls -->
            <div class="absolute top-4 right-4 flex items-center space-x-4 z-50">
                <!-- Close Button -->
                <button @click="closeLightbox(); reset()" class="p-2 text-white hover:text-red-400 focus:outline-none transition-colors rounded-full hover:bg-white/10">
                    <i class="bi bi-x-lg text-2xl"></i>
                </button>
            </div>

            <!-- Image Container -->
            <div class="w-full h-full flex items-center justify-center p-4 overflow-hidden cursor-move"
                @wheel.prevent="handleScroll($event)"
                @mousedown="startDrag($event)"
                @mousemove="drag($event)"
                @mouseup="stopDrag()"
                @mouseleave="stopDrag()">

                <img :src="lightboxImage"
                    class="max-w-none origin-center transition-transform duration-100 ease-linear select-none"
                    :style="`transform: translate(${translateX}px, ${translateY}px) scale(${scale}); max-height: 90vh; max-width: 90vw;`"
                    oncontextmenu="return false;"
                    draggable="false"
                    alt="Banner Preview">
            </div>

            <!-- Instructions -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white/50 text-sm pointer-events-none bg-black/40 px-3 py-1 rounded-full backdrop-blur-sm"
                x-show="scale > 1">
                Drag to pan • Scroll to zoom
            </div>
        </div>
    </template>
</div>