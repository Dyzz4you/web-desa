@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Struktur Organisasi</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.organization-structures.update', $organizationStructure) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.organization-structures._form')

            <div class="mt-6 flex gap-3">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Update
                </button>
                <a href="{{ route('admin.organization-structures.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection