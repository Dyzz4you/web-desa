@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Data Penduduk</h1>
        <a href="{{ route('admin.population-statistics.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Data
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.population-statistics.index') }}" class="grid md:grid-cols-3 gap-4">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Cari tahun..."
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
                    <th class="p-3 text-left">Tahun</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Laki-laki</th>
                    <th class="p-3 text-left">Perempuan</th>
                    <th class="p-3 text-left">KK</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($statistics as $item)
                    <tr class="border-t">
                        <td class="p-3">{{ $item->year }}</td>
                        <td class="p-3">{{ $item->total_population }}</td>
                        <td class="p-3">{{ $item->male_count }}</td>
                        <td class="p-3">{{ $item->female_count }}</td>
                        <td class="p-3">{{ $item->family_count }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.population-statistics.show', $item) }}" class="text-blue-600">Detail</a>
                            <a href="{{ route('admin.population-statistics.edit', $item) }}" class="text-yellow-600">Edit</a>

                            <form action="{{ route('admin.population-statistics.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-500">
                            Belum ada data penduduk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $statistics->links() }}
    </div>
@endsection