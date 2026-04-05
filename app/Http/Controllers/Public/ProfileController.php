<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\OrganizationStructure;
use App\Models\VillageProfile;

class ProfileController extends Controller
{
    public function about()
    {
        $profile = VillageProfile::first();

        return view('public.profile.about', compact('profile'));
    }

    public function organization()
    {
        $profile = VillageProfile::first();

        $organizations = OrganizationStructure::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.profile.organization', compact('profile', 'organizations'));
    }

    public function map()
    {
        $profile = VillageProfile::first();

        return view('public.profile.map', compact('profile'));
    }
}