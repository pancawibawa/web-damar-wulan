@extends('layoutadmin.app')

@section('konten')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Informasi Pelanggan -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fw-semibold">Informasi Pelanggan</h5>
                        <p><strong>Nama:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                        <p><strong>Alamat:</strong> {{ $order->address ?? 'N/A' }}</p>
                        <p><strong>Kota:</strong> {{ $order->city ?? 'N/A' }}</p>
                        <p><strong>Provinsi:</strong> {{ $order->province ?? 'N/A' }}</p>
                        <p><strong>Kode Pos:</strong> {{ $order->postal_code ?? 'N/A' }}</p>
                        <p><strong>Telepon:</strong> {{ $order->phone ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Barang -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fw-semibold">Detail Barang</h5>
                        @if ($order->orderItems && $order->orderItems->isNotEmpty())
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama Barang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/produk/' . $item->produk->image) }}"
                                                    alt="{{ $item->produk->name }}" style="width: 100px; height: auto;">
                                            </td>
                                            <td>{{ $item->produk->name ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Data barang tidak ditemukan.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bukti Pembayaran -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fw-semibold">Detail Pembayaran</h5>
                        <p><strong>Bukti Pembayaran:</strong>
                            @if ($order->payment_proof)
                                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank">Lihat Bukti
                                    Pembayaran</a>
                            @else
                                Tidak ada bukti pembayaran.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tombol untuk memverifikasi pembayaran -->
        @if ($order->status == 'menunggu_konfirmasi')
            <div class="d-flex justify-content-between">
                {{-- <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" name="status" value="berhasil" class="btn btn-success">ACC Pembayaran</button>
        </form> --}}
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Tombol untuk memunculkan modal SweetAlert
                        document.getElementById('acc-button-{{ $order->id }}').addEventListener('click', function() {
                            Swal.fire({
                                title: 'Konfirmasi Pembayaran',
                                html: `
                            <div class="form-group text-start">
                                <label for="resi_number">Masukkan Nomor Resi</label>
                                <input type="text" id="resi_number_input" class="form-control mt-2" placeholder="Nomor Resi" required>
                            </div>
                        `,
                                showCancelButton: true,
                                confirmButtonText: 'Konfirmasi',
                                cancelButtonText: 'Batal',
                                preConfirm: () => {
                                    // Ambil input nomor resi
                                    const resiNumber = document.getElementById('resi_number_input').value;
                                    if (!resiNumber) {
                                        Swal.showValidationMessage('Nomor resi wajib diisi!');
                                        return false;
                                    }
                                    return resiNumber;
                                },
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Kirim data melalui form
                                    const resiForm = document.getElementById('resi-form-{{ $order->id }}');
                                    const resiInput = document.getElementById('resi_number_field');
                                    resiInput.value = result.value;
                                    resiForm.submit();
                                }
                            });
                        });
                    });
                </script>

                <!-- Tombol untuk memunculkan modal -->
                <button type="button" class="btn btn-success" id="acc-button-{{ $order->id }}">ACC Pembayaran</button>

                <!-- Formulir untuk mengirim data -->
                <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST"
                    id="resi-form-{{ $order->id }}" style="display: none;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="resi_number" id="resi_number_field">
                    <input type="hidden" name="status" value="berhasil">
                </form>

                <!-- Tombol untuk menolak -->
                <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST"
                    style="display: inline-block;">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="status" value="ditolak" class="btn btn-danger">Ditolak</button>
                </form>
            </div>
        @endif


        <!-- Tombol Kembali -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@endsection
