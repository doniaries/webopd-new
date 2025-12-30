<div class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200 min-h-screen relative">

    {{-- Content --}}
    <div>
        <x-page-header title="Berita" />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <div class="mb-6 flex items-center justify-between">
                        <p class="text-gray-600 dark:text-gray-400">{{ $posts->total() }} berita ditemukan</p>

                        @if($tag)
                        <div class="animate-fade-in-up">
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-md text-sm bg-blue-50 text-blue-700 border border-blue-100">
                                Topik: <strong>{{ Str::title(str_replace('-', ' ', $tag)) }}</strong>
                                <a wire:navigate href="{{ route('berita.index') }}" class="ml-1 text-blue-400 hover:text-red-500 transition-colors" title="Hapus Filter">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Posts Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($posts as $post)
                        <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col">
                            <!-- Featured Image -->
                            <!-- Featured Image Wrapper -->
                            <div class="block flex-shrink-0 relative group">
                                <a wire:navigate href="{{ route('berita.show', $post->slug) }}" class="block w-full h-full">
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
                                $postTag = $post->tags->first();
                                @endphp
                                <div class="absolute bottom-0 left-0 p-3 w-full bg-gradient-to-t from-black/80 to-transparent z-10 pointer-events-none">
                                    @if($postTag)
                                    @php
                                    $tagName = $postTag->name;
                                    // Use model accessor
                                    $bgColor = $postTag->color ?: '#3B82F6';
                                    @endphp
                                    <a wire:navigate href="{{ route('berita.index', ['tag' => $postTag->slug]) }}"
                                        class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-md shadow-sm hover:opacity-90 transition-opacity pointer-events-auto"
                                        @style(['background-color: ' . $bgColor])>
    {{ $tagName }}
</a>
                                    @else
                                    <a wire:navigate href="{{ route('berita.index') }}"
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
                                    <a wire:navigate href="{{ route('berita.show', $post->slug) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                <!-- Excerpt -->
                                <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3 text-sm flex-grow">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>

                                <!-- Date and Meta -->
                                <div class="pt-4 mt-auto border-t border-gray-100 dark:border-gray-700">
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500 dark:text-gray-400">
                                            <div class="flex items-center gap-1.5 bg-gray-50 dark:bg-gray-700/50 px-2 py-1 rounded-md">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span class="font-medium">{{ $post->published_at ? $post->published_at->translatedFormat('d F Y') : 'N/A' }}</span>
                                            </div>

                                            <div class="flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <span>{{ strtok($post->user->name ?? 'Admin', ' ') }}</span>
                                            </div>
                                        </div>

                                        @if(isset($post->views))
                                        <div class="flex-shrink-0">
                                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-900/5 dark:bg-gray-100/10 text-gray-700 dark:text-gray-300">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <span>{{ number_format($post->views, 0, ',', '.') }}</span>
                                            </div>
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

                <!-- Sidebar -->
                <div class="lg:col-span-1 border-l border-gray-100 dark:border-gray-700 pl-0 lg:pl-8">
                    <div class="sticky top-24">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 transition-colors duration-200">
                            <h3 class="font-bold text-gray-900 dark:text-white text-lg mb-4 flex items-center">
                                <span class="w-1 h-6 bg-blue-600 rounded-full mr-3"></span>
                                Topik Terkini
                            </h3>

                            <div class="flex flex-wrap gap-2">
                                @forelse($tags as $t)
                                @php
                                $tagName = $t->name;
                                $isActive = request()->query(' tag')===$t->slug;
                                        // Use the model accessor for color
                                        $bgClass = $t->color ?: '#3b82f6'; // This returns a HEX code now, e.g., #3b82f6

                                        // Active State vs Inactive State
                                        if ($isActive) {
                                        $style = "background-color: {$bgClass}; color: white; transform: scale(1.05); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);";
                                        } else {
                                        // Make it look like a pastel version for inactive, or just use the color with lower opacity if possible,
                                        // but since we have hex, let's just use the solid color with white text for consistency with slider,
                                        // OR use a utility class if we want to be fancy.
                                        // For now, let's stick to the consistent solid color look from the slider.
                                        $style = "background-color: {$bgClass}; color: white;";
                                        }
                                        @endphp
                                        <a wire:navigate href="{{ route('berita.index', ['tag' => $t->slug]) }}"
                                            class="inline-flex items-center text-xs font-medium px-3 py-1.5 rounded-full transition-all duration-200 hover:opacity-90"
                                            @style([$style])>
                                            {{ $tagName }}
                                            <span class="ml-1.5 opacity-70 text-[10px] bg-white/20 px-1.5 rounded-full">{{ $t->posts_count }}</span>
                                        </a>
                                        @empty
                                        <p class="text-sm text-gray-500 dark:text-gray-400 italic">Belum ada topik.</p>
                                        @endforelse
                                </div>
                            </div>

                            <!-- Info Widget -->
                            <!-- <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 rounded-xl p-5 border border-blue-100 dark:border-blue-900/50">
                            <h4 class="font-bold text-blue-800 dark:text-blue-200 mb-2 text-sm">Informasi</h4>
                            <p class="text-xs text-blue-600 dark:text-blue-300 leading-relaxed">
                                Gunakan filter topik di atas untuk menemukan berita berdasarkan kategori yang Anda minati.
                            </p>
                        </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>