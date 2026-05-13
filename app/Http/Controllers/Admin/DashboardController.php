<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class DashboardController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:access dashboard'),
        ];
    }

    public function __invoke(): View
    {
        return view('admin.pages.dashboard', [
            'stats' => [
                'posts' => Post::count(),
                'published_posts' => Post::published()->count(),
                'categories' => Category::count(),
                'tags' => Tag::count(),
                'comments' => Comment::count(),
                'pages' => Page::count(),
                'users' => User::count(),
            ],
            'recentPosts' => Post::with(['author', 'category'])->latest()->take(5)->get(),
            'pendingComments' => Comment::with('post')->where('status', 'pending')->latest()->take(5)->get(),
        ]);
    }
}
