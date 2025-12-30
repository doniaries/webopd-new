<div class="relative w-full overflow-hidden" wire:ignore>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <div x-ref="swiperContainer" class="swiper w-full h-[500px] md:h-[450px] lg:h-[550px] bg-gray-900 relative">
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
                <div class="relative z-10 text-left px-4 md:px-8 lg:px-16 max-w-7xl mx-auto w-full mt-12 md:mt-20">
                    @if ($slider->tags && count($slider->tags) > 0)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach ($slider->tags as $tag)
                        <span class="px-3 py-1 text-xs font-semibold text-white rounded-md shadow-lg backdrop-blur-sm"
                            style="background-color: {{ $tag->color ?? '#f97316' }}">
                            {{ $tag->name }}
                        </span>
                        @endforeach
                    </div>
                    @endif

                    <a wire:navigate href="{{ route('berita.show', $slider->slug) }}" class="group block">
                        <h2 class="text-2xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight drop-shadow-lg group-hover:text-blue-400 transition-colors duration-300 max-w-4xl">
                            {{ $slider->title }}
                        </h2>
                    </a>

                    <a wire:navigate href="{{ route('berita.show', $slider->slug) }}" class="inline-flex items-center text-white text-sm md:text-base gap-2 hover:text-blue-400 transition-colors w-fit">
                        <i class="bi bi-arrow-right-circle"></i>
                        <span>Baca Selengkapnya</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Navigation Buttons --}}
        <div class="swiper-button-next !text-white !opacity-70 hover:!opacity-100 transition-opacity"></div>
        <div class="swiper-button-prev !text-white !opacity-70 hover:!opacity-100 transition-opacity"></div>

        {{-- Pagination with numbers --}}
        <div class="swiper-pagination"></div>

        {{-- Popular Posts Overlay (Bottom) --}}
        @if(isset($popularPosts) && $popularPosts->count() > 0)
        <div class="absolute bottom-0 left-0 right-0 z-20 bg-gradient-to-t from-black/90 to-transparent pb-4 pt-12">
            <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
                <h3 class="text-white font-bold text-lg mb-3">Berita populer</h3>
                <div class="flex overflow-x-auto snap-x scrollbar-hide md:grid md:grid-cols-4 gap-3 pb-2 -mx-4 px-4 md:mx-0 md:px-0">
                    @foreach($popularPosts as $post)
                    <a wire:navigate href="{{ route('berita.show', $post->slug) }}" class="group flex flex-shrink-0 w-[85%] sm:w-[300px] md:w-auto snap-center gap-2 bg-black/40 hover:bg-black/60 rounded-lg overflow-hidden transition-all duration-300 backdrop-blur-sm">
                        @if($post->foto_utama_url)
                        <img src="{{ $post->foto_utama_url }}"
                            alt="{{ $post->title }}"
                            class="w-16 h-16 object-cover flex-shrink-0"
                            onerror="this.onerror=null; this.src='https://placehold.co/100x100/1e293b/ffffff?text=No+Image';">
                        @else
                        <div class="w-16 h-16 bg-gray-700 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-image text-gray-400"></i>
                        </div>
                        @endif
                        <div class="flex-1 py-1 pr-2 min-w-0">
                            @if($post->tags->isNotEmpty())
                            <span class="inline-block px-2 py-0.5 text-[10px] font-semibold text-white rounded mb-1"
                                style="background-color: {{ $post->tags->first()->color ?? '#f97316' }}">
                                {{ $post->tags->first()->name }}
                            </span>
                            @endif
                            <h4 class="text-white text-xs font-semibold line-clamp-2 group-hover:text-blue-300 transition-colors">
                                {{ $post->title }}
                            </h4>
                            <p class="text-gray-400 text-[10px] mt-0.5">
                                {{ $post->user->name ?? 'Admin' }} - {{ $post->published_at?->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Alpine.js Slider Logic -->
    <div x-data="{
        swiper: null,
        init() {
            this.initSwiper();
        },
        initSwiper() {
            if (this.swiper) {
                this.swiper.destroy(true, true);
            }

            const slideCount = {{ count($sliders) }};

            this.swiper = new Swiper(this.$refs.swiperContainer, {
                loop: slideCount > 1,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: slideCount > 0 ? {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                } : false,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    renderBullet: function(index, className) {
                        return '<span class=\'' + className + '\'>' + (index + 1) + '</span>';
                    },
                },
            });
        }
    }"
        x-init="init()"
        class="absolute inset-0 pointer-events-none">
        <!-- This div just holds the logic, actual slider is above -->
    </div>

    <style>
        /* Custom pagination styling for numbered bullets */
        .swiper-pagination {
            bottom: 140px !important;
            /* Above popular posts */
            right: 20px !important;
            left: auto !important;
            width: auto !important;
            z-index: 50 !important;
            pointer-events: auto !important;
        }

        .swiper-pagination-bullet {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.3);
            opacity: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            color: white;
            border-radius: 50%;
            transition: all 0.3s ease;
            margin: 0 4px !important;
        }

        .swiper-pagination-bullet-active {
            background: rgba(255, 255, 255, 0.9);
            color: #1e40af;
            transform: scale(1.1);
        }

        .swiper-pagination-bullet:hover {
            background: rgba(255, 255, 255, 0.6);
        }

        /* Navigation buttons styling */
        .swiper-button-next,
        .swiper-button-prev {
            color: white !important;
            background: rgba(0, 0, 0, 0.3) !important;
            width: 44px !important;
            height: 44px !important;
            border-radius: 50% !important;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px !important;
        }
    </style>
</div>