@extends('admin.layouts.app')

@php
    $title = 'Edit page';
@endphp

@section('content')
    <form method="POST" action="{{ route('admin.pages.update', $page) }}">
        @csrf
        @method('PUT')
        @include('admin.pages.form', ['submitLabel' => 'Save changes'])
    </form>
@endsection

@include('admin.partials.rich-text-editor')
