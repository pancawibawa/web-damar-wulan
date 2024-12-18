@extends('layouts.main')
@section('konten')
    <section class="h-100">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-center">Shopping Cart</h3>
                        {{-- <div>
              <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">price <i
                    class="fas fa-angle-down mt-1"></i></a></p>
            </div> --}}
                    </div>

                    <div class="card rounded-3 mb-4">
                        <div class="card-body p-4 ">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img1.webp"
                                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <p class="lead fw-normal mb-2">Basic T-shirt</p>
                                    <p><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey
                                    </p>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <input id="form1" min="0" name="quantity" value="2" type="number"
                                        class="form-control form-control-sm" />

                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h5 class="mb-0">$499.00</h5>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-between align-items-between ">
                        {{-- <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h5 class="mb-0">Alamat Pengiriman</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                            Nama Penerima
                                            <span>Budi</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                            No Hp
                                            <span>121212121212</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            Alamat
                                            <span>Jalan Jalan</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                            <div>
                                                <strong>Total Harga</strong>

                                            </div>
                                            <span><strong>$53.98</strong></span>
                                        </li>
                                    </ul>

                                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-primary btn-lg btn-block">
                                        Go to checkout
                                    </button>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-6">
                            <div class="card border">
                                <div class="card-header py-3">
                                    <h5 class="mb-0">Alamat Pengiriman</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Header Resi -->
                                    <div class="mb-3">
                                        <p class="mb-0"><strong>No Resi:</strong> AB1234567890</p>
                                        <p class="mb-0"><strong>Tanggal:</strong> 18 Desember 2024</p>
                                    </div>
                                    <hr>
                                    <!-- Informasi Penerima -->
                                    <h6 class="text-muted"><strong>Nama Penerima</strong></h6>
                                    <p>Budi</p>
                                    
                                    <h6 class="text-muted"><strong>No HP</strong></h6>
                                    <p>121212121212</p>
                                    
                                    <h6 class="text-muted"><strong>Alamat Pengiriman</strong></h6>
                                    <p>Jalan Jalan, RT 02 RW 03, Kelurahan A, Kecamatan B, Kota C, 12345</p>
                                    <hr>
                                    <!-- Total Harga -->
                                    <h6 class="text-muted"><strong>Total Harga</strong></h6>
                                    <p>Rp 500.000</p>
                                    
                                    <h6 class="text-muted"><strong>Metode Pembayaran</strong></h6>
                                    <p>Transfer Bank</p>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-md-6 ">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h5 class="mb-0">Summary</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center  px-0 ">
                                            Harga Produk
                                            <span>$53.98</span><span>X</span>1
                                        </li>
                                        {{-- <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            Pengiriman
                                            <span>Gratis</span>
                                        </li> --}}
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                            <div>
                                                <strong>Total Harga</strong>

                                            </div>
                                            <span><strong>$53.98</strong></span>
                                        </li>
                                    </ul>
                                    {{-- 
                                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-primary btn-lg btn-block">
                                        Go to checkout
                                    </button> --}}
                                    <a href="{{route('user.cekoutView')}}" type="button" class="btn btn-primary btn-lg btn-block">
                                        Go to checkout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- 
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h5>Subtotal : </h5>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-dark btn-block btn-lg">Proses Pembayaran</button>

                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Fungsi untuk update quantity dan menghitung ulang harga
        function updateQuantity(itemId) {
            var quantity = document.getElementById('quantity-' + itemId).value;
            // Kirim request ke server untuk update quantity
            fetch(`/cart/update/${itemId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload halaman untuk melihat pembaruan
                    }
                });
        }
    </script>
@endsection
