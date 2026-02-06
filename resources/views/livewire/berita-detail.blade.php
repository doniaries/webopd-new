<div class="py-12 bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Featured Image -->
                @if($post->foto_utama)
                <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ $post->foto_utama_url }}"
                        alt="{{ $post->title }}"
                        class="w-full h-auto max-h-[500px] object-cover select-none"
                        oncontextmenu="return false;"
                        draggable="false"
                        onerror="this.style.display='none'">
                </div>
                @endif

                <!-- Gallery Removed from Top -->
                <!-- Article Content -->
                <article class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900 dark:text-white leading-tight">{{ $post->title }}</h1>

                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400 mb-8 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <!-- Date -->
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $post->published_at ? $post->published_at->format('d M Y') : 'Belum dipublikasi' }}</span>
                        </div>

                        <!-- Author -->
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ $post->user->name ?? 'Admin' }}</span>
                        </div>

                        <!-- Category (Tag) -->
                        @php $firstTag = $post->tags->first(); @endphp
                        @if($firstTag)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span class="inline-block px-3 py-1 rounded-full text-white text-xs font-medium"
                                style="--tag-bg: {{ $firstTag->color ?: '#3B82F6' }}; background-color: var(--tag-bg);">
                                {{ $firstTag->name }}
                            </span>
                        </div>
                        @endif

                        <!-- Views -->
                        @if(isset($post->views))
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>{{ number_format($post->views, 0, ',', '.') }} kali dilihat</span>
                        </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="prose prose-lg dark:prose-invert max-w-none 
                                text-gray-900 dark:text-gray-100
                                prose-headings:text-gray-900 dark:prose-headings:text-gray-100
                                prose-p:text-gray-900 dark:prose-p:text-gray-100
                                prose-a:text-blue-600 dark:prose-a:text-blue-400
                                prose-strong:text-gray-900 dark:prose-strong:text-gray-100
                                prose-li:text-gray-900 dark:prose-li:text-gray-100">
                        {!! $post->content !!}
                    </div>

                    @if($post->source_link)
                    <div class="mt-8 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600 flex items-start sm:items-center gap-3">
                        <div class="flex-shrink-0 mt-1 sm:mt-0">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-0.5">Disadur dari sumber:</p>
                            <a href="{{ $post->source_link }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="text-blue-600 dark:text-blue-400 font-medium hover:underline truncate block"
                                title="{{ $post->source_link }}">
                                {{ $post->source_link }}
                            </a>
                        </div>
                        <div class="flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </div>
                    </div>
                    @endif

                    <!-- Gallery Grid Section (Bottom) -->
                    @if(!empty($post->gallery) && count($post->gallery) > 0)
                    <div x-data="{ 
                            lightboxOpen: false, 
                            activeImage: '',
                            currentIndex: 0,
                            images: {{ Js::from(array_map(fn($img) => asset('storage/' . $img), array_values($post->gallery))) }},
                            openLightbox(index) {
                                this.currentIndex = index;
                                this.activeImage = this.images[index];
                                this.lightboxOpen = true;
                                document.body.style.overflow = 'hidden'; 
                            },
                            closeLightbox() {
                                this.lightboxOpen = false;
                                document.body.style.overflow = '';
                            },
                            next() {
                                this.currentIndex = (this.currentIndex + 1) % this.images.length;
                                this.activeImage = this.images[this.currentIndex];
                            },
                            prev() {
                                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                                this.activeImage = this.images[this.currentIndex];
                            }
                        }"
                        @keydown.escape.window="closeLightbox()"
                        @keydown.arrow-right.window="if(lightboxOpen) next()"
                        @keydown.arrow-left.window="if(lightboxOpen) prev()"
                        class="mt-10 pt-8 border-t border-gray-200 dark:border-gray-700">

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <i class="bi bi-images mr-3 text-blue-600"></i> Galeri Foto
                        </h3>

                        <!-- Thumbnail Grid -->
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->gallery as $index => $image)
                            <div class="group relative w-24 h-24 rounded-lg overflow-hidden cursor-pointer shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200 dark:border-gray-700"
                                @click="openLightbox({{ $loop->index }})">
                                <img src="{{ asset('storage/' . $image) }}"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500 select-none"
                                    oncontextmenu="return false;"
                                    draggable="false"
                                    alt="Galeri foto">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                                    <div class="opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300 w-8 h-8 bg-white/90 rounded-full flex items-center justify-center shadow-lg">
                                        <i class="bi bi-zoom-in text-gray-800 text-sm"></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
                                class="fixed inset-0 z-[99999] grid place-items-center bg-black/90 backdrop-blur-sm p-4"
                                style="display: none;">

                                <!-- Close Button -->
                                <button @click="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-50 p-2 focus:outline-none transition-colors">
                                    <i class="bi bi-x-lg text-2xl"></i>
                                </button>

                                <!-- Navigation Buttons -->
                                <button @click.stop="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 z-50 p-4 focus:outline-none transition-colors bg-black/20 hover:bg-black/40 rounded-full" x-show="images.length > 1">
                                    <i class="bi bi-chevron-left text-3xl md:text-4xl"></i>
                                </button>

                                <button @click.stop="next()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 z-50 p-4 focus:outline-none transition-colors bg-black/20 hover:bg-black/40 rounded-full" x-show="images.length > 1">
                                    <i class="bi bi-chevron-right text-3xl md:text-4xl"></i>
                                </button>

                                <!-- Image Container -->
                                <div class="relative w-full h-full flex items-center justify-center p-4 md:p-10 pointer-events-none" @click.outside="closeLightbox()">
                                    <img :src="activeImage"
                                        class="max-w-[90vw] max-h-[70vh] md:max-w-[75vw] md:max-h-[60vh] object-contain rounded-lg shadow-2xl pointer-events-auto mx-auto select-none"
                                        oncontextmenu="return false;"
                                        draggable="false"
                                        alt="Gallery Preview">

                                    <!-- Counter -->
                                    <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 text-white/90 bg-black/60 backdrop-blur-md px-4 py-1.5 rounded-full text-sm font-medium border border-white/10 pointer-events-auto">
                                        <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    @endif

                    <!-- Back Button -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a wire:navigate href="{{ route('berita.index') }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Berita
                        </a>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Related News Widget -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 sticky top-24 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 border-l-4 border-blue-600 pl-3">
                        Berita Terkait
                    </h3>

                    <div class="space-y-6">
                        @forelse($relatedPosts as $related)
                        <div class="group flex gap-4">
                            <!-- Thumbnail -->
                            <a wire:navigate href="{{ route('berita.show', $related->slug) }}" class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden relative">
                                @if($related->foto_utama)
                                <img src="{{ $related->foto_utama_url }}"
                                    alt="{{ $related->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                    onerror="this.src='https://placehold.co/100x100/e2e8f0/64748b?text=News'">
                                @else
                                <div class="w-full h-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                @endif
                            </a>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                                    {{ $related->published_at->format('d M Y') }}
                                </div>
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white line-clamp-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    <a wire:navigate href="{{ route('berita.show', $related->slug) }}">
                                        {{ $related->title }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <p>Tidak ada berita terkait saat ini.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700 text-center">
                        <a wire:navigate href="{{ route('berita.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                            Lihat Semua Berita <i class="bi bi-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>