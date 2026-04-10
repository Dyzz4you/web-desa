@extends('layouts.public')

@section('content')
    <section class="relative overflow-hidden bg-slate-50 py-16 lg:py-20">
        <div class="absolute inset-0">
            <div class="absolute -top-20 -left-16 h-72 w-72 rounded-full bg-emerald-100/70 blur-3xl"></div>
            <div class="absolute top-24 right-0 h-80 w-80 rounded-full bg-sky-100/70 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 h-64 w-64 rounded-full bg-cyan-100/40 blur-3xl"></div>
        </div>

        <div class="container relative mx-auto px-4">
            {{-- Header --}}
            <div class="mb-10 max-w-3xl">
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                    Informasi Desa
                </span>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 md:text-5xl">
                    Berita Desa
                </h1>
                <p class="mt-4 text-base leading-7 text-slate-600 md:text-lg">
                    Ikuti informasi terbaru, kegiatan desa, pengumuman penting, dan berbagai kabar
                    terkini yang terjadi di lingkungan desa.
                </p>
            </div>

            {{-- Highlight --}}
            <div class="mb-8 overflow-hidden rounded-[28px] bg-gradient-to-r from-emerald-600 via-teal-500 to-sky-500 shadow-xl">
                <div class="grid gap-6 px-6 py-8 text-white md:grid-cols-2 md:px-10 md:py-10">
                    <div>
                        <p class="text-sm font-medium text-white/80">Pusat Informasi</p>
                        <h2 class="mt-2 text-3xl font-bold md:text-4xl">
                            Kabar & Kegiatan Desa
                        </h2>
                        <p class="mt-3 text-sm leading-7 text-white/90">
                            Halaman ini menampilkan berita desa yang telah dipublikasikan agar
                            masyarakat dapat memperoleh informasi secara cepat dan mudah.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                            <p class="text-sm text-white/80">Total Berita</p>
                            <h3 class="mt-2 text-3xl font-bold">{{ $posts->total() }}</h3>
                        </div>
                        <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                            <p class="text-sm text-white/80">Pencarian</p>
                            <h3 class="mt-2 text-lg font-bold">
                                {{ $search ? 'Aktif' : 'Semua Berita' }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Search --}}
            <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-4 shadow-sm md:p-5">
                <form method="GET" action="{{ route('information.news.index') }}" class="flex flex-col gap-3 md:flex-row md:items-center">
                    <div class="relative flex-1">
                        <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari berita desa..."
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-12 pr-4 text-slate-700 placeholder:text-slate-400 focus:border-emerald-400 focus:ring-emerald-400"
                        >
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-2xl bg-emerald-500 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-600 transition"
                        >
                            Cari
                        </button>

                        @if($search)
                            <a
                                href="{{ route('information.news.index') }}"
                                class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition"
                            >
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- List News --}}
            @if($posts->count())
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($posts as $post)
                        <article class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <a href="{{ route('information.news.show', $post->slug) }}" class="block">
                                <div class="relative">
                                    @if($post->thumbnail)
                                        <img
                                            src="{{ asset('storage/' . $post->thumbnail) }}"
                                            alt="{{ $post->title }}"
                                            class="h-56 w-full object-cover transition duration-300 group-hover:scale-105"
                                        >
                                    @else
                                        <div class="flex h-56 w-full items-center justify-center bg-gradient-to-br from-emerald-100 via-sky-100 to-cyan-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h8a2 2 0 012 2v14a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="absolute left-4 top-4 inline-flex rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-emerald-700 shadow-sm backdrop-blur">
                                        {{ $post->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </a>

                            <div class="p-6">
                                <h3 class="line-clamp-2 text-xl font-bold leading-snug text-slate-900">
                                    <a href="{{ route('information.news.show', $post->slug) }}" class="hover:text-emerald-700 transition">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">
                                    {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content), 140) }}
                                </p>

                                <div class="mt-5 flex items-center justify-between">
                                    <a href="{{ route('information.news.show', $post->slug) }}"
                                       class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-800">
                                        Baca Selengkapnya
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                    <h2 class="text-2xl font-bold text-slate-800">
                        {{ $search ? 'Berita Tidak Ditemukan' : 'Belum Ada Berita' }}
                    </h2>
                    <p class="mt-3 text-slate-500">
                        {{ $search ? 'Coba gunakan kata kunci lain untuk pencarian berita desa.' : 'Berita desa belum tersedia saat ini.' }}
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection