@extends('layouts.public')

@section('content')
    @php
        $embedUrl = null;

        if (!empty($profile?->map_embed)) {
            $embedUrl = trim($profile->map_embed);
        } elseif (!empty($profile?->google_maps_embed)) {
            $rawValue = trim($profile->google_maps_embed);

            if (str_contains($rawValue, 'google.com/maps/embed')) {
                $embedUrl = $rawValue;
            } else {
                $embedUrl = 'https://maps.google.com/maps?hl=id&q='
                    . urlencode($rawValue)
                    . '&t=h&z=13&ie=UTF8&iwloc=B&output=embed';
            }
        }
    @endphp

    <section class="relative overflow-hidden bg-slate-50 py-16 lg:py-20">
        {{-- Background blur --}}
        <div class="absolute inset-0">
            <div class="absolute -top-20 -left-16 h-72 w-72 rounded-full bg-emerald-100/70 blur-3xl"></div>
            <div class="absolute top-24 right-0 h-80 w-80 rounded-full bg-sky-100/70 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 h-64 w-64 rounded-full bg-cyan-100/40 blur-3xl"></div>
        </div>

        <div class="container relative mx-auto px-4">
            {{-- Header --}}
            <div class="mb-10 max-w-3xl">
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                    Lokasi Desa
                </span>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 md:text-5xl">
                    Peta Desa
                </h1>
                <p class="mt-4 text-base leading-7 text-slate-600 md:text-lg">
                    Informasi lokasi geografis desa yang dapat membantu masyarakat maupun pengunjung
                    dalam menemukan wilayah desa secara lebih mudah.
                </p>
            </div>

            {{-- Highlight --}}
            <div class="mb-8 overflow-hidden rounded-[28px] bg-gradient-to-r from-emerald-600 via-teal-500 to-sky-500 shadow-xl">
                <div class="grid gap-6 px-6 py-8 text-white md:grid-cols-2 md:px-10 md:py-10">
                    <div>
                        <p class="text-sm font-medium text-white/80">Informasi Lokasi</p>
                        <h2 class="mt-2 text-3xl font-bold md:text-4xl">
                            Wilayah Desa
                        </h2>
                        <p class="mt-3 text-sm leading-7 text-white/90">
                            Peta ini menunjukkan lokasi desa secara visual menggunakan peta digital
                            maupun gambar peta wilayah yang tersedia.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                        <p class="text-sm text-white/80">Akses Peta</p>
                        <p class="mt-2 text-sm leading-6 text-white/90">
                            Gunakan peta interaktif untuk memperbesar, menggeser, dan melihat detail lokasi desa.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Gambar Peta --}}
            @if($profile?->map_image)
                <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-lg font-semibold text-slate-900">Peta Wilayah Desa</h3>

                    <div class="overflow-hidden rounded-2xl">
                        <img
                            src="{{ asset('storage/' . $profile->map_image) }}"
                            alt="Peta Desa"
                            class="w-full object-cover transition duration-300 hover:scale-105"
                        >
                    </div>
                </div>
            @endif

            {{-- Google Maps --}}
            @if($embedUrl)
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Peta Interaktif</h3>
                            <p class="text-sm text-slate-500">
                                Gunakan peta ini untuk melihat lokasi desa secara langsung.
                            </p>
                        </div>

                        <a href="{{ $embedUrl }}" target="_blank"
                           class="hidden md:inline-flex rounded-xl bg-emerald-500 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-600 transition">
                            Buka di Google Maps
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-2xl">
                        <iframe
                            src="{{ $embedUrl }}"
                            class="w-full h-[450px] md:h-[520px]"
                            style="border:0;"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            @else
                {{-- Empty State --}}
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                    <h2 class="text-2xl font-bold text-slate-800">Peta Desa Belum Tersedia</h2>
                    <p class="mt-3 text-slate-500">
                        Data peta desa belum tersedia. Silakan cek kembali nanti.
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection