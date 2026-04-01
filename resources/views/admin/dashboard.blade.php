@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-5">
            <p class="text-sm text-gray-500">Total Berita</p>
            <h2 class="text-3xl font-bold">{{ $stats['posts'] }}</h2>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <p class="text-sm text-gray-500">Berita Publish</p>
            <h2 class="text-3xl font-bold">{{ $stats['published_posts'] }}</h2>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <p class="text-sm text-gray-500">Total UMKM</p>
            <h2 class="text-3xl font-bold">{{ $stats['umkms'] }}</h2>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <p class="text-sm text-gray-500">Total Pesan</p>
            <h2 class="text-3xl font-bold">{{ $stats['messages'] }}</h2>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <p class="text-sm text-gray-500">Pesan Belum Dibaca</p>
            <h2 class="text-3xl font-bold">{{ $stats['unread_messages'] }}</h2>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <p class="text-sm text-gray-500">Total User</p>
            <h2 class="text-3xl font-bold">{{ $stats['users'] }}</h2>
        </div>
    </div>
@endsection