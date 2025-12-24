<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">Pengumuman</h1>
        <div class="space-y-4">
            @foreach($pengumuman as $item)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold mb-2">
                    <a href="{{ route('pengumuman.show', $item->slug) }}" class="text-blue-600 hover:text-blue-800">
                        {{ $item->judul }}
                    </a>
                </h2>
                <p class="text-gray-600 mb-2">{{ $item->published_at ? $item->published_at->format('d M Y') : '' }}</p>
                <p class="text-gray-700">
                    {{ Str::limit(strip_tags($item->isi), 150) }}
                </p>
            </div>
            @endforeach
        </div>
        {{ $pengumuman->links() }}
    </div>
</div>