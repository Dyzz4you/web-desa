@extends('layouts.public')

@section('content')
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            <p class="text-sm text-gray-500 mb-3">
                {{ $post->created_at->format('d M Y') }}
            </p>

            <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>

            @if($post->thumbnail)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}"
                         alt="{{ $post->title }}"
                         class="w-full rounded-2xl shadow object-cover">
                </div>
            @endif

            @if($post->excerpt)
                <p class="text-lg text-gray-600 mb-6">
                    {{ $post->excerpt }}
                </p>
            @endif

            <div class="prose max-w-none text-gray-800 leading-relaxed whitespace-pre-line">
                {{ $post->content }}
            </div>

            <div class="mt-10">
                <a href="{{ route('posts.index') }}" class="text-green-700 font-semibold hover:underline">
                    ← Kembali ke daftar berita
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6">Berita Terkait</h2>

            <div class="grid md:grid-cols-3 gap-6">
                @forelse($relatedPosts as $item)
                    <article class="bg-white rounded-2xl shadow-sm p-5">
                        <h3 class="text-lg font-bold mb-3">{{ $item->title }}</h3>
                        <p class="text-gray-600 mb-3">
                            {{ \Illuminate\Support\Str::limit($item->excerpt ?: strip_tags($item->content), 100) }}
                        </p>
                        <a href="{{ route('posts.show', $item->slug) }}" class="text-green-700 font-semibold hover:underline">
                            Baca Selengkapnya
                        </a>
                    </article>
                @empty
                    <p class="text-gray-500">Tidak ada berita terkait.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection