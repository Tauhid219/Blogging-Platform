@extends('admin.layouts.app')

@php
    $title = 'Edit tag';
@endphp

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.tags.update', $tag) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $tag->name) }}"></div>
                <div class="form-group"><label>Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $tag->slug) }}"></div>
                <div class="form-group"><label>Description</label><textarea name="description" rows="3" class="form-control">{{ old('description', $tag->description) }}</textarea></div>
            </div>
            <div class="card-footer"><button class="btn btn-primary">Save changes</button></div>
        </form>
    </div>
@endsection
