<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PopulationStatistic;
use App\Models\VillageProfile;

class PopulationStatisticController extends Controller
{
    public function index()
    {
        $profile = VillageProfile::first();

        $statistics = PopulationStatistic::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->get();

        $latestStatistic = PopulationStatistic::query()
            ->where('is_active', true)
            ->orderByDesc('year')
            ->first();

        return view('public.population.index', compact('profile', 'statistics', 'latestStatistic'));
    }
}