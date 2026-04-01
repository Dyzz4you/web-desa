<div class="space-y-5">
    <div>
        <label class="block mb-1 font-medium">Nama</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $organizationStructure->name ?? '') }}"
            class="w-full rounded border-gray-300"
        >
        @error('name')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Jabatan</label>
        <input
            type="text"
            name="position"
            value="{{ old('position', $organizationStructure->position ?? '') }}"
            class="w-full rounded border-gray-300"
        >
        @error('position')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Deskripsi</label>
        <textarea
            name="description"
            rows="4"
            class="w-full rounded border-gray-300"
        >{{ old('description', $organizationStructure->description ?? '') }}</textarea>
        @error('description')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Foto</label>
        <input type="file" name="photo" class="w-full rounded border-gray-300">

        @if(!empty($organizationStructure?->photo))
            <img src="{{ asset('storage/' . $organizationStructure->photo) }}" alt="{{ $organizationStructure->name }}" class="w-32 mt-3 rounded">
        @endif

        @error('photo')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Urutan Tampil</label>
        <input
            type="number"
            name="sort_order"
            value="{{ old('sort_order', $organizationStructure->sort_order ?? 0) }}"
            class="w-full rounded border-gray-300"
            min="0"
        >
        @error('sort_order')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Status</label>
        <select name="is_active" class="w-full rounded border-gray-300">
            <option value="1" @selected((string) old('is_active', isset($organizationStructure) ? (int) $organizationStructure->is_active : 1) === '1')>Aktif</option>
            <option value="0" @selected((string) old('is_active', isset($organizationStructure) ? (int) $organizationStructure->is_active : 1) === '0')>Nonaktif</option>
        </select>
        @error('is_active')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>