<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Web Desa' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl md:text-2xl font-bold text-green-700">
                {{ $profile->village_name ?? 'Web Desa' }}
            </a>

           <nav class="hidden md:flex items-center gap-6 text-sm font-medium" x-data="{ open: null }">

            <a href="{{ route('home') }}" class="hover:text-green-700">Beranda</a>

            <!-- PROFIL -->
            <div class="relative">
                <button 
                    @click="open === 'profil' ? open = null : open = 'profil'"
                    class="hover:text-green-700 focus:outline-none"
                >
                    Profil
                </button>

                <div 
                    x-show="open === 'profil'" 
                    @click.outside="open = null"
                    x-transition
                    class="absolute bg-white shadow-lg rounded-lg mt-2 w-56 p-2 z-50"
                >
                    <a href="{{ route('profile.about') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Tentang Desa</a>
                    <a href="{{ route('profile.organization') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Struktur Organisasi</a>
                    <a href="{{ route('profile.map') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Peta Desa</a>
                </div>
            </div>

            <!-- INFORMASI -->
            <div class="relative">
                <button 
                    @click="open === 'info' ? open = null : open = 'info'"
                    class="hover:text-green-700 focus:outline-none"
                >
                    Informasi
                </button>

                <div 
                    x-show="open === 'info'" 
                    @click.outside="open = null"
                    x-transition
                    class="absolute bg-white shadow-lg rounded-lg mt-2 w-56 p-2 z-50"
                >
                    <a href="{{ route('information.news.index') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Berita</a>
                    <a href="{{ route('information.announcements.index') }}" class="block px-4 py-2 hover:bg-gray-100 rounded">Pengumuman</a>
                </div>
            </div>

            <a href="{{ route('budget.index') }}" class="hover:text-green-700">APBDes</a>
            <a href="{{ route('public.umkm.index') }}" class="hover:text-green-700">UMKM</a>
            <a href="{{ route('population.index') }}" class="hover:text-green-700">Data Penduduk</a>
            <a href="{{ route('home') }}#galeri" class="hover:text-green-700">Galeri</a>
            <a href="{{ route('contact.index') }}" class="hover:text-green-700">Kontak</a>

            <a href="{{ route('login') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800">
                Login
            </a>
        </nav>
        </div>
    </header>

    @include('components.flash-message')

    <main>
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-white mt-16">
        <div class="container mx-auto px-4 py-10 grid md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-3">{{ $profile->village_name ?? 'Web Desa' }}</h3>
                <p class="text-sm text-slate-300">
                    Portal informasi resmi desa yang menampilkan profil desa, berita, UMKM, dan layanan informasi masyarakat.
                </p>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-3">Navigasi</h3>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('profile.about') }}" class="hover:text-white">Tentang Desa</a></li>
                    <li><a href="{{ route('profile.organization') }}" class="hover:text-white">Struktur Organisasi</a></li>
                    <li><a href="{{ route('information.news.index') }}" class="hover:text-white">Berita</a></li>
                    <li><a href="{{ route('information.announcements.index') }}" class="hover:text-white">Pengumuman</a></li>
                    <li><a href="{{ route('budget.index') }}" class="hover:text-white">APBDes</a></li>
                    <li><a href="{{ route('public.umkm.index') }}" class="hover:text-white">UMKM</a></li>
                    <li><a href="{{ route('population.index') }}" class="hover:text-white">Data Penduduk</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-white">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-3">Kontak</h3>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li>{{ $profile->address ?? 'Alamat belum tersedia' }}</li>
                    <li>{{ $profile->email ?? 'Email belum tersedia' }}</li>
                    <li>{{ $profile->phone ?? 'Telepon belum tersedia' }}</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-slate-700 text-center text-sm text-slate-400 py-4">
            &copy; {{ date('Y') }} {{ $profile->village_name ?? 'Web Desa' }}. All rights reserved.
        </div>
    </footer>
</body>
</html>