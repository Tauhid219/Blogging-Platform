<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function show(Page $page): View
    {
        abort_unless($page->isPublished(), 404);

        return view('pages.show', ['page' => $page]);
    }
}
