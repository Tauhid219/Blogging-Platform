@extends('layouts.frontend')

@section('content')
    <section class="px-4 py-20">
        <div class="mx-auto grid w-full max-w-5xl gap-10 md:grid-cols-[1.1fr_.9fr] md:items-center">
            <div class="space-y-6">
                <small class="border-l-2 border-black pl-2 text-xs uppercase tracking-[0.3em]">About the platform</small>
                <h1 class="playfair text-4xl font-bold md:text-6xl">A blogging system built for serious publishing.</h1>
                <p class="text-lg text-stone-600">This project combines a polished reader-facing frontend with an AdminLTE-powered control room so teams can create, review, and publish content with confidence.</p>
            </div>
            <img class="rounded-[2rem] object-cover shadow-lg" src="{{ asset('vendor/daiva/team.jpg') }}" alt="Team">
        </div>
    </section>
@endsection
