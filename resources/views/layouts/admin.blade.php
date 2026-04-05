<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-slate-900 text-white p-6">
            <h2 class="text-xl font-bold mb-6">Admin Desa</h2>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block hover:text-yellow-300">Dashboard</a>
                    <a href="{{ route('admin.village-profile.edit') }}" class="block hover:text-yellow-300">Profil Desa</a>
                    <a href="{{ route('admin.village-galleries.index') }}" class="block hover:text-yellow-300">Slider / Galeri</a>
                    <a href="{{ route('admin.organization-structures.index') }}" class="block hover:text-yellow-300">Struktur Organisasi</a>
                    <a href="{{ route('admin.news.index') }}" class="block hover:text-yellow-300">Berita</a>
                    <a href="{{ route('admin.announcements.index') }}" class="block hover:text-yellow-300">Pengumuman</a>
                    <a href="{{ route('admin.budget-reports.index') }}" class="block hover:text-yellow-300">APBDes</a>
                    <a href="{{ route('admin.umkms.index') }}" class="block hover:text-yellow-300">UMKM</a>
                    <a href="{{ route('admin.contacts.index') }}" class="block hover:text-yellow-300">Kontak</a>
                    <a href="{{ route('admin.messages.index') }}" class="block hover:text-yellow-300">Pesan Masuk</a>
                </nav>
        </aside>

        <main class="flex-1 p-6">
            @include('components.flash-message')
            @yield('content')
        </main>
    </div>
</body>
</html>