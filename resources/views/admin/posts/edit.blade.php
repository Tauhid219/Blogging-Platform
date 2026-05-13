@extends('admin.layouts.app')

@php
    $title = 'Edit post';
@endphp

@section('content')
    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.posts._form', ['submitLabel' => 'Save changes'])
    </form>
@endsection

@include('admin.partials.rich-text-editor')
