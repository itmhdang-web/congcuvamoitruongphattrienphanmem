<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-color navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link" id="sidebarCollapse" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('page-user-home') }}" class="nav-link link-home d-block" target="_blank">Xem Webite <i
                    class="fa-solid fa-arrow-up-right-from-square fa-xs ml-1"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item">
            <div class="user_profile_dd dropdown">
                <a class="nav-link d-block" data-toggle="dropdown" href="#">
                    <img class="img-responsive rounded-circle"
                        src="{{ asset('upload/avatar/' . Auth::guard('user')->user()->avatar) }}"
                        onerror="src='{{ asset('assets/admin/images/noimage.png') }}'"alt="Alt Photo" style="" />
                    <span class="name_user">{{ Auth::guard('user')->user()->name }}</span></a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('do-user-logout') }}"><span>Đăng xuất</span> <i
                            class="fa fa-sign-out"></i></a>
                </div>
            </div>
        </li>
    </ul>

</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('page-admin-home') }}" class="brand-link">
        <img src="{{ asset('assets/admin/images/logo.png') }}" alt="Logo company"
            class="brand-image img-circle elevation-3 ">
        <span class="brand-text ml-2 font-weight-light font-size-3">InfinityShop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->

        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('page-admin-home') }}"
                        class="nav-link {{ $name == 'page-admin-home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trang chủ
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('page-admin-user-list') }}"
                        class="nav-link {{ $name == 'page-admin-user-list' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Danh sách người dùng</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('page-admin-order-list') }}" class="nav-link {{ $name == 'page-admin-order-list' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-shopping"></i>
                        <p>
                            Danh sách đơn hàng
                        </p>
                    </a>
                </li>

                <li
                    class="nav-item {{ $name == 'page-admin-product-list' ||
                    $name == 'page-admin-product-add' ||
                    $name == 'page-admin-product-update' ||
                    $name == 'thuong-hieu-admin' ||
                    $name == 'page-admin-type-list' ||
                    $name == 'page-admin-type-add' ||
                    $name == 'page-admin-type-update' ||
                    $name == 'page-admin-product-search' ||
                    $name == 'page-admin-type-search'
                        ? 'menu-open'
                        : '' }} ">

                    <a
                        class="nav-link {{ $name == 'page-admin-product-list' ||
                        $name == 'page-admin-product-add' ||
                        $name == 'page-admin-product-update' ||
                        $name == 'page-admin-type-list' ||
                        $name == 'page-admin-type-add' ||
                        $name == 'page-admin-type-update' ||
                        $name == 'page-admin-product-search' ||
                        $name == 'page-admin-type-search'
                            ? 'active'
                            : '' }}">
                        <i class="nav-icon fas fa-boxes-stacked"></i>
                        <p>
                            Quản lý sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('page-admin-type-list') }}"
                                class="nav-link {{ $name == 'page-admin-type-list' ||
                                $name == 'page-admin-type-add' ||
                                $name == 'page-admin-type-update' ||
                                $name == 'page-admin-type-search'
                                    ? 'active'
                                    : '' }}">
                                <i class="nav-icon-small fas fa-circle fa-2xs"></i>
                                <p>Danh mục loại</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('page-admin-product-list') }}"
                               class="nav-link {{ $name == 'page-admin-product-list' ||
                                $name == 'page-admin-product-add' ||
                                $name == 'page-admin-product-update' ||
                                $name == 'page-admin-product-search'
                                    ? 'active'
                                    : '' }}">
                                <i class="nav-icon-small fas fa-circle fa-2xs"></i>
                                <p>Danh sách sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('page-admin-statistic') }}" class="nav-link {{ $name == 'page-admin-statistic' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-simple"></i>
                        <p>Thống kê</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
