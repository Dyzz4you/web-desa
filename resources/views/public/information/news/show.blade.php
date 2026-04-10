@extends('layouts.public')

@section('content')
    <section class="relative overflow-hidden bg-slate-50 py-16 lg:py-20">
        <div class="absolute inset-0">
            <div class="absolute -top-20 -left-16 h-72 w-72 rounded-full bg-emerald-100/70 blur-3xl"></div>
            <div class="absolute top-24 right-0 h-80 w-80 rounded-full bg-sky-100/70 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 h-64 w-64 rounded-full bg-cyan-100/40 blur-3xl"></div>
        </div>

        <div class="container relative mx-auto px-4">
            {{-- Breadcrumb / Back --}}
            <div class="mb-6">
                <a href="{{ route('information.news.index') }}"
                   class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-medium text-slate-600 shadow-sm ring-1 ring-slate-200 hover:text-emerald-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Berita
                </a>
            </div>

            <article class="mx-auto max-w-5xl overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm">
                @if($post->thumbnail)
                    <div class="relative">
                        <img
                            src="{{ asset('storage/' . $post->thumbnail) }}"
                            alt="{{ $post->title }}"
                            class="h-[260px] w-full object-cover md:h-[420px]"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 via-slate-900/10 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 rounded-full bg-white/90 px-4 py-2 text-sm font-semibold text-emerald-700 shadow backdrop-blur">
                            {{ $post->created_at->format('d M Y') }}
                        </div>
                    </div>
                @endif

                <div class="px-6 py-8 md:px-10 md:py-10">
                    @if(!$post->thumbnail)
                        <div class="mb-4 inline-flex rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                            {{ $post->created_at->format('d M Y') }}
                        </div>
                    @endif

                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 md:text-5xl">
                        {{ $post->title }}
                    </h1>

                    @if($post->excerpt)
                        <p class="mt-4 text-lg leading-8 text-slate-600">
                            {{ $post->excerpt }}
                        </p>
                    @endif

                    <div class="my-8 h-px bg-slate-200"></div>

                    <div class="prose prose-slate max-w-none leading-8">
                        <div class="whitespace-pre-line text-slate-700">
                            {{ $post->content }}
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
@endsection