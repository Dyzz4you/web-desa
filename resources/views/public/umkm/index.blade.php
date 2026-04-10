@extends('layouts.public')

@section('content')
    <section class="relative overflow-hidden bg-slate-50 py-16 lg:py-20">
        {{-- Background dekor --}}
        <div class="absolute inset-0">
            <div class="absolute -top-20 -left-16 h-72 w-72 rounded-full bg-emerald-100/70 blur-3xl"></div>
            <div class="absolute top-24 right-0 h-80 w-80 rounded-full bg-lime-100/70 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 h-64 w-64 rounded-full bg-yellow-100/40 blur-3xl"></div>
        </div>

        <div class="container relative mx-auto px-4">
            {{-- Header --}}
            <div class="mb-10 max-w-3xl">
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                    Ekonomi Desa
                </span>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 md:text-5xl">
                    UMKM Desa
                </h1>
                <p class="mt-4 text-base leading-7 text-slate-600 md:text-lg">
                    Daftar pelaku usaha mikro, kecil, dan menengah di desa yang berperan
                    dalam menggerakkan ekonomi masyarakat.
                </p>
            </div>

            {{-- Highlight --}}
            <div class="mb-8 overflow-hidden rounded-[28px] bg-gradient-to-r from-emerald-600 via-green-500 to-lime-500 shadow-xl">
                <div class="grid gap-6 px-6 py-8 text-white md:grid-cols-2 md:px-10 md:py-10">
                    <div>
                        <p class="text-sm font-medium text-white/80">Potensi Desa</p>
                        <h2 class="mt-2 text-3xl font-bold md:text-4xl">
                            UMKM Aktif
                        </h2>
                        <p class="mt-3 text-sm leading-7 text-white/90">
                            UMKM desa menjadi salah satu pilar penting dalam pertumbuhan ekonomi
                            dan kemandirian masyarakat lokal.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                            <p class="text-sm text-white/80">Total UMKM</p>
                            <h3 class="mt-2 text-3xl font-bold">{{ $umkms->total() }}</h3>
                        </div>
                        <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                            <p class="text-sm text-white/80">Kategori</p>
                            <h3 class="mt-2 text-lg font-bold">
                                {{ $category ?: 'Semua' }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Filter --}}
            <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-4 shadow-sm md:p-5">
                <form method="GET" action="{{ request()->url() }}" class="grid gap-4 md:grid-cols-3">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari UMKM..."
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 focus:border-emerald-400 focus:ring-emerald-400"
                    >

                    <select
                        name="category"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 focus:border-emerald-400 focus:ring-emerald-400"
                        onchange="this.form.submit()"
                    >
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $item)
                            <option value="{{ $item }}" @selected($category === $item)>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-emerald-500 px-4 py-3 text-sm font-semibold text-white hover:bg-emerald-600 transition"
                        >
                            Cari
                        </button>

                        @if($search || $category)
                            <a
                                href="{{ request()->url() }}"
                                class="w-full text-center rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition"
                            >
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- List UMKM --}}
            @if($umkms->count())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($umkms as $umkm)
                        <div class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            {{-- Foto --}}
                            <div class="relative">
                                @if($umkm->photo)
                                    <img
                                        src="{{ asset('storage/' . $umkm->photo) }}"
                                        alt="{{ $umkm->name }}"
                                        class="h-48 w-full object-cover transition duration-300 group-hover:scale-105"
                                    >
                                @else
                                    <div class="flex h-48 w-full items-center justify-center bg-gradient-to-br from-emerald-100 via-lime-100 to-yellow-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 7h18M6 12h12M8 17h8" />
                                        </svg>
                                    </div>
                                @endif

                                {{-- Badge kategori --}}
                                <div class="absolute left-4 top-4">
                                    <span class="inline-flex rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-emerald-700 shadow-sm backdrop-blur">
                                        {{ $umkm->category }}
                                    </span>
                                </div>
                            </div>

                            {{-- Konten --}}
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-slate-900 line-clamp-2">
                                    {{ $umkm->name }}
                                </h3>

                                <p class="mt-2 text-sm text-slate-600">
                                    <span class="font-medium">Pemilik:</span>
                                    {{ $umkm->owner_name ?? '-' }}
                                </p>

                                <p class="mt-3 text-sm text-slate-600 line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit($umkm->description, 120) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $umkms->links() }}
                </div>
            @else
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                    <h2 class="text-2xl font-bold text-slate-800">
                        Data UMKM Tidak Ditemukan
                    </h2>
                    <p class="mt-3 text-slate-500">
                        {{ ($search || $category) ? 'Coba ubah filter pencarian.' : 'Belum ada data UMKM yang tersedia.' }}
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection