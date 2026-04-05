@extends('layouts.public')

@section('content')
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-6">Tentang Desa</h1>
            <p class="mb-4"><strong>Nama Desa:</strong> {{ $profile->village_name ?? '-' }}</p>
            <p class="mb-4"><strong>Sejarah:</strong></p>
            <div class="whitespace-pre-line text-gray-700">{{ $profile->history ?? $profile->about ?? 'Data belum tersedia.' }}</div>

            <div class="mt-8 grid md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-xl font-semibold mb-2">Visi</h2>
                    <p>{{ $profile->vision ?? '-' }}</p>
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-2">Misi</h2>
                    <p class="whitespace-pre-line">{{ $profile->mission ?? '-' }}</p>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-2">Identitas Desa</h2>
                <div class="whitespace-pre-line text-gray-700">{{ $profile->identity ?? 'Belum tersedia.' }}</div>
            </div>
        </div>
    </section>
@endsection