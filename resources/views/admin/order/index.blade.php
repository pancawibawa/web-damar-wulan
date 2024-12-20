@extends('layoutadmin.app')

@section('konten')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Kolom Order -->
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-semibold">Daftar Order</h5>

                    <!-- Tabel Order -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Pelanggan</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Tanggal Order</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($order->orderItems && $order->orderItems->isNotEmpty())
                                    @foreach($order->orderItems as $item)
                                    {{ $item->produk->name ?? 'Produk tidak ditemukan' }}<br>
                                    @endforeach
                                    @else
                                    Tidak ada produk
                                    @endif
                                </td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>{{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <span class="badge
                                        @if(is_null($order->payment_proof)) bg-warning
                                        @elseif($order->payment_proof && $order->status == 'menunggu_konfirmasi') bg-info
                                        @elseif($order->status == 'berhasil') bg-success
                                        @elseif($order->status == 'ditolak') bg-danger
                                        @endif">
                                        @if(is_null($order->payment_proof)) Pending
                                        @elseif($order->payment_proof && $order->status == 'menunggu_konfirmasi')
                                        Menunggu Konfirmasi
                                        @elseif($order->status == 'berhasil') Berhasil
                                        @elseif($order->status == 'ditolak') Ditolak
                                        @endif
                                    </span>
                                </td>

                                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.order.show', $order->id) }}"
                                        class="btn btn-info btn-sm">Detail</a>
                                    <form action="/" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection