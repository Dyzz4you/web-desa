<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BudgetReport;
use App\Models\VillageProfile;
use Illuminate\Http\Request;

class BudgetReportController extends Controller
{
    public function index(Request $request)
    {
        $profile = VillageProfile::first();
        $year = $request->year;

        $budgetReports = BudgetReport::query()
            ->where('is_active', true)
            ->when($year, function ($query) use ($year) {
                $query->where('year', $year);
            })
            ->orderByDesc('year')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $years = BudgetReport::query()
            ->select('year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        return view('public.budget.index', compact('profile', 'budgetReports', 'years', 'year'));
    }
}