<!DOCTYPE html>
<html lang="en" class="min-h-screen">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteSettings['site_name'] ?? config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('vendor/daiva/favicon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root { font-family: "Roboto", sans-serif; }
        .playfair { font-family: "Playfair Display", serif; }
    </style>
</head>
<body class="min-h-screen bg-stone-100">
    <div class="min-h-screen flex flex-col justify-between">
        @include('partials.frontend.header')
        <main class="px-4 py-16">
            <div class="mx-auto grid w-full max-w-5xl gap-10 lg:grid-cols-[1.15fr_.85fr] lg:items-center">
                <div class="space-y-6">
                    <small class="border-l-2 border-black pl-3 text-xs uppercase tracking-[0.3em] text-stone-500">Secure access</small>
                    <h1 class="playfair text-4xl font-bold text-stone-900 md:text-6xl">Welcome back to the editorial workspace.</h1>
                    <p class="max-w-xl text-lg text-stone-600">Manage your writing pipeline, collaborate with editors, and publish with a workflow that is built for a real multi-author platform.</p>
                    <div class="flex gap-4 text-sm text-stone-500">
                        <span class="rounded-full bg-white px-4 py-2 shadow-sm">Multi-role access</span>
                        <span class="rounded-full bg-white px-4 py-2 shadow-sm">Structured publishing</span>
                    </div>
                </div>
                <div class="rounded-[2rem] bg-white p-8 shadow-xl shadow-stone-300/50">
                    {{ $slot }}
                </div>
            </div>
        </main>
        @include('partials.frontend.footer')
    </div>
</body>
</html>
