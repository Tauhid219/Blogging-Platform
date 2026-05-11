<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:media.view')->only('index');
    }

    public function index(): View
    {
        return view('admin.media.index', [
            'mediaItems' => Media::with('user')->latest()->paginate(20),
        ]);
    }
}
