@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail Data Penduduk</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid md:grid-cols-2 gap-6">
            <div><strong>Tahun:</strong> {{ $populationStatistic->year }}</div>
            <div><strong>Status:</strong> {{ $populationStatistic->is_active ? 'Aktif' : 'Nonaktif' }}</div>
            <div><strong>Total Penduduk:</strong> {{ $populationStatistic->total_population }}</div>
            <div><strong>Jumlah KK:</strong> {{ $populationStatistic->family_count }}</div>
            <div><strong>Laki-laki:</strong> {{ $populationStatistic->male_count }}</div>
            <div><strong>Perempuan:</strong> {{ $populationStatistic->female_count }}</div>
            <div><strong>Kelahiran:</strong> {{ $populationStatistic->birth_count }}</div>
            <div><strong>Kematian:</strong> {{ $populationStatistic->death_count }}</div>
            <div><strong>Penduduk Masuk:</strong> {{ $populationStatistic->moved_in_count }}</div>
            <div><strong>Penduduk Keluar:</strong> {{ $populationStatistic->moved_out_count }}</div>
        </div>

        <div class="mt-6">
            <h3 class="font-semibold mb-2">Keterangan</h3>
            <div class="whitespace-pre-line bg-gray-50 rounded p-4">
                {{ $populationStatistic->description ?? '-' }}
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.population-statistics.edit', $populationStatistic) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Edit
            </a>
            <a href="{{ route('admin.population-statistics.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </div>
@endsection