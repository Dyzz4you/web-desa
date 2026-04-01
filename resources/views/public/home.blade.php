@extends('layouts.public')

@section('content')
    <section class="bg-green-700 text-white py-20">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">
                {{ $profile->hero_title ?? $profile->village_name ?? 'Selamat Datang di Website Desa' }}
            </h1>

            <p class="text-lg max-w-2xl">
                {{ $profile->hero_description ?? 'Portal informasi resmi desa.' }}
            </p>

            @if(!empty($profile?->hero_image))
                <div class="mt-6">
                    <img src="{{ asset('storage/' . $profile->hero_image) }}" alt="{{ $profile->village_name }}" class="w-full max-w-3xl rounded-lg shadow">
                </div>
            @endif
        </div>
    </section>
    <section id="kontak" class="py-16 bg-white">
    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-8">
        <div>
            <h2 class="text-2xl font-bold mb-4">Kontak Desa</h2>

            <p class="mb-2"><strong>Alamat:</strong> {{ $profile->address ?? '-' }}</p>
            <p class="mb-2"><strong>Email:</strong> {{ $profile->email ?? '-' }}</p>
            <p class="mb-2"><strong>Telepon:</strong> {{ $profile->phone ?? '-' }}</p>

            @if($profile?->google_maps_embed)
                <div class="mt-4">
                    <iframe
                        src="{{ $profile->google_maps_embed }}"
                        class="w-full h-72 rounded"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            @endif
        </div>

        <div>
            <h2 class="text-2xl font-bold mb-4">Kirim Pesan</h2>

            <form action="{{ route('messages.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Nama"
                        class="w-full rounded border-gray-300"
                    >
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Email"
                        class="w-full rounded border-gray-300"
                    >
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <input
                        type="text"
                        name="subject"
                        value="{{ old('subject') }}"
                        placeholder="Subjek"
                        class="w-full rounded border-gray-300"
                    >
                    @error('subject')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <textarea
                        name="message"
                        rows="5"
                        placeholder="Pesan"
                        class="w-full rounded border-gray-300"
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</section>
@endsection