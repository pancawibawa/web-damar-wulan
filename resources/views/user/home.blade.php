@extends('layouts.main')
@section('konten')
    <section id="billboard" class="position-relative overflow-hidden bg-light-blue">
        <div class="swiper main-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-6">
                                <div class="banner-content">
                                    <h1 class="display-2 text-uppercase text-dark pb-5">Solusi Belanja Peci Modern</h1>
                                    <a href="/produk"
                                        class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Belanja Sekarang</a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="image-holder">
                                    <img src="asset/images/banner-image.png" alt="banner">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row d-flex flex-wrap align-items-center">
                            <div class="col-md-6">
                                <div class="banner-content">
                                    <h1 class="display-2 text-uppercase text-dark pb-5">Technology Hack You Won't Get
                                    </h1>
                                    <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop
                                        Product</a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="image-holder">
                                    <img src="asset/images/banner-image.png" alt="banner">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Services Section -->
    <section class="services py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3">
                    <i class="fas fa-truck fa-2x mb-3"></i>
                    <h5>Pengiriman Cepat</h5>
                    <p>Pesanan Anda akan sampai tepat waktu.</p>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-headset fa-2x mb-3"></i>
                    <h5>Layanan Pelanggan</h5>
                    <p>Bantuan 24/7 untuk semua kebutuhan Anda.</p>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-credit-card fa-2x mb-3"></i>
                    <h5>Pembayaran Mudah</h5>
                    <p>Berbagai metode pembayaran tersedia.</p>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-shield-alt fa-2x mb-3"></i>
                    <h5>Jaminan Kualitas</h5>
                    <p>Produk terjamin dengan garansi.</p>
                </div>
            </div>
        </div>
    </section>


    <section id="mobile-products" class="product-store position-relative padding-large no-padding-top">
        <div class="container">
            <div class="row">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h2 class="display-7 text-dark text-uppercase">Produk Kami</h2>
                    <div class="btn-right">
                        <a href="{{ route('user.produk') }}" class="btn btn-medium btn-normal text-uppercase">Lihat
                            Selengkapnya</a>
                    </div>
                </div>
                <div class="swiper product-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($produk as $item)
                            <div class="swiper-slide">
                                <div class="product-card position-relative px-0">
                                    <div class="container py-0 px-0">
                                        <div class="card"
                                            style="width: 100%; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                            <div class="image-holder" style="width: 100%; height: 18rem; overflow: hidden;">
                                                <img src="{{ asset('storage/produk/' . $item->image) }}"
                                                    class="card-img-top" alt="..."
                                                    style="object-fit: cover; width: 100%; height: 100%;">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item->name }}</h5>
                                                <h4>RP {{ number_format($item->price, 2) }}</h4>
                                                <p class="card-text">{{ $item->description }}</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <form action="{{ route('user.cart.add', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-dark">Add Cart</button>
                                                    </form>
                                                    <p style="font-size: 14px; color: #555;">Terjual: <span
                                                            style="font-weight: bold; color: green;">{{ $item->terjual }}</span>
                                                        pcs
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination position-absolute text-center"></div>
    </section>

    {{-- <section id="smart-watches" class="product-store padding-large position-relative">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">Produk Promo</h2>
                <div class="btn-right">
                    <a href="/" class="btn btn-medium btn-normal text-uppercase">Lihat
                        Selengkapnya</a>
                </div>
            </div>
            <div class="swiper product-watch-swiper">
                <div class="swiper-wrapper">
                    @for ($i = 1; $i <= 10; $i++) <div class="swiper-slide">
                        <div class="product-card position-relative px-0">
                            <div class="container py-0 px-0">
                                <div class="card"
                                    style="width: 100%; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    <div class="image-holder" style="width: 100%; height: 18rem; overflow: hidden;">
                                        <img src="asset/images/product-item1.jpg" class="card-img-top" alt="..."
                                            style="object-fit: cover; width: 100%; height: 100%;">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Songkok NasiUduk</h5>
                                        <h4>RP 80000</h4>
                                        <p class="card-text">songkok dengan pribadi yang luwes</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="#" class="btn btn-dark">Add Cart</a>
                                            <p style="font-size: 14px; color: #555;">Terjual: <span
                                                    style="font-weight: bold; color: green;">150</span> pcs</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section> --}}

    <section id="latest-blog" class="padding-large">
        <div class="container">
            <div class="row">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h2 class="display-7 text-dark text-uppercase">Produk Terlaris</h2>
                    <div class="btn-right">
                        <a href="{{ route('user.produk') }}" class="btn btn-medium btn-normal text-uppercase">Lihat
                            Selengkapnya</a>
                    </div>
                </div>
                <div class="swiper product-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($produklaris as $item)
                            <div class="swiper-slide">
                                <div class="product-card position-relative px-0">
                                    <div class="container py-0 px-0">
                                        <div class="card"
                                            style="width: 100%; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                            <div class="image-holder" style="width: 100%; height: 18rem; overflow: hidden;">
                                                <img src="{{ asset('storage/produk/' . $item->image) }}"
                                                    class="card-img-top" alt="..."
                                                    style="object-fit: cover; width: 100%; height: 100%;">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item->name }}</h5>
                                                <h4>RP {{ number_format($item->price, 2) }}</h4>
                                                <p class="card-text">{{ $item->description }}</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <form action="{{ route('user.cart.add', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-dark">Add Cart</button>
                                                    </form>
                                                    <p style="font-size: 14px; color: #555;">Terjual: <span
                                                            style="font-weight: bold; color: green;">{{ $item->terjual }}</span>
                                                        pcs
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="position-relative">
        <div class="container">
            <div class="row">
                <div class="review-content position-relative">
                    <div class="swiper-icon swiper-arrow swiper-arrow-prev position-absolute d-flex align-items-center">
                        <svg class="chevron-left">
                            <use xlink:href="#chevron-left" />
                        </svg>
                    </div>
                    <div class="swiper testimonial-swiper">
                        <div class="quotation text-center">
                            <svg class="quote">
                                <use xlink:href="#quote" />
                            </svg>
                        </div>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide text-center d-flex justify-content-center">
                                <div class="review-item col-md-10">
                                    <i class="icon icon-review"></i>
                                    <blockquote>
                                        “Damar Wulan Group hadir untuk melengkapi ibadah Anda dengan songkok berkualitas
                                        tinggi.
                                        Setiap detail dirancang untuk kenyamanan dan kekhusyukan, menjadikan ibadah lebih
                                        sempurna.”
                                    </blockquote>

                                    <div class="author-detail">
                                        <div class="name text-dark text-uppercase pt-2">Owner Damar Wulan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </section>
    <section id="subscribe" class="container-grid padding-large position-relative overflow-hidden">
        <div class="container">
        </div>
    </section>
    <section id="instagram" class="padding-large overflow-hidden no-padding-top">
        <div class="container">
            <div class="row">
                <div class="display-header text-uppercase text-dark text-center pb-3">
                    <h2 class="display-7">Foto Produk Unggulan</h2>
                </div>
                <div class="d-flex flex-wrap">
                    <figure class="instagram-item pe-2">
                        <a href="https://templatesjungle.com/" class="image-link position-relative">
                            <img src="asset/images/insta-item1.jpg" alt="instagram" class="insta-image">
                            <div class="icon-overlay position-absolute d-flex justify-content-center">
                                <svg class="instagram">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </div>
                        </a>
                    </figure>
                    <figure class="instagram-item pe-2">
                        <a href="https://templatesjungle.com/" class="image-link position-relative">
                            <img src="asset/images/insta-item2.jpg" alt="instagram" class="insta-image">
                            <div class="icon-overlay position-absolute d-flex justify-content-center">
                                <svg class="instagram">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </div>
                        </a>
                    </figure>
                    <figure class="instagram-item pe-2">
                        <a href="https://templatesjungle.com/" class="image-link position-relative">
                            <img src="asset/images/insta-item3.jpg" alt="instagram" class="insta-image">
                            <div class="icon-overlay position-absolute d-flex justify-content-center">
                                <svg class="instagram">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </div>
                        </a>
                    </figure>
                    <figure class="instagram-item pe-2">
                        <a href="https://templatesjungle.com/" class="image-link position-relative">
                            <img src="asset/images/insta-item4.jpg" alt="instagram" class="insta-image">
                            <div class="icon-overlay position-absolute d-flex justify-content-center">
                                <svg class="instagram">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </div>
                        </a>
                    </figure>
                    <figure class="instagram-item pe-2">
                        <a href="https://templatesjungle.com/" class="image-link position-relative">
                            <img src="asset/images/insta-item5.jpg" alt="instagram" class="insta-image">
                            <div class="icon-overlay position-absolute d-flex justify-content-center">
                                <svg class="instagram">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </div>
                        </a>
                    </figure>
                </div>
            </div>
        </div>
    </section>
@endsection
