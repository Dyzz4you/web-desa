@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Kontak</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.contacts.store') }}" method="POST">
            @csrf

            @include('admin.contacts._form')

            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>
                <a href="{{ route('admin.contacts.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection