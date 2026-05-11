@extends('layouts.frontend')

@section('content')
    <section class="px-4 py-20">
        <div class="mx-auto max-w-4xl space-y-8">
            <div class="space-y-4">
                <small class="border-l-2 border-black pl-2 text-xs uppercase tracking-[0.3em]">Page</small>
                <h1 class="playfair text-4xl font-bold md:text-6xl">{{ $page->title }}</h1>
                @if ($page->excerpt)
                    <p class="text-lg text-stone-600">{{ $page->excerpt }}</p>
                @endif
            </div>
            <div class="prose max-w-none rounded-[2rem] bg-white p-8 shadow-sm">
                {!! $page->body !!}
            </div>
        </div>
    </section>
@endsection
