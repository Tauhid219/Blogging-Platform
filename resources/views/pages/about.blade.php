@extends('layouts.frontend')

@section('content')
    <section class="px-4 py-20">
        <div class="mx-auto grid w-full max-w-5xl gap-10 md:grid-cols-[1.1fr_.9fr] md:items-center">
            <div class="space-y-6">
                <small class="border-l-2 border-black pl-2 text-xs uppercase tracking-[0.3em]">About the platform</small>
                <h1 class="playfair text-4xl font-bold md:text-6xl">{{ $page->title }}</h1>
                @if ($page->excerpt)
                    <p class="text-lg text-stone-600">{{ $page->excerpt }}</p>
                @endif
            </div>
            <img class="rounded-[2rem] object-cover shadow-lg" src="{{ asset('vendor/daiva/team.jpg') }}" alt="Team">
        </div>

        @if ($page->body)
            <div class="mx-auto mt-12 max-w-5xl">
                <div class="prose max-w-none rounded-[2rem] bg-white p-8 shadow-sm">
                    {!! $page->body !!}
                </div>
            </div>
        @endif
    </section>
@endsection
