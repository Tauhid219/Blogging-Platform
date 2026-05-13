@extends('admin.layouts.app')

@php
    $title = 'Create page';
@endphp

@section('content')
    <form method="POST" action="{{ route('admin.pages.store') }}">
        @csrf
        @include('admin.pages.form', ['submitLabel' => 'Create page'])
    </form>
@endsection

@include('admin.partials.rich-text-editor')
