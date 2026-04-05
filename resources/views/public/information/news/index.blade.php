@extends('layouts.public')

@section('content')
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-6">Berita Desa</h1>

            <form method="GET" action="{{ route('information.news.index') }}" class="mb-8">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari berita..."
                    class="rounded-lg border-gray-300 w-full md:w-96"
                >
            </form>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($posts as $post)
                    <article class="bg-gray-50 rounded-2xl shadow-sm overflow-hidden">
                        @if($post->thumbnail)
                            <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-52 object-cover">
                        @endif

                        <div class="p-5">
                            <p class="text-sm text-gray-500 mb-2">
                                {{ $post->created_at->format('d M Y') }}
                            </p>

                            <h3 class="text-xl font-bold mb-3">{{ $post->title }}</h3>

                            <p class="text-gray-600 mb-4">
                                {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content), 120) }}
                            </p>

                            <a href="{{ route('information.news.show', $post->slug) }}"
                               class="text-green-700 font-semibold hover:underline">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="text-gray-500">Belum ada berita.</p>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection