@extends('admin.layouts.app')

@php($title = 'Edit post')

@section('content')
    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
        @csrf
        @method('PUT')
        @include('admin.posts._form', ['submitLabel' => 'Save changes'])
    </form>
@endsection
