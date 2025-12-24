<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
            <div class="text-gray-600 mb-4">
                {{ $post->published_at ? $post->published_at->format('d M Y') : '' }} | {{ $post->user->name ?? 'Admin' }}
            </div>
            @if($post->foto_utama_url)
            <img src="{{ $post->foto_utama_url }}" alt="{{ $post->title }}" class="w-full max-h-96 object-cover rounded-lg mb-6">
            @endif
            <div class="prose max-w-none">
                {!! $post->content !!}
            </div>
        </div>
    </div>
</div>