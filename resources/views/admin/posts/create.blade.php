@extends('admin.layouts.app')

@php
    $title = 'Create post';
@endphp

@section('content')
    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.posts._form', ['submitLabel' => 'Create post'])
    </form>
@endsection

@include('admin.partials.rich-text-editor')
