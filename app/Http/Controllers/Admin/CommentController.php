<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(): View
    {
        return view('admin.comments.index', [
            'comments' => Comment::with(['post', 'user'])->latest()->paginate(20),
            'statuses' => ['pending', 'approved', 'rejected', 'spam'],
        ]);
    }

    public function edit(Comment $comment): View
    {
        return view('admin.comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment): RedirectResponse
    {
        $data = $request->validate([
            'content' => ['required', 'string'],
            'status' => ['required', 'in:pending,approved,rejected,spam'],
        ]);

        if ($data['status'] === 'approved' && blank($comment->approved_at)) {
            $data['approved_at'] = now();
        }

        $comment->update($data);

        return redirect()->route('admin.comments.index')->with('status', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('status', 'Comment deleted successfully.');
    }
}
