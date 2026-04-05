<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVillageGalleryRequest;
use App\Http\Requests\Admin\UpdateVillageGalleryRequest;
use App\Models\VillageGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VillageGalleryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $category = $request->category;

        $galleries = VillageGallery::query()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.village-galleries.index', compact('galleries', 'search', 'category'));
    }

    public function create()
    {
        return view('admin.village-galleries.create');
    }

    public function store(StoreVillageGalleryRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('village-galleries', 'public');

        VillageGallery::create($data);

        return redirect()
            ->route('admin.village-galleries.index')
            ->with('success', 'Data slider/galeri berhasil ditambahkan.');
    }

    public function show(VillageGallery $villageGallery)
    {
        return view('admin.village-galleries.show', compact('villageGallery'));
    }

    public function edit(VillageGallery $villageGallery)
    {
        return view('admin.village-galleries.edit', compact('villageGallery'));
    }

    public function update(UpdateVillageGalleryRequest $request, VillageGallery $villageGallery)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($villageGallery->image && Storage::disk('public')->exists($villageGallery->image)) {
                Storage::disk('public')->delete($villageGallery->image);
            }

            $data['image'] = $request->file('image')->store('village-galleries', 'public');
        }

        $villageGallery->update($data);

        return redirect()
            ->route('admin.village-galleries.index')
            ->with('success', 'Data slider/galeri berhasil diperbarui.');
    }

    public function destroy(VillageGallery $villageGallery)
    {
        if ($villageGallery->image && Storage::disk('public')->exists($villageGallery->image)) {
            Storage::disk('public')->delete($villageGallery->image);
        }

        $villageGallery->delete();

        return redirect()
            ->route('admin.village-galleries.index')
            ->with('success', 'Data slider/galeri berhasil dihapus.');
    }
}