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

<footer class="bg-gradient-to-b from-slate-950 via-blue-950 to-slate-900 text-white mt-16">
    <div class="container mx-auto px-4 py-10 grid md:grid-cols-2 lg:grid-cols-5 gap-8">
        
        <!-- Profil Desa -->
        <div class="lg:col-span-1">
            <h3 class="text-lg font-bold leading-tight">
                {{ $profile->village_name ?? 'Web Desa' }}
            </h3>
            <p class="text-sm text-blue-200 mb-3">
                Kabupaten Sukoharjo
            </p>

            <div class="inline-block bg-blue-600/70 px-3 py-2 rounded text-sm leading-relaxed text-white">
                {{ $profile->address ?? 'Alamat belum tersedia' }}
            </div>

            <div class="mt-4 space-y-1 text-sm text-slate-300">
                <p>{{ $profile->email ?? 'Email belum tersedia' }}</p>
                <p>{{ $profile->phone ?? 'Telepon belum tersedia' }}</p>
            </div>
        </div>

        <!-- Navigasi -->
        <div>
            <h3 class="text-lg font-bold mb-3 uppercase tracking-wide">Navigasi</h3>
            <ul class="space-y-2 text-sm text-slate-300">
                <li><a href="{{ route('home') }}" class="hover:text-blue-300 transition">Beranda</a></li>
                <li><a href="{{ route('profile.about') }}" class="hover:text-blue-300 transition">Tentang Desa</a></li>
                <li><a href="{{ route('profile.organization') }}" class="hover:text-blue-300 transition">Struktur Organisasi</a></li>
                <li><a href="{{ route('contact.index') }}" class="hover:text-blue-300 transition">Kontak</a></li>
            </ul>
        </div>

        <!-- Informasi -->
        <div>
            <h3 class="text-lg font-bold mb-3 uppercase tracking-wide">Informasi</h3>
            <ul class="space-y-2 text-sm text-slate-300">
                <li><a href="{{ route('information.news.index') }}" class="hover:text-blue-300 transition">Berita</a></li>
                <li><a href="{{ route('information.announcements.index') }}" class="hover:text-blue-300 transition">Pengumuman</a></li>
                <li><a href="{{ route('budget.index') }}" class="hover:text-blue-300 transition">APBDes</a></li>
                <li><a href="{{ route('population.index') }}" class="hover:text-blue-300 transition">Data Penduduk</a></li>
            </ul>
        </div>

        <!-- Layanan -->
        <div>
            <h3 class="text-lg font-bold mb-3 uppercase tracking-wide">Layanan</h3>
            <ul class="space-y-2 text-sm text-slate-300">
                <li><a href="{{ route('public.umkm.index') }}" class="hover:text-blue-300 transition">UMKM</a></li>
                <li><a href="{{ route('contact.index') }}" class="hover:text-blue-300 transition">Layanan Informasi</a></li>
                <li><a href="{{ route('budget.index') }}" class="hover:text-blue-300 transition">Transparansi Anggaran</a></li>
                <li><a href="{{ route('profile.about') }}" class="hover:text-blue-300 transition">Profil Desa</a></li>
            </ul>
        </div>

        <!-- Jadwal / Info Tambahan -->
        <div>
            <h3 class="text-lg font-bold mb-3 uppercase tracking-wide">Jadwal Pelayanan</h3>
            <ul class="space-y-2 text-sm text-slate-300 leading-relaxed">
                <li>Senin - Kamis: 07.30 - 15.00 WIB</li>
                <li>Jumat: 07.30 - 11.00 WIB</li>
                <li>Sabtu: Libur</li>
            </ul>
        </div>
    </div>

    <div class="border-t border-white/10 text-center text-sm text-slate-400 py-4">
        &copy; {{ date('Y') }} {{ $profile->village_name ?? 'Web Desa' }}. All rights reserved.
    </div>
</footer>
</body>
</html>