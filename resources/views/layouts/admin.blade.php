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

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-slate-900 text-slate-100 flex flex-col shadow-2xl">
        <div class="px-6 py-6 border-b border-slate-800">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Panel Admin</p>
            <h2 class="text-2xl font-semibold mt-1">Admin Desa</h2>
            <p class="text-sm text-slate-400 mt-2">Kelola konten desa</p>
        </div>

        <div class="flex-1 px-4 py-6 overflow-y-auto">
            <nav class="space-y-2">

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center rounded-xl px-4 py-3 text-sm font-medium transition
                   {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500 text-white shadow' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                    Dashboard
                </a>

                {{-- PROFIL DESA --}}
                <details class="group rounded-xl"
                    {{ request()->routeIs('admin.village-profile.*', 'admin.organization-structures.*', 'admin.contacts.*') ? 'open' : '' }}>
                    <summary class="flex cursor-pointer list-none items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold text-slate-200 hover:bg-slate-800">
                        <span>Profil Desa</span>
                        <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>

                    <div class="mt-1 space-y-1 px-2 pb-2">
                        <a href="{{ route('admin.village-profile.edit') }}"
                           class="block rounded-lg px-4 py-2 text-sm transition
                           {{ request()->routeIs('admin.village-profile.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Profil Desa
                        </a>

                        <a href="{{ route('admin.organization-structures.index') }}"
                           class="block rounded-lg px-4 py-2 text-sm transition
                           {{ request()->routeIs('admin.organization-structures.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Struktur Organisasi
                        </a>

                        <a href="{{ route('admin.contacts.index') }}"
                           class="block rounded-lg px-4 py-2 text-sm transition
                           {{ request()->routeIs('admin.contacts.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Kontak
                        </a>
                    </div>
                </details>

                {{-- KONTEN --}}
                <details class="group rounded-xl"
                    {{ request()->routeIs('admin.village-galleries.*', 'admin.news.*', 'admin.announcements.*') ? 'open' : '' }}>
                    <summary class="flex cursor-pointer list-none items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold text-slate-200 hover:bg-slate-800">
                        <span>Informasi</span>
                        <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>

                    <div class="mt-1 space-y-1 px-2 pb-2">
                        <a href="{{ route('admin.village-galleries.index') }}"
                           class="block rounded-lg px-4 py-2 text-sm transition
                           {{ request()->routeIs('admin.village-galleries.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Slider / Galeri
                        </a>

                        <a href="{{ route('admin.news.index') }}"
                           class="block rounded-lg px-4 py-2 text-sm transition
                           {{ request()->routeIs('admin.news.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Berita
                        </a>

                        <a href="{{ route('admin.announcements.index') }}"
                           class="block rounded-lg px-4 py-2 text-sm transition
                           {{ request()->routeIs('admin.announcements.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Pengumuman
                        </a>
                    </div>
                </details>

                {{-- LAYANAN --}}
                <details class="group rounded-xl"
                    {{ request()->routeIs('admin.budget-reports.*', 'admin.umkms.*', 'admin.messages.*') ? 'open' : '' }}>
                    <summary class="flex cursor-pointer list-none items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold text-slate-200 hover:bg-slate-800">
                        <span>Layanan & Data</span>
                        <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>

                    <div class="mt-1 space-y-1 px-2 pb-2">
                        <a href="{{ route('admin.budget-reports.index') }}"
                           class="block rounded-lg px-4 py-2 text-sm transition
                           {{ request()->routeIs('admin.budget-reports.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            APBDes
                        </a>

                        <a href="{{ route('admin.umkms.index') }}"
                           class="block rounded-lg px-4 py-2 text-sm transition
                           {{ request()->routeIs('admin.umkms.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            UMKM
                        </a>

                        <a href="{{ route('admin.population-statistics.index') }}"
                           class="block rounded-lg px-4 py-2 text-sm transition
                           {{ request()->routeIs('admin.umkms.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Data Penduduk
                        </a>

                        <a href="{{ route('admin.messages.index') }}"
                           class="block rounded-lg px-4 py-2 text-sm transition
                           {{ request()->routeIs('admin.messages.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Pesan Masuk
                        </a>
                    </div>
                </details>

            </nav>
        </div>

        {{-- LOGOUT --}}
        <div class="px-4 py-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full rounded-xl bg-red-500 px-4 py-3 text-sm font-medium text-white hover:bg-red-600 transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="flex-1 p-6 md:p-8">
        @include('components.flash-message')

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 p-6">
            @yield('content')
        </div>
    </main>

</div>
</body>
</html>