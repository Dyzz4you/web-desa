<div class="space-y-5">
    <div>
        <label class="block mb-1 font-medium">Label</label>
        <input
            type="text"
            name="label"
            value="{{ old('label', $contact->label ?? '') }}"
            class="w-full rounded border-gray-300"
        >
        @error('label')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Tipe</label>
        <select name="type" class="w-full rounded border-gray-300">
            @foreach($types as $item)
                <option value="{{ $item }}" @selected(old('type', $contact->type ?? '') === $item)>
                    {{ ucfirst(str_replace('_', ' ', $item)) }}
                </option>
            @endforeach
        </select>
        @error('type')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Isi / Value</label>
        <textarea
            name="value"
            rows="4"
            class="w-full rounded border-gray-300"
        >{{ old('value', $contact->value ?? '') }}</textarea>
        @error('value')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Urutan Tampil</label>
        <input
            type="number"
            name="sort_order"
            value="{{ old('sort_order', $contact->sort_order ?? 0) }}"
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
            <option value="1" @selected((string) old('is_active', isset($contact) ? (int) $contact->is_active : 1) === '1')>Aktif</option>
            <option value="0" @selected((string) old('is_active', isset($contact) ? (int) $contact->is_active : 1) === '0')>Nonaktif</option>
        </select>
        @error('is_active')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>