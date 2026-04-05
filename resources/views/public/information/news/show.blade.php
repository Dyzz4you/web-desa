@extends('layouts.public')

@section('content')
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>

            @if($post->thumbnail)
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full rounded-2xl shadow mb-6">
            @endif

            <p class="text-gray-600 mb-6">{{ $post->excerpt }}</p>

            <div class="whitespace-pre-line">{{ $post->content }}</div>
        </div>
    </section>
@endsection