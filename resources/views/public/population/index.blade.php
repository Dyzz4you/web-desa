@extends('layouts.public')

@section('content')
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-6">Data Penduduk</h1>

            @if($latestStatistic)
                <div class="grid md:grid-cols-4 gap-6 mb-10">
                    <div class="bg-gray-50 rounded-2xl p-6 shadow-sm">
                        <p class="text-sm text-gray-500">Total Penduduk</p>
                        <h2 class="text-3xl font-bold">{{ $latestStatistic->total_population }}</h2>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-6 shadow-sm">
                        <p class="text-sm text-gray-500">Laki-laki</p>
                        <h2 class="text-3xl font-bold">{{ $latestStatistic->male_count }}</h2>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-6 shadow-sm">
                        <p class="text-sm text-gray-500">Perempuan</p>
                        <h2 class="text-3xl font-bold">{{ $latestStatistic->female_count }}</h2>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-6 shadow-sm">
                        <p class="text-sm text-gray-500">Jumlah KK</p>
                        <h2 class="text-3xl font-bold">{{ $latestStatistic->family_count }}</h2>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <table class="w-full border-collapse">
                    <thead class="bg-slate-100">
                        <tr>
                            <th class="p-3 text-left">Tahun</th>
                            <th class="p-3 text-left">Total</th>
                            <th class="p-3 text-left">Laki-laki</th>
                            <th class="p-3 text-left">Perempuan</th>
                            <th class="p-3 text-left">KK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($statistics as $item)
                            <tr class="border-t">
                                <td class="p-3">{{ $item->year }}</td>
                                <td class="p-3">{{ $item->total_population }}</td>
                                <td class="p-3">{{ $item->male_count }}</td>
                                <td class="p-3">{{ $item->female_count }}</td>
                                <td class="p-3">{{ $item->family_count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data penduduk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection