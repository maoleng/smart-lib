@php use \Illuminate\Support\Facades\Auth; @endphp
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="navbar-brand" href="{{ route(Route::is('admin.*') ? 'admin.user.index' : 'index') }}">
                    <span class="brand-logo">
                    </span>
                    <h2 class="brand-text mb-0">Smart Lib {{ Route::is('admin.*') ? '- Admin Area' : '' }}</h2>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item dropdown dropdown-user">
                @if (Auth::check())
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">{{ Auth::user()->name }}</span><span class="user-status">{{ \App\Enums\UserRole::getDescription(Auth::user()->role) }}</span></div>
                        <span class="avatar"><img class="round" src="../../../app-assets//images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('me') }}">
                            <i class="me-50" data-feather="user"></i> Profile
                        </a>
                        @if (Auth::user()->role === \App\Enums\UserRole::ADMIN)
                            <a class="dropdown-item" href="{{ route('admin.user.index') }}">
                                <i class="me-50" data-feather="settings"></i> Admin Area
                            </a>
                        @endif

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('auth.logout') }}"><i class="me-50" data-feather="power"></i> Logout</a>
                    </div>
                @else
                    <a href="{{ route('auth.login') }}" type="button" class="ms-2 btn btn-gradient-secondary">Login</a>
                @endif
            </li>
        </ul>
    </div>
</nav>
