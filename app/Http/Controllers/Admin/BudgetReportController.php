<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBudgetReportRequest;
use App\Http\Requests\Admin\UpdateBudgetReportRequest;
use App\Models\BudgetReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BudgetReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $year = $request->year;
        $type = $request->type;

        $budgetReports = BudgetReport::query()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($year, function ($query) use ($year) {
                $query->where('year', $year);
            })
            ->when($type, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->orderByDesc('year')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $years = BudgetReport::query()
            ->select('year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        return view('admin.budget-reports.index', compact(
            'budgetReports',
            'search',
            'year',
            'type',
            'years'
        ));
    }

    public function create()
    {
        return view('admin.budget-reports.create');
    }

    public function store(StoreBudgetReportRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('budget-reports/files', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('budget-reports/thumbnails', 'public');
        }

        BudgetReport::create($data);

        return redirect()
            ->route('admin.budget-reports.index')
            ->with('success', 'Data APBDes berhasil ditambahkan.');
    }

    public function show(BudgetReport $budgetReport)
    {
        return view('admin.budget-reports.show', compact('budgetReport'));
    }

    public function edit(BudgetReport $budgetReport)
    {
        return view('admin.budget-reports.edit', compact('budgetReport'));
    }

    public function update(UpdateBudgetReportRequest $request, BudgetReport $budgetReport)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            if ($budgetReport->file && Storage::disk('public')->exists($budgetReport->file)) {
                Storage::disk('public')->delete($budgetReport->file);
            }

            $data['file'] = $request->file('file')->store('budget-reports/files', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($budgetReport->thumbnail && Storage::disk('public')->exists($budgetReport->thumbnail)) {
                Storage::disk('public')->delete($budgetReport->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')->store('budget-reports/thumbnails', 'public');
        }

        $budgetReport->update($data);

        return redirect()
            ->route('admin.budget-reports.index')
            ->with('success', 'Data APBDes berhasil diperbarui.');
    }

    public function destroy(BudgetReport $budgetReport)
    {
        if ($budgetReport->file && Storage::disk('public')->exists($budgetReport->file)) {
            Storage::disk('public')->delete($budgetReport->file);
        }

        if ($budgetReport->thumbnail && Storage::disk('public')->exists($budgetReport->thumbnail)) {
            Storage::disk('public')->delete($budgetReport->thumbnail);
        }

        $budgetReport->delete();

        return redirect()
            ->route('admin.budget-reports.index')
            ->with('success', 'Data APBDes berhasil dihapus.');
    }
}