@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Slider / Galeri Desa</h1>
        <a href="{{ route('admin.village-galleries.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Data
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.village-galleries.index') }}" class="grid md:grid-cols-3 gap-4">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Cari judul..."
                class="rounded border-gray-300"
            >

            <select name="category" class="rounded border-gray-300">
                <option value="">Semua Kategori</option>
                <option value="slider" @selected($category === 'slider')>Slider</option>
                <option value="gallery" @selected($category === 'gallery')>Gallery</option>
            </select>

            <button type="submit" class="bg-slate-800 text-white rounded px-4 py-2">
                Filter
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-slate-100">
                <tr>
                    <th class="p-3 text-left">Gambar</th>
                    <th class="p-3 text-left">Judul</th>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-left">Urutan</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galleries as $item)
                    <tr class="border-t">
                        <td class="p-3">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-20 h-14 object-cover rounded">
                        </td>
                        <td class="p-3">{{ $item->title }}</td>
                        <td class="p-3">{{ ucfirst($item->category) }}</td>
                        <td class="p-3">{{ $item->sort_order }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.village-galleries.show', $item) }}" class="text-blue-600">Detail</a>
                            <a href="{{ route('admin.village-galleries.edit', $item) }}" class="text-yellow-600">Edit</a>

                            <form action="{{ route('admin.village-galleries.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                            Belum ada data slider/galeri.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $galleries->links() }}
    </div>
@endsection