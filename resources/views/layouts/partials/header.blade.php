<!-- START HEADER -->
<header class="app-header">
    <div class="container-fluid">
        <div class="nav-header">

            <div class="header-left hstack gap-3">
                <div class="app-sidebar-logo app-horizontal-logo justify-content-center align-items-center">
                    <a href="{{ route('home') }}">
                        <img height="35" class="app-sidebar-logo-default" alt="Logo" src="{{ asset('assets/images/light-logo.png') }}">
                        <img height="40" class="app-sidebar-logo-minimize" alt="Logo" src="{{ asset('assets/images/Favicon.png') }}">
                    </a>
                </div>

                <button type="button" class="btn btn-light-light icon-btn sidebar-toggle d-none d-md-block" aria-expanded="false" aria-controls="main-menu">
                    <span class="visually-hidden">Toggle sidebar</span>
                    <i class="ri-menu-2-fill"></i>
                </button>

                <button class="btn btn-light-light icon-btn d-md-none small-screen-toggle" id="smallScreenSidebarLabel" type="button" data-bs-toggle="offcanvas" data-bs-target="#smallScreenSidebar" aria-controls="smallScreenSidebar">
                    <span class="visually-hidden">Sidebar toggle for mobile</span>
                    <i class="ri-arrow-right-fill"></i>
                </button>

                <button class="btn btn-light-light icon-btn d-lg-none small-screen-horizontal-toggle" type="button" aria-expanded="false" aria-controls="main-menu">
                    <span class="visually-hidden">Sidebar toggle for horizontal</span>
                    <i class="ri-arrow-right-fill"></i>
                </button>

                <span class="d-none d-lg-inline text-muted fs-13">
                    <i class="ri-calendar-line me-1"></i>{{ now()->format('l, d M Y') }}
                </span>
            </div>

            <div class="header-right hstack gap-3">
                <div class="hstack gap-0 gap-sm-1">

                    <!-- Theme -->
                    <div class="dropdown features-dropdown d-none d-sm-block">
                        <button type="button" class="btn icon-btn btn-text-primary rounded-circle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Light or Dark Mode Switch</span>
                            <i class="ri-sun-line fs-20"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end header-language-scrollable">
                            <div class="dropdown-item cursor-pointer" id="light-theme">
                                <span class="hstack gap-2 align-middle"><i class="ri-sun-line"></i>Light</span>
                            </div>
                            <div class="dropdown-item cursor-pointer" id="dark-theme">
                                <span class="hstack gap-2 align-middle"><i class="ri-moon-clear-line"></i>Dark</span>
                            </div>
                            <div class="dropdown-item cursor-pointer" id="system-theme">
                                <span class="hstack gap-2 align-middle"><i class="ri-computer-line"></i>System</span>
                            </div>
                        </div>
                    </div>

                    <!-- Fullscreen -->
                    <button type="button" id="fullscreen-button" class="btn icon-btn btn-text-primary rounded-circle custom-toggle d-none d-sm-block" aria-pressed="false">
                        <span class="visually-hidden">Toggle Fullscreen</span>
                        <span class="icon-on"><i class="ri-fullscreen-exit-line fs-16"></i></span>
                        <span class="icon-off"><i class="ri-fullscreen-line fs-16"></i></span>
                    </button>

                    @can('admin')
                        <!-- Agents' change requests waiting for approval -->
                        <livewire:approvals.bell />
                    @endcan
                </div>

                <!-- Profile -->
                <div class="dropdown profile-dropdown features-dropdown">
                    <button type="button" id="accountNavbarDropdown" class="btn profile-btn shadow-none px-0 hstack gap-0 gap-sm-3" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <span class="position-relative">
                            <span class="avatar-item avatar avatar-title bg-primary text-white fw-semibold overflow-hidden">
                                {{ auth()->user()->initials() }}
                            </span>
                            <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                        </span>
                        <span>
                            <span class="h6 d-none d-xl-inline-block text-start fw-semibold mb-0">{{ auth()->user()->name }}</span>
                            <span class="d-none d-xl-block fs-12 text-start text-muted">{{ auth()->user()->role->label() }}</span>
                        </span>
                    </button>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="accountNavbarDropdown">
                        <span class="dropdown-header fs-12">{{ auth()->user()->email }}</span>
                        <a class="dropdown-item" href="{{ route('profile') }}"><i class="ri-user-settings-line me-2"></i>My Profile</a>
                        @can('admin')
                            <a class="dropdown-item" href="{{ route('users.index') }}"><i class="ri-team-line me-2"></i>Users &amp; Agents</a>
                            <a class="dropdown-item" href="{{ route('audit.index') }}"><i class="ri-history-line me-2"></i>Audit Log</a>
                        @endcan
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"><i class="ri-logout-box-r-line me-2"></i>Sign out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER -->
