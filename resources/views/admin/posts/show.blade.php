@extends('admin.layouts.app')

@php($title = 'Post details')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3 class="card-title">{{ $post->title }}</h3></div>
                <div class="card-body">{!! $post->body !!}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p><strong>Status:</strong> {{ $post->status }}</p>
                    <p><strong>Author:</strong> {{ $post->author?->name }}</p>
                    <p><strong>Category:</strong> {{ $post->category?->name ?? 'Uncategorized' }}</p>
                    <p><strong>Published:</strong> {{ optional($post->published_at)->format('M d, Y H:i') ?: 'Not published' }}</p>
                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary">Edit post</a>
                </div>
            </div>
        </div>
    </div>
@endsection
