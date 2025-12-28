@php
use App\Models\Pengaturan;
$pengaturan = Pengaturan::first();
$opdName = $pengaturan->name ?? config('app.name');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - ' . $opdName : $opdName }}</title>

    <!-- Theme Initialization (Prevent FOUC) -->
    <script>
        // Initialize theme before page renders
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @stack('styles')
</head>

<body class="flex flex-col min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    @include('partials.header')

    <main class="flex-1">
        {{ $slot }}
    </main>

    @include('partials.footer')

    <!-- Global Page Transition Loader -->
    <div x-data="{ loading: false }"
        x-init="
            Livewire.hook('commit', ({ succeed }) => {
                succeed(() => {
                    setTimeout(() => loading = false, 300); // Minimal delay for smoothness
                })
            });
            
            // Handle SPA navigation events
            document.addEventListener('livewire:navigate', () => loading = true);
            document.addEventListener('livewire:navigating', () => loading = true);
            document.addEventListener('livewire:navigated', () => setTimeout(() => loading = false, 300));
         "
        @beforeunload.window="loading = true"
        class="fixed inset-0 z-[99999] flex items-center justify-center bg-gray-50/80 dark:bg-gray-900/80 backdrop-blur-sm transition-opacity duration-300"
        x-show="loading"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="display: none;">

        <div class="relative flex flex-col items-center">
            <!-- Sophisticated Spinner -->
            <div class="relative w-24 h-24">
                <!-- Outer Ring -->
                <div class="absolute inset-0 rounded-full border-4 border-t-blue-600 border-r-transparent border-b-blue-600 border-l-transparent animate-spin"></div>
                <!-- Inner Ring -->
                <div class="absolute inset-2 rounded-full border-4 border-t-transparent border-r-purple-500 border-b-transparent border-l-purple-500 animate-spin-reverse"></div>
                <!-- Center Pulse -->
                <div class="absolute inset-8 rounded-full bg-blue-500/20 dark:bg-blue-400/20 animate-pulse"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="h-3 w-3 bg-blue-600 rounded-full animate-ping"></div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <p class="text-lg font-medium text-gray-700 dark:text-gray-200 animate-pulse">Memuat...</p>
                <div class="mt-2 flex space-x-1 justify-center">
                    <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce [animation-delay:-0.3s]"></div>
                    <div class="w-2 h-2 bg-purple-600 rounded-full animate-bounce [animation-delay:-0.15s]"></div>
                    <div class="w-2 h-2 bg-pink-600 rounded-full animate-bounce"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes spin-reverse {
            to {
                transform: rotate(-360deg);
            }
        }

        .animate-spin-reverse {
            animation: spin-reverse 1.5s linear infinite;
        }
    </style>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @livewireScripts
    @stack('scripts')
</body>

</html>