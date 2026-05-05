<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="https://actores.org.co/favicon.ico" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white text-gray-900">
    <div class="min-h-screen">
        <div class="sticky top-0 z-50 bg-white/80 backdrop-blur-md">
            <livewire:layout.navigation />
        </div>


        <main class="bg-white">
            <div class="max-w-7xl mx-auto pb-6">
                {{ $slot }}
            </div>
        </main>

        <footer class="py-10 border-t border-gray-50 text-center">
            <p class="text-xs text-gray-300 font-medium tracking-widest uppercase">
                &copy; {{ date('Y') }} Actores S.C.G. • Área de Tecnología
            </p>
        </footer>
    </div>
</body>

</html>