<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MediaController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:manage media', only: ['index']),
            new Middleware('permission:create media', only: ['storeEditorImage']),
        ];
    }

    public function index(): View
    {
        return view('admin.media.index', [
            'mediaItems' => Media::with('user')->latest()->paginate(20),
        ]);
    }

    public function storeEditorImage(Request $request): JsonResponse
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
        ]);

        $image = $data['image'];
        $directory = 'editor-images';
        $storedPath = $image->store($directory, 'public');

        $media = Media::create([
            'user_id' => $request->user()->id,
            'disk' => 'public',
            'directory' => $directory,
            'filename' => basename($storedPath),
            'original_name' => $image->getClientOriginalName(),
            'mime_type' => $image->getClientMimeType() ?: $image->getMimeType() ?: 'application/octet-stream',
            'extension' => $image->getClientOriginalExtension(),
            'size' => $image->getSize(),
            'alt_text' => Str::headline(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)),
        ]);

        return response()->json([
            'id' => $media->id,
            'url' => asset('storage/'.$storedPath),
            'alt_text' => $media->alt_text,
        ]);
    }
}
