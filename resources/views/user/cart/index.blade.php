@extends('layouts.main')

@section('konten')
<section class="h-100">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0 text-center">Shopping Cart</h3>
                </div>

                @foreach ($carts as $cart)
                <div class="card rounded-3 mb-4" id="cart-item-{{ $cart->id }}">
                    <div class="card-body p-4">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img src="{{ asset('storage/produk/' . $cart->produk->image) }}"
                                    class="img-fluid rounded-3" alt="{{ $cart->produk->name }}">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <p class="lead fw-normal mb-2">{{ $cart->produk->name }}</p>
                                <p><span class="text-muted">Size: {{ $cart->produk->size }}</span></p>
                                <p><span class="text-muted">Stok: {{ $cart->produk->stock }} Tersisa</span></p>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                <button class="btn btn-link px-2" onclick="updateQuantity({{ $cart->id }}, -1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input id="quantity-{{ $cart->id }}" min="1" max="{{ $cart->produk->stock }}"
                                    name="quantity" value="{{ $cart->quantity }}" type="number"
                                    class="form-control form-control-sm" data-stock="{{ $cart->produk->stock }}" />
                                <button class="btn btn-link px-2" onclick="updateQuantity({{ $cart->id }}, 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                <h5 class="mb-0" id="price-{{ $cart->id }}">Rp
                                    {{ number_format($cart->produk->price * $cart->quantity, 0, ',', '.') }}</h5>
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                <form action="{{ route('user.cart.delete', $cart->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                        <i class="fas fa-trash fa-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="row d-flex justify-content-between align-items-between">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Summary</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                            <strong>Total Harga</strong>
                                        </div>
                                        <span><strong id="grand-total">Rp
                                                {{ number_format($grandTotal, 0, ',', '.') }}</strong></span>
                                    </li>
                                </ul>
                                <a href="{{ route('user.cekoutView') }}" type="button"
                                    class="btn btn-primary btn-lg btn-block">
                                    Go to checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function updateQuantity(cartId, change) {
            var quantityInput = document.getElementById('quantity-' + cartId);
            var priceElement = document.getElementById('price-' + cartId);
            var stock = parseInt(quantityInput.getAttribute('data-stock'));
            var newQuantity = parseInt(quantityInput.value) + change;

            if (newQuantity < 1) return; // Prevent quantity from going below 1
            if (newQuantity > stock) {
                alert('Jumlah yang dimasukkan melebihi stok produk!');
                return; // Prevent quantity from exceeding stock
            }

            quantityInput.value = newQuantity;

            // Kirim request AJAX untuk memperbarui kuantitas di server
            $.ajax({
                url: '/cart/' + cartId + '/update', // Ganti dengan URL rute Anda
                type: 'POST',
                data: {
                    quantity: newQuantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var totalPriceForItem = response.totalPrice;
                    priceElement.textContent = 'Rp ' + totalPriceForItem.toLocaleString();

                    updateGrandTotal(response.grandTotal);
                },
                error: function(xhr, status, error) {
                    alert("Terjadi kesalahan saat memperbarui kuantitas.");
                }
            });
        }

        function updateGrandTotal(grandTotal) {
            var grandTotalElement = document.getElementById('grand-total');
            grandTotalElement.textContent = 'Rp ' + grandTotal.toLocaleString();
        }
</script>
@endsection
