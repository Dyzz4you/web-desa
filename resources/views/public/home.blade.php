@extends('layouts.public')

@section('content')
    <section class="bg-gradient-to-r from-green-700 to-emerald-600 text-white py-20">
        <div class="container mx-auto px-4 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                    {{ $profile->hero_title ?? $profile->village_name ?? 'Selamat Datang di Website Desa' }}
                </h1>

                <p class="text-lg text-green-50 mb-6">
                    {{ $profile->hero_description ?? 'Portal resmi desa untuk informasi publik, berita, UMKM, dan layanan masyarakat.' }}
                </p>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('profile.about') }}" class="bg-white text-green-700 px-5 py-3 rounded-lg font-semibold hover:bg-green-50">
                        Tentang Desa
                    </a>
                    <a href="{{ route('contact.index') }}" class="border border-white px-5 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-700">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <div>
    @if(isset($sliders) && $sliders->count())
        <div
            x-data="{
                active: 0,
                slides: {{ $sliders->count() }},
                start() {
                    setInterval(() => {
                        this.active = (this.active + 1) % this.slides
                    }, 3000)
                }
            }"
            x-init="start()"
            class="relative bg-white/10 rounded-2xl overflow-hidden shadow-xl"
        >
            <div
                class="flex transition-transform duration-700 ease-in-out"
                :style="`transform: translateX(-${active * 100}%); width: {{ $sliders->count() * 100 }}%;`"
            >
                @foreach($sliders as $slider)
                    <div class="w-full flex-shrink-0">
                        <img
                            src="{{ asset('storage/' . $slider->image) }}"
                            alt="{{ $slider->title }}"
                            class="w-full h-[320px] md:h-[420px] object-cover object-center"
                        >

                        <div class="p-4 bg-slate-900/60 text-white">
                            <h3 class="text-xl font-bold">{{ $slider->title }}</h3>
                            <p class="text-sm mt-1">{{ $slider->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- indikator --}}
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                @foreach($sliders as $index => $slider)
                    <button
                        @click="active = {{ $index }}"
                        :class="active === {{ $index }} ? 'bg-white' : 'bg-white/50'"
                        class="w-3 h-3 rounded-full"
                    ></button>
                @endforeach
            </div>
        </div>
    @endif
