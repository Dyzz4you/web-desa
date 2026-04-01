<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Post;
use App\Models\Umkm;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => Post::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'umkms' => Umkm::count(),
            'messages' => Message::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
            'users' => User::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}