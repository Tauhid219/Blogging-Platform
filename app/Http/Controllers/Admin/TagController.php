<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TagController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:manage tags', only: ['index']),
            new Middleware('permission:create tags', only: ['create', 'store']),
            new Middleware('permission:edit tags', only: ['edit', 'update']),
            new Middleware('permission:delete tags', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        return view('admin.tags.index', [
            'tags' => Tag::orderBy('name')->paginate(20),
        ]);
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('admin.tags.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:tags,slug'],
            'description' => ['nullable', 'string'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        Tag::create($data);

        return back()->with('status', 'Tag created successfully.');
    }

    public function edit(Tag $tag): View
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:tags,slug,'.$tag->id],
            'description' => ['nullable', 'string'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $tag->update($data);

        return redirect()->route('admin.tags.index')->with('status', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('status', 'Tag deleted successfully.');
    }
}
