@extends('layouts.main')
@section('konten')
    <section id="mobile-products" class="product-store position-relative padding-large no-padding-top">
        <div class="container">
            <div class="row">
                {{-- <div class="display-header d-flex justify-content-between pb-3">
                    <h2 class="display-7 text-dark text-uppercase">Produk Kami</h2>
                    <div class="btn-right">
                        <a href="{{ route('user.produk') }}" class="btn btn-medium btn-normal text-uppercase">Lihat
                            Selengkapnya</a>
                    </div>
                </div> --}}
                <div class="my-4 d-flex justify-content-center">
                    <h1>Produk Kami</h1>
                </div>

                <div class="container py-4">
                    <div class="row g-4"> <!-- Row dengan jarak antar kartu -->
                        <!-- Perulangan kartu -->
                        @for ($i = 1; $i <= 10; $i++)
                        <div class="col-md-3 col-sm-6"> <!-- Ukuran responsif -->
                            <div class="card" style="width: 100%; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="image-holder" style="width: 100%; height: 18rem; overflow: hidden;">
                                    <img src="asset/images/product-item1.jpg" class="card-img-top" alt="..." style="object-fit: cover; width: 100%; height: 100%;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Songkok NasiUduk</h5>
                                    <h4>RP 80000</h4>
                                    <p class="card-text">songkok dengan pribadi yang luwes</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="#" class="btn btn-dark">Add Cart</a>
                                        <p style="font-size: 14px; color: #555;">Terjual: <span style="font-weight: bold; color: green;">150</span> pcs</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @endfor

                    </div>
                </div>

                {{-- @for ($i = 1; $i <= 10; $i++)
                    <div class="card" style="width: 18rem; margin-bottom: 20px;">
                        <div class="image-holder" style="width: 100%; height: 18rem; overflow: hidden;">
                            <img src="asset/images/product-item{{ $i }}.jpg" class="card-img-top"
                                alt="Product {{ $i }}" style="object-fit: cover; width: 100%; height: 100%;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Songkok NasiUduk {{ $i }}</h5>
                            <p class="card-text">Some quick example text for item {{ $i }} to build on the card
                                title.</p>
                            <a href="#" class="btn btn-medium btn-black">Add Cart</a>
                        </div>
                    </div>
                @endfor --}}



            </div>
        </div>
        <div class="swiper-pagination position-absolute text-center"></div>
    </section>
@endsection
