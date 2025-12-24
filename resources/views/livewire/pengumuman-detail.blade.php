<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $pengumuman->judul }}</h1>
            <div class="text-gray-600 mb-4">
                {{ $pengumuman->published_at ? $pengumuman->published_at->format('d M Y') : '' }}
            </div>

            <div class="prose max-w-none">
                {!! $pengumuman->isi !!}
            </div>

            @if($pengumuman->lampiran)
            <div class="mt-8 border-t pt-4">
                <h3 class="text-lg font-semibold mb-2">Lampiran</h3>
                <a href="{{ asset('storage/' . $pengumuman->lampiran) }}" target="_blank" class="text-blue-600 hover:underline">
                    <i class="bi bi-paperclip"></i> Unduh Lampiran
                </a>
            </div>
            @endif
        </div>
    </div>
</div>