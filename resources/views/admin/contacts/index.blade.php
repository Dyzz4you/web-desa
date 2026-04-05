@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Manajemen Kontak</h1>
        <a href="{{ route('admin.contacts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Kontak
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.contacts.index') }}" class="grid md:grid-cols-3 gap-4">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Cari label / isi kontak..."
                class="rounded border-gray-300"
            >

            <select name="type" class="rounded border-gray-300">
                <option value="">Semua Tipe</option>
                @foreach($types as $item)
                    <option value="{{ $item }}" @selected($type === $item)>{{ ucfirst(str_replace('_', ' ', $item)) }}</option>
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
                    <th class="p-3 text-left">Label</th>
                    <th class="p-3 text-left">Tipe</th>
                    <th class="p-3 text-left">Value</th>
                    <th class="p-3 text-left">Urutan</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr class="border-t">
                        <td class="p-3">{{ $contact->label }}</td>
                        <td class="p-3">{{ ucfirst(str_replace('_', ' ', $contact->type)) }}</td>
                        <td class="p-3">{{ \Illuminate\Support\Str::limit($contact->value, 40) }}</td>
                        <td class="p-3">{{ $contact->sort_order }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm {{ $contact->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $contact->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="text-blue-600">Detail</a>
                            <a href="{{ route('admin.contacts.edit', $contact) }}" class="text-yellow-600">Edit</a>

                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data kontak ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                            Belum ada data kontak.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $contacts->links() }}
    </div>
@endsection