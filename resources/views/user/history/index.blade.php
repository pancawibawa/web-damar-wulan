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
                                {{ $order->user->name }}, {{ $order->user->phone }}, {{ $order->address }},
                                {{ $order->city }}, {{ $order->province }} - {{ $order->postal_code }}
                            </td>
                            <td rowspan="{{ $order->orderItems->count() }}">
                                <strong>Bayar</strong>
                                <form action="{{ route('order.uploadPaymentProof', $order->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- Input file untuk mengunggah bukti transfer -->
                                    <div class="form-group">
                                        <label for="payment_proof">Unggah Bukti Transfer</label>
                                        <input type="file" name="payment_proof" id="payment_proof" class="form-control"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Bayar</button>
                                </form>
                                @if ($order->payment_proof)
                                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank">Lihat Bukti
                                        Transfer</a>
                                @endif
                            </td>

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
            <a href="/products" class="btn btn-primary">Belanja Lagi</a>
        </div>
    </div>
@endsection
