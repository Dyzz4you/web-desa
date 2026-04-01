<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOrganizationStructureRequest;
use App\Http\Requests\Admin\UpdateOrganizationStructureRequest;
use App\Models\OrganizationStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationStructureController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $organizationStructures = OrganizationStructure::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('position', 'like', '%' . $search . '%');
                });
            })
            ->when($status !== null && $status !== '', function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.organization-structures.index', compact(
            'organizationStructures',
            'search',
            'status'
        ));
    }

    public function create()
    {
        return view('admin.organization-structures.create');
    }

    public function store(StoreOrganizationStructureRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('organization-structures', 'public');
        }

        OrganizationStructure::create($data);

        return redirect()
            ->route('admin.organization-structures.index')
            ->with('success', 'Data struktur organisasi berhasil ditambahkan.');
    }

    public function show(OrganizationStructure $organizationStructure)
    {
        return view('admin.organization-structures.show', compact('organizationStructure'));
    }

    public function edit(OrganizationStructure $organizationStructure)
    {
        return view('admin.organization-structures.edit', compact('organizationStructure'));
    }

    public function update(UpdateOrganizationStructureRequest $request, OrganizationStructure $organizationStructure)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($organizationStructure->photo && Storage::disk('public')->exists($organizationStructure->photo)) {
                Storage::disk('public')->delete($organizationStructure->photo);
            }

            $data['photo'] = $request->file('photo')->store('organization-structures', 'public');
        }

        $organizationStructure->update($data);

        return redirect()
            ->route('admin.organization-structures.index')
            ->with('success', 'Data struktur organisasi berhasil diperbarui.');
    }

    public function destroy(OrganizationStructure $organizationStructure)
    {
        if ($organizationStructure->photo && Storage::disk('public')->exists($organizationStructure->photo)) {
            Storage::disk('public')->delete($organizationStructure->photo);
        }

        $organizationStructure->delete();

        return redirect()
            ->route('admin.organization-structures.index')
            ->with('success', 'Data struktur organisasi berhasil dihapus.');
    }
}