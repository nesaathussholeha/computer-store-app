<nav class="sidebar-nav scroll-sidebar" data-simplebar>
    <ul id="sidebarnav">
        <!-- ============================= -->
        <!-- Home -->
        <!-- ============================= -->
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <!-- =================== -->
        <!-- Dashboard -->
        <!-- =================== -->
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('cashier.dashboard') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Beranda</span>
            </a>
        </li>

        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Master</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('member.index') ? 'active' : '' }}"
                href="{{ route('member.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-shopping-cart"></i>
                </span>
                <span class="hide-menu">Member</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('supplier.index') ? 'active' : '' }}"
                href="{{ route('supplier.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-shopping-cart"></i>
                </span>
                <span class="hide-menu">Supplier</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('product.index') ? 'active' : '' }}"
                href="{{ route('product.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-shopping-cart"></i>
                </span>
                <span class="hide-menu">Produk</span>
            </a>
        </li>


</nav>
