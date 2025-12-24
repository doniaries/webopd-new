<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">Berita</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($posts as $post)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-6">
                <h2 class="text-xl font-bold mb-2">
                    <a href="{{ route('berita.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800">
                        {{ $post->title }}
                    </a>
                </h2>
                <p class="text-gray-600 mb-2">{{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</p>
                <p class="text-gray-700">
                    {{ Str::limit(strip_tags($post->content), 100) }}
                </p>
            </div>
            @endforeach
        </div>
        {{ $posts->links() }}
    </div>
</div>