<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" width="32" class="app-brand-logo">
            <span class="app-brand-text demo menu-text fw-bold">{{ config('app.name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('panel.dashboard') ? 'active' : '' }}">
            <a href="{{ route('panel.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Data Master -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Data Master">Data Master</span>
        </li>
        <li class="menu-item {{ request()->routeIs('panel.categories.*') ? 'active' : '' }}">
            <a href="{{ route('panel.categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-category"></i>
                <div data-i18n="Kategori">Kategori</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('panel.books.*') ? 'active' : '' }}">
            <a href="{{ route('panel.books.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-books"></i>
                <div data-i18n="Buku">Buku</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('panel.renters.*') ? 'active' : '' }}">
            <a href="{{ route('panel.renters.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Peminjam">Peminjam</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('panel.admins.*') ? 'active' : '' }}">
            <a href="{{ route('panel.admins.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-shield"></i>
                <div data-i18n="Admin">Admin</div>
            </a>
        </li>

        <!-- Peminjaman -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Peminjaman">Peminjaman</span>
        </li>
        <li class="menu-item {{ request()->routeIs('panel.rentings.*') ? 'active' : '' }}">
            <a href="{{ route('panel.rentings.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-book-upload"></i>
                <div data-i18n="Log Peminjaman">Log Peminjaman</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('panel.returns.*') ? 'active' : '' }}">
            <a href="{{ route('panel.returns.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-book-download"></i>
                <div data-i18n="Pengembalian">Pengembalian</div>
            </a>
        </li>

        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Pengaturan">Pengaturan</span>
        </li>
        <li class="menu-item {{ request()->routeIs('panel.settings.*') ? 'active' : '' }}">
            <a href="{{ route('panel.settings.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Pengaturan">Pengaturan</div>
            </a>
        </li>
    </ul>
</aside>