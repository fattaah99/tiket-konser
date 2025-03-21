<nav class="app-header navbar navbar-dark bg-dark navbar-expand">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">

            <li class="nav-item d-none d-md-block"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="{{ route('orders.myOrders') }}"
                    class="nav-link">Transaction</a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="{{ route('all-tiket') }}" class="nav-link">All
                    Tiket</a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto align-items-center">
            <!-- Fullscreen Toggle -->
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen fs-5"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit fs-5" style="display: none"></i>
                </a>
            </li>
            <!-- User Menu Dropdown -->
            @if(Auth::check())
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                    <span class="me-2 d-none d-md-inline fw-semibold">{{ Auth::user()->name }}</span>
                    <i class="bi bi-person-circle fs-4"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow-sm">
                    <li class="dropdown-item text-center">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm w-100">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
            @else
            <li class="nav-item">
                <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2">Login</a>
            </li>
            @endif
        </ul>

        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>