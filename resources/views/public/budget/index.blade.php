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
                    Transparansi Desa
                </span>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 md:text-5xl">
                    APBDes / Transparansi Anggaran
                </h1>
                <p class="mt-4 text-base leading-7 text-slate-600 md:text-lg">
                    Informasi anggaran desa yang disajikan secara terbuka agar masyarakat dapat
                    melihat dokumen dan laporan anggaran berdasarkan tahun yang tersedia.
                </p>
            </div>

            {{-- Highlight --}}
            <div class="mb-8 overflow-hidden rounded-[28px] bg-gradient-to-r from-emerald-600 via-teal-500 to-sky-500 shadow-xl">
                <div class="grid gap-6 px-6 py-8 text-white md:grid-cols-2 md:px-10 md:py-10">
                    <div>
                        <p class="text-sm font-medium text-white/80">Informasi Anggaran</p>
                        <h2 class="mt-2 text-3xl font-bold md:text-4xl">
                            Laporan APBDes
                        </h2>
                        <p class="mt-3 text-sm leading-7 text-white/90">
                            Halaman ini memuat dokumen transparansi anggaran desa yang dapat diakses
                            masyarakat sebagai bentuk keterbukaan informasi publik.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                            <p class="text-sm text-white/80">Total Laporan</p>
                            <h3 class="mt-2 text-3xl font-bold">{{ $budgetReports->total() }}</h3>
                        </div>
                        <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                            <p class="text-sm text-white/80">Filter Tahun</p>
                            <h3 class="mt-2 text-lg font-bold">
                                {{ $year ?: 'Semua Tahun' }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Filter --}}
            <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-4 shadow-sm md:p-5">
                <form method="GET" class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div class="w-full md:max-w-xs">
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Filter Tahun
                        </label>
                        <select
                            name="year"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 focus:border-emerald-400 focus:ring-emerald-400"
                            onchange="this.form.submit()"
                        >
                            <option value="">Semua Tahun</option>
                            @foreach($years as $item)
                                <option value="{{ $item }}" @selected((string) $year === (string) $item)>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if($year)
                        <div>
                            <a
                                href="{{url('/apbdes')}}"
                                class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition"
                            >
                                Reset Filter
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            {{-- Cards --}}
            @if($budgetReports->count())
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($budgetReports as $report)
                        <article class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <div class="relative">
                                @if($report->thumbnail)
                                    <img
                                        src="{{ asset('storage/' . $report->thumbnail) }}"
                                        alt="{{ $report->title }}"
                                        class="h-56 w-full object-cover transition duration-300 group-hover:scale-105"
                                    >
                                @else
                                    <div class="flex h-56 w-full items-center justify-center bg-gradient-to-br from-emerald-100 via-sky-100 to-cyan-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 7h18M6 12h12M8 17h8" />
                                        </svg>
                                    </div>
                                @endif

                                <div class="absolute left-4 top-4 flex flex-wrap gap-2">
                                    <span class="inline-flex rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-emerald-700 shadow-sm backdrop-blur">
                                        {{ $report->year }}
                                    </span>
                                    <span class="inline-flex rounded-full bg-emerald-500/90 px-3 py-1 text-xs font-semibold text-white shadow-sm backdrop-blur">
                                        {{ strtoupper($report->type) }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="line-clamp-2 text-xl font-bold leading-snug text-slate-900">
                                    {{ $report->title }}
                                </h3>

                                <p class="mt-3 line-clamp-4 text-sm leading-6 text-slate-600">
                                    {{ $report->description ?: 'Dokumen transparansi anggaran desa tersedia untuk dilihat atau diunduh.' }}
                                </p>

                                <div class="mt-6 flex items-center justify-between gap-3">
                                    @if($report->file)
                                        <a
                                            href="{{ asset('storage/' . $report->file) }}"
                                            target="_blank"
                                            class="inline-flex items-center gap-2 rounded-2xl bg-emerald-500 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-600 transition"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 16V4m0 12l-4-4m4 4l4-4M4 20h16" />
                                            </svg>
                                            Lihat File
                                        </a>
                                    @else
                                        <span class="inline-flex rounded-2xl bg-slate-100 px-4 py-2.5 text-sm font-medium text-slate-500">
                                            File belum tersedia
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $budgetReports->links() }}
                </div>
            @else
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                    <h2 class="text-2xl font-bold text-slate-800">
                        Belum Ada Data APBDes
                    </h2>
                    <p class="mt-3 text-slate-500">
                        Data transparansi anggaran belum tersedia untuk tahun yang dipilih.
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection