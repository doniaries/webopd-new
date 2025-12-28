@php
use App\Models\Pengaturan;
$pengaturan = Pengaturan::first();
@endphp

<footer class="bg-white dark:bg-zinc-900 border-t border-gray-200 dark:border-gray-800 pt-16 pb-8 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

            <!-- Brand & Socials -->
            <div class="space-y-6">
                <a href="{{ url('/') }}" class="inline-block">
                    <div class="flex items-center space-x-3">
                        @if(!empty($pengaturan->logo_instansi))
                        <img src="{{ asset('storage/' . $pengaturan->logo_instansi) }}" alt="Logo" class="h-10 w-auto">
                        @else
                        <div class="h-10 w-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                            {{ substr($pengaturan->name ?? config('app.name'), 0, 1) }}
                        </div>
                        @endif
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white leading-tight">
                                {{ $pengaturan->name ?? config('app.name') }}
                            </h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Pemerintah Kabupaten Sijunjung</p>
                        </div>
                    </div>
                </a>

                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                    {{ $pengaturan->deskripsi_situs ?? 'Portal resmi Pemerintah Kabupaten Sijunjung. Menyajikan informasi terkini, layanan publik, dan transparansi pemerintahan.' }}
                </p>

                <div class="flex space-x-4 pt-2">
                    @if (!empty($pengaturan->facebook))
                    <a href="{{ $pengaturan->facebook }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-50 dark:bg-zinc-800 flex items-center justify-center text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-500 dark:hover:text-white transition-all duration-300">
                        <i class="bi bi-facebook text-lg"></i>
                    </a>
                    @endif
                    @if (!empty($pengaturan->twitter))
                    <a href="{{ $pengaturan->twitter }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-50 dark:bg-zinc-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-black hover:text-white transition-all duration-300">
                        <i class="bi bi-twitter-x text-lg"></i>
                    </a>
                    @endif
                    @if (!empty($pengaturan->instagram))
                    <a href="{{ $pengaturan->instagram }}" target="_blank" class="w-10 h-10 rounded-full bg-pink-50 dark:bg-zinc-800 flex items-center justify-center text-pink-600 dark:text-pink-400 hover:bg-pink-600 hover:text-white transition-all duration-300">
                        <i class="bi bi-instagram text-lg"></i>
                    </a>
                    @endif
                    @if (!empty($pengaturan->youtube))
                    <a href="{{ $pengaturan->youtube }}" target="_blank" class="w-10 h-10 rounded-full bg-red-50 dark:bg-zinc-800 flex items-center justify-center text-red-600 dark:text-red-400 hover:bg-red-600 hover:text-white transition-all duration-300">
                        <i class="bi bi-youtube text-lg"></i>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Tautan Cepat</h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ url('/') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-600 mr-2 group-hover:bg-blue-600 dark:group-hover:bg-blue-400 transition-colors"></span>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('berita.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-600 mr-2 group-hover:bg-blue-600 dark:group-hover:bg-blue-400 transition-colors"></span>
                            Berita & Artikel
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-600 mr-2 group-hover:bg-blue-600 dark:group-hover:bg-blue-400 transition-colors"></span>
                            Agenda Kegiatan
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-600 mr-2 group-hover:bg-blue-600 dark:group-hover:bg-blue-400 transition-colors"></span>
                            Pengumuman
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Hubungi Kami</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start text-gray-600 dark:text-gray-400">
                        <i class="bi bi-geo-alt-fill text-blue-600 dark:text-blue-400 mt-0.5 mr-3"></i>
                        <span>
                            {{ $pengaturan->alamat_instansi ?? 'Alamat instansi belum diatur.' }}
                        </span>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-400">
                        <i class="bi bi-telephone-fill text-blue-600 dark:text-blue-400 mr-3"></i>
                        <span>{{ $pengaturan->no_telp_instansi ?? '+62 000 0000 0000' }}</span>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-400">
                        <i class="bi bi-envelope-fill text-blue-600 dark:text-blue-400 mr-3"></i>
                        <a href="mailto:{{ $pengaturan->email_instansi }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            {{ $pengaturan->email_instansi ?? 'info@example.com' }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Visitor Stats (New Location) -->
            <div>
                <livewire:visitor-stats lazy />
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-100 dark:border-gray-800 pt-8 mt-8 text-center sm:text-left flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500 dark:text-gray-400">
            <p>
                &copy; {{ date('Y') }} <strong class="text-gray-900 dark:text-white font-semibold">{{ $pengaturan->name ?? config('app.name') }}</strong>. All Rights Reserved.
            </p>
            <p class="mt-2 sm:mt-0 flex items-center">
                Dibuat dengan <i class="bi bi-heart-fill text-red-500 mx-1"></i> oleh <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 ml-1 transition-colors">Tim IT Diskominfo</a>
            </p>
        </div>
    </div>
</footer>