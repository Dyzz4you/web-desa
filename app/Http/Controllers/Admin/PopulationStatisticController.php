<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePopulationStatisticRequest;
use App\Http\Requests\Admin\UpdatePopulationStatisticRequest;
use App\Models\PopulationStatistic;
use Illuminate\Http\Request;

class PopulationStatisticController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $statistics = PopulationStatistic::query()
            ->when($search, function ($query) use ($search) {
                $query->where('year', 'like', '%' . $search . '%');
            })
            ->when($status !== null && $status !== '', function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->orderByDesc('year')
            ->paginate(10)
            ->withQueryString();

        return view('admin.population-statistics.index', compact('statistics', 'search', 'status'));
    }

    public function create()
    {
        return view('admin.population-statistics.create');
    }

    public function store(StorePopulationStatisticRequest $request)
    {
        PopulationStatistic::create($request->validated());

        return redirect()
            ->route('admin.population-statistics.index')
            ->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function show(PopulationStatistic $populationStatistic)
    {
        return view('admin.population-statistics.show', compact('populationStatistic'));
    }

    public function edit(PopulationStatistic $populationStatistic)
    {
        return view('admin.population-statistics.edit', compact('populationStatistic'));
    }

    public function update(UpdatePopulationStatisticRequest $request, PopulationStatistic $populationStatistic)
    {
        $populationStatistic->update($request->validated());

        return redirect()
            ->route('admin.population-statistics.index')
            ->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(PopulationStatistic $populationStatistic)
    {
        $populationStatistic->delete();

        return redirect()
            ->route('admin.population-statistics.index')
            ->with('success', 'Data penduduk berhasil dihapus.');
    }
}