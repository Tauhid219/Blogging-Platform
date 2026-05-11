<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tags.view')->only(['index', 'edit']);
        $this->middleware('permission:tags.create')->only(['create', 'store']);
        $this->middleware('permission:tags.update')->only('update');
        $this->middleware('permission:tags.delete')->only('destroy');
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
