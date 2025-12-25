@php
use App\Models\Pengaturan;
$pengaturan = Pengaturan::first();
@endphp

<!-- Pre-Footer Section -->
<div class="bg-gray-100 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-8 transition-colors duration-200">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Tetap Terhubung</h3>
            <div class="flex justify-center space-x-6">
                @if (!empty($pengaturan->facebook))
                <a href="{{ $pengaturan->facebook }}" target="_blank"
                    class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-300">
                    <i class="bi bi-facebook text-2xl"></i>
                </a>
                @endif
                @if (!empty($pengaturan->twitter))
                <a href="{{ $pengaturan->twitter }}" target="_blank"
                    class="text-gray-600 hover:text-blue-400 transition-colors duration-300">
                    <i class="bi bi-twitter-x text-2xl"></i>
                </a>
                @endif
                @if (!empty($pengaturan->instagram))
                <a href="{{ $pengaturan->instagram }}" target="_blank"
                    class="text-gray-600 hover:text-pink-500 transition-colors duration-300">
                    <i class="bi bi-instagram text-2xl"></i>
                </a>
                @endif
                @if (!empty($pengaturan->youtube))
                <a href="{{ $pengaturan->youtube }}" target="_blank"
                    class="text-gray-600 hover:text-red-600 transition-colors duration-300">
                    <i class="bi bi-youtube text-2xl"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Main Footer -->
<footer class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About Section -->
            <div class="lg:col-span-2">
                <a href="{{ url('/') }}" class="inline-block mb-4">
                    <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $pengaturan->name ?? config('app.name') }}</span>
                </a>
                <div class="space-y-2 text-gray-600 dark:text-gray-400">
                    @if (!empty($pengaturan->alamat_instansi))
                    <p>{{ $pengaturan->alamat_instansi }}</p>
                    @else
                    <p>Jl. Contoh No. 123</p>
                    @endif

                    @if (!empty($pengaturan->no_telp_instansi))
                    <p class="mt-3"><strong class="text-gray-800">Telepon:</strong> {{ $pengaturan->no_telp_instansi }}</p>
                    @else
                    <p class="mt-3"><strong class="text-gray-800 dark:text-gray-200">Telepon:</strong> +62 123 4567 890</p>
                    @endif

                    @if (!empty($pengaturan->email_instansi))
                    <p><strong class="text-gray-800 dark:text-gray-200">Email:</strong> {{ $pengaturan->email_instansi }}</p>
                    @else
                    <p><strong class="text-gray-800 dark:text-gray-200">Email:</strong> info@webopd.com</p>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Tautan Cepat</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Beranda</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Sambutan Pimpinan</a></li>
                    <li><a href="{{ route('berita.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Berita</a></li>
                </ul>
            </div>

            <!-- Information Links -->
            <div>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Infografis</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Dokumen</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-950 transition-colors duration-200">
        <div class="container mx-auto px-4 py-4">
            <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                © <span>Copyright</span> <strong class="px-1 text-gray-900">{{ $pengaturan->name ?? config('app.name') }}</strong>
                <span>{{ date('Y') }}. All Rights Reserved</span>
            </p>
        </div>
    </div>
</footer>