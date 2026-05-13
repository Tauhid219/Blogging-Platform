@extends('admin.layouts.app')

@php
    $title = 'Posts';
@endphp

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">All posts</h3>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">New post</a>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead><tr><th>Title</th><th>Status</th><th>Category</th><th>Author</th><th></th></tr></thead>
                <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td><span class="badge badge-secondary">{{ $post->status }}</span></td>
                        <td>{{ $post->category?->name ?? 'Uncategorized' }}</td>
                        <td>{{ $post->author?->name }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-outline-secondary">View</a>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">No posts found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $posts->links() }}</div>
    </div>
@endsection
