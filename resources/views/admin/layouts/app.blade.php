<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ ($title ?? 'Dashboard') . ' | ' . ($siteSettings['site_name'] ?? config('app.name')) }}</title>
    <script>
        (function () {
            var storageKey = 'admin-theme-preference';
            var allowedThemes = ['light', 'dark', 'auto'];
            var mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            var storedTheme = null;

            try {
                storedTheme = window.localStorage.getItem(storageKey);
            } catch (error) {
                storedTheme = null;
            }

            var preferredTheme = allowedThemes.indexOf(storedTheme) !== -1 ? storedTheme : 'auto';
            var resolvedTheme = preferredTheme === 'auto' ? (mediaQuery.matches ? 'dark' : 'light') : preferredTheme;
            var root = document.documentElement;

            root.dataset.adminThemePreference = preferredTheme;
            root.dataset.adminThemeResolved = resolvedTheme;
            root.classList.toggle('dark-mode', resolvedTheme === 'dark');
            root.style.colorScheme = resolvedTheme;
        }());
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <style>
        .brand-link .brand-image { opacity: .9; }
        .content-wrapper { min-height: calc(100vh - 114px); }
        html[data-admin-theme-resolved="dark"] #admin-navbar {
            background-color: #343a40;
            border-bottom: 1px solid #4b545c;
        }
        html[data-admin-theme-resolved="dark"] #admin-navbar .nav-link,
        html[data-admin-theme-resolved="dark"] #admin-navbar .navbar-nav .nav-link {
            color: rgba(255, 255, 255, .8);
        }
        html[data-admin-theme-resolved="dark"] #admin-navbar .nav-link:hover,
        html[data-admin-theme-resolved="dark"] #admin-navbar .navbar-nav .nav-link:hover {
            color: #fff;
        }
        html[data-admin-theme-resolved="dark"] #admin-navbar .dropdown-menu {
            background-color: #3f474e;
            border-color: #56606a;
            color: #fff;
        }
        html[data-admin-theme-resolved="dark"] #admin-navbar .dropdown-item {
            color: rgba(255, 255, 255, .85);
        }
        html[data-admin-theme-resolved="dark"] #admin-navbar .dropdown-item:hover,
        html[data-admin-theme-resolved="dark"] #admin-navbar .dropdown-item:focus {
            background-color: rgba(255, 255, 255, .08);
            color: #fff;
        }
        html[data-admin-theme-resolved="dark"] #admin-navbar .dropdown-divider {
            border-top-color: rgba(255, 255, 255, .12);
        }
        html[data-admin-theme-resolved="dark"] #admin-navbar .text-muted {
            color: rgba(255, 255, 255, .65) !important;
        }
        html[data-admin-theme-resolved="dark"] .content-header .breadcrumb-item a,
        html[data-admin-theme-resolved="dark"] .content-header .breadcrumb-item.active,
        html[data-admin-theme-resolved="dark"] .content-header .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255, 255, 255, .72);
        }
        html[data-admin-theme-resolved="dark"] .content-header .breadcrumb-item a:hover {
            color: #fff;
        }
        html[data-admin-theme-resolved="dark"] .content-wrapper a:not(.btn):not(.nav-link):not(.dropdown-item):not(.page-link) {
            color: #c7d0d9;
        }
        html[data-admin-theme-resolved="dark"] .content-wrapper a:not(.btn):not(.nav-link):not(.dropdown-item):not(.page-link):hover {
            color: #fff;
        }
        .theme-switcher-toggle { min-width: 10.5rem; }
        .theme-switcher-toggle .theme-label { max-width: 5rem; }
        .theme-switcher-menu { min-width: 14rem; padding: .5rem; }
        .theme-switcher-option {
            align-items: center;
            border-radius: .5rem;
            display: flex;
            gap: .75rem;
            white-space: normal;
        }
        .theme-switcher-option + .theme-switcher-option { margin-top: .25rem; }
        .theme-switcher-option .theme-icon {
            align-items: center;
            display: inline-flex;
            justify-content: center;
            width: 1.25rem;
        }
        .theme-switcher-option .theme-copy {
            display: flex;
            flex: 1 1 auto;
            flex-direction: column;
            line-height: 1.2;
        }
        .theme-switcher-option .theme-title { font-weight: 600; }
        .theme-switcher-option .theme-description { font-size: .8rem; opacity: .75; }
        .theme-switcher-option.active {
            background-color: rgba(0, 123, 255, .12);
            color: #007bff;
        }
        .dark-mode .theme-switcher-option.active {
            background-color: rgba(255, 255, 255, .12);
            color: rgba(255, 255, 255, .95);
        }
    </style>
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('admin.partials.navbar')
    @include('admin.partials.sidebar')

    <div class="content-wrapper">
        @include('admin.partials.content-header', ['title' => $title ?? 'Dashboard', 'breadcrumbs' => $breadcrumbs ?? []])
        <section class="content">
            <div class="container-fluid">
                @include('admin.partials.alerts')
                @yield('content')
            </div>
        </section>
    </div>

    @include('admin.partials.footer')
