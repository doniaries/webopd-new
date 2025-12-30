@php
use App\Models\Pengaturan;
$pengaturan = Pengaturan::first();
$siteName = $pengaturan->name ?? config('app.name');
$logoUrl = $pengaturan->logo ? asset('storage/settings/' . basename($pengaturan->logo)) : asset('images/logo.png');
@endphp

<header
    x-data="{ scrolled: false }"
    @scroll.window="scrolled = (window.pageYOffset > 50)"
    class="sticky top-0 z-50 bg-white dark:bg-gray-900 shadow-sm transition-all duration-300 ease-in-out"
    :class="{'shadow-md': scrolled}">
    <!-- Top Bar -->
    <div class="border-b border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between transition-all duration-300 ease-in-out"
                :class="{'py-1': scrolled, 'py-3': !scrolled}">
                <!-- Logo Group -->
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 border-r border-gray-200 dark:border-gray-700 pr-4 transition-all duration-300">
                        <img src="{{ $logoUrl }}" alt="Logo"
                            class="w-auto h-12 object-contain transition-all duration-300 ease-in-out"
                            :class="{'!h-9': scrolled}"
                            onerror="this.src='{{ asset('images/logo.png') }}'">
                        <div class="flex flex-col justify-center">
                            <span class="text-[10px] sm:text-xs text-gray-600 dark:text-gray-400 uppercase transition-all duration-300"
                                :class="{'opacity-0 h-0 overflow-hidden': scrolled}">Pemerintah Kabupaten {{ $pengaturan->kabupaten ?? 'Sijunjung' }}</span>
                            <h1 class="text-xs sm:text-base font-bold text-gray-900 dark:text-white uppercase leading-tight transition-all duration-300"
                                :class="{'!text-sm': scrolled}">{{ $siteName }}</h1>
                        </div>
                    </a>

                    <!-- Partner Logos (Desktop) -->
                    <div class="hidden lg:flex items-center gap-4 transition-all duration-300">
                        <img src="{{ asset('images/bangga.png') }}" alt="Bangga"
                            class="w-auto h-8 transition-all duration-300 ease-in-out"
                            :class="{'!h-6': scrolled}">
                        <img src="{{ asset('images/berakhlak.png') }}" alt="Berakhlak"
                            class="w-auto h-8 transition-all duration-300 ease-in-out"
                            :class="{'!h-6': scrolled}">
                    </div>
                </div>

                <!-- Dark Mode Toggle & Mobile Menu -->
                <div class="flex items-center gap-2">
                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" class="p-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors" aria-label="Toggle dark mode">
                        <i class="bi bi-sun-fill text-xl hidden dark:block"></i>
                        <i class="bi bi-moon-fill text-xl block dark:hidden"></i>
                    </button>

                    <!-- Mobile Menu Toggle -->
                    <button id="mobile-menu-toggle" class="lg:hidden p-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                        <i class="bi bi-list text-3xl"></i>
                    </button>
                </div>
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
                        class="flex items-center px-5 py-4 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide hover:text-blue-600 dark:hover:text-blue-400 hover:border-b-2 hover:border-blue-600 dark:hover:border-blue-400 transition-all {{ request()->routeIs('home') ? 'text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : '' }}">
                        <i class="bi bi-house-door-fill text-xl"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('berita.index') }}"
                        class="flex items-center gap-2 px-5 py-4 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide hover:text-blue-600 dark:hover:text-blue-400 hover:border-b-2 hover:border-blue-600 dark:hover:border-blue-400 transition-all {{ request()->is('berita*') ? 'text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : '' }}">
                        Berita
                    </a>
                </li>

                <!-- Profil Dropdown -->
                <li class="relative group">
                    <a href="#" class="flex items-center gap-2 px-5 py-4 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide hover:text-blue-600 dark:hover:text-blue-400 transition-all">
                        Profil <i class="bi bi-chevron-down text-xs"></i>
                    </a>
                    <ul class="absolute left-1/2 transform -translate-x-1/2 top-full hidden group-hover:block bg-white dark:bg-gray-800 shadow-lg rounded-b-lg min-w-[220px] py-2 z-50 border border-gray-200 dark:border-gray-700">
                        <!-- <li><a href="{{ route('home') }}#sejarah" class="block px-5 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400">Sejarah</a></li> -->

                        <li><a href="{{ route('struktur-organisasi') }}" class="block px-5 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400">Struktur Organisasi</a></li>
                    </ul>
                </li>

                <!-- Informasi Dropdown -->
                <li class="relative group">
                    <a href="#" class="flex items-center gap-2 px-5 py-4 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide hover:text-blue-600 dark:hover:text-blue-400 transition-all">
                        Informasi <i class="bi bi-chevron-down text-xs"></i>
                    </a>
                    <ul class="absolute left-1/2 transform -translate-x-1/2 top-full hidden group-hover:block bg-white dark:bg-gray-800 shadow-lg rounded-b-lg min-w-[220px] py-2 z-50 border border-gray-200 dark:border-gray-700">
                        <li><a href="{{ route('agenda.index') }}" class="block px-5 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400">Agenda Kegiatan</a></li>
                        <li><a href="{{ route('dokumen.index') }}" class="block px-5 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400">Dokumen & Download</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('gallery.index') }}"
                        class="flex items-center gap-2 px-5 py-4 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide hover:text-blue-600 dark:hover:text-blue-400 hover:border-b-2 hover:border-blue-600 dark:hover:border-blue-400 transition-all {{ request()->routeIs('gallery.index') ? 'text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : '' }}">
                        Galeri
                    </a>
                </li>

                <li>
                    <a href="{{ route('pengumuman.index') }}"
                        class="flex items-center gap-2 px-5 py-4 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide hover:text-blue-600 dark:hover:text-blue-400 hover:border-b-2 hover:border-blue-600 dark:hover:border-blue-400 transition-all {{ request()->is('pengumuman*') ? 'text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : '' }}">
                        Pengumuman
                    </a>
                </li>

                <li>
                    <a href="{{ route('home') }}#layanan"
                        class="flex items-center gap-2 px-5 py-4 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide hover:text-blue-600 dark:hover:text-blue-400 hover:border-b-2 hover:border-blue-600 dark:hover:border-blue-400 transition-all">
                        Layanan
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
        <ul class="py-2">
            <li><a href="{{ route('home') }}" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 {{ request()->routeIs('home') ? 'bg-blue-50 dark:bg-gray-800 text-blue-600 dark:text-blue-400' : '' }}"><i class="bi bi-house-door-fill"></i> Beranda</a></li>
            <li><a href="{{ route('berita.index') }}" class="block px-5 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 {{ request()->is('berita*') ? 'bg-blue-50 dark:bg-gray-800 text-blue-600 dark:text-blue-400' : '' }}">Berita</a></li>

            <!-- Mobile Profil -->
            <li>
                <button class="mobile-dropdown-toggle w-full flex items-center justify-between px-5 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800">
                    Profil <i class="bi bi-chevron-down text-xs"></i>
                </button>
                <ul class="mobile-dropdown-menu hidden bg-gray-50 dark:bg-gray-800">
                    <li><a href="{{ route('home') }}#sejarah" class="block px-10 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">Sejarah</a></li>
                    <li><a href="{{ route('home') }}#visi-misi" class="block px-10 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">Visi & Misi</a></li>
                    <li><a href="{{ route('struktur-organisasi') }}" class="block px-10 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">Struktur Organisasi</a></li>
                </ul>
            </li>

            <!-- Mobile Informasi -->
            <li>
                <button class="mobile-dropdown-toggle w-full flex items-center justify-between px-5 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800">
                    Informasi <i class="bi bi-chevron-down text-xs"></i>
                </button>
                <ul class="mobile-dropdown-menu hidden bg-gray-50 dark:bg-gray-800">
                    <li><a href="{{ route('agenda.index') }}" class="block px-10 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">Agenda Kegiatan</a></li>
                    <li><a href="{{ route('dokumen.index') }}" class="block px-10 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">Dokumen & Download</a></li>
                </ul>
            </li>

            <!-- Mobile Galeri -->
            <li><a href="{{ route('gallery.index') }}" class="block px-5 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 {{ request()->routeIs('gallery.index') ? 'bg-blue-50 dark:bg-gray-800 text-blue-600 dark:text-blue-400' : '' }}">Galeri</a></li>

            <li><a href="{{ route('pengumuman.index') }}" class="block px-5 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 {{ request()->is('pengumuman*') ? 'bg-blue-50 dark:bg-gray-800 text-blue-600 dark:text-blue-400' : '' }}">Pengumuman</a></li>
            <li><a href="{{ route('home') }}#layanan" class="block px-5 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800">Layanan</a></li>
        </ul>
    </div>
</header>

@push('scripts')
<script>
    // Theme toggle functionality
    const themeToggle = document.getElementById('theme-toggle');

    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');

            if (isDark) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });
    }

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