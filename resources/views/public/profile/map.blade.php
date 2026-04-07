@extends('layouts.public')

@section('content')
    @php
        $embedUrl = null;

        if (!empty($profile?->map_embed)) {
            $embedUrl = trim($profile->map_embed);
        } elseif (!empty($profile?->google_maps_embed)) {
            $rawValue = trim($profile->google_maps_embed);

            // Kalau isinya URL embed Google Maps
            if (str_contains($rawValue, 'google.com/maps/embed')) {
                $embedUrl = $rawValue;
            }
            // Kalau isinya alamat/lokasi biasa, mis. "Gadingan, Sukoharjo"
            else {
                $embedUrl = 'https://maps.google.com/maps?hl=id&q='
                    . urlencode($rawValue)
                    . '&t=h&z=13&ie=UTF8&iwloc=B&output=embed';
            }
        }
    @endphp

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-6">Peta Desa</h1>

            @if($profile?->map_image)
                <div class="mb-6">
                    <img
                        src="{{ asset('storage/' . $profile->map_image) }}"
                        alt="Peta Desa"
                        class="w-full max-w-4xl rounded-xl shadow"
                    >
                </div>
            @endif

            @if($embedUrl)
                <iframe
                    src="{{ $embedUrl }}"
                    class="w-full h-[500px] rounded-xl shadow"
                    style="border:0;"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            @else
                <p class="text-gray-500">Peta desa belum tersedia.</p>
            @endif
        </div>
    </section>
@endsection