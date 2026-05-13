@extends('admin.layouts.app')

@php
    $title = 'Review comment';
@endphp

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.comments.update', $comment) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group"><label>Comment</label><textarea name="content" rows="6" class="form-control">{{ old('content', $comment->content) }}</textarea></div>
                <div class="form-group"><label>Status</label><select name="status" class="form-control"><option value="pending" @selected(old('status', $comment->status) === 'pending')>Pending</option><option value="approved" @selected(old('status', $comment->status) === 'approved')>Approved</option><option value="rejected" @selected(old('status', $comment->status) === 'rejected')>Rejected</option><option value="spam" @selected(old('status', $comment->status) === 'spam')>Spam</option></select></div>
            </div>
            <div class="card-footer"><button class="btn btn-primary">Update comment</button></div>
        </form>
    </div>
@endsection
