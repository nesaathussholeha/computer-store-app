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
            <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
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
            <a class="sidebar-link {{ request()->routeIs('member.transaction') ? 'active' : '' }}"
                href="{{ route('member.transaction') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-shopping-cart"></i>
                </span>
                <span class="hide-menu">Riwayat Pembelian</span>
            </a>
        </li>
</nav>
