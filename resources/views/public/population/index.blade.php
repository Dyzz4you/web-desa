@extends('layouts.public')

@section('content')
    @php
        $totalPopulation = $latestStatistic->total_population ?? 0;
        $maleCount = $latestStatistic->male_count ?? 0;
        $femaleCount = $latestStatistic->female_count ?? 0;
        $familyCount = $latestStatistic->family_count ?? 0;
        $birthCount = $latestStatistic->birth_count ?? 0;
        $deathCount = $latestStatistic->death_count ?? 0;
        $movedInCount = $latestStatistic->moved_in_count ?? 0;
        $movedOutCount = $latestStatistic->moved_out_count ?? 0;

        $malePercentage = $totalPopulation > 0 ? round(($maleCount / $totalPopulation) * 100, 1) : 0;
        $femalePercentage = $totalPopulation > 0 ? round(($femaleCount / $totalPopulation) * 100, 1) : 0;
        $avgFamilySize = $familyCount > 0 ? round($totalPopulation / $familyCount, 1) : 0;
        $netGrowth = ($birthCount + $movedInCount) - ($deathCount + $movedOutCount);
    @endphp

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
                    Statistik Kependudukan
                </span>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 md:text-5xl">
                    Data Penduduk Desa
                </h1>
                <p class="mt-4 text-base leading-7 text-slate-600 md:text-lg">
                    Informasi terbaru mengenai jumlah penduduk, komposisi gender, jumlah kepala keluarga,
                    serta dinamika pertumbuhan penduduk desa.
                </p>
            </div>

            @if($latestStatistic)
                {{-- Hero Summary --}}
                <div class="mb-8 overflow-hidden rounded-[28px] bg-gradient-to-r from-emerald-600 via-teal-500 to-sky-500 shadow-xl">
                    <div class="grid gap-8 px-6 py-8 text-white md:grid-cols-2 md:px-10 md:py-10">
                        <div>
                            <p class="text-sm font-medium text-white/80">Data Aktif Tahun</p>
                            <h2 class="mt-2 text-3xl font-bold md:text-4xl">
                                {{ $latestStatistic->year }}
                            </h2>
                            <p class="mt-4 max-w-2xl text-sm leading-7 text-white/90">
                                Statistik ini menampilkan kondisi kependudukan desa berdasarkan data aktif,
                                termasuk jumlah warga, komposisi gender, jumlah kepala keluarga,
                                serta pergerakan penduduk dalam periode tahun berjalan.
                            </p>

                            @if(!empty($latestStatistic->description))
                                <div class="mt-5 rounded-2xl bg-white/15 p-4 backdrop-blur-sm">
                                    <p class="text-xs uppercase tracking-wide text-white/70">Keterangan</p>
                                    <p class="mt-2 text-sm leading-6 text-white/90">
                                        {{ $latestStatistic->description }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                                <p class="text-sm text-white/80">Total Penduduk</p>
                                <h3 class="mt-2 text-3xl font-bold">
                                    {{ number_format($totalPopulation, 0, ',', '.') }}
                                </h3>
                            </div>

                            <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                                <p class="text-sm text-white/80">Jumlah KK</p>
                                <h3 class="mt-2 text-3xl font-bold">
                                    {{ number_format($familyCount, 0, ',', '.') }}
                                </h3>
                            </div>

                            <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                                <p class="text-sm text-white/80">Laki-laki</p>
                                <h3 class="mt-2 text-3xl font-bold">
                                    {{ number_format($maleCount, 0, ',', '.') }}
                                </h3>
                            </div>

                            <div class="rounded-2xl bg-white/15 p-5 backdrop-blur-sm">
                                <p class="text-sm text-white/80">Perempuan</p>
                                <h3 class="mt-2 text-3xl font-bold">
                                    {{ number_format($femaleCount, 0, ',', '.') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Cards --}}
                <div class="mb-10 grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21h18M5 21V8.6a1 1 0 01.553-.894l5-2.5a1 1 0 01.894 0l5 2.5A1 1 0 0117 8.6V21" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-500">Total Penduduk</p>
                        <h2 class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($totalPopulation, 0, ',', '.') }}</h2>
                        <p class="mt-2 text-sm text-slate-500">Jumlah keseluruhan penduduk yang tercatat.</p>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14a4 4 0 100-8 4 4 0 000 8zm-7 7a7 7 0 0114 0" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-500">Laki-laki</p>
                        <h2 class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($maleCount, 0, ',', '.') }}</h2>
                        <p class="mt-2 text-sm text-slate-500">{{ $malePercentage }}% dari total penduduk.</p>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-pink-100 text-pink-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 14a4 4 0 10-8 0m8 0a4 4 0 11-8 0" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-500">Perempuan</p>
                        <h2 class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($femaleCount, 0, ',', '.') }}</h2>
                        <p class="mt-2 text-sm text-slate-500">{{ $femalePercentage }}% dari total penduduk.</p>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7h18M6 12h12M8 17h8" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-500">Rata-rata / KK</p>
                        <h2 class="mt-2 text-3xl font-bold text-slate-900">{{ $avgFamilySize }}</h2>
                        <p class="mt-2 text-sm text-slate-500">Rata-rata anggota keluarga per KK.</p>
                    </div>
                </div>

                {{-- Visualization --}}
                <div class="mb-10 grid gap-6 lg:grid-cols-3">
                    {{-- Gender Composition --}}
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">
                        <div class="mb-6 flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900">Komposisi Penduduk</h3>
                                <p class="mt-1 text-sm text-slate-500">Perbandingan laki-laki dan perempuan.</p>
                            </div>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                                Tahun {{ $latestStatistic->year }}
                            </span>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <div class="mb-2 flex items-center justify-between text-sm">
                                    <span class="font-medium text-slate-700">Laki-laki</span>
                                    <span class="text-slate-500">{{ number_format($maleCount, 0, ',', '.') }} ({{ $malePercentage }}%)</span>
                                </div>
                                <div class="h-4 overflow-hidden rounded-full bg-slate-100">
                                    <div class="h-full rounded-full bg-sky-500" style="width: {{ $malePercentage }}%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="mb-2 flex items-center justify-between text-sm">
                                    <span class="font-medium text-slate-700">Perempuan</span>
                                    <span class="text-slate-500">{{ number_format($femaleCount, 0, ',', '.') }} ({{ $femalePercentage }}%)</span>
                                </div>
                                <div class="h-4 overflow-hidden rounded-full bg-slate-100">
                                    <div class="h-full rounded-full bg-pink-500" style="width: {{ $femalePercentage }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-2xl bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">Selisih Gender</p>
                                <h4 class="mt-2 text-2xl font-bold text-slate-900">
                                    {{ number_format(abs($maleCount - $femaleCount), 0, ',', '.') }}
                                </h4>
                                <p class="mt-1 text-sm text-slate-500">Selisih jumlah laki-laki dan perempuan.</p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">Jumlah KK</p>
                                <h4 class="mt-2 text-2xl font-bold text-slate-900">
                                    {{ number_format($familyCount, 0, ',', '.') }}
                                </h4>
                                <p class="mt-1 text-sm text-slate-500">Total kepala keluarga yang terdata.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Summary --}}
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-xl font-semibold text-slate-900">Ringkasan Data</h3>
                        <p class="mt-1 text-sm text-slate-500">Ikhtisar kondisi penduduk saat ini.</p>

                        <div class="mt-6 space-y-4">
                            <div class="rounded-2xl bg-emerald-50 p-4">
                                <p class="text-sm text-emerald-700">Total Penduduk</p>
                                <p class="mt-1 text-2xl font-bold text-emerald-900">{{ number_format($totalPopulation, 0, ',', '.') }}</p>
                            </div>

                            <div class="rounded-2xl bg-sky-50 p-4">
                                <p class="text-sm text-sky-700">Pertumbuhan Bersih</p>
                                <p class="mt-1 text-2xl font-bold {{ $netGrowth >= 0 ? 'text-sky-900' : 'text-red-700' }}">
                                    {{ $netGrowth >= 0 ? '+' : '' }}{{ number_format($netGrowth, 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-amber-50 p-4">
                                <p class="text-sm text-amber-700">Rata-rata per KK</p>
                                <p class="mt-1 text-2xl font-bold text-amber-900">{{ $avgFamilySize }} jiwa</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Arus Perubahan Penduduk --}}
                <div class="mb-10 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-slate-900">Dinamika Penduduk</h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Visualisasi arus perubahan penduduk selama periode data aktif.
                        </p>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                        <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5">
                            <p class="text-sm font-medium text-emerald-700">Kelahiran</p>
                            <h4 class="mt-2 text-3xl font-bold text-emerald-900">
                                {{ number_format($birthCount, 0, ',', '.') }}
                            </h4>
                            <p class="mt-2 text-sm text-emerald-700/80">Penambahan penduduk dari kelahiran.</p>
                        </div>

                        <div class="rounded-2xl border border-red-100 bg-red-50 p-5">
                            <p class="text-sm font-medium text-red-700">Kematian</p>
                            <h4 class="mt-2 text-3xl font-bold text-red-900">
                                {{ number_format($deathCount, 0, ',', '.') }}
                            </h4>
                            <p class="mt-2 text-sm text-red-700/80">Pengurangan penduduk karena kematian.</p>
                        </div>

                        <div class="rounded-2xl border border-sky-100 bg-sky-50 p-5">
                            <p class="text-sm font-medium text-sky-700">Penduduk Masuk</p>
                            <h4 class="mt-2 text-3xl font-bold text-sky-900">
                                {{ number_format($movedInCount, 0, ',', '.') }}
                            </h4>
                            <p class="mt-2 text-sm text-sky-700/80">Penduduk yang masuk ke wilayah desa.</p>
                        </div>

                        <div class="rounded-2xl border border-orange-100 bg-orange-50 p-5">
                            <p class="text-sm font-medium text-orange-700">Penduduk Keluar</p>
                            <h4 class="mt-2 text-3xl font-bold text-orange-900">
                                {{ number_format($movedOutCount, 0, ',', '.') }}
                            </h4>
                            <p class="mt-2 text-sm text-orange-700/80">Penduduk yang pindah keluar desa.</p>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Total Penambahan</p>
                            <h4 class="mt-2 text-2xl font-bold text-slate-900">
                                {{ number_format($birthCount + $movedInCount, 0, ',', '.') }}
                            </h4>
                            <p class="mt-1 text-sm text-slate-500">Dari kelahiran dan penduduk masuk.</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Total Pengurangan</p>
                            <h4 class="mt-2 text-2xl font-bold text-slate-900">
                                {{ number_format($deathCount + $movedOutCount, 0, ',', '.') }}
                            </h4>
                            <p class="mt-1 text-sm text-slate-500">Dari kematian dan penduduk keluar.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                    <h2 class="text-2xl font-bold text-slate-800">Belum Ada Data Penduduk</h2>
                    <p class="mt-3 text-slate-500">
                        Data statistik penduduk belum tersedia. Silakan cek kembali setelah data ditambahkan oleh admin.
                    </p>
                </div>
            @endif

            {{-- Riwayat Data --}}
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h3 class="text-xl font-semibold text-slate-900">Riwayat Statistik Penduduk</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Daftar statistik penduduk per tahun yang telah diinput.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead class="bg-slate-50">
                            <tr class="text-left text-sm text-slate-600">
                                <th class="px-6 py-4 font-semibold">Tahun</th>
                                <th class="px-6 py-4 font-semibold">Total</th>
                                <th class="px-6 py-4 font-semibold">Laki-laki</th>
                                <th class="px-6 py-4 font-semibold">Perempuan</th>
                                <th class="px-6 py-4 font-semibold">KK</th>
                                <th class="px-6 py-4 font-semibold">Lahir</th>
                                <th class="px-6 py-4 font-semibold">Meninggal</th>
                                <th class="px-6 py-4 font-semibold">Masuk</th>
                                <th class="px-6 py-4 font-semibold">Keluar</th>
                                <th class="px-6 py-4 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($statistics as $item)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="px-6 py-4 font-medium text-slate-900">{{ $item->year }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ number_format($item->total_population, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ number_format($item->male_count, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ number_format($item->female_count, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ number_format($item->family_count, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ number_format($item->birth_count, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ number_format($item->death_count, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ number_format($item->moved_in_count, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ number_format($item->moved_out_count, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        @if($item->is_active)
                                            <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-8 text-center text-slate-500">
                                        Belum ada data penduduk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection