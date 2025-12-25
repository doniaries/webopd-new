<div class="py-12 bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Berita</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $posts->total() }} berita ditemukan</p>
        </div>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col">
                <!-- Featured Image -->
                <a href="{{ route('berita.show', $post->slug) }}" class="block flex-shrink-0">
                    @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}"
                        alt="{{ $post->title }}"
                        class="w-full h-48 object-cover"
                        onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center\'><svg class=\'w-12 h-12 text-gray-400 dark:text-gray-500\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>'">
                    @else
                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                </a>

                <!-- Post Content -->
                <div class="p-5 flex flex-col flex-grow">
                    <!-- Category Badge (if exists) -->
                    @if($post->category)
                    <div class="mb-3">
                        <span class="inline-block text-xs font-medium px-2.5 py-0.5 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                            {{ $post->category->name }}
                        </span>
                    </div>
                    @endif

                    <!-- Title -->
                    <h2 class="text-xl font-bold mb-2 text-gray-900 dark:text-white leading-tight">
                        <a href="{{ route('berita.show', $post->slug) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <!-- Excerpt -->
                    <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3 text-sm flex-grow">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>

                    <!-- Date and Views -->
                    <div class="text-sm text-gray-500 dark:text-gray-400 pt-3 border-t border-gray-100 dark:border-gray-700 mt-auto">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $post->published_at ? $post->published_at->format('d M Y') : 'Belum dipublikasi' }}</span>
                            </div>
                            @if(isset($post->views))
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>{{ number_format($post->views, 0, ',', '.') }}x</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-lg">Tidak ada berita yang ditemukan.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
        @endif
    </div>
</div>