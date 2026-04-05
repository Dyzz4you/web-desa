@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Manajemen APBDes</h1>
        <a href="{{ route('admin.budget-reports.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Data
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.budget-reports.index') }}" class="grid md:grid-cols-4 gap-4">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Cari judul..."
                class="rounded border-gray-300"
            >

            <select name="year" class="rounded border-gray-300">
                <option value="">Semua Tahun</option>
                @foreach($years as $item)
                    <option value="{{ $item }}" @selected((string) $year === (string) $item)>{{ $item }}</option>
                @endforeach
            </select>

            <select name="type" class="rounded border-gray-300">
                <option value="">Semua Tipe</option>
                <option value="poster" @selected($type === 'poster')>Poster</option>
                <option value="pdf" @selected($type === 'pdf')>PDF</option>
                <option value="report" @selected($type === 'report')>Report</option>
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
                    <th class="p-3 text-left">Judul</th>
                    <th class="p-3 text-left">Tahun</th>
                    <th class="p-3 text-left">Tipe</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($budgetReports as $item)
                    <tr class="border-t">
                        <td class="p-3">{{ $item->title }}</td>
                        <td class="p-3">{{ $item->year }}</td>
                        <td class="p-3">{{ strtoupper($item->type) }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.budget-reports.show', $item) }}" class="text-blue-600">Detail</a>
                            <a href="{{ route('admin.budget-reports.edit', $item) }}" class="text-yellow-600">Edit</a>

                            <form action="{{ route('admin.budget-reports.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            Belum ada data APBDes.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $budgetReports->links() }}
    </div>
@endsection