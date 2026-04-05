@extends('layouts.public')

@section('content')
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8">Struktur Organisasi Desa</h1>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($organizations as $item)
                    <div class="bg-gray-50 rounded-2xl shadow-sm p-5 text-center">
                        @if($item->photo)
                            <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="w-24 h-24 rounded-full mx-auto object-cover mb-4">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gray-200 mx-auto mb-4"></div>
                        @endif

                        <h3 class="font-bold text-lg">{{ $item->name }}</h3>
                        <p class="text-green-700 font-medium">{{ $item->position }}</p>
                        <p class="text-sm text-gray-600 mt-2">{{ $item->description }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada data struktur organisasi.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection