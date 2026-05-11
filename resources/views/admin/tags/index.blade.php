@extends('admin.layouts.app')

@php($title = 'Tags')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Create tag</h3></div>
                <form method="POST" action="{{ route('admin.tags.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" required></div>
                        <div class="form-group"><label>Slug</label><input type="text" name="slug" class="form-control"></div>
                        <div class="form-group"><label>Description</label><textarea name="description" rows="3" class="form-control"></textarea></div>
                    </div>
                    <div class="card-footer"><button class="btn btn-primary">Create</button></div>
                </form>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Tag list</h3></div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead><tr><th>Name</th><th>Slug</th><th></th></tr></thead>
                        <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td class="text-right"><a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-outline-primary">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
