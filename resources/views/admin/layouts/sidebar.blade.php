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
            <a class="sidebar-link {{ request()->routeIs('category.index') ? 'active' : '' }}"
                href="{{ route('category.index') }}" aria-expanded="false">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-category-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 4h6v6h-6z" />
                        <path d="M4 14h6v6h-6z" />
                        <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    </svg>
                </span>
                <span class="hide-menu">Kategori</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('supplier.index') ? 'active' : '' }}"
                href="{{ route('supplier.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-users fs-6"></i>
                </span>
                <span class="hide-menu">Supplier</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('product.index') || request()->routeIs('product.show') || request()->routeIs('product.create') || request()->routeIs('purchase.edit') || request()->routeIs('purchase.show') || request()->routeIs('product.*') ? 'active' : '' }}"
                href="{{ route('product.index') }}" aria-expanded="false">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-superhuman">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M16 12l4 3l-8 7l-8 -7l4 -3" />
                        <path d="M12 3l-8 6l8 6l8 -6z" />
                        <path d="M12 15h8" />
                    </svg>
                </span>
                <span class="hide-menu">Produk</span>
            </a>
        </li>




</nav>
