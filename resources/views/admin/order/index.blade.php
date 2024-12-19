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
                                <th>Order ID</th>
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
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ number_format($order->total_price, 2) }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($order->status == 'Pending') bg-warning @elseif($order->status == 'Completed') bg-success @else bg-danger @endif">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    {{-- <div class="d-flex justify-content-center">
                        {{ $order->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
