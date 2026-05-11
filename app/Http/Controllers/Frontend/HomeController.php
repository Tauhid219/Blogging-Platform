<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        if (! Schema::hasTable('posts')) {
            return view('home', [
                'featuredPosts' => collect(),
                'latestPosts' => collect(),
            ]);
        }

        $featuredPosts = Post::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', [
            'featuredPosts' => $featuredPosts,
            'latestPosts' => Post::published()->latest('published_at')->take(6)->get(),
        ]);
    }
}
