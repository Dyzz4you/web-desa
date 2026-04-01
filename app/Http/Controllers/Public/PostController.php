<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $posts = Post::where('status', 'published')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('excerpt', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('public.posts.index', compact('posts', 'search'));
    }

    public function show(string $slug)
    {
        $post = Post::where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.posts.show', compact('post', 'relatedPosts'));
    }
}