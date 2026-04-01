<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUmkmRequest;
use App\Http\Requests\Admin\UpdateUmkmRequest;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $category = $request->category;

        $umkms = Umkm::query()
            ->with('user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('owner_name', 'like', '%' . $search . '%')
                        ->orWhere('category', 'like', '%' . $search . '%');
                });
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Umkm::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.umkms.index', compact('umkms', 'search', 'category', 'categories'));
    }

    public function create()
    {
        return view('admin.umkms.create');
    }

    public function store(StoreUmkmRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('umkms', 'public');
        }

        Umkm::create($data);

        return redirect()
            ->route('admin.umkms.index')
            ->with('success', 'Data UMKM berhasil ditambahkan.');
    }

    public function show(Umkm $umkm)
    {
        return view('admin.umkms.show', compact('umkm'));
    }

    public function edit(Umkm $umkm)
    {
        return view('admin.umkms.edit', compact('umkm'));
    }

    public function update(UpdateUmkmRequest $request, Umkm $umkm)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($umkm->photo && Storage::disk('public')->exists($umkm->photo)) {
                Storage::disk('public')->delete($umkm->photo);
            }

            $data['photo'] = $request->file('photo')->store('umkms', 'public');
        }

        $umkm->update($data);

        return redirect()
            ->route('admin.umkms.index')
            ->with('success', 'Data UMKM berhasil diperbarui.');
    }

    public function destroy(Umkm $umkm)
    {
        if ($umkm->photo && Storage::disk('public')->exists($umkm->photo)) {
            Storage::disk('public')->delete($umkm->photo);
        }

        $umkm->delete();

        return redirect()
            ->route('admin.umkms.index')
            ->with('success', 'Data UMKM berhasil dihapus.');
    }
}