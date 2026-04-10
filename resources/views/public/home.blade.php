@extends('layouts.public')

@section('content')
<section
    class="relative overflow-hidden bg-cover bg-center py-20 text-white shadow-inner lg:py-28"
    style="background-image: url('{{ $profile->hero_image ? asset('storage/' . $profile->hero_image) : asset('images/default-hero.jpg') }}');"
>
    <div class="absolute inset-0 bg-slate-950/65 z-0"></div>
    <div class="absolute inset-0 z-0">
        <div class="absolute -top-20 -left-16 h-72 w-72 rounded-full bg-emerald-400/20 blur-3xl"></div>
        <div class="absolute top-24 right-0 h-80 w-80 rounded-full bg-sky-400/20 blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-10 items-center relative z-10">
        {{-- Sisi Kiri: Teks Hero --}}
        <div class="space-y-6">
            <span class="inline-flex items-center rounded-full bg-white/15 px-4 py-1.5 text-sm font-medium text-white backdrop-blur">
                Website Resmi Desa
            </span>

            <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                {{ $profile->hero_title ?? $profile->village_name ?? 'Selamat Datang di Website Desa' }}
            </h1>

            <p class="text-lg leading-8 text-slate-100">
                {{ $profile->hero_description ?? 'Portal resmi desa untuk informasi publik, berita, UMKM, dan layanan masyarakat.' }}
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('profile.about') }}"
                   class="inline-flex items-center rounded-2xl bg-white px-6 py-3 font-semibold text-emerald-700 transition hover:bg-emerald-50">
                    Tentang Desa
                </a>
                <a href="{{ route('contact.index') }}"
                   class="inline-flex items-center rounded-2xl border border-white/70 px-6 py-3 font-semibold text-white transition hover:bg-white hover:text-emerald-700">
                    Hubungi Kami
                </a>
            </div>
        </div>

        {{-- Sisi Kanan: Slider Alpine.js --}}
        <div class="relative">
            @if(isset($sliders) && $sliders->count())
                <div
                    x-data="{
                        active: 0,
                        slides: {{ $sliders->count() }},
                        start() {
                            setInterval(() => {
                                this.active = (this.active + 1) % this.slides
                            }, 4000)
                        }
                    }"
                    x-init="start()"
                    class="relative overflow-hidden rounded-[28px] border border-white/20 bg-white/10 shadow-2xl backdrop-blur-sm"
                >
                    <div
                        class="flex transition-transform duration-700 ease-in-out"
                        :style="`transform: translateX(-${active * 100}%); width: {{ $sliders->count() * 100 }}%;`"
                    >
                        @foreach($sliders as $slider)
                            <div class="w-full flex-shrink-0 relative">
                                <img
                                    src="{{ asset('storage/' . $slider->image) }}"
                                    alt="{{ $slider->title }}"
                                    class="w-full h-[320px] md:h-[420px] object-cover object-center"
                                >
                                <div class="absolute bottom-0 inset-x-0 p-6 bg-gradient-to-t from-slate-950/90 via-slate-900/40 to-transparent">
                                    <h3 class="text-xl font-bold">{{ $slider->title }}</h3>
                                    <p class="text-sm mt-2 text-slate-200 line-clamp-2">{{ $slider->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                        @foreach($sliders as $index => $slider)
                            <button
                                @click="active = {{ $index }}"
                                :class="active === {{ $index }} ? 'bg-white w-8' : 'bg-white/50 w-3'"
                                class="h-3 rounded-full transition-all duration-300"
                            ></button>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<section id="tentang" class="relative overflow-hidden py-16 bg-slate-50">
    <div class="absolute inset-0">
        <div class="absolute -top-16 left-0 h-56 w-56 rounded-full bg-emerald-100/70 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 h-64 w-64 rounded-full bg-sky-100/60 blur-3xl"></div>
    </div>

    <div class="container relative mx-auto px-4">
        <div class="max-w-3xl mb-10">
            <span class="inline-flex items-center rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                Profil Singkat
            </span>
            <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900">Tentang Desa</h2>
            <p class="mt-3 text-slate-600 leading-7">
                Informasi singkat mengenai profil, visi, dan misi desa.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6 md:col-span-1">
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Profil Desa</h3>
                <p class="text-slate-600 leading-7">
                    {{ $profile->about ?? 'Profil desa belum diisi.' }}
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6">
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Visi</h3>
                <p class="text-slate-600 leading-7">
                    {{ $profile->vision ?? 'Visi desa belum diisi.' }}
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6">
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Misi</h3>
                <p class="text-slate-600 leading-7 whitespace-pre-line">
                    {{ $profile->mission ?? 'Misi desa belum diisi.' }}
                </p>
            </div>
        </div>
    </div>
</section>

<section id="struktur" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mb-10">
            <span class="inline-flex items-center rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                Pemerintahan Desa
            </span>
            <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900">Struktur Organisasi</h2>
            <p class="mt-3 text-slate-600 leading-7">
                Susunan perangkat dan aparatur desa.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($organizations as $item)
                <div class="group rounded-3xl border border-slate-200 bg-slate-50 shadow-sm p-5 text-center transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    @if($item->photo)
                        <div class="w-24 h-24 rounded-full mx-auto overflow-hidden mb-4 ring-4 ring-emerald-100">
                            <img src="{{ asset('storage/' . $item->photo) }}"
                                 alt="{{ $item->name }}"
                                 class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                        </div>
                    @else
                        <div class="w-24 h-24 rounded-full mx-auto mb-4 flex items-center justify-center bg-gradient-to-br from-emerald-100 to-sky-100 ring-4 ring-emerald-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M5.121 17.804A9 9 0 1118.88 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    @endif

                    <h3 class="font-bold text-lg text-slate-900">{{ $item->name }}</h3>
                    <p class="mt-2 inline-flex rounded-full bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-700">
                        {{ $item->position }}
                    </p>
                    <p class="text-sm text-slate-600 mt-3 leading-6">
                        {{ $item->description }}
                    </p>
                </div>
            @empty
                <p class="text-slate-500">Belum ada data struktur organisasi.</p>
            @endforelse
        </div>
    </div>
</section>

<section id="galeri" class="py-16 bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mb-10">
            <span class="inline-flex items-center rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                Dokumentasi Desa
            </span>
            <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900">Galeri Desa</h2>
            <p class="mt-3 text-slate-600 leading-7">
                Dokumentasi kegiatan dan suasana desa.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($galleries as $gallery)
                <div class="group rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <img
                        src="{{ asset('storage/' . $gallery->image) }}"
                        alt="{{ $gallery->title }}"
                        class="w-full h-52 object-cover transition duration-300 group-hover:scale-105"
                    >

                    <div class="p-4">
                        <h3 class="font-bold text-lg text-slate-900">{{ $gallery->title }}</h3>
                        @if($gallery->description)
                            <p class="text-sm text-slate-600 mt-2 leading-6">
                                {{ \Illuminate\Support\Str::limit($gallery->description, 80) }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-slate-500">Belum ada galeri desa.</p>
            @endforelse
        </div>
    </div>
</section>

<section id="berita" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                    Informasi Terkini
                </span>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900">Berita Terbaru</h2>
                <p class="mt-3 text-slate-600 leading-7">Informasi dan kegiatan terbaru desa.</p>
            </div>

            <a href="{{ route('information.news.index') }}" class="text-emerald-700 font-semibold hover:text-emerald-800">
                Lihat Semua
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($latestPosts as $post)
                <article class="group rounded-3xl border border-slate-200 bg-slate-50 shadow-sm overflow-hidden transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-52 object-cover transition duration-300 group-hover:scale-105">
                    @endif

                    <div class="p-5">
                        <p class="text-sm text-slate-500 mb-2">
                            {{ $post->created_at->format('d M Y') }}
                        </p>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">
                            {{ $post->title }}
                        </h3>
                        <p class="text-slate-600 mb-4 leading-6">
                            {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content), 120) }}
                        </p>
                        <a href="{{ route('information.news.show', $post->slug) }}" class="text-emerald-700 font-semibold hover:text-emerald-800">
                            Baca Selengkapnya
                        </a>
                    </div>
                </article>
            @empty
                <p class="text-slate-500">Belum ada berita terbaru.</p>
            @endforelse
        </div>
    </div>
