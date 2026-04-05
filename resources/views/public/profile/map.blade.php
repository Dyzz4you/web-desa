@extends('layouts.public')

@section('content')
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-6">Peta Desa</h1>

            @if($profile?->map_image)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $profile->map_image) }}" alt="Peta Desa" class="w-full max-w-4xl rounded-xl shadow">
                </div>
            @endif

            @if($profile?->map_embed)
                <iframe
                    src="{{ $profile->map_embed }}"
                    class="w-full h-[500px] rounded-xl shadow"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            @elseif($profile?->google_maps_embed)
                <iframe
                    src="{{ $profile->google_maps_embed }}"
                    class="w-full h-[500px] rounded-xl shadow"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            @else
                <p class="text-gray-500">Peta desa belum tersedia.</p>
            @endif
        </div>
    </section>
@endsection