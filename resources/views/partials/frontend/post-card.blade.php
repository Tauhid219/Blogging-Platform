<article class="flex h-full flex-col gap-4 rounded-[2rem] bg-white p-5 shadow-sm">
    <div class="aspect-[4/3] overflow-hidden rounded-[1.5rem] bg-stone-100">
        <img class="h-full w-full object-cover" src="{{ $post->featured_image_url ?: ($siteSettings['fallback_post_image_url'] ?? asset('vendor/daiva/codye2.png')) }}" alt="{{ $post->title }}">
    </div>
    <div class="space-y-3">
        <div class="text-xs uppercase tracking-[0.3em] text-stone-400">
            {{ optional($post->published_at)->format('M d, Y') }} @if($post->category) · {{ $post->category->name }} @endif
        </div>
        <h3 class="playfair text-2xl font-bold"><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h3>
        <p class="text-sm text-stone-600">{{ $post->excerpt }}</p>
    </div>
    <div class="mt-auto flex items-center justify-between pt-2 text-sm text-stone-500">
        <span>{{ $post->author?->name }}</span>
        <a class="underline" href="{{ route('blog.show', $post) }}">Read more</a>
    </div>
</article>
