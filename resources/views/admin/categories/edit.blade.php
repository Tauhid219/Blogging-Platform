@extends('admin.layouts.app')

@php($title = 'Edit category')

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group"><label>Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}"></div>
                    <div class="col-md-6 form-group"><label>Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}"></div>
                </div>
                <div class="form-group"><label>Parent</label><select name="parent_id" class="form-control"><option value="">None</option>@foreach($parents as $parent)<option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>@endforeach</select></div>
                <div class="form-group"><label>Description</label><textarea name="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea></div>
                <div class="form-group"><label>Status</label><select name="status" class="form-control"><option value="active" @selected(old('status', $category->status) === 'active')>Active</option><option value="hidden" @selected(old('status', $category->status) === 'hidden')>Hidden</option></select></div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?');">
        @csrf
        @method('DELETE')
        <button class="btn btn-outline-danger mt-3">Delete category</button>
    </form>
@endsection
