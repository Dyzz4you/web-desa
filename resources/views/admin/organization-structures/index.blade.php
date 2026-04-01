@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Struktur Organisasi</h1>
        <a href="{{ route('admin.organization-structures.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Data
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.organization-structures.index') }}" class="grid md:grid-cols-3 gap-4">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Cari nama / jabatan..."
                class="rounded border-gray-300"
            >

            <select name="status" class="rounded border-gray-300">
                <option value="">Semua Status</option>
                <option value="1" @selected((string) $status === '1')>Aktif</option>
                <option value="0" @selected((string) $status === '0')>Nonaktif</option>
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
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Jabatan</th>
                    <th class="p-3 text-left">Urutan</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($organizationStructures as $item)
                    <tr class="border-t">
                        <td class="p-3">{{ $item->name }}</td>
                        <td class="p-3">{{ $item->position }}</td>
                        <td class="p-3">{{ $item->sort_order }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.organization-structures.show', $item) }}" class="text-blue-600">Detail</a>
                            <a href="{{ route('admin.organization-structures.edit', $item) }}" class="text-yellow-600">Edit</a>

                            <form action="{{ route('admin.organization-structures.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            Belum ada data struktur organisasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $organizationStructures->links() }}
    </div>
@endsection