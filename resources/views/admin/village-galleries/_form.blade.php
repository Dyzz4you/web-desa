<div class="space-y-5">
    <div>
        <label class="block mb-1 font-medium">Judul</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $villageGallery->title ?? '') }}"
            class="w-full rounded border-gray-300"
        >
        @error('title')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Deskripsi</label>
        <textarea
            name="description"
            rows="4"
            class="w-full rounded border-gray-300"
        >{{ old('description', $villageGallery->description ?? '') }}</textarea>
        @error('description')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Gambar</label>
        <input type="file" name="image" class="w-full rounded border-gray-300">

        @if(!empty($villageGallery?->image))
            <img src="{{ asset('storage/' . $villageGallery->image) }}" alt="{{ $villageGallery->title }}" class="w-40 mt-3 rounded">
        @endif

        @error('image')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Kategori</label>
        <select name="category" class="w-full rounded border-gray-300">
            <option value="slider" @selected(old('category', $villageGallery->category ?? '') === 'slider')>Slider</option>
            <option value="gallery" @selected(old('category', $villageGallery->category ?? '') === 'gallery')>Gallery</option>
        </select>
        @error('category')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Urutan Tampil</label>
        <input
            type="number"
            name="sort_order"
            value="{{ old('sort_order', $villageGallery->sort_order ?? 0) }}"
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
            <option value="1" @selected((string) old('is_active', isset($villageGallery) ? (int) $villageGallery->is_active : 1) === '1')>Aktif</option>
            <option value="0" @selected((string) old('is_active', isset($villageGallery) ? (int) $villageGallery->is_active : 1) === '0')>Nonaktif</option>
        </select>
        @error('is_active')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>