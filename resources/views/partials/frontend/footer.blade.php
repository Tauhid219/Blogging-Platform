<footer class="p-4 pb-8">
    <div class="mx-auto flex w-full max-w-5xl flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <small>Copyright {{ now()->year }} · {{ $siteSettings['site_name'] ?? config('app.name') }}</small>
        <div class="flex items-center gap-4 text-lg">
            <a href="https://github.com/Tauhid219" target="_blank"><i class="bi bi-github"></i></a>
            <a href="mailto:{{ $siteSettings['contact_email'] ?? 'admin@example.com' }}"><i class="bi bi-envelope"></i></a>
            <a href="{{ route('blog.index') }}"><i class="bi bi-rss"></i></a>
        </div>
    </div>
</footer>
