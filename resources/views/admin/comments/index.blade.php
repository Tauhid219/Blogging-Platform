@extends('admin.layouts.app')

@php
    $title = 'Comments';
@endphp

@section('content')
    <div class="card">
        <div class="card-header"><h3 class="card-title">Moderation queue</h3></div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead><tr><th>Author</th><th>Comment</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->user?->name ?? $comment->guest_name ?? 'Guest' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($comment->content, 80) }}</td>
                        <td>{{ $comment->status }}</td>
                        <td class="text-right"><a href="{{ route('admin.comments.edit', $comment) }}" class="btn btn-sm btn-outline-primary">Review</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $comments->links() }}</div>
    </div>
@endsection
