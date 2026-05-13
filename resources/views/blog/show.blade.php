@extends('layouts.frontend')

@section('content')
    <section class="px-4 py-20">
        <div class="mx-auto grid w-full max-w-5xl gap-12 lg:grid-cols-[1.7fr_.7fr]">
            <article class="space-y-8">
                <div class="space-y-4">
                    <div class="text-xs uppercase tracking-[0.3em] text-stone-400">
                        {{ optional($post->published_at)->format('M d, Y') }}
                        @if($post->category)
                            · <a href="{{ route('blog.category', $post->category) }}">{{ $post->category->name }}</a>
                        @endif
                    </div>
                    <h1 class="playfair text-4xl font-bold md:text-6xl">{{ $post->title }}</h1>
                    <p class="max-w-3xl text-lg text-stone-600">{{ $post->excerpt }}</p>
                </div>

                <img class="w-full rounded-[2rem] object-cover" src="{{ $post->featured_image_url ?: ($siteSettings['fallback_post_image_url'] ?? asset('vendor/daiva/codye2.png')) }}" alt="{{ $post->title }}">

                <div class="prose max-w-none rounded-[2rem] bg-white p-8 shadow-sm prose-headings:font-serif prose-p:text-stone-700">
                    {!! $post->body !!}
                </div>

                @if ($post->tags->isNotEmpty())
                    <div class="flex flex-wrap gap-2">
                        @foreach ($post->tags as $tag)
                            <a href="{{ route('blog.tag', $tag) }}" class="rounded-full border border-stone-200 px-4 py-2 text-sm">#{{ $tag->name }}</a>
                        @endforeach
                    </div>
                @endif

                @if ($relatedPosts->isNotEmpty())
                    <section class="space-y-6">
                        <h2 class="playfair text-3xl font-bold">Related articles</h2>
                        <div class="grid gap-6 md:grid-cols-3">
                            @foreach ($relatedPosts as $relatedPost)
                                @include('partials.frontend.post-card', ['post' => $relatedPost])
                            @endforeach
                        </div>
                    </section>
                @endif
            </article>

            <div class="space-y-8">
                @include('partials.frontend.sidebar')
                <div class="rounded-[2rem] bg-white p-6 shadow-sm">
                    <h3 class="playfair text-2xl font-bold">Author</h3>
                    <p class="mt-4 font-medium">{{ $post->author?->name }}</p>
                    <p class="mt-2 text-sm text-stone-600">{{ $post->author?->profile?->headline ?? 'Contributing writer' }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
