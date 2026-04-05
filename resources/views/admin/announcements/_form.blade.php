<div class="space-y-5">
    <input type="hidden" name="type" value="announcement">

    <div>
        <label class="block mb-1 font-medium">Judul</label>
        <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" class="w-full rounded border-gray-300">
        @error('title')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Excerpt</label>
        <textarea name="excerpt" rows="3" class="w-full rounded border-gray-300">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        @error('excerpt')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Konten</label>
        <textarea name="content" rows="8" class="w-full rounded border-gray-300">{{ old('content', $post->content ?? '') }}</textarea>
        @error('content')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Thumbnail</label>
        <input type="file" name="thumbnail" class="w-full rounded border-gray-300">

        @if(!empty($post?->thumbnail))
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-32 mt-3 rounded">
        @endif

        @error('thumbnail')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Status</label>
        <select name="status" class="w-full rounded border-gray-300">
            <option value="draft" @selected(old('status', $post->status ?? '') === 'draft')>Draft</option>
            <option value="published" @selected(old('status', $post->status ?? '') === 'published')>Published</option>
        </select>
        @error('status')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>