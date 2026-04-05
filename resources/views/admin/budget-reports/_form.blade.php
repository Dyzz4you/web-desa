<div class="space-y-5">
    <div>
        <label class="block mb-1 font-medium">Judul</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $budgetReport->title ?? '') }}"
            class="w-full rounded border-gray-300"
        >
        @error('title')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block mb-1 font-medium">Tahun</label>
            <input
                type="number"
                name="year"
                value="{{ old('year', $budgetReport->year ?? date('Y')) }}"
                class="w-full rounded border-gray-300"
            >
            @error('year')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Tipe</label>
            <select name="type" class="w-full rounded border-gray-300">
                <option value="poster" @selected(old('type', $budgetReport->type ?? '') === 'poster')>Poster</option>
                <option value="pdf" @selected(old('type', $budgetReport->type ?? '') === 'pdf')>PDF</option>
                <option value="report" @selected(old('type', $budgetReport->type ?? '') === 'report')>Report</option>
            </select>
            @error('type')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div>
        <label class="block mb-1 font-medium">Deskripsi</label>
        <textarea
            name="description"
            rows="4"
            class="w-full rounded border-gray-300"
        >{{ old('description', $budgetReport->description ?? '') }}</textarea>
        @error('description')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">File Utama</label>
        <input type="file" name="file" class="w-full rounded border-gray-300">

        @if(!empty($budgetReport?->file))
            <a href="{{ asset('storage/' . $budgetReport->file) }}" target="_blank" class="text-blue-600 inline-block mt-2">
                Lihat file saat ini
            </a>
        @endif

        @error('file')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Thumbnail</label>
        <input type="file" name="thumbnail" class="w-full rounded border-gray-300">

        @if(!empty($budgetReport?->thumbnail))
            <img src="{{ asset('storage/' . $budgetReport->thumbnail) }}" alt="{{ $budgetReport->title }}" class="w-40 mt-3 rounded">
        @endif

        @error('thumbnail')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Status</label>
        <select name="is_active" class="w-full rounded border-gray-300">
            <option value="1" @selected((string) old('is_active', isset($budgetReport) ? (int) $budgetReport->is_active : 1) === '1')>Aktif</option>
            <option value="0" @selected((string) old('is_active', isset($budgetReport) ? (int) $budgetReport->is_active : 1) === '0')>Nonaktif</option>
        </select>
        @error('is_active')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>