<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @foreach ($recentPosts as $post)
    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 h-full flex flex-col group">
        <a href="{{ route('berita.show', $post->slug) }}" class="block relative aspect-video overflow-hidden">
            @if ($post->foto_utama)
            <img src="{{ asset('storage/' . $post->foto_utama) }}"
                alt="{{ $post->title }}"
                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                onerror="this.onerror=null; this.src='https://placehold.co/600x400/e2e8f0/64748b?text=No+Image';">
            @else
            <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 dark:from-zinc-700 dark:to-zinc-800 flex items-center justify-center">
                <i class="bi bi-image text-4xl text-gray-400 dark:text-gray-500"></i>
            </div>
            @endif

            <div class="absolute bottom-0 left-0 p-3 w-full bg-gradient-to-t from-black/80 to-transparent">
                @php
                $tagName = $post->tags->first()->name ?? 'Berita';
                $colors = [
                'bg-blue-600',
                'bg-red-600',
                'bg-green-600',
                'bg-yellow-600',
                'bg-purple-600',
                'bg-pink-600',
                'bg-indigo-600',
                'bg-teal-600',
                'bg-orange-600',
                'bg-cyan-600',
                ];
                // Generate a consistent index based on the tag name string
                $colorIndex = crc32($tagName) % count($colors);
                // Ensure positive index
                if ($colorIndex < 0) $colorIndex=-$colorIndex;
                    $bgClass=$colors[$colorIndex];
                    @endphp
                    <span class="inline-block px-2 py-1 text-xs font-semibold text-white {{ $bgClass }} rounded-md shadow-sm">
                    {{ $tagName }}
                    </span>
            </div>
        </a>

        <div class="p-5 flex-1 flex flex-col">


            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                <a href="{{ route('berita.show', $post->slug) }}">
                    {{ $post->title }}
                </a>
            </h3>

            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                {{ Str::limit(strip_tags($post->content), 100) }}
            </p>

            <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between text-xs">
                <div class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                    <span class="flex items-center gap-1.5 bg-gray-50 dark:bg-gray-700/50 px-2 py-1 rounded-md mb-0">
                        <i class="bi bi-calendar3"></i>
                        {{ $post->created_at->translatedFormat('d F Y') }}
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <span class="flex items-center gap-1 text-gray-400" title="{{ $post->views ?? 0 }} Dilihat">
                        <i class="bi bi-eye"></i> {{ $post->views ?? 0 }}
                    </span>
                    <a href="{{ route('berita.show', $post->slug) }}" class="text-blue-600 dark:text-blue-400 font-medium hover:underline">
                        Baca..
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>