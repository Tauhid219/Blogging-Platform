<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostRevision;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => Post::with(['author', 'category'])->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.posts.create', $this->formData(new Post()));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['author_id'] = $request->user()->id;
        $data['editor_id'] = $request->user()->id;
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        $post = Post::create($data);
        $post->tags()->sync($request->input('tag_ids', []));

        PostRevision::create([
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
            'title' => $post->title,
            'excerpt' => $post->excerpt,
            'body' => $post->body,
            'meta' => [
                'status' => $post->status,
                'seo_title' => $post->seo_title,
                'seo_description' => $post->seo_description,
            ],
        ]);

        return redirect()->route('admin.posts.index')->with('status', 'Post created successfully.');
    }

    public function show(Post $post): View
    {
        return view('admin.posts.show', [
            'post' => $post->load(['author', 'editor', 'category', 'tags', 'revisions.user']),
        ]);
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', $this->formData($post));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validatedData($request, $post->id);
        $data['editor_id'] = $request->user()->id;
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['published_at'] = $data['status'] === 'published'
            ? ($post->published_at ?: now())
            : null;

        $post->update($data);
        $post->tags()->sync($request->input('tag_ids', []));

        PostRevision::create([
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
            'title' => $post->title,
            'excerpt' => $post->excerpt,
            'body' => $post->body,
            'meta' => [
                'status' => $post->status,
                'seo_title' => $post->seo_title,
                'seo_description' => $post->seo_description,
            ],
        ]);

        return redirect()->route('admin.posts.edit', $post)->with('status', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', 'Post moved to trash.');
    }

    protected function formData(Post $post): array
    {
        return [
            'post' => $post,
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
            'statuses' => ['draft', 'in_review', 'scheduled', 'published', 'archived'],
        ];
    }

    protected function validatedData(Request $request, ?int $postId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:posts,slug,'.($postId ?: 'NULL').',id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'featured_image_path' => ['nullable', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:draft,in_review,scheduled,published,archived'],
            'is_featured' => ['nullable', 'boolean'],
            'tag_ids' => ['array'],
            'tag_ids.*' => ['exists:tags,id'],
        ]);
    }
}
