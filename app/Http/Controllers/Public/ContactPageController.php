<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\VillageProfile;

class ContactPageController extends Controller
{
    public function index()
    {
        $profile = VillageProfile::first();

        $contacts = Contact::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.contact.index', compact('profile', 'contacts'));
    }
}
