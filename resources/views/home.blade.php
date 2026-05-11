@extends('layouts.frontend')

@section('content')
    <section class="px-4 py-24">
        <div class="mx-auto flex w-full max-w-5xl flex-col gap-8 sm:flex-row">
            <div class="hidden w-full max-w-[400px] sm:block">
                <img class="w-full object-cover" src="{{ asset('vendor/daiva/codye.png') }}" alt="Hero">
            </div>
            <div class="flex w-full flex-col items-start gap-4">
                <small class="mb-4 border-l-2 border-black pl-2 text-xs uppercase tracking-[0.3em]">Done with passion</small>
                <h1 class="playfair text-2xl font-bold md:text-4xl xl:text-6xl">{{ $siteSettings['site_tagline'] ?? 'Build by developers for developers' }}</h1>
                <p class="text-md text-gray-500">{{ $siteSettings['site_description'] ?? 'A structured, multi-user publishing platform for serious editorial work.' }}</p>
                <a class="mt-4 rounded-full bg-black px-6 py-2 text-white hover:bg-gray-800" href="{{ route('blog.index') }}">Read the latest</a>
            </div>
        </div>
    </section>

    <section class="px-4 py-20">
        <div class="mx-auto w-full max-w-5xl space-y-8">
            <small class="border-l-2 border-black pl-2 text-xs uppercase tracking-[0.3em]">Featured writing</small>
            <div class="grid gap-6 md:grid-cols-3">
                @forelse ($featuredPosts as $post)
                    @include('partials.frontend.post-card', ['post' => $post])
                @empty
                    <p class="text-stone-500">Featured posts will appear here once the editorial team starts publishing.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="px-4 py-20">
        <div class="mx-auto w-full max-w-5xl space-y-8">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <small class="border-l-2 border-black pl-2 text-xs uppercase tracking-[0.3em]">Fresh updates</small>
                    <h2 class="playfair mt-4 text-4xl font-bold">Latest from the blog</h2>
                </div>
                <a class="underline" href="{{ route('blog.index') }}">View all posts</a>
            </div>
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($latestPosts as $post)
                    @include('partials.frontend.post-card', ['post' => $post])
                @empty
                    <p class="text-stone-500">No posts have been published yet.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
