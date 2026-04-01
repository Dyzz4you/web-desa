@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail Pesan</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="font-semibold">Nama</h3>
                <p>{{ $message->name }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Email</h3>
                <p>{{ $message->email }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Subjek</h3>
                <p>{{ $message->subject }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Tanggal</h3>
                <p>{{ $message->created_at->format('d M Y H:i') }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Status</h3>
                <p>{{ $message->is_read ? 'Dibaca' : 'Belum Dibaca' }}</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold mb-2">Isi Pesan</h3>
            <div class="whitespace-pre-line bg-gray-50 rounded p-4">
                {{ $message->message }}
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.messages.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                Kembali
            </a>

            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                    Hapus
                </button>
            </form>
        </div>
    </div>
@endsection