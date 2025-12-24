@php
use App\Models\Pengaturan;
$pengaturan = Pengaturan::first();
$siteName = $pengaturan->name ?? config('app.name');
$logoUrl = $pengaturan->logo ? asset('storage/' . $pengaturan->logo) : asset('assets/img/logo.png');
@endphp

<header class="sticky top-0 z-50 bg-white shadow-sm">
    <!-- Top Bar -->
    <div class="border-b border-gray-200">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between py-3">
                <!-- Logo Group -->
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 border-r border-gray-200 pr-4">
                        <img src="{{ $logoUrl }}" alt="Logo" class="h-12 w-auto object-contain"
                            onerror="this.src='{{ asset('assets/img/logo.png') }}'">
                        <div class="hidden sm:flex flex-col">
                            <h1 class="text-base font-bold text-gray-900 uppercase leading-tight">{{ $siteName }}</h1>
                            <span class="text-xs text-gray-600 uppercase">Pemerintah {{ $pengaturan->kabupaten ?? 'Sijunjung' }}</span>
                        </div>
                    </a>

                    <!-- Partner Logos (Desktop) -->
                    <div class="hidden lg:flex items-center gap-4">
                        <img src="{{ asset('images/bangga.png') }}" alt="Bangga" class="h-8 w-auto">
                        <img src="{{ asset('images/berakhlak.png') }}" alt="Berakhlak" class="h-8 w-auto">
                    </div>
                </div>

                <!-- Mobile Toggle -->
                <button id="mobile-menu-toggle" class="lg:hidden p-2 text-gray-700 hover:text-blue-600">
                    <i class="bi bi-list text-3xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav id="main-nav" class="hidden lg:block">
        <div class="container mx-auto px-4 lg:px-8">
            <ul class="flex justify-center items-center">
                <!-- Home Icon -->
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center px-5 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wide hover:text-blue-600 hover:border-b-2 hover:border-blue-600 transition-all {{ request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                        <i class="bi bi-house-door-fill text-xl"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('berita.index') }}"
                        class="flex items-center gap-2 px-5 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wide hover:text-blue-600 hover:border-b-2 hover:border-blue-600 transition-all {{ request()->is('berita*') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                        Berita
                    </a>
                </li>

                <!-- Profil Dropdown -->
                <li class="relative group">
                    <a href="#" class="flex items-center gap-2 px-5 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wide hover:text-blue-600 transition-all">
                        Profil <i class="bi bi-chevron-down text-xs"></i>
                    </a>
                    <ul class="absolute left-1/2 transform -translate-x-1/2 top-full hidden group-hover:block bg-white shadow-lg rounded-b-lg min-w-[220px] py-2 z-50">
                        <li><a href="#" class="block px-5 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Sejarah</a></li>
                        <li><a href="#" class="block px-5 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Visi & Misi</a></li>
                        <li><a href="#" class="block px-5 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Struktur Organisasi</a></li>
                    </ul>
                </li>

                <!-- Informasi Dropdown -->
                <li class="relative group">
                    <a href="#" class="flex items-center gap-2 px-5 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wide hover:text-blue-600 transition-all">
                        Informasi <i class="bi bi-chevron-down text-xs"></i>
                    </a>
                    <ul class="absolute left-1/2 transform -translate-x-1/2 top-full hidden group-hover:block bg-white shadow-lg rounded-b-lg min-w-[220px] py-2 z-50">
                        <li><a href="#" class="block px-5 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Agenda Kegiatan</a></li>
                        <li><a href="#" class="block px-5 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Dokumen & Download</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"
                        class="flex items-center gap-2 px-5 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wide hover:text-blue-600 hover:border-b-2 hover:border-blue-600 transition-all">
                        Pengumuman
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="flex items-center gap-2 px-5 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wide hover:text-blue-600 hover:border-b-2 hover:border-blue-600 transition-all">
                        Layanan
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
        <ul class="py-2">
            <li><a href="{{ route('home') }}" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-gray-50 {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : '' }}"><i class="bi bi-house-door-fill"></i> Beranda</a></li>
            <li><a href="{{ route('berita.index') }}" class="block px-5 py-3 text-sm text-gray-700 hover:bg-gray-50 {{ request()->is('berita*') ? 'bg-blue-50 text-blue-600' : '' }}">Berita</a></li>

            <!-- Mobile Profil -->
            <li>
                <button class="mobile-dropdown-toggle w-full flex items-center justify-between px-5 py-3 text-sm text-gray-700 hover:bg-gray-50">
                    Profil <i class="bi bi-chevron-down text-xs"></i>
                </button>
                <ul class="mobile-dropdown-menu hidden bg-gray-50">
                    <li><a href="#" class="block px-10 py-2 text-sm text-gray-600 hover:text-blue-600">Sejarah</a></li>
                    <li><a href="#" class="block px-10 py-2 text-sm text-gray-600 hover:text-blue-600">Visi & Misi</a></li>
                    <li><a href="#" class="block px-10 py-2 text-sm text-gray-600 hover:text-blue-600">Struktur Organisasi</a></li>
                </ul>
            </li>

            <!-- Mobile Informasi -->
            <li>
                <button class="mobile-dropdown-toggle w-full flex items-center justify-between px-5 py-3 text-sm text-gray-700 hover:bg-gray-50">
                    Informasi <i class="bi bi-chevron-down text-xs"></i>
                </button>
                <ul class="mobile-dropdown-menu hidden bg-gray-50">
                    <li><a href="#" class="block px-10 py-2 text-sm text-gray-600 hover:text-blue-600">Agenda Kegiatan</a></li>
                    <li><a href="#" class="block px-10 py-2 text-sm text-gray-600 hover:text-blue-600">Dokumen & Download</a></li>
                </ul>
            </li>

            <li><a href="#" class="block px-5 py-3 text-sm text-gray-700 hover:bg-gray-50">Pengumuman</a></li>
            <li><a href="#" class="block px-5 py-3 text-sm text-gray-700 hover:bg-gray-50">Layanan</a></li>
        </ul>
    </div>
</header>

@push('scripts')
<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    // Mobile dropdown toggles
    document.querySelectorAll('.mobile-dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const menu = this.nextElementSibling;
            const icon = this.querySelector('.bi-chevron-down');
            menu.classList.toggle('hidden');
            icon.style.transform = menu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        });
    });
</script>
@endpush