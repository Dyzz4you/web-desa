@extends('layouts.public')

@section('content')
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 grid md:grid-cols-2 gap-10">
            <div>
                <h1 class="text-3xl font-bold mb-6">Kontak Desa</h1>

                <div class="space-y-4">
                    @forelse($contacts as $contact)
                        <div class="bg-gray-50 rounded-xl p-4 shadow-sm">
                            <p class="font-semibold">{{ $contact->label }}</p>
                            <p class="text-gray-700">{{ $contact->value }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada data kontak.</p>
                    @endforelse
                </div>

                @if($profile?->google_maps_embed)
                    <div class="mt-6">
                        <iframe
                            src="{{ $profile->google_maps_embed }}"
                            class="w-full h-72 rounded-xl shadow-sm"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                @endif
            </div>

            <div class="bg-gray-50 rounded-2xl shadow-sm p-6">
                <h2 class="text-2xl font-bold mb-4">Kirim Pesan</h2>

                <form action="{{ route('messages.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama" class="w-full rounded-lg border-gray-300">
                        @error('name')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full rounded-lg border-gray-300">
                        @error('email')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Subjek" class="w-full rounded-lg border-gray-300">
                        @error('subject')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <textarea name="message" rows="5" placeholder="Pesan" class="w-full rounded-lg border-gray-300">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-green-700 text-white px-4 py-3 rounded-lg font-semibold hover:bg-green-800">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection