<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RYB Vehicle Trading</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/home.js'])
</head>
<body class="font-sans antialiased bg-ryb-black text-ryb-light min-h-screen flex flex-col">
    
    @include('layouts.navigation')

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-ryb-black border-t border-ryb-dark py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-ryb-light/70">
            &copy; {{ date('Y') }} RYB Vehicle Trading. All rights reserved.
        </div>
    </footer>
</body>
</html>