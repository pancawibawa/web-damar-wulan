@extends('layouts.main')
@section('konten')
<section class="h-100">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0 text-center">Checkout Details</h3>
                </div>
                <form action="{{ route('user.order') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card border">
                                <div class="card-header py-3 bg-light">
                                    <h5 class="mb-0 text-center">Alamat Pengiriman</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Input fields updated -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Penerima <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat Lengkap <span
                                                class="text-danger">*</span></label>
                                        <textarea id="alamat" name="alamat" rows="3"
                                            class="form-control @error('alamat') is-invalid @enderror"
                                            required>{{ old('alamat', $user->alamat) }}</textarea>
                                        @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="province" class="form-label">Pilih Provinsi <span
                                                class="text-danger">*</span></label>
                                        <select id="province" name="province"
                                            class="form-control @error('province') is-invalid @enderror" required>
                                            @include('user.cekout.provinsi')
                                        </select>
                                        @error('province')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Input optimized -->
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
                                            <input type="text" id="phone" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ old('phone', $user->phone) }}" required
                                                pattern="^\+?[0-9]{10,15}$" placeholder="Masukan nomor HP">
                                            @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Alamat Email</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                value="{{ old('email', $user->email) }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Order Summary -->
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white py-3">
                                    <h5 class="mb-0">Orderan Kamu</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Produk</th>
                                                    <th class="text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($carts as $cart)
                                                <tr>
                                                    <td>{{ $cart->produk->name }}</td>
                                                    <td class="text-end">
                                                        {{ $cart->quantity }} x Rp {{
                                                        number_format($cart->produk->price, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="2" class="text-center text-muted">Keranjang kosong!
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Subtotal</th>
                                                    <td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Ongkir</th>
                                                    <td class="text-end" id="ongkir">Rp {{ number_format($ongkir, 0,
                                                        ',', '.') }}</td>
                                                </tr>
                                                <tr class="table-dark">
                                                    <th>Total</th>
                                                    <td class="text-end" id="grandTotal">
                                                        <strong>Rp {{ number_format($grandTotal, 0, ',', '.')
                                                            }}</strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="text-end mt-3">
                                        <button type="submit" class="btn btn-success">Buat Pesanan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    // Update ongkir berdasarkan provinsi yang dipilih
    document.getElementById('province').addEventListener('change', function () {
        const province = this.value;
        let ongkir = 0; // Default ongkir
        let totalQuantity = 0;

        @foreach ($carts as $cart)
            totalQuantity += {{ $cart->quantity }};
        @endforeach

        // Hitung berat berdasarkan jumlah produk
        let berat = Math.ceil(totalQuantity / 5); // 5 pcs = 1 kg, 6-10 pcs = 2 kg, dst.

        // Tentukan ongkir berdasarkan provinsi dan berat
        if (province === 'Aceh') {
            ongkir = 25000 * berat;
        } else if (province === 'Bali') {
            ongkir = 20000 * berat;
        } else if (province === 'Banten') {
            ongkir = 15000 * berat;
        } else if (province === 'Bengkulu') {
            ongkir = 25000 * berat;
        } else if (province === 'DI Yogyakarta') {
            ongkir = 15000 * berat;
        } else if (province === 'DKI Jakarta') {
            ongkir = 15000 * berat;
        } else if (province === 'Gorontalo') {
            ongkir = 25000 * berat;
        } else if (province === 'Jambi') {
            ongkir = 25000 * berat;
        } else if (province === 'Jawa Barat') {
            ongkir = 15000 * berat;
        } else if (province === 'Jawa Tengah') {
            ongkir = 10000 * berat; // Set default for Jawa Tengah
        } else if (province === 'Jawa Timur') {
            ongkir = 12000 * berat;
        } else if (province === 'Kalimantan Barat') {
            ongkir = 30000 * berat;
        } else if (province === 'Kalimantan Selatan') {
            ongkir = 30000 * berat;
        } else if (province === 'Kalimantan Tengah') {
            ongkir = 30000 * berat;
        } else if (province === 'Kalimantan Timur') {
            ongkir = 30000 * berat;
        } else if (province === 'Kalimantan Utara') {
            ongkir = 30000 * berat;
        } else if (province === 'Kepulauan Bangka Belitung') {
            ongkir = 25000 * berat;
        } else if (province === 'Kepulauan Riau') {
            ongkir = 25000 * berat;
        } else if (province === 'Lampung') {
            ongkir = 20000 * berat;
        } else if (province === 'Maluku') {
            ongkir = 35000 * berat;
        } else if (province === 'Maluku Utara') {
            ongkir = 35000 * berat;
        } else if (province === 'Nusa Tenggara Barat') {
            ongkir = 20000 * berat;
        } else if (province === 'Nusa Tenggara Timur') {
            ongkir = 20000 * berat;
        } else if (province === 'Papua') {
            ongkir = 40000 * berat;
        } else if (province === 'Papua Barat') {
            ongkir = 40000 * berat;
        } else if (province === 'Riau') {
            ongkir = 25000 * berat;
        } else if (province === 'Sulawesi Barat') {
            ongkir = 30000 * berat;
        } else if (province === 'Sulawesi Selatan') {
            ongkir = 30000 * berat;
        } else if (province === 'Sulawesi Tengah') {
            ongkir = 30000 * berat;
        } else if (province === 'Sulawesi Tenggara') {
            ongkir = 30000 * berat;
        } else if (province === 'Sulawesi Utara') {
            ongkir = 30000 * berat;
        } else if (province === 'Sumatera Barat') {
            ongkir = 25000 * berat;
        } else if (province === 'Sumatera Selatan') {
            ongkir = 25000 * berat;
        } else if (province === 'Sumatera Utara') {
            ongkir = 25000 * berat;
        } else {
            ongkir = 20000 * berat; // Default
        }

        // Update nilai ongkir di halaman
        document.getElementById('ongkir').innerText = 'Rp ' + ongkir.toLocaleString('id-ID');

        // Update grand total
        const subtotal = {{ $subtotal }}; // Pastikan ini terdefinisi di server-side
        const grandTotal = subtotal + ongkir;
        document.getElementById('grandTotal').innerText = 'Rp ' + grandTotal.toLocaleString('id-ID');
    });
</script>
@endsection