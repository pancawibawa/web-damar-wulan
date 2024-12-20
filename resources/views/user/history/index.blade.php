@extends('layouts.main')

@section('konten')
    <div class="container py-5">
        <h2 class="mb-4 text-center">Riwayat Pesanan</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Nama Produk</th>
                        <th>Jml Barang</th>
                        <th>Harga /pcs</th>
                        <th>Ongkir</th>
                        <th>Total</th>
                        <th>Alamat Pengiriman</th>
                        <th>No. Resi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td rowspan="{{ $order->orderItems->count() }}">
                                {{ $loop->iteration }}
                            </td>
                            <td rowspan="{{ $order->orderItems->count() }}">
                                {{ $order->status ?? 'Belum Dikonfirmasi' }}
                            </td>
                            <td rowspan="{{ $order->orderItems->count() }}">
                                {{ $order->created_at->format('d-m-Y') }}
                            </td>

                            <!-- Menampilkan item pesanan pertama -->
                            <td>{{ $order->orderItems->first()->produk->name }}</td>
                            <td>{{ $order->orderItems->first()->quantity }}</td>
                            <td>Rp {{ number_format($order->orderItems->first()->price, 0, ',', '.') }}</td>
                            <td rowspan="{{ $order->orderItems->count() }}">
                                <strong>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</strong>
                            </td>
                            <td rowspan="{{ $order->orderItems->count() }}">
                                <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                            </td>
                            <td rowspan="{{ $order->orderItems->count() }}">
                                {{ $order->user->name }}, {{ $order->phone }}, {{ $order->address }},
                                {{ $order->city }}, {{ $order->province }} - {{ $order->postal_code }}
                            </td>

                            <td rowspan="{{ $order->orderItems->count() }}">
                                <strong>{{ $order->nomor_resi }}</strong>
                            </td>
                            <td rowspan="{{ $order->orderItems->count() }}">

                                <button type="button" class="btn btn-primary"
                                    id="pay-button-{{ $order->id }}">Bayar</button>

                                <!-- Link untuk melihat bukti pembayaran jika sudah ada -->
                                @if ($order->payment_proof)
                                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank"
                                        class="btn btn-link mt-2">Lihat Bukti Transfer</a>
                                @endif
                            </td>

                            <script>
                                document.getElementById('pay-button-{{ $order->id }}').addEventListener('click', function() {
                                    Swal.fire({
                                        title: 'Unggah Bukti Pembayaran',
                                        html: `
                                        <p class="text-start">Silahkan transfer ke nomor rekening berikut:</p>
                                            <div class="text-start mb-3">
                                                <strong>Bank: BCA</strong><br>
                                                <strong>Nomor Rekening: 1234567890</strong><br>
                                                <strong>Atas Nama: Damar Wulan Group</strong>
                                            </div>
                                            <div class="text-center mb-3">
                                                <img src="{{ asset('asset/images/qris.jpg') }}" alt="QRIS" class="img-fluid" style="max-width: 200px;">
                                            </div>
                                            <form action="{{ route('order.uploadPaymentProof', $order->id) }}" method="POST" enctype="multipart/form-data" id="payment-form-{{ $order->id }}">
                                                @csrf
                                                
                                                <div class="form-group text-start">
                                                    <label for="payment_proof">Unggah Bukti Transfer</label>
                                                    <input type="file" name="payment_proof" id="payment_proof" class="form-control mt-2" required>
                                                </div>
                                                <button type="submit" class="btn btn-success mt-3">Kirim</button>
                                            </form>
                                        `,
                                        showConfirmButton: false,
                                    });
                                });
                            </script>

                        </tr>

                        <!-- Menampilkan item pesanan lainnya -->
                        @foreach ($order->orderItems->skip(1) as $item)
                            <tr>
                                <td>{{ $item->produk->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="/produk" class="btn btn-primary">Belanja Lagi</a>
        </div>
    </div>
@endsection
