@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Manajemen UMKM</h1>
        <a href="{{ route('admin.umkms.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah UMKM
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.umkms.index') }}" class="grid md:grid-cols-3 gap-4">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Cari nama / pemilik / kategori..."
                class="rounded border-gray-300"
            >

            <select name="category" class="rounded border-gray-300">
                <option value="">Semua Kategori</option>
                @foreach($categories as $item)
                    <option value="{{ $item }}" @selected($category === $item)>{{ $item }}</option>
                @endforeach
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
                    <th class="p-3 text-left">Nama UMKM</th>
                    <th class="p-3 text-left">Pemilik</th>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($umkms as $umkm)
                    <tr class="border-t">
                        <td class="p-3">{{ $umkm->name }}</td>
                        <td class="p-3">{{ $umkm->owner_name ?? '-' }}</td>
                        <td class="p-3">{{ $umkm->category ?? '-' }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm {{ $umkm->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $umkm->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.umkms.show', $umkm) }}" class="text-blue-600">Detail</a>
                            <a href="{{ route('admin.umkms.edit', $umkm) }}" class="text-yellow-600">Edit</a>

                            <form action="{{ route('admin.umkms.destroy', $umkm) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data UMKM ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            Belum ada data UMKM.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $umkms->links() }}
    </div>
@endsection