<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Radicación Angostura') }}</title>

        <link rel="icon" href="{{ asset('images/Angostura.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        {{-- Mensaje flotante de éxito (sin Alpine.js) --}}
        @if (session('success'))
            <div id="toast-success" 
                 class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg text-sm font-semibold opacity-0 transition-opacity duration-500 z-50">
                ✅ {{ session('success') }}
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const toast = document.getElementById('toast-success');
                    if (toast) {
                        // Mostrar con transición
                        setTimeout(() => toast.classList.add('opacity-100'), 100);
                        // Ocultar después de 4 segundos
                        setTimeout(() => toast.classList.remove('opacity-100'), 4000);
                        // Eliminar del DOM después de ocultarse
                        setTimeout(() => toast.remove(), 4500);
                    }
                });
            </script>
        @endif
    </body>
</html>
