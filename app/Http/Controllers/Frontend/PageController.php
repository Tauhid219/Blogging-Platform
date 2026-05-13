<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        $page = Page::published()
            ->where(function ($query) {
                $query
                    ->where('template', 'about')
                    ->orWhereIn('slug', ['about', 'about-the-platform']);
            })
            ->latest('published_at')
            ->first();

        if (! $page) {
            $publishedPages = Page::published()
                ->latest('published_at')
                ->get();

            if ($publishedPages->count() === 1) {
                $page = $publishedPages->first();
            }
        }

        if (! $page) {
            throw (new ModelNotFoundException())->setModel(Page::class);
        }

        return view('pages.about', [
            'page' => $page,
            'title' => $page->seo_title ?: $page->title,
            'metaDescription' => $page->seo_description ?: $page->excerpt,
        ]);
    }

    public function show(Page $page): View
    {
        abort_unless($page->isPublished(), 404);

        return view('pages.show', ['page' => $page]);
    }
}
