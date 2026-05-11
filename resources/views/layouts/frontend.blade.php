<!DOCTYPE html>
<html lang="en" class="min-h-screen">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($title ?? ($siteSettings['site_name'] ?? config('app.name'))) }}</title>
    <meta name="description" content="{{ $metaDescription ?? ($siteSettings['site_description'] ?? config('app.name')) }}">
    <link rel="icon" type="image/png" href="{{ asset('vendor/daiva/favicon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root { font-family: "Roboto", sans-serif; }
        .playfair { font-family: "Playfair Display", serif; }
        .bg-skew:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 55%;
            transform: skewY(-5deg);
            transform-origin: top left;
            z-index: -1;
            background-color: #ececec;
            min-height: 620px;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-skew min-h-screen flex flex-col justify-between {{ $bodyClass ?? '' }}">
    @include('partials.frontend.header')
    <main>
        @yield('content')
    </main>
    @include('partials.frontend.footer')
    @stack('scripts')
</body>
</html>
