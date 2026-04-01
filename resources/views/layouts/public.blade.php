<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Web Desa' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-bold">Web Desa</a>

            <nav class="space-x-4">
                <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
                <a href="{{ route('posts.index') }}" class="hover:text-blue-600">Berita</a>
                <a href="#umkm" class="hover:text-blue-600">UMKM</a>
                <a href="#kontak" class="hover:text-blue-600">Kontak</a>
                <a href="{{ route('login') }}" class="hover:text-blue-600">Login</a>
            </nav>
        </div>
    </header>

    @include('components.flash-message')

    <main>
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-white mt-16">
        <div class="container mx-auto px-4 py-8 text-center">
            <p>&copy; {{ date('Y') }} Web Desa. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>