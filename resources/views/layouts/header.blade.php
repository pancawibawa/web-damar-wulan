<nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="font-weight: bold; font-size: 1.5rem;">Damar Wulan Group.
            {{-- <img src="asset/images/main-logo.png" class="logo"> --}}
        </a>
        <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-home navbar-icon" aria-hidden="true"></i>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
            <div class="offcanvas-header px-4 pb-0">
                {{-- <a class="navbar-brand" href="index.html">
                    <img src="asset/images/main-logo.png" class="logo">
                </a> --}}
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"
                    data-bs-target="#bdNavbar"></button>
            </div>
            <div class="offcanvas-body">
                <ul id="navbar"
                    class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">
                    @if (!Auth::check())
                    {{-- Jika user belum login, tampilkan menu untuk halaman utama --}}
                    <li class="nav-item">
                        <a class="nav-link me-4 active" href="#billboard">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="#company-services">Pelayanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="#mobile-products">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="#latest-blog">Terlaris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="/login">Login</a>
                    </li>
                    @else
                    {{-- Jika user sudah login, tampilkan menu dengan nama user dan opsi tambahan --}}
                    <li class="nav-item">
                        <a class="nav-link me-4 active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="/#company-services">Pelayanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="{{ route('user.produk') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="/#latest-blog">Terlaris</a>
                    </li>
                    {{-- Dropdown untuk user yang sudah login --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#"
                            role="button" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('user.cart') }}" class="dropdown-item">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Keranjang
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.history') }}" class="dropdown-item">
                                    <i class="fa fa-truck" aria-hidden="true"></i> Pesanan Saya
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile') }}" class="dropdown-item">
                                    <i class="fa fa-user" aria-hidden="true"></i> Profil
                                </a>
                            </li>
                            <li>
                                {{-- Tombol logout --}}
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="fa fa-sign-out-alt" aria-hidden="true"></i> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endif

                    {{-- <li class="nav-item">
                        <div class="user-items ps-5">
                            <ul class="d-flex justify-content-end list-unstyled">
                                <li class="search-item pe-3">
                                    <a href="#" class="search-button">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown"
                                        href="#">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="about.html" class="dropdown-item">About</a>
                                        </li>
                                        <li>
                                            <a href="about.html" class="dropdown-item">About</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.cart') }}" class="dropdown-item">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</nav>