</div>
        </div>
    </section>
    <section id="tentang" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mb-10">
                <h2 class="text-3xl font-bold mb-4">Tentang Desa</h2>
                <p class="text-gray-600">
                    Informasi singkat mengenai profil, visi, dan misi desa.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gray-50 rounded-2xl shadow-sm p-6 md:col-span-1">
                    <h3 class="text-xl font-semibold mb-3">Profil Desa</h3>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $profile->about ?? 'Profil desa belum diisi.' }}
                    </p>
                </div>

                <div class="bg-gray-50 rounded-2xl shadow-sm p-6">
                    <h3 class="text-xl font-semibold mb-3">Visi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $profile->vision ?? 'Visi desa belum diisi.' }}
                    </p>
                </div>

                <div class="bg-gray-50 rounded-2xl shadow-sm p-6">
                    <h3 class="text-xl font-semibold mb-3">Misi</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $profile->mission ?? 'Misi desa belum diisi.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="struktur" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mb-10">
                <h2 class="text-3xl font-bold mb-4">Struktur Organisasi</h2>
                <p class="text-gray-600">
                    Susunan perangkat dan aparatur desa.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($organizations as $item)
                    <div class="bg-white rounded-2xl shadow-sm p-5 text-center">
                        @if($item->photo)
                            <img src="{{ asset('storage/' . $item->photo) }}"
                                 alt="{{ $item->name }}"
                                 class="w-24 h-24 rounded-full mx-auto object-cover mb-4">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gray-200 mx-auto mb-4"></div>
                        @endif

                        <h3 class="font-bold text-lg">{{ $item->name }}</h3>
                        <p class="text-green-700 font-medium">{{ $item->position }}</p>
                        <p class="text-sm text-gray-600 mt-2">
                            {{ $item->description }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada data struktur organisasi.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="galeri" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mb-10">
                <h2 class="text-3xl font-bold mb-4">Galeri Desa</h2>
                <p class="text-gray-600">
                    Dokumentasi kegiatan dan suasana desa.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($galleries as $gallery)
                    <div class="bg-gray-50 rounded-2xl shadow-sm overflow-hidden">
                        <img
                            src="{{ asset('storage/' . $gallery->image) }}"
                            alt="{{ $gallery->title }}"
                            class="w-full h-52 object-cover"
                        >

                        <div class="p-4">
                            <h3 class="font-bold text-lg">{{ $gallery->title }}</h3>
                            @if($gallery->description)
                                <p class="text-sm text-gray-600 mt-2">
                                    {{ \Illuminate\Support\Str::limit($gallery->description, 80) }}
                                </p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada galeri desa.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="berita" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Berita Terbaru</h2>
                    <p class="text-gray-600">Informasi dan kegiatan terbaru desa.</p>
                </div>

                <a href="{{ route('information.news.index') }}" class="text-green-700 font-semibold hover:underline">
                    Lihat Semua
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($latestPosts as $post)
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
                            <h3 class="text-xl font-bold mb-3">
                                {{ $post->title }}
                            </h3>
                            <p class="text-gray-600 mb-4">
                                {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content), 120) }}
                            </p>
                            <a href="{{ route('information.news.show', $post->slug) }}" class="text-green-700 font-semibold hover:underline">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="text-gray-500">Belum ada berita terbaru.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="umkm" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mb-10">
                <h2 class="text-3xl font-bold mb-4">UMKM Desa</h2>
                <p class="text-gray-600">
                    Produk dan usaha masyarakat desa yang aktif dan berkembang.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($umkms as $umkm)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        @if($umkm->photo)
                            <img src="{{ asset('storage/' . $umkm->photo) }}"
                                 alt="{{ $umkm->name }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200"></div>
                        @endif

                        <div class="p-5">
                            <h3 class="text-lg font-bold">{{ $umkm->name }}</h3>
                            <p class="text-green-700 text-sm font-medium mb-2">
                                {{ $umkm->category ?? 'Kategori belum diisi' }}
                            </p>
                            <p class="text-sm text-gray-600 mb-2">
                                Pemilik: {{ $umkm->owner_name ?? '-' }}
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ \Illuminate\Support\Str::limit($umkm->description, 100) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada data UMKM.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="kontak" class="py-16 bg-white">
        <div class="container mx-auto px-4 grid md:grid-cols-2 gap-10">
            <div>
                <h2 class="text-3xl font-bold mb-4">Kontak Desa</h2>
                <p class="text-gray-600 mb-6">
                    Hubungi kami melalui informasi berikut atau kirim pesan langsung melalui form.
                </p>

                <div class="space-y-4">
                    @forelse($contacts as $contact)
                        <div class="bg-gray-50 rounded-xl p-4 shadow-sm">
                            <p class="font-semibold">{{ $contact->label }}</p>
                            <p class="text-gray-700">{{ $contact->value }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada data kontak.</p>
                    @endforelse
                </div>

                @if($profile?->google_maps_embed)
                    <div class="mt-6">
                        <iframe
                            src="{{ $profile->google_maps_embed }}"
                            class="w-full h-72 rounded-xl shadow-sm"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                @endif
            </div>

            <div>
                <div class="bg-gray-50 rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold mb-4">Kirim Pesan</h2>

                    <form action="{{ route('messages.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama"
                                   class="w-full rounded-lg border-gray-300">
                            @error('name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                                   class="w-full rounded-lg border-gray-300">
                            @error('email')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Subjek"
                                   class="w-full rounded-lg border-gray-300">
                            @error('subject')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <textarea name="message" rows="5" placeholder="Tulis pesan Anda..."
                                      class="w-full rounded-lg border-gray-300">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-green-700 text-white px-4 py-3 rounded-lg font-semibold hover:bg-green-800">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection