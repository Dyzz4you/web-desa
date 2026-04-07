<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">
    <div class="min-h-screen flex">
        <aside class="w-72 bg-slate-900 text-slate-100 flex flex-col shadow-2xl">
            <div class="px-6 py-6 border-b border-slate-800">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Panel Admin</p>
                <h2 class="text-2xl font-semibold mt-1">Admin Desa</h2>
                <p class="text-sm text-slate-400 mt-2">Kelola konten dan informasi desa</p>
            </div>

            <div class="flex-1 px-4 py-6">
                <nav class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white transition">
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.village-profile.edit') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white transition">
                        <span>Profil Desa</span>
                    </a>

                    <a href="{{ route('admin.village-galleries.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white transition">
                        <span>Slider / Galeri</span>
                    </a>

                    <a href="{{ route('admin.organization-structures.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white transition">
                        <span>Struktur Organisasi</span>
                    </a>

                    <a href="{{ route('admin.news.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white transition">
                        <span>Berita</span>
                    </a>

                    <a href="{{ route('admin.announcements.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white transition">
                        <span>Pengumuman</span>
                    </a>

                    <a href="{{ route('admin.budget-reports.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white transition">
                        <span>APBDes</span>
                    </a>

                    <a href="{{ route('admin.umkms.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white transition">
                        <span>UMKM</span>
                    </a>

                    <a href="{{ route('admin.contacts.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white transition">
                        <span>Kontak</span>
                    </a>

                    <a href="{{ route('admin.messages.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white transition">
                        <span>Pesan Masuk</span>
                    </a>
                </nav>
            </div>

            <div class="px-4 py-4 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full rounded-xl bg-slate-800 px-4 py-3 text-sm font-medium text-slate-100 hover:bg-slate-700 transition">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-8">
            @include('components.flash-message')

            <div class="rounded-2xl bg-white shadow-sm border border-slate-200 p-6">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>