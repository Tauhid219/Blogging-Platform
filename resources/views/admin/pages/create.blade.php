@extends('admin.layouts.app')

@php($title = 'Create page')

@section('content')
    <form method="POST" action="{{ route('admin.pages.store') }}">
        @csrf
        @include('admin.pages.form', ['submitLabel' => 'Create page'])
    </form>
@endsection
