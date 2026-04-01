@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail UMKM</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="mb-4">
            <h2 class="text-xl font-semibold">{{ $umkm->name }}</h2>
            <p class="text-sm text-gray-500">
                Status: {{ $umkm->is_active ? 'Aktif' : 'Nonaktif' }}
            </p>
        </div>

        @if($umkm->photo)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $umkm->photo) }}" alt="{{ $umkm->name }}" class="w-64 rounded">
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold">Pemilik</h3>
                <p>{{ $umkm->owner_name ?? '-' }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Kategori</h3>
                <p>{{ $umkm->category ?? '-' }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Alamat</h3>
                <p>{{ $umkm->address ?? '-' }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Telepon</h3>
                <p>{{ $umkm->phone ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="font-semibold">Deskripsi</h3>
            <div class="whitespace-pre-line">{{ $umkm->description ?? '-' }}</div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.umkms.edit', $umkm) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Edit
            </a>
            <a href="{{ route('admin.umkms.index', $umkm) }}" class="bg-gray-300 px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </div>
@endsection