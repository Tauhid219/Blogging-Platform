@extends('admin.layouts.app')

@php
    $title = 'Pages';
@endphp

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Static pages</h3>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">New page</a>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead><tr><th>Title</th><th>Status</th><th>Slug</th><th></th></tr></thead>
                <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->status }}</td>
                        <td>{{ $page->slug }}</td>
                        <td class="text-right"><a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-outline-primary">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $pages->links() }}</div>
    </div>
@endsection
