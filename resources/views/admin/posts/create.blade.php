@extends('admin.layouts.app')

@php($title = 'Create post')

@section('content')
    <form method="POST" action="{{ route('admin.posts.store') }}">
        @csrf
        @include('admin.posts._form', ['submitLabel' => 'Create post'])
    </form>
@endsection
