<div class="space-y-5">
    <div>
        <label class="block mb-1 font-medium">Nama UMKM</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $umkm->name ?? '') }}"
            class="w-full rounded border-gray-300"
        >
        @error('name')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Nama Pemilik</label>
        <input
            type="text"
            name="owner_name"
            value="{{ old('owner_name', $umkm->owner_name ?? '') }}"
            class="w-full rounded border-gray-300"
        >
        @error('owner_name')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Kategori</label>
        <input
            type="text"
            name="category"
            value="{{ old('category', $umkm->category ?? '') }}"
            class="w-full rounded border-gray-300"
        >
        @error('category')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Deskripsi</label>
        <textarea
            name="description"
            rows="5"
            class="w-full rounded border-gray-300"
        >{{ old('description', $umkm->description ?? '') }}</textarea>
        @error('description')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Alamat</label>
        <input
            type="text"
            name="address"
            value="{{ old('address', $umkm->address ?? '') }}"
            class="w-full rounded border-gray-300"
        >
        @error('address')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">No. Telepon</label>
        <input
            type="text"
            name="phone"
            value="{{ old('phone', $umkm->phone ?? '') }}"
            class="w-full rounded border-gray-300"
        >
        @error('phone')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Foto</label>
        <input type="file" name="photo" class="w-full rounded border-gray-300">

        @if(!empty($umkm?->photo))
            <img src="{{ asset('storage/' . $umkm->photo) }}" alt="{{ $umkm->name }}" class="w-32 mt-3 rounded">
        @endif

        @error('photo')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Status</label>
        <select name="is_active" class="w-full rounded border-gray-300">
            <option value="1" @selected((string) old('is_active', isset($umkm) ? (int) $umkm->is_active : 1) === '1')>Aktif</option>
            <option value="0" @selected((string) old('is_active', isset($umkm) ? (int) $umkm->is_active : 1) === '0')>Nonaktif</option>
        </select>
        @error('is_active')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>