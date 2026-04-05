@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail Berita</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-3">{{ $post->title }}</h2>

        @if($post->thumbnail)
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-64 rounded mb-4">
        @endif

        <p class="mb-4"><strong>Status:</strong> {{ ucfirst($post->status) }}</p>
        <p class="mb-4"><strong>Excerpt:</strong> {{ $post->excerpt }}</p>

        <div class="whitespace-pre-line">{{ $post->content }}</div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.news.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('admin.news.index') }}" class="bg-gray-300 px-4 py-2 rounded">Kembali</a>
        </div>
    </div>
@endsection