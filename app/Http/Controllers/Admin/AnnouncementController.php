<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePostRequest;
use App\Http\Requests\Admin\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $posts = Post::query()
            ->announcement()
            ->with('user')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.announcements.index', compact('posts', 'search', 'status'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['type'] = 'announcement';
        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function show(Post $announcement)
    {
        abort_if($announcement->type !== 'announcement', 404);

        return view('admin.announcements.show', ['post' => $announcement]);
    }

    public function edit(Post $announcement)
    {
        abort_if($announcement->type !== 'announcement', 404);

        return view('admin.announcements.edit', ['post' => $announcement]);
    }

    public function update(UpdatePostRequest $request, Post $announcement)
    {
        abort_if($announcement->type !== 'announcement', 404);

        $data = $request->validated();
        $data['type'] = 'announcement';
        $data['published_at'] = $data['status'] === 'published'
            ? ($announcement->published_at ?? now())
            : null;

        if ($request->hasFile('thumbnail')) {
            if ($announcement->thumbnail && Storage::disk('public')->exists($announcement->thumbnail)) {
                Storage::disk('public')->delete($announcement->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        $announcement->update($data);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Post $announcement)
    {
        abort_if($announcement->type !== 'announcement', 404);

        if ($announcement->thumbnail && Storage::disk('public')->exists($announcement->thumbnail)) {
            Storage::disk('public')->delete($announcement->thumbnail);
        }

        $announcement->delete();

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}