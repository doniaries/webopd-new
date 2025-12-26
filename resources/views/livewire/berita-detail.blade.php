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
                        class="w-full h-auto max-h-[500px] object-cover"
                        onerror="this.style.display='none'">
                </div>
                @endif

                @if($post->galleries->count() > 0)
                <!-- Gallery Section -->
                <div x-data="{ activeImage: '{{ asset('storage/' . $post->galleries->first()->image_path) }}' }" class="mb-8 p-4 bg-white dark:bg-gray-800 rounded-xl shadow-md">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Galeri Foto
                    </h3>

                    <!-- Main Preview -->
                    <div class="mb-4 rounded-lg overflow-hidden shadow-inner bg-gray-100 dark:bg-gray-700 h-[300px] md:h-[450px]">
                        <img :src="activeImage" class="w-full h-full object-contain transition-all duration-300">
                    </div>

                    <!-- Thumbnails -->
                    <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
                        @foreach($post->galleries as $gallery)
                        <button @click="activeImage = '{{ asset('storage/' . $gallery->image_path) }}'"
                            class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden border-2 transition-all p-0.5"
                            :class="activeImage === '{{ asset('storage/' . $gallery->image_path) }}' ? 'border-blue-500 ring-2 ring-blue-200' : 'border-transparent opacity-70 hover:opacity-100'">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-full h-full object-cover rounded-md">
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

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

                        <!-- Category -->
                        @if($post->category)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span class="inline-block px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-medium">
                                {{ $post->category->name }}
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

                    <!-- Back Button -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('berita.index') }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">
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
                            <a href="{{ route('berita.show', $related->slug) }}" class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden relative">
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
                                    <a href="{{ route('berita.show', $related->slug) }}">
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
                        <a href="{{ route('berita.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                            Lihat Semua Berita <i class="bi bi-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>