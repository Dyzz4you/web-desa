@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Manajemen Berita</h1>
        <a href="{{ route('admin.news.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Berita
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.news.index') }}" class="grid md:grid-cols-3 gap-4">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul berita..." class="rounded border-gray-300">

            <select name="status" class="rounded border-gray-300">
                <option value="">Semua Status</option>
                <option value="draft" @selected($status === 'draft')>Draft</option>
                <option value="published" @selected($status === 'published')>Published</option>
            </select>

            <button type="submit" class="bg-slate-800 text-white rounded px-4 py-2">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-slate-100">
                <tr>
                    <th class="p-3 text-left">Judul</th>
                    <th class="p-3 text-left">Penulis</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr class="border-t">
                        <td class="p-3">{{ $post->title }}</td>
                        <td class="p-3">{{ $post->user->name ?? '-' }}</td>
                        <td class="p-3">{{ ucfirst($post->status) }}</td>
                        <td class="p-3">{{ $post->created_at->format('d M Y') }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.news.show', $post) }}" class="text-blue-600">Detail</a>
                            <a href="{{ route('admin.news.edit', $post) }}" class="text-yellow-600">Edit</a>

                            <form action="{{ route('admin.news.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data berita.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $posts->links() }}</div>
@endsection