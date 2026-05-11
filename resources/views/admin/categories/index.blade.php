@extends('admin.layouts.app')

@php($title = 'Categories')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Create category</h3></div>
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" required></div>
                        <div class="form-group"><label>Slug</label><input type="text" name="slug" class="form-control"></div>
                        <div class="form-group">
                            <label>Parent</label>
                            <select name="parent_id" class="form-control">
                                <option value="">None</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group"><label>Description</label><textarea name="description" rows="3" class="form-control"></textarea></div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control"><option value="active">Active</option><option value="hidden">Hidden</option></select>
                        </div>
                    </div>
                    <div class="card-footer"><button class="btn btn-primary">Create</button></div>
                </form>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Category list</h3></div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead><tr><th>Name</th><th>Parent</th><th>Status</th><th></th></tr></thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->parent?->name ?? 'Root' }}</td>
                                <td>{{ $category->status }}</td>
                                <td class="text-right"><a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
