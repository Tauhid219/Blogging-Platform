@extends('admin.layouts.app')

@php
    $title = 'Dashboard';
@endphp

@section('content')
    <div class="row">
        @foreach ([
            ['label' => 'Posts', 'value' => $stats['posts'], 'icon' => 'far fa-newspaper', 'color' => 'info'],
            ['label' => 'Published', 'value' => $stats['published_posts'], 'icon' => 'fas fa-check-circle', 'color' => 'success'],
            ['label' => 'Categories', 'value' => $stats['categories'], 'icon' => 'fas fa-sitemap', 'color' => 'primary'],
            ['label' => 'Users', 'value' => $stats['users'], 'icon' => 'fas fa-users', 'color' => 'warning'],
        ] as $card)
            <div class="col-lg-3 col-6">
                <div class="small-box bg-{{ $card['color'] }}">
                    <div class="inner">
                        <h3>{{ $card['value'] }}</h3>
                        <p>{{ $card['label'] }}</p>
                    </div>
                    <div class="icon"><i class="{{ $card['icon'] }}"></i></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Recent posts</h3></div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead><tr><th>Title</th><th>Status</th><th>Author</th><th>Published</th></tr></thead>
                        <tbody>
                        @forelse ($recentPosts as $post)
                            <tr>
                                <td><a href="{{ route('admin.posts.edit', $post) }}">{{ $post->title }}</a></td>
                                <td><span class="badge badge-secondary">{{ $post->status }}</span></td>
                                <td>{{ $post->author?->name }}</td>
                                <td>{{ optional($post->published_at)->format('M d, Y') ?: 'Not published' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted">No posts yet.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Pending comments</h3></div>
                <div class="card-body">
                    @forelse ($pendingComments as $comment)
                        <div class="mb-3 border-bottom pb-3">
                            <strong>{{ $comment->user?->name ?? $comment->guest_name ?? 'Guest' }}</strong>
                            <p class="mb-1 text-sm">{{ \Illuminate\Support\Str::limit($comment->content, 90) }}</p>
                            <a href="{{ route('admin.comments.edit', $comment) }}" class="text-sm">Review comment</a>
                        </div>
                    @empty
                        <p class="mb-0 text-muted">No pending comments right now.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
