<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\OrganizationStructure;
use App\Models\Post;
use App\Models\Umkm;
use App\Models\VillageGallery;
use App\Models\VillageProfile;

class HomeController extends Controller
{
public function index()
{
    $profile = VillageProfile::first();

    $sliders = VillageGallery::query()
        ->where('category', 'slider')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $galleries = VillageGallery::query()
        ->where('category', 'gallery')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->latest('id')
        ->take(8)
        ->get();

    $organizations = OrganizationStructure::where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $latestPosts = Post::query()
        ->where('type', 'news')
        ->where('status', 'published')
        ->latest()
        ->take(6)
        ->get();

    $umkms = Umkm::where('is_active', true)
        ->latest()
        ->take(8)
        ->get();

    $contacts = Contact::where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('public.home', compact(
        'profile',
        'sliders',
        'galleries',
        'organizations',
        'latestPosts',
        'umkms',
        'contacts'
    ));
    }
}