@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail Berita</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="mb-4">
            <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
            <p class="text-sm text-gray-500">
                Status: {{ ucfirst($post->status) }}
            </p>
        </div>

        @if($post->thumbnail)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-64 rounded">
            </div>
        @endif

        <div class="mb-4">
            <h3 class="font-semibold">Excerpt</h3>
            <p>{{ $post->excerpt }}</p>
        </div>

        <div class="mb-4">
            <h3 class="font-semibold">Konten</h3>
            <div class="whitespace-pre-line">{{ $post->content }}</div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.posts.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Edit
            </a>
            <a href="{{ route('admin.posts.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </div>
@endsection