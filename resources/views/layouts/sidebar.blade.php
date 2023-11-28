<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('template') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIStokMen</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (auth()->user()->role == 'pemilik')
                <li class="nav-item">
                    <a href="{{ route('supplier.index') }}" class="nav-link {{ request()->is('supplier*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Supplier
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan') }}" class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Kelola Pengguna
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('barang*', 'bMasuk*', 'bKeluar*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('barang*', 'bMasuk*', 'bKeluar*') ? 'active' : '' }}">
                        <i class="nav-icon fab fa-dropbox"></i>
                        <p>
                            Barang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('barang*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Daftar Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bMasuk.index') }}" class="nav-link {{ request()->is('bMasuk*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cart-arrow-down"></i>
                                <p>Transaksi Barang Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bKeluar.index') }}" class="nav-link {{ request()->is('bKeluar*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shipping-fast"></i>
                                <p>Transaksi Barang Keluar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan') }}" class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>
