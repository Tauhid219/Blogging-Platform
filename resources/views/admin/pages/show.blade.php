@extends('admin.layouts.app')

@php($title = 'Page preview')

@section('content')
    <div class="card">
        <div class="card-header"><h3 class="card-title">{{ $page->title }}</h3></div>
        <div class="card-body">{!! $page->body !!}</div>
    </div>
@endsection
