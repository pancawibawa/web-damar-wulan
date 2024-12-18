@extends('layouts.main')
@section('konten')
    <section class="h-100">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-center">Cekout Details</h3>
                    </div>

                    <form action="{{ route('user.cekout') }}" method="post">
                        @method('POST')
                        @csrf
                        <div class="row d-flex justify-content-between align-items-between ">
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-header py-3 bg-light">
                                        <h5 class="mb-0 text-center">Alamat Pengiriman</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Nama Penerima<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="username" name="username" class="form-control"
                                                placeholder="Username ...">
                                        </div>

                                        {{-- <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="first-name" class="form-label">First Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="first-name" name="first_name" class="form-control"
                                                    placeholder="First Name ...">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="last-name" class="form-label">Last Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="last-name" name="last_name" class="form-control"
                                                    placeholder="Last Name ...">
                                            </div>
                                        </div> --}}

                                        <div class="mb-3">
                                            <label for="address1" class="form-label">Alamat Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="address1" name="address1" class="form-control"
                                                placeholder="Jl. Bersamamu No.90 Rt01/01 No.90 ...">
                                        </div>

                                        {{-- <div class="mb-3">
                                            <input type="text" id="address2" name="address2" class="form-control"
                                                placeholder="Apartment, suite, unit etc. (optional)...">
                                        </div> --}}

                                        <div class="mb-3">
                                            <label for="province-id" class="form-label">Provinsi <span
                                                    class="text-danger">*</span></label>
                                            <select id="province-id" name="province_id" class="form-select">
                                                <option value="">- Pilih Provinsi -</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province['province_id'] }}"
                                                        {{ old('province_id', request()->get('province_id')) == $province['province_id'] ? 'selected' : '' }}>
                                                        {{ $province['province'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="city-id" class="form-label">Kota <span
                                                        class="text-danger">*</span></label>
                                                        <input type="text" id="city-id" name="city-id" class="form-control"
                                                        placeholder="Masukan Kota Anda">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="postcode" class="form-label">Kode Pos <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" id="postcode" name="postcode" class="form-control"
                                                    placeholder="Postal Code...">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">No HP <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="phone" name="phone" class="form-control"
                                                    placeholder="Phone...">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Alamat Email</label>
                                                <input type="text" id="email" name="email" class="form-control"
                                                    readonly placeholder="Email...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-primary text-white py-3">
                                        <h5 class="mb-0">Orderan Kamu</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="text-center">Produk</th>
                                                        <th class="text-center">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @forelse ($items as $item)
                                                        @php
                                                            $product = $item->associatedModel;
                                                            $image = !empty($product->firstMedia)
                                                                ? asset('storage/images/products/' . $product->firstMedia->file_name)
                                                                : asset('frontend/assets/img/cart/3.jpg');
                                                        @endphp
                                                        <tr>
                                                            <td class="text-start">
                                                                <strong>{{ $item->name }}</strong> 
                                                                <br>
                                                                <span class="text-muted">× {{ $item->quantity }}</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <span class="amount">Rp {{ number_format(\Cart::get($item->id)->getPriceSum()) }}</span>
                                                            </td>
                                                        </tr>
                                                    @empty --}}
                                                    <tr>
                                                        <td colspan="2" class="text-center text-muted">Keranjang
                                                            kosong!</td>
                                                    </tr>
                                                    {{-- @endforelse --}}
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-end">Subtotal</th>
                                                        <td class="text-end">Rp <span class="amount">0</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Pajak</th>
                                                        <td class="text-end">Rp <span class="amount">0</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Ongkir</th>
                                                        <td>Onkir Ditanggung Pembeli Saat Menerima Barang
                                                            {{-- <select id="shipping-cost-option" name="shipping_service"
                                                                class="form-select" required>
                                                                <option value="">Pilih layanan pengiriman...</option>
                                                            </select> --}}
                                                        </td>
                                                    </tr>
                                                    <tr class="table-dark">
                                                        <th class="text-end">Total Keseluruhan</th>
                                                        <td class="text-end">
                                                            <strong>Rp <span class="total-amount">0</span></strong>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="accordion mt-4" id="paymentAccordion">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="paymentOne">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#payment-1"
                                                        aria-expanded="true">
                                                        Transfer Bank Langsung
                                                    </button>
                                                </h2>
                                                <div id="payment-1" class="accordion-collapse collapse show"
                                                    aria-labelledby="paymentOne">
                                                    <div class="accordion-body">
                                                        Lakukan pembayaran langsung ke rekening bank kami. Gunakan ID
                                                        Pesanan sebagai referensi pembayaran.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="paymentTwo">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#payment-2"
                                                        aria-expanded="false">
                                                        Pembayaran Cek
                                                    </button>
                                                </h2>
                                                <div id="payment-2" class="accordion-collapse collapse"
                                                    aria-labelledby="paymentTwo">
                                                    <div class="accordion-body">
                                                        Lakukan pembayaran dengan cek menggunakan ID Pesanan sebagai
                                                        referensi.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="paymentThree">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#payment-3"
                                                        aria-expanded="false">
                                                        PayPal
                                                    </button>
                                                </h2>
                                                <div id="payment-3" class="accordion-collapse collapse"
                                                    aria-labelledby="paymentThree">
                                                    <div class="accordion-body">
                                                        Gunakan PayPal untuk melakukan pembayaran dengan cepat dan aman.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end mt-4">
                                            <button type="submit" class="btn btn-success btn-lg">Buat Pesanan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="card">
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
