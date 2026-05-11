<aside class="space-y-8 rounded-[2rem] bg-white p-6 shadow-sm">
    <section class="space-y-4">
        <h3 class="playfair text-2xl font-bold">Categories</h3>
        <div class="flex flex-wrap gap-2 text-sm">
            @foreach ($blogSidebarCategories as $category)
                <a href="{{ route('blog.category', $category) }}" class="rounded-full bg-stone-100 px-4 py-2 hover:bg-stone-200">{{ $category->name }}</a>
            @endforeach
        </div>
    </section>
    <section class="space-y-4">
        <h3 class="playfair text-2xl font-bold">Tags</h3>
        <div class="flex flex-wrap gap-2 text-sm">
            @foreach ($blogSidebarTags as $tag)
                <a href="{{ route('blog.tag', $tag) }}" class="rounded-full border border-stone-200 px-4 py-2 hover:bg-stone-50">{{ $tag->name }}</a>
            @endforeach
        </div>
    </section>
</aside>
