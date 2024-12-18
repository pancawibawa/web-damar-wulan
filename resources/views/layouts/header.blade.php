<nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html" style="font-weight: bold; font-size: 1.5rem;">Damar Wulan Group.
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
                    @if (request()->is('/'))
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
                            <a class="nav-link me-4" href="#smart-watches">Promo</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link me-4 active" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="/#company-services">Pelayanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="{{route('user.produk')}}">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="/#smart-watches">Promo</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <div class="user-items ps-5">
                            <ul class="d-flex justify-content-end list-unstyled">
                                {{-- <li class="search-item pe-3">
                                    <a href="#" class="search-button">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </a>
                                </li> --}}
                                <li class="pe-3">
                                    <a href="#">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('user.cart')}}">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
