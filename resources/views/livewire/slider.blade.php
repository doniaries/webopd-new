<div class="relative w-full overflow-hidden" wire:ignore>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <div class="swiper mySwiper w-full h-[300px] md:h-[450px] lg:h-[550px] bg-gray-900">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide relative flex items-center justify-center bg-gray-900">
                {{-- Image --}}
                @if ($slider->foto_utama_url)
                <img src="{{ $slider->foto_utama_url }}" alt="{{ $slider->title }}"
                    class="absolute inset-0 w-full h-full object-cover opacity-60" />
                @else
                <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-900 w-full h-full opacity-60"></div>
                @endif

                {{-- Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent"></div>

                {{-- Content --}}
                <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-12 md:mt-20">
                    @if ($slider->tags && count($slider->tags) > 0)
                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        @foreach ($slider->tags as $tag)
                        <span class="px-3 py-1 text-xs font-semibold bg-blue-600/90 text-white rounded-full shadow-lg backdrop-blur-sm">
                            {{ $tag->name }}
                        </span>
                        @endforeach
                    </div>
                    @endif

                    <a href="{{ route('berita.show', $slider->slug) }}" class="group block">
                        <h2 class="text-2xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight drop-shadow-lg group-hover:text-blue-400 transition-colors duration-300">
                            {{ $slider->title }}
                        </h2>
                    </a>

                    {{-- Additional info if needed --}}
                    {{-- <p class="text-gray-300 text-sm md:text-base line-clamp-2 md:line-clamp-3 max-w-2xl mx-auto drop-shadow-md">
                            {{ $slider->excerpt ?? '' }}
                    </p> --}}
                </div>
            </div>
            @endforeach
        </div>

        <!-- Navigation Buttons -->
        <div class="swiper-button-next !text-white !opacity-50 hover:!opacity-100 transition-opacity !w-12 !h-12 !bg-black/20 hover:!bg-black/40 !rounded-full !hidden md:!flex"></div>
        <div class="swiper-button-prev !text-white !opacity-50 hover:!opacity-100 transition-opacity !w-12 !h-12 !bg-black/20 hover:!bg-black/40 !rounded-full !hidden md:!flex"></div>

        <!-- Pagination -->
        <div class="swiper-pagination !bottom-6"></div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.mySwiper', {
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
            });
        });
    </script>
</div>