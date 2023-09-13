<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('my-profile.edit') }}" class="d-block">
                    {{ auth()->user()->name }}
                </a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->segment(1) != null ?: 'active' }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my-profile.edit') }}"
                        class="nav-link  {{ request()->is('my-profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            My Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('manage.product.index') }}"
                        class="nav-link  {{ request()->is('product') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-weight"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>

                @if (auth()->user()->role_id == \App\Models\Role::ADMIN)
                    <li class="nav-header">MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="{{ route('manage.category.index') }}"
                            class="nav-link  {{ request()->is('category') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-window-restore"></i>
                            <p>
                                Categories
                            </p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link  {{ request()->is('users') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-package"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li> --}}
                @endif

                <li class="nav-header">ACCOUNT</li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link bg-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-door-open"></i>
                        <p>
                            {{ __('Logout') }}
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
