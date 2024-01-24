@php use \Illuminate\Support\Facades\Route; @endphp
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="#">
                    <span class="brand-logo">
                        <img src="{{ asset('app-assets/images/docs/logout.PNG') }}" alt="">
                    </span>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item"><a class="d-flex align-items-center" href=""><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Manager</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="{{ Route::is('admin.user.*') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href=""><i data-feather="save"></i><span class="menu-title text-truncate" data-i18n="File Manager">User</span></a>
            </li>
            <li class="{{ Route::is('admin.book.*') ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href=""><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Book</span></a>
            </li>
        </ul>
    </div>
</div>
