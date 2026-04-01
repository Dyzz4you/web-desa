@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail Struktur Organisasi</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="mb-4">
            <h2 class="text-xl font-semibold">{{ $organizationStructure->name }}</h2>
            <p class="text-sm text-gray-500">
                {{ $organizationStructure->position }}
            </p>
        </div>

        @if($organizationStructure->photo)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $organizationStructure->photo) }}" alt="{{ $organizationStructure->name }}" class="w-64 rounded">
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold">Jabatan</h3>
                <p>{{ $organizationStructure->position }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Urutan Tampil</h3>
                <p>{{ $organizationStructure->sort_order }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Status</h3>
                <p>{{ $organizationStructure->is_active ? 'Aktif' : 'Nonaktif' }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="font-semibold">Deskripsi</h3>
            <div class="whitespace-pre-line">{{ $organizationStructure->description ?? '-' }}</div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.organization-structures.edit', $organizationStructure) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Edit
            </a>
            <a href="{{ route('admin.organization-structures.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </div>
@endsection