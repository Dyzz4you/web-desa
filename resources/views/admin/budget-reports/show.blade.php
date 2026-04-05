@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail APBDes</h1>

    <div class="bg-white rounded-lg shadow p-6">
        @if($budgetReport->thumbnail)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $budgetReport->thumbnail) }}" alt="{{ $budgetReport->title }}" class="w-full max-w-xl rounded-lg shadow">
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold">Judul</h3>
                <p>{{ $budgetReport->title }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Tahun</h3>
                <p>{{ $budgetReport->year }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Tipe</h3>
                <p>{{ strtoupper($budgetReport->type) }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Status</h3>
                <p>{{ $budgetReport->is_active ? 'Aktif' : 'Nonaktif' }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="font-semibold">Deskripsi</h3>
            <div class="whitespace-pre-line bg-gray-50 rounded p-4">
                {{ $budgetReport->description ?? '-' }}
            </div>
        </div>

        @if($budgetReport->file)
            <div class="mt-6">
                <a href="{{ asset('storage/' . $budgetReport->file) }}" target="_blank" class="text-blue-600 font-semibold">
                    Lihat File
                </a>
            </div>
        @endif

        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.budget-reports.edit', $budgetReport) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Edit
            </a>
            <a href="{{ route('admin.budget-reports.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </div>
@endsection