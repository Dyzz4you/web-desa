@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Data Penduduk</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.population-statistics.store') }}" method="POST">
            @csrf

            @include('admin.population-statistics._form')

            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>
                <a href="{{ route('admin.population-statistics.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection