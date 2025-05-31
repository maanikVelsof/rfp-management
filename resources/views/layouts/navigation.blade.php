<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/velocity_logo.png')}}" alt="" height="40" />
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/velocity_logo.png')}}" alt="" height="" />
                    </span>
                </a>
            </div>
        </div>

        <div class="d-flex pr-2">
            <div class="dropdown d-inline-block">
                <span class="d-none d-xl-inline-block ml-1" key="t-henry">Welcome
                    {{ Auth::user()->name }}</span>&nbsp;&nbsp;
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
                </form>
        </div>
    </div>
</header>


<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-file-document-box-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="" class="waves-effect">
                        <i class="mdi mdi-weather-night"></i>
                        <span>Article</span>
                    </a>
                </li>
                <li>
                    <a href="" class="waves-effect">
                        <i class="mdi mdi-weather-night"></i>
                        <span>Category</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>