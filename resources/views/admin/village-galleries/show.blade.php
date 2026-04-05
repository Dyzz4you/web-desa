@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail Slider / Galeri</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="mb-4">
            <img src="{{ asset('storage/' . $villageGallery->image) }}" alt="{{ $villageGallery->title }}" class="w-full max-w-xl rounded-lg shadow">
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold">Judul</h3>
                <p>{{ $villageGallery->title }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Kategori</h3>
                <p>{{ ucfirst($villageGallery->category) }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Urutan</h3>
                <p>{{ $villageGallery->sort_order }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Status</h3>
                <p>{{ $villageGallery->is_active ? 'Aktif' : 'Nonaktif' }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="font-semibold">Deskripsi</h3>
            <div class="whitespace-pre-line bg-gray-50 rounded p-4">
                {{ $villageGallery->description ?? '-' }}
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.village-galleries.edit', $villageGallery) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Edit
            </a>
            <a href="{{ route('admin.village-galleries.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </div>
@endsection