</section>

<section id="umkm" class="py-16 bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mb-10">
            <span class="inline-flex items-center rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                Ekonomi Desa
            </span>
            <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900">UMKM Desa</h2>
            <p class="mt-3 text-slate-600 leading-7">
                Produk dan usaha masyarakat desa yang aktif dan berkembang.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($umkms as $umkm)
                <div class="group rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    @if($umkm->photo)
                        <img src="{{ asset('storage/' . $umkm->photo) }}"
                             alt="{{ $umkm->name }}"
                             class="w-full h-48 object-cover transition duration-300 group-hover:scale-105">
                    @else
                        <div class="w-full h-48 flex items-center justify-center bg-gradient-to-br from-emerald-100 via-lime-100 to-yellow-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 7h18M6 12h12M8 17h8" />
                            </svg>
                        </div>
                    @endif

                    <div class="p-5">
                        <h3 class="text-lg font-bold text-slate-900">{{ $umkm->name }}</h3>
                        <p class="text-emerald-700 text-sm font-medium mb-2 mt-2">
                            {{ $umkm->category ?? 'Kategori belum diisi' }}
                        </p>
                        <p class="text-sm text-slate-600 mb-2">
                            Pemilik: {{ $umkm->owner_name ?? '-' }}
                        </p>
                        <p class="text-sm text-slate-600 leading-6">
                            {{ \Illuminate\Support\Str::limit($umkm->description, 100) }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-slate-500">Belum ada data UMKM.</p>
            @endforelse
        </div>
    </div>
</section>

<section id="kontak" class="py-16 bg-white">
    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-10">
        <div>
            <span class="inline-flex items-center rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                Layanan Informasi
            </span>
            <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 mb-4">Kontak Desa</h2>
            <p class="text-slate-600 mb-6 leading-7">
                Hubungi kami melalui informasi berikut atau kirim pesan langsung melalui form.
            </p>

            <div class="space-y-4">
                @forelse($contacts as $contact)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 shadow-sm">
                        <p class="font-semibold text-slate-900">{{ $contact->label }}</p>
                        <p class="text-slate-600 mt-1">{{ $contact->value }}</p>
                    </div>
                @empty
                    <p class="text-slate-500">Belum ada data kontak.</p>
                @endforelse
            </div>

            <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200 shadow-sm">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1879.6213835932472!2d110.84445962568937!3d-7.582666596893978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a16492496322d%3A0xccc7d52a92f7e1e!2sKantor%20Kepala%20Desa%20Gadingan%20Kec.%20Moholaban!5e1!3m2!1sid!2sid!4v1775546925635!5m2!1sid!2sid"
                    class="w-full h-72"
                    style="border:0;"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div>
            <div class="rounded-3xl border border-slate-200 bg-slate-50 shadow-sm p-6">
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Kirim Pesan</h2>

                <form action="{{ route('messages.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama"
                               class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 focus:border-emerald-400 focus:ring-emerald-400">
                        @error('name')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                               class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 focus:border-emerald-400 focus:ring-emerald-400">
                        @error('email')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Subjek"
                               class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 focus:border-emerald-400 focus:ring-emerald-400">
                        @error('subject')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <textarea name="message" rows="5" placeholder="Tulis pesan Anda..."
                                  class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 focus:border-emerald-400 focus:ring-emerald-400">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-emerald-700 text-white px-4 py-3 rounded-2xl font-semibold hover:bg-emerald-800 transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection