<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <div class="navbar-brand">
                <a href="{{ route('users-list') }}">
                    <b class="logo-icon">
                        <!-- Dark Logo icon -->
                        <img src="{{asset('assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo"/>
                        <!-- Light Logo icon -->
                        <img src="{{asset('assets/images/logo-icon.png')}}" alt="homepage" class="light-logo"/>
                    </b>
                </a>
            </div>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
               data-toggle="collapse" data-target="#navbarSupportedContent"
               aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav float-left mr-auto ml-3 pl-1"></ul>
            <ul class="navbar-nav float-right">
                <img src="{{ asset('assets/images/users/profile-pic.jpg') }}" alt="user" class="rounded-circle" width="40">
                <span class="ml-2 d-none d-lg-inline-block">
                    <span>Hello,</span>
                    <span class="text-dark">John Smith</span>
                </span>
            </ul>
        </div>
    </nav>
</header>

<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false">
                        <i class=" fas fa-address-book"></i>
                        <span class="hide-menu">Users </span>
                    </a>
                    <ul aria-expanded="false" class="base-level-line">
                        <li class="sidebar-item">
                            <a href="{{route('users-list')}}" class="sidebar-link">
                                <span class="hide-menu"> User List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="list-divider"></li>
            </ul>
        </nav>
    </div>
</aside>
