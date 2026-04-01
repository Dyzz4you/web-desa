<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\OrganizationStructure;
use App\Models\Post;
use App\Models\Umkm;
use App\Models\VillageProfile;

class HomeController extends Controller
{
    public function index()
    {
        $profile = VillageProfile::first();

        $organizations = OrganizationStructure::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $latestPosts = Post::where('status', 'published')
            ->latest()
            ->take(6)
            ->get();

        $umkms = Umkm::where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        return view('public.home', compact(
            'profile',
            'organizations',
            'latestPosts',
            'umkms'
        ));
    }
}