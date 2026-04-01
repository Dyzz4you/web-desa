@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Pesan Masuk</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.messages.index') }}" class="grid md:grid-cols-2 gap-4">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Cari nama / email / subjek..."
                class="rounded border-gray-300"
            >

            <button type="submit" class="bg-slate-800 text-white rounded px-4 py-2">
                Cari
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-slate-100">
                <tr>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Subjek</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr class="border-t {{ !$message->is_read ? 'bg-blue-50' : '' }}">
                        <td class="p-3">{{ $message->name }}</td>
                        <td class="p-3">{{ $message->email }}</td>
                        <td class="p-3">{{ $message->subject }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm {{ $message->is_read ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $message->is_read ? 'Dibaca' : 'Belum Dibaca' }}
                            </span>
                        </td>
                        <td class="p-3">{{ $message->created_at->format('d M Y H:i') }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.messages.show', $message) }}" class="text-blue-600">Detail</a>

                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                            Belum ada pesan masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
@endsection