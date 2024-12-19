@extends('layouts.main')
@section('konten')
    <section class="h-100">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-center">Cekout Details</h3>
                    </div>

                    <form action="{{ route('user.order') }}" method="post">
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
                                            <label for="name" class="form-label">Nama Penerima<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="alamat"
                                                class="form-control @error('alamat') is-invalid @enderror"
                                                value="{{ old('alamat', $user->alamat) }}" required>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="province" class="form-label">Pilih Provinsi <span
                                                    class="text-danger">*</span></label>
                                            <select name="province"
                                                class="form-control @error('province') is-invalid @enderror" required>
                                                @include('user.cekout.provinsi')
                                            </select>
                                            @error('province')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="city" class="form-label">Kota <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="city"
                                                    class="form-control @error('city') is-invalid @enderror"
                                                    value="{{ old('city', $user->city) }}" required
                                                    placeholder="Masukan city Anda">
                                                @error('city')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="postcode" class="form-label">Kode Pos <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="postcode"
                                                    class="form-control @error('postcode') is-invalid @enderror"
                                                    value="{{ old('postcode', $user->postcode) }}" required
                                                    placeholder="Masukan postcode Anda">
                                                @error('postcode')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">No HP <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone', $user->phone) }}" required
                                                    placeholder="Masukan phone Anda">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Alamat Email</label>
                                                <input type="text" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email', $user->email) }}" readonly
                                                    placeholder="Masukan email Anda">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
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
                                                    @forelse ($carts as $cart)
                                                        <tr>
                                                            <td>{{ $cart->produk->name }}</td>
                                                            <td>
                                                                <span class="text-center">{{ $cart->quantity }} Pcs</span>
                                                                <span class="text-end float-end">Rp
                                                                    {{ number_format($cart->produk->price * $cart->quantity, 0, ',', '.') }}</span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2" class="text-center text-muted">Keranjang
                                                                kosong!</td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-end">Subtotal</th>
                                                        <td class="text-end">Rp <span
                                                                class="amount">{{ number_format($subtotal, 0, ',', '.') }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Ongkir</th>
                                                        <td class="text-end">Rp <span
                                                                class="amount">{{ number_format($ongkir, 0, ',', '.') }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="table-dark">
                                                        <th class="text-end">Total Keseluruhan</th>
                                                        <td class="text-end">
                                                            <strong>Rp <span
                                                                    class="total-amount">{{ number_format($grandTotal, 0, ',', '.') }}</span></strong>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        {{-- <div class="accordion mt-4" id="paymentAccordion">
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
                                        </div> --}}
                                        <div class="text-end mt-4">
                                            <button type="submit" class="btn btn-success btn-lg">Buat Pesanan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
