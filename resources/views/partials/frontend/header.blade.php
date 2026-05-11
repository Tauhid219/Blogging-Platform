<header class="p-4 pt-8">
    <div class="mx-auto flex w-full max-w-5xl flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <a class="playfair text-2xl font-bold" href="{{ route('home') }}">{{ $siteSettings['site_name'] ?? 'Daiva ///' }}</a>
        <nav class="flex flex-wrap items-center gap-6 text-sm">
            <a href="{{ route('about') }}" class="hover:underline">About us</a>
            <a href="{{ route('blog.index') }}" class="hover:underline">Blog</a>
            @auth
                <a class="rounded-full bg-black px-5 py-2 text-white transition hover:bg-stone-800" href="{{ route('admin.dashboard') }}">Admin panel</a>
            @else
                <a class="flex items-center gap-2 rounded-full bg-gray-300 px-6 py-2 text-black transition hover:bg-gray-600 hover:text-white" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Sign in</span>
                </a>
            @endauth
        </nav>
    </div>
</header>
