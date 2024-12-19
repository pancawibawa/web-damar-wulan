<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <!-- Dashboard -->
    <li class="menu-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
        <a href="{{ route('dashboard.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <!-- Produk Management -->
    <li class="menu-item {{ Request::is('admin/produk*') ? 'active' : '' }}">
        <a href="{{ route('admin.produk.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Produk Management</div>
        </a>
    </li>
    <!-- Order Management -->
    <li class="menu-item {{ Request::is('admin/order*') ? 'active' : '' }}">
        <a href="{{ route('admin.order.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-box"></i>
            <div data-i18n="Analytics">Order Management</div>
        </a>
    </li>
</ul>
