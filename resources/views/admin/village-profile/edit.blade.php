@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Profil Desa</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.village-profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <div>
                    <label class="block mb-1 font-medium">Nama Desa</label>
                    <input
                        type="text"
                        name="village_name"
                        value="{{ old('village_name', $profile->village_name ?? '') }}"
                        class="w-full rounded border-gray-300"
                    >
                    @error('village_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Hero Title</label>
                    <input
                        type="text"
                        name="hero_title"
                        value="{{ old('hero_title', $profile->hero_title ?? '') }}"
                        class="w-full rounded border-gray-300"
                    >
                    @error('hero_title')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Hero Description</label>
                    <textarea
                        name="hero_description"
                        rows="3"
                        class="w-full rounded border-gray-300"
                    >{{ old('hero_description', $profile->hero_description ?? '') }}</textarea>
                    @error('hero_description')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Tentang Desa</label>
                    <textarea
                        name="about"
                        rows="4"
                        class="w-full rounded border-gray-300"
                    >{{ old('about', $profile->about ?? '') }}</textarea>
                    @error('about')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Visi</label>
                    <textarea
                        name="vision"
                        rows="3"
                        class="w-full rounded border-gray-300"
                    >{{ old('vision', $profile->vision ?? '') }}</textarea>
                    @error('vision')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Misi</label>
                    <textarea
                        name="mission"
                        rows="4"
                        class="w-full rounded border-gray-300"
                    >{{ old('mission', $profile->mission ?? '') }}</textarea>
                    @error('mission')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Alamat</label>
                    <input
                        type="text"
                        name="address"
                        value="{{ old('address', $profile->address ?? '') }}"
                        class="w-full rounded border-gray-300"
                    >
                    @error('address')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block mb-1 font-medium">Email</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $profile->email ?? '') }}"
                            class="w-full rounded border-gray-300"
                        >
                        @error('email')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Telepon</label>
                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone', $profile->phone ?? '') }}"
                            class="w-full rounded border-gray-300"
                        >
                        @error('phone')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Google Maps Embed URL</label>
                    <textarea
                        name="google_maps_embed"
                        rows="3"
                        class="w-full rounded border-gray-300"
                    >{{ old('google_maps_embed', $profile->google_maps_embed ?? '') }}</textarea>
                    @error('google_maps_embed')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Hero Image</label>
                    <input type="file" name="hero_image" class="w-full rounded border-gray-300">

                    @if(!empty($profile->hero_image))
                        <img src="{{ asset('storage/' . $profile->hero_image) }}" alt="{{ $profile->village_name }}" class="w-48 mt-3 rounded">
                    @endif

                    @error('hero_image')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection