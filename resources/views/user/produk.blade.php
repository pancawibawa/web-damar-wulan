@extends('layouts.main')
@section('konten')
    <section id="mobile-products" class="product-store position-relative padding-large no-padding-top">
        <div class="container">
            <div class="row">
                <div class="my-4 d-flex justify-content-center">
                    <h1>Produk Kami</h1>
                </div>

                <div class="container py-4">
                    <div class="row g-4"> <!-- Row dengan jarak antar kartu -->
                        <!-- Perulangan kartu -->
                        <!-- Perulangan untuk menampilkan produk -->
                        @foreach ($produk as $item)
                            <div class="col-md-3 col-sm-6"> <!-- Ukuran responsif -->
                                <div class="card"
                                    style="width: 100%; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    <div class="image-holder" style="width: 100%; height: 18rem; overflow: hidden;">
                                        <img src="{{ asset('storage/produk/' . $item->image) }}" class="card-img-top"
                                            alt="..." style="object-fit: cover; width: 100%; height: 100%;">
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
                                                    style="font-weight: bold; color: green;">{{ $item->sold }}</span> pcs
                                            </p>
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
@endsection
