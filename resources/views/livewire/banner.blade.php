<div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-4 border border-gray-100 dark:border-gray-700"
    x-data="{
        activeSlide: 0,
        slidesCount: {{ count($banners) }},
        autoplayInterval: null,
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
        }
    }"
    x-init="startAutoplay()"
    @mouseenter="stopAutoplay()"
    @mouseleave="startAutoplay()">

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
                class="absolute inset-0 w-full h-full">
                <a href="{{ $banner->url ?? '#' }}" target="_blank" class="block w-full h-full group relative">
                    @if($banner->image_url)
                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title ?? 'Banner' }}"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        loading="lazy">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-200 dark:bg-zinc-600 text-gray-400">
                        <i class="bi bi-image text-3xl"></i>
                    </div>
                    @endif

                    {{-- Gradient Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    {{-- Title (Optional, appears on hover) --}}
                    @if($banner->title)
                    <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <p class="text-white text-sm font-medium truncate drop-shadow-md">{{ $banner->title }}</p>
                    </div>
                    @endif
                </a>
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
        <div class="absolute bottom-3 left-0 right-0 flex justify-center space-x-2 z-10">
            @foreach($banners as $index => $banner)
            <button @click="goTo({{ $index }})"
                class="w-2 h-2 rounded-full transition-all duration-300 focus:outline-none"
                :class="activeSlide === {{ $index }} ? 'bg-white w-4' : 'bg-white/50 hover:bg-white/80'">
            </button>
            @endforeach
        </div>
        @endif
    </div>
</div>