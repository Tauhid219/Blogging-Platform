@extends('layouts.frontend')

@section('content')
    <section class="px-4 py-20">
        <div class="mx-auto w-full max-w-5xl space-y-6">
            <small class="border-l-2 border-black pl-2 text-xs uppercase tracking-[0.3em]">Editorial archive</small>
            <h1 class="playfair text-4xl font-bold md:text-5xl">{{ $title }}</h1>
            <p class="max-w-2xl text-stone-600">{{ $description }}</p>
        </div>
    </section>

    <section class="px-4 pb-20">
        <div class="mx-auto grid w-full max-w-5xl gap-10 lg:grid-cols-[1.8fr_.8fr]">
            <div class="space-y-8">
                <div class="grid gap-6 md:grid-cols-2">
                    @forelse ($posts as $post)
                        @include('partials.frontend.post-card', ['post' => $post])
                    @empty
                        <div class="rounded-[2rem] bg-white p-8 text-stone-500 shadow-sm">No published posts matched this archive yet.</div>
                    @endforelse
                </div>
                {{ $posts->links() }}
            </div>

            @include('partials.frontend.sidebar')
        </div>
    </section>
@endsection
