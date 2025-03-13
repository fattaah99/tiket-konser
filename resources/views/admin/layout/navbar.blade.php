<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->
                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('assets/images/user2-160x160.jpg') }}"
                                class="user-image rounded-circle shadow" alt="User Image" />
                            <span class="d-none d-md-inline"> {{ Auth::guard('admin')->user()->nama }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                <img src="{{ asset('assets/images/user2-160x160.jpg') }}" class="rounded-circle shadow"
                                    alt="User Image" />
                                <p>
                                    {{ Auth::guard('admin')->user()->nama }}
                                    <small>Member since Nov. 2023</small>
                                </p>
                            </li>
                            <!--end::User Image-->
                            <!--begin::Menu Footer-->
                            <li class="user-footer">
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" class="btn btn-default btn-flat float-end"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>
                            </li>

                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="../index.html" class="brand-link">
                    <!--begin::Brand Image-->
                    <img src="../../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image opacity-75 shadow" />
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <span class="brand-text fw-light">AdminLTE 4</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ set_active('admin.dashboard') }}">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="nav-link {{ set_active('admin.users.index') }}">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-seam-fill"></i>
                                <p>
                                    Data Pemesanan
                                    <i class="nav-icon bi "></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.tickets.index') }}"
                                class="nav-link {{ set_active('admin.tickets.index') }}">
                                <i class="nav-icon bi bi-ticket-perforated-fill"></i>
                                <p>
                                    Data Tiket
                                </p>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.event_gallery.index') }}"
                                class="nav-link {{ set_active('admin.event_gallery.index') }}">
                                <i class="nav-icon bi bi-images"></i>
                                <p>
                                    Data galeri
                                </p>
                            </a>
                        </li>

                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <!--begin::App Main-->