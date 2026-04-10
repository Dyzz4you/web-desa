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
                    Pemerintahan Desa
                </span>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 md:text-5xl">
                    Struktur Organisasi Desa
                </h1>
                <p class="mt-4 text-base leading-7 text-slate-600 md:text-lg">
                    Informasi susunan aparatur dan struktur organisasi desa yang bertugas dalam
                    menjalankan pelayanan, pemerintahan, dan pembangunan desa.
                </p>
            </div>

            @if($organizations->count())
                {{-- Highlight --}}
                <div class="mb-8 overflow-hidden rounded-[28px] bg-gradient-to-r from-emerald-600 via-teal-500 to-sky-500 shadow-xl">
                    <div class="grid gap-6 px-6 py-8 text-white md:grid-cols-3 md:px-10 md:py-10">
                        <div>
                            <p class="text-sm font-medium text-white/80">Informasi</p>
                            <h2 class="mt-2 text-3xl font-bold md:text-4xl">
                                Aparatur Desa
                            </h2>
                            <p class="mt-3 text-sm leading-7 text-white/90">
                                Struktur organisasi ini menampilkan susunan perangkat desa beserta jabatan
                                dan tugas umumnya dalam pelayanan kepada masyarakat.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                            <p class="text-sm text-white/80">Total Personel</p>
                            <h3 class="mt-2 text-3xl font-bold">
                                {{ $organizations->count() }}
                            </h3>
                            <p class="mt-2 text-sm text-white/85">
                                Jumlah aparatur yang ditampilkan dalam struktur organisasi.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                            <p class="text-sm text-white/80">Layanan Publik</p>
                            <h3 class="mt-2 text-2xl font-bold">
                                Aktif & Terstruktur
                            </h3>
                            <p class="mt-2 text-sm text-white/85">
                                Susunan jabatan disajikan agar masyarakat lebih mudah mengenali perangkat desa.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Grid Struktur --}}
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @forelse($organizations as $item)
                        <div class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <div class="text-center">
                                @if($item->photo)
                                    <div class="mx-auto mb-5 h-28 w-28 overflow-hidden rounded-full ring-4 ring-emerald-100">
                                        <img
                                            src="{{ asset('storage/' . $item->photo) }}"
                                            alt="{{ $item->name }}"
                                            class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                        >
                                    </div>
                                @else
                                    <div class="mx-auto mb-5 flex h-28 w-28 items-center justify-center rounded-full bg-gradient-to-br from-emerald-100 to-sky-100 ring-4 ring-emerald-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M5.121 17.804A9 9 0 1118.88 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                @endif

                                <h3 class="text-xl font-bold text-slate-900">
                                    {{ $item->name }}
                                </h3>

                                <div class="mt-2 inline-flex rounded-full bg-emerald-50 px-4 py-1.5 text-sm font-semibold text-emerald-700">
                                    {{ $item->position }}
                                </div>

                                @if($item->description)
                                    <p class="mt-4 text-sm leading-6 text-slate-600">
                                        {{ $item->description }}
                                    </p>
                                @else
                                    <p class="mt-4 text-sm leading-6 text-slate-400 italic">
                                        Belum ada deskripsi jabatan.
                                    </p>
                                @endif
                            </div>
                        </div>
                    @empty
                        {{-- kosong --}}
                    @endforelse
                </div>
            @else
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                    <h2 class="text-2xl font-bold text-slate-800">Belum Ada Data Struktur Organisasi</h2>
                    <p class="mt-3 text-slate-500">
                        Data struktur organisasi desa belum tersedia. Silakan cek kembali nanti.
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection