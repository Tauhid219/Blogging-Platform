<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:manage categories', only: ['index']),
            new Middleware('permission:create categories', only: ['create', 'store']),
            new Middleware('permission:edit categories', only: ['edit', 'update']),
            new Middleware('permission:delete categories', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::with('parent')->orderBy('name')->paginate(15),
            'parents' => Category::orderBy('name')->get(),
        ]);
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('admin.categories.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'parent_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,hidden'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        Category::create($data + ['sort_order' => 0]);

        return back()->with('status', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'parents' => Category::whereKeyNot($category->id)->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->validate([
            'parent_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug,'.$category->id],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,hidden'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $category->update($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Category removed successfully.');
    }
}
