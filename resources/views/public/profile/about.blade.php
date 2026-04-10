@extends('layouts.public')

@section('content')
    <section class="relative overflow-hidden bg-slate-50 py-16 lg:py-20">
        {{-- Background --}}
        <div class="absolute inset-0">
            <div class="absolute -top-20 -left-16 h-72 w-72 rounded-full bg-emerald-100/70 blur-3xl"></div>
            <div class="absolute top-24 right-0 h-80 w-80 rounded-full bg-sky-100/70 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 h-64 w-64 rounded-full bg-cyan-100/40 blur-3xl"></div>
        </div>

        <div class="container relative mx-auto px-4">
            {{-- Header --}}
            <div class="mb-10 max-w-3xl">
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                    Profil Desa
                </span>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 md:text-5xl">
                    Tentang Desa {{ $profile->village_name ?? '' }}
                </h1>
                <p class="mt-4 text-base leading-7 text-slate-600 md:text-lg">
                    Informasi umum mengenai sejarah, visi, misi, serta identitas desa sebagai
                    gambaran arah pembangunan dan karakter desa.
                </p>
            </div>

            {{-- Highlight --}}
            <div class="mb-8 overflow-hidden rounded-[28px] bg-gradient-to-r from-emerald-600 via-teal-500 to-sky-500 shadow-xl">
                <div class="grid gap-6 px-6 py-8 text-white md:grid-cols-2 md:px-10 md:py-10">
                    <div>
                        <p class="text-sm font-medium text-white/80">Nama Desa</p>
                        <h2 class="mt-2 text-3xl font-bold md:text-4xl">
                            {{ $profile->village_name ?? '-' }}
                        </h2>
                        <p class="mt-3 text-sm leading-7 text-white/90">
                            Desa ini memiliki karakteristik dan potensi yang berkembang
                            seiring dengan sejarah serta partisipasi masyarakatnya.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                        <p class="text-sm text-white/80">Informasi Umum</p>
                        <p class="mt-2 text-sm leading-6 text-white/90">
                            Halaman ini berisi profil desa yang mencakup sejarah,
                            visi dan misi, serta identitas desa.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Sejarah --}}
            <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-900 mb-4">Sejarah Desa</h2>
                <div class="prose max-w-none text-slate-700 whitespace-pre-line leading-relaxed">
                    {{ $profile->history ?? $profile->about ?? 'Data belum tersedia.' }}
                </div>
            </div>

            {{-- Visi Misi --}}
            <div class="mb-8 grid gap-6 md:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Visi</h2>
                    <p class="text-slate-700 leading-relaxed">
                        {{ $profile->vision ?? 'Belum tersedia.' }}
                    </p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Misi</h2>
                    <div class="text-slate-700 whitespace-pre-line leading-relaxed">
                        {{ $profile->mission ?? 'Belum tersedia.' }}
                    </div>
                </div>
            </div>

            {{-- Identitas --}}
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-900 mb-4">Identitas Desa</h2>
                <div class="text-slate-700 whitespace-pre-line leading-relaxed">
                    {{ $profile->identity ?? 'Belum tersedia.' }}
                </div>
            </div>

            {{-- Empty fallback --}}
            @if(!$profile)
                <div class="mt-8 rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                    <h2 class="text-2xl font-bold text-slate-800">Profil Desa Belum Tersedia</h2>
                    <p class="mt-3 text-slate-500">
                        Data profil desa belum tersedia. Silakan cek kembali nanti.
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection