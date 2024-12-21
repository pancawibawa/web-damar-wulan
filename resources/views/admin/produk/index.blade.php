@extends('layoutadmin.app')

@section('konten')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Kolom Produk -->
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-semibold">Daftar Produk</h5>
                    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

                    <!-- Tabel Produk -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Size</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Terjual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produk as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->terjual }}</td>
                                    <td>
                                        <a href="{{ route('admin.produk.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                    <div class="d-flex justify-content-center">
                        {{ $produk->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
