<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\VillageProfile;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $profile = VillageProfile::first();
        $search = $request->search;

        $posts = Post::query()
            ->where('type', 'news')
            ->where('status', 'published')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhere('excerpt', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('public.information.news.index', compact('profile', 'posts', 'search'));
    }

    public function show(string $slug)
    {
        $profile = VillageProfile::first();

        $post = Post::query()
            ->where('type', 'news')
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedPosts = Post::query()
            ->where('type', 'news')
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.information.news.show', compact('profile', 'post', 'relatedPosts'));
    }
}
