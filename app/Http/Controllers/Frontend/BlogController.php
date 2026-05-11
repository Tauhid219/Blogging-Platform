<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('blog.index', [
            'posts' => Post::published()->with(['author', 'category', 'tags'])->latest('published_at')->paginate(9),
            'title' => 'Latest articles',
            'description' => 'Fresh writing, publishing notes, and platform updates.',
        ]);
    }

    public function show(Post $post): View
    {
        abort_unless($post->isPublished(), 404);

        return view('blog.show', [
            'post' => $post->load(['author.profile', 'category', 'tags', 'comments.user']),
            'relatedPosts' => Post::published()
                ->whereKeyNot($post->getKey())
                ->when($post->category_id, fn ($query) => $query->where('category_id', $post->category_id))
                ->latest('published_at')
                ->take(3)
                ->get(),
        ]);
    }

    public function category(Category $category): View
    {
        return view('blog.index', [
            'posts' => $category->posts()->published()->with(['author', 'category', 'tags'])->latest('published_at')->paginate(9),
            'title' => "Category: {$category->name}",
            'description' => $category->description ?: 'Articles grouped by category.',
        ]);
    }

    public function tag(Tag $tag): View
    {
        return view('blog.index', [
            'posts' => $tag->posts()->published()->with(['author', 'category', 'tags'])->latest('published_at')->paginate(9),
            'title' => "Tag: {$tag->name}",
            'description' => $tag->description ?: 'Articles grouped by topic.',
        ]);
    }
}
