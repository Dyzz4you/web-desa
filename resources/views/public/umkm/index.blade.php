@extends('layouts.public')

@section('content')
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-6">UMKM Desa</h1>

            <form method="GET" class="grid md:grid-cols-2 gap-4 mb-8">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari UMKM..." class="rounded-lg border-gray-300">

                <select name="category" class="rounded-lg border-gray-300" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $item)
                        <option value="{{ $item }}" @selected($category === $item)>{{ $item }}</option>
                    @endforeach
                </select>
            </form>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($umkms as $umkm)
                    <div class="bg-gray-50 rounded-2xl shadow-sm overflow-hidden">
                        @if($umkm->photo)
                            <img src="{{ asset('storage/' . $umkm->photo) }}" alt="{{ $umkm->name }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-5">
                            <h3 class="text-lg font-bold">{{ $umkm->name }}</h3>
                            <p class="text-green-700 text-sm font-medium mb-2">{{ $umkm->category }}</p>
                            <p class="text-sm text-gray-600 mb-2">Pemilik: {{ $umkm->owner_name ?? '-' }}</p>
                            <p class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($umkm->description, 100) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada data UMKM.</p>
                @endforelse
            </div>

            <div class="mt-8">{{ $umkms->links() }}</div>
        </div>
    </section>
@endsection