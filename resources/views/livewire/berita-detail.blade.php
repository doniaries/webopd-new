<div class="py-12 bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Featured Image -->
        @if($post->foto_utama)
        <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
            <img src="{{ $post->foto_utama }}"
                alt="{{ $post->title }}"
                class="w-full h-auto max-h-[500px] object-cover"
                onerror="this.style.display='none'">
        </div>
        @endif

        <!-- Article Content -->
        <article class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
            <!-- Title -->
            <h1 class="text-4xl font-bold mb-6 text-gray-900 dark:text-white">{{ $post->title }}</h1>

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
            <div class="prose prose-lg dark:prose-invert max-w-none">
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
</div>