@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail Kontak</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold">Label</h3>
                <p>{{ $contact->label }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Tipe</h3>
                <p>{{ ucfirst(str_replace('_', ' ', $contact->type)) }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Urutan</h3>
                <p>{{ $contact->sort_order }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Status</h3>
                <p>{{ $contact->is_active ? 'Aktif' : 'Nonaktif' }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="font-semibold">Isi / Value</h3>
            <div class="whitespace-pre-line bg-gray-50 rounded p-4">
                {{ $contact->value ?? '-' }}
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.contacts.edit', $contact) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Edit
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </div>
@endsection