<div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-4 border border-gray-100 dark:border-gray-700">
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
        <i class="bi bi-images text-blue-600 mr-2"></i> Banner
    </h3>

    <div class="relative w-full aspect-[4/5] mx-auto overflow-hidden rounded-lg bg-gray-100 dark:bg-zinc-700" wire:ignore>
        <div class="swiper bannerSwiper w-full h-full">
            <div class="swiper-wrapper">
                @forelse ($banners as $banner)
                <div class="swiper-slide w-full h-full">
                    <a href="{{ $banner->url ?? '#' }}" target="_blank" class="block w-full h-full group relative">
                        @if($banner->image_url)
                        <img src="{{ $banner->image_url }}" alt="{{ $banner->title ?? 'Banner' }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            loading="lazy">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200 dark:bg-zinc-600 text-gray-400">
                            <i class="bi bi-image text-3xl"></i>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                    </a>
                </div>
                @empty
                <div class="swiper-slide h-full flex flex-col items-center justify-center text-gray-400 dark:text-gray-500 p-4 text-center">
                    <i class="bi bi-image text-4xl mb-2 opacity-50"></i>
                    <p class="text-sm">Tidak ada banner</p>
                </div>
                @endforelse
            </div>

            @if(count($banners) > 1)
            <div class="swiper-pagination !bottom-2"></div>
            @endif
        </div>
    </div>

    <!-- Swiper JS -->
    <!-- Assuming Swiper JS already loaded in layout or slider component, but safe to include check or rely on stack -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.bannerSwiper', {
                loop: {
                    {
                        count($banners) > 1 ? 'true' : 'false'
                    }
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
            });
        });
    </script>
    @endpush
</div>