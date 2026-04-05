@extends('layouts.public')

@section('content')
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-6">APBDes / Transparansi Anggaran</h1>

            <form method="GET" class="mb-8">
                <select name="year" class="rounded-lg border-gray-300 w-full md:w-64" onchange="this.form.submit()">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $item)
                        <option value="{{ $item }}" @selected((string) $year === (string) $item)>{{ $item }}</option>
                    @endforeach
                </select>
            </form>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($budgetReports as $report)
                    <div class="bg-gray-50 rounded-2xl shadow-sm overflow-hidden">
                        @if($report->thumbnail)
                            <img src="{{ asset('storage/' . $report->thumbnail) }}" alt="{{ $report->title }}" class="w-full h-52 object-cover">
                        @endif
                        <div class="p-5">
                            <p class="text-sm text-green-700 font-medium mb-2">{{ $report->year }} - {{ strtoupper($report->type) }}</p>
                            <h3 class="text-xl font-bold mb-3">{{ $report->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $report->description }}</p>

                            @if($report->file)
                                <a href="{{ asset('storage/' . $report->file) }}" target="_blank" class="text-green-700 font-semibold">
                                    Lihat File
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada data APBDes.</p>
                @endforelse
            </div>

            <div class="mt-8">{{ $budgetReports->links() }}</div>
        </div>
    </section>
@endsection