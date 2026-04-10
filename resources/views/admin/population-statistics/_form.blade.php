<div class="space-y-5">
    <div>
        <label class="block mb-1 font-medium">Tahun</label>
        <input
            type="number"
            name="year"
            value="{{ old('year', $populationStatistic->year ?? date('Y')) }}"
            class="w-full rounded border-gray-300"
        >
        @error('year')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block mb-1 font-medium">Total Penduduk</label>
            <input type="number" name="total_population" value="{{ old('total_population', $populationStatistic->total_population ?? 0) }}" class="w-full rounded border-gray-300">
            @error('total_population')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Jumlah KK</label>
            <input type="number" name="family_count" value="{{ old('family_count', $populationStatistic->family_count ?? 0) }}" class="w-full rounded border-gray-300">
            @error('family_count')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block mb-1 font-medium">Laki-laki</label>
            <input type="number" name="male_count" value="{{ old('male_count', $populationStatistic->male_count ?? 0) }}" class="w-full rounded border-gray-300">
            @error('male_count')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Perempuan</label>
            <input type="number" name="female_count" value="{{ old('female_count', $populationStatistic->female_count ?? 0) }}" class="w-full rounded border-gray-300">
            @error('female_count')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block mb-1 font-medium">Kelahiran</label>
            <input type="number" name="birth_count" value="{{ old('birth_count', $populationStatistic->birth_count ?? 0) }}" class="w-full rounded border-gray-300">
            @error('birth_count')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Kematian</label>
            <input type="number" name="death_count" value="{{ old('death_count', $populationStatistic->death_count ?? 0) }}" class="w-full rounded border-gray-300">
            @error('death_count')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block mb-1 font-medium">Penduduk Masuk</label>
            <input type="number" name="moved_in_count" value="{{ old('moved_in_count', $populationStatistic->moved_in_count ?? 0) }}" class="w-full rounded border-gray-300">
            @error('moved_in_count')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Penduduk Keluar</label>
            <input type="number" name="moved_out_count" value="{{ old('moved_out_count', $populationStatistic->moved_out_count ?? 0) }}" class="w-full rounded border-gray-300">
            @error('moved_out_count')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div>
        <label class="block mb-1 font-medium">Keterangan</label>
        <textarea name="description" rows="4" class="w-full rounded border-gray-300">{{ old('description', $populationStatistic->description ?? '') }}</textarea>
        @error('description')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Status</label>
        <select name="is_active" class="w-full rounded border-gray-300">
            <option value="1" @selected((string) old('is_active', isset($populationStatistic) ? (int) $populationStatistic->is_active : 1) === '1')>Aktif</option>
            <option value="0" @selected((string) old('is_active', isset($populationStatistic) ? (int) $populationStatistic->is_active : 1) === '0')>Nonaktif</option>
        </select>
        @error('is_active')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>