<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePostRequest;
use App\Http\Requests\Admin\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $posts = Post::query()
            ->news()
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

        return view('admin.news.index', compact('posts', 'search', 'status'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['type'] = 'news';
        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Post $news)
    {
        abort_if($news->type !== 'news', 404);

        return view('admin.news.show', ['post' => $news]);
    }

    public function edit(Post $news)
    {
        abort_if($news->type !== 'news', 404);

        return view('admin.news.edit', ['post' => $news]);
    }

    public function update(UpdatePostRequest $request, Post $news)
    {
        abort_if($news->type !== 'news', 404);

        $data = $request->validated();
        $data['type'] = 'news';
        $data['published_at'] = $data['status'] === 'published'
            ? ($news->published_at ?? now())
            : null;

        if ($request->hasFile('thumbnail')) {
            if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
                Storage::disk('public')->delete($news->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        $news->update($data);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Post $news)
    {
        abort_if($news->type !== 'news', 404);

        if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
            Storage::disk('public')->delete($news->thumbnail);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}