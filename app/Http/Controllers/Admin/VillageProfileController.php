<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateVillageProfileRequest;
use App\Models\VillageProfile;
use Illuminate\Support\Facades\Storage;

class VillageProfileController extends Controller
{
    public function edit()
    {
        $profile = VillageProfile::first();

        if (! $profile) {
            $profile = VillageProfile::create([
                'village_name' => 'Nama Desa',
            ]);
        }

        return view('admin.village-profile.edit', compact('profile'));
    }

    public function update(UpdateVillageProfileRequest $request)
    {
        $profile = VillageProfile::first();

        if (! $profile) {
            $profile = VillageProfile::create([
                'village_name' => 'Nama Desa',
            ]);
        }

        $data = $request->validated();

        if ($request->hasFile('hero_image')) {
            if ($profile->hero_image && Storage::disk('public')->exists($profile->hero_image)) {
                Storage::disk('public')->delete($profile->hero_image);
            }

            $data['hero_image'] = $request->file('hero_image')->store('village-profile', 'public');
        }

        $profile->update($data);

        return redirect()
            ->route('admin.village-profile.edit')
            ->with('success', 'Profil desa berhasil diperbarui.');
    }
}