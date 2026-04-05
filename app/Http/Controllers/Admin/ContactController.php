<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContactRequest;
use App\Http\Requests\Admin\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $type = $request->type;

        $contacts = Contact::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('label', 'like', '%' . $search . '%')
                        ->orWhere('value', 'like', '%' . $search . '%');
                });
            })
            ->when($type, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $types = [
            'address',
            'phone',
            'email',
            'whatsapp',
            'map',
            'facebook',
            'instagram',
            'youtube',
            'website',
            'service_hours',
            'other',
        ];

        return view('admin.contacts.index', compact('contacts', 'search', 'type', 'types'));
    }

    public function create()
    {
        $types = [
            'address',
            'phone',
            'email',
            'whatsapp',
            'map',
            'facebook',
            'instagram',
            'youtube',
            'website',
            'service_hours',
            'other',
        ];

        return view('admin.contacts.create', compact('types'));
    }

    public function store(StoreContactRequest $request)
    {
        Contact::create($request->validated());

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Data kontak berhasil ditambahkan.');
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        $types = [
            'address',
            'phone',
            'email',
            'whatsapp',
            'map',
            'facebook',
            'instagram',
            'youtube',
            'website',
            'service_hours',
            'other',
        ];

        return view('admin.contacts.edit', compact('contact', 'types'));
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Data kontak berhasil diperbarui.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Data kontak berhasil dihapus.');
    }
}