</div>

<script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
<script>
    (function () {
        var storageKey = 'admin-theme-preference';
        var allowedThemes = ['light', 'dark', 'auto'];
        var mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        var root = document.documentElement;
        var body = document.body;
        var navbar = document.getElementById('admin-navbar');
        var statusLabel = document.querySelector('[data-theme-status-label]');
        var statusIcon = document.querySelector('[data-theme-status-icon]');
        var optionButtons = Array.prototype.slice.call(document.querySelectorAll('[data-admin-theme-choice]'));
        var iconMap = {
            light: 'far fa-sun',
            dark: 'far fa-moon',
            auto: 'fas fa-desktop',
        };
        var labelMap = {
            light: 'Light',
            dark: 'Dark',
            auto: 'Auto',
        };

        function readStoredTheme() {
            try {
                return window.localStorage.getItem(storageKey);
            } catch (error) {
                return null;
            }
        }

        function writeStoredTheme(theme) {
            try {
                window.localStorage.setItem(storageKey, theme);
            } catch (error) {
                return;
            }
        }

        function getPreferredTheme() {
            var storedTheme = readStoredTheme();

            return allowedThemes.indexOf(storedTheme) !== -1 ? storedTheme : 'auto';
        }

        function getResolvedTheme(preferredTheme) {
            return preferredTheme === 'auto' ? (mediaQuery.matches ? 'dark' : 'light') : preferredTheme;
        }

        function syncControls(preferredTheme, resolvedTheme) {
            if (statusLabel) {
                statusLabel.textContent = labelMap[preferredTheme];
            }

            if (statusIcon) {
                statusIcon.className = iconMap[preferredTheme];
            }

            optionButtons.forEach(function (button) {
                var isActive = button.dataset.adminThemeChoice === preferredTheme;
                var stateText = isActive ? 'true' : 'false';

                button.classList.toggle('active', isActive);
                button.setAttribute('aria-pressed', stateText);
                button.setAttribute('aria-current', isActive ? 'true' : 'false');

                var indicator = button.querySelector('[data-theme-active-indicator]');

                if (indicator) {
                    indicator.classList.toggle('invisible', !isActive);
                }
            });

            root.dataset.adminThemePreference = preferredTheme;
            root.dataset.adminThemeResolved = resolvedTheme;
            root.style.colorScheme = resolvedTheme;
        }

        function applyTheme(preferredTheme) {
            var resolvedTheme = getResolvedTheme(preferredTheme);
            var isDark = resolvedTheme === 'dark';

            root.classList.toggle('dark-mode', isDark);
            body.classList.toggle('dark-mode', isDark);

            if (navbar) {
                navbar.classList.toggle('navbar-dark', isDark);
                navbar.classList.toggle('navbar-light', !isDark);
                navbar.classList.toggle('navbar-white', !isDark);
                navbar.classList.toggle('navbar-gray-dark', isDark);
            }

            syncControls(preferredTheme, resolvedTheme);
        }

        function setTheme(theme) {
            var preferredTheme = allowedThemes.indexOf(theme) !== -1 ? theme : 'auto';

            writeStoredTheme(preferredTheme);
            applyTheme(preferredTheme);
        }

        optionButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                setTheme(button.dataset.adminThemeChoice);
            });
        });

        var initialTheme = getPreferredTheme();
        applyTheme(initialTheme);

        if (typeof mediaQuery.addEventListener === 'function') {
            mediaQuery.addEventListener('change', function () {
                if (getPreferredTheme() === 'auto') {
                    applyTheme('auto');
                }
            });
        } else if (typeof mediaQuery.addListener === 'function') {
            mediaQuery.addListener(function () {
                if (getPreferredTheme() === 'auto') {
                    applyTheme('auto');
                }
            });
        }
    }());
</script>
@stack('scripts')
</body>
</html>
