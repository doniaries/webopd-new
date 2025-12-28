<div class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200 min-h-screen relative">

    {{-- Loading Skeleton (Now explicitly outside the content container) --}}
    <div wire:loading class="w-full">
        @include('livewire.placeholders.skeleton-news-grid')
    </div>

    {{-- Content --}}
    <div wire:loading.remove>
        <x-page-header title="Berita" />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-8">
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $posts->total() }} berita ditemukan</p>
            </div>

            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($posts as $post)
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col">
                    <!-- Featured Image -->
                    <!-- Featured Image Wrapper -->
                    <div class="block flex-shrink-0 relative group">
                        <a href="{{ route('berita.show', $post->slug) }}" class="block w-full h-full">
                            @if($post->foto_utama)
                            <img src="{{ asset('storage/' . $post->foto_utama) }}"
                                alt="{{ $post->title }}"
                                class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105"
                                onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center\'><svg class=\'w-12 h-12 text-gray-400 dark:text-gray-500\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg></div>'">
                            @else
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            @endif
                        </a>

                        <!-- Tag Overlay -->
                        @php
                        $tag = $post->tags->first();
                        @endphp
                        <div class="absolute bottom-0 left-0 p-3 w-full bg-gradient-to-t from-black/80 to-transparent z-10 pointer-events-none">
                            @if($tag)
                            @php
                            $tagName = $tag->name;
                            $colors = [
                            'bg-blue-600', 'bg-red-600', 'bg-green-600', 'bg-yellow-600',
                            'bg-purple-600', 'bg-pink-600', 'bg-indigo-600', 'bg-teal-600',
                            'bg-orange-600', 'bg-cyan-600'
                            ];
                            $colorIndex = crc32($tagName) % count($colors);
                            if ($colorIndex < 0) $colorIndex=-$colorIndex;
                                $bgClass=$colors[$colorIndex];
                                @endphp
                                <a href="{{ route('berita.index', ['tag' => $tag->slug]) }}"
                                class="inline-block px-2 py-1 text-xs font-semibold text-white {{ $bgClass }} rounded-md shadow-sm hover:opacity-90 transition-opacity pointer-events-auto">
                                {{ $tagName }}
                                </a>
                                @else
                                <a href="{{ route('berita.index') }}"
                                    class="inline-block px-2 py-1 text-xs font-semibold text-white bg-blue-600 rounded-md shadow-sm hover:opacity-90 transition-opacity pointer-events-auto">
                                    Berita
                                </a>
                                @endif
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="p-5 flex flex-col flex-grow">


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
                        <div class="text-xs text-gray-500 dark:text-gray-400 pt-3 border-t border-gray-100 dark:border-gray-700 mt-auto">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $post->published_at ? $post->published_at->format('d M Y') : 'N/A' }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ strtok($post->user->name ?? 'Admin', ' ') }}
                                    </span>
                                </div>
                                @if(isset($post->views))
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ number_format($post->views, 0, ',', '.') }}
                                    </span>
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
</div>