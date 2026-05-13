<nav id="admin-navbar" class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link" target="_blank">View site</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link theme-switcher-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-desktop" data-theme-status-icon></i>
                <span class="ml-2 theme-label" data-theme-status-label>Auto</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right theme-switcher-menu">
                <button type="button" class="dropdown-item theme-switcher-option" data-admin-theme-choice="light">
                    <span class="theme-icon"><i class="far fa-sun"></i></span>
                    <span class="theme-copy">
                        <span class="theme-title">Light mode</span>
                        <span class="theme-description">Keep the admin panel bright.</span>
                    </span>
                    <i class="fas fa-check small invisible" data-theme-active-indicator></i>
                </button>
                <button type="button" class="dropdown-item theme-switcher-option" data-admin-theme-choice="dark">
                    <span class="theme-icon"><i class="far fa-moon"></i></span>
                    <span class="theme-copy">
                        <span class="theme-title">Dark mode</span>
                        <span class="theme-description">Use AdminLTE dark surfaces.</span>
                    </span>
                    <i class="fas fa-check small invisible" data-theme-active-indicator></i>
                </button>
                <button type="button" class="dropdown-item theme-switcher-option" data-admin-theme-choice="auto">
                    <span class="theme-icon"><i class="fas fa-desktop"></i></span>
                    <span class="theme-copy">
                        <span class="theme-title">Auto mode</span>
                        <span class="theme-description">Follow your Windows or OS theme.</span>
                    </span>
                    <i class="fas fa-check small invisible" data-theme-active-indicator></i>
                </button>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
                <span class="ml-1">{{ auth()->user()->name }}</span>
                <small class="text-muted ml-1">({{ auth()->user()->roles->pluck('name')->map(fn ($role) => \Illuminate\Support\Str::headline($role))->implode(', ') ?: 'User' }})</small>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">Profile</a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </div>
        </li>
    </ul>
</nav>
