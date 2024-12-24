<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $produk_id)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan produk ke keranjang.');
        }

        // Cek apakah produk ada
        $produk = Produk::find($produk_id);

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Cek apakah stok mencukupi
        if ($produk->stock < 1) {
            return redirect()->back()->with('error', 'Produk ini sudah habis.');
        }

        // Cek apakah produk sudah ada di keranjang
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('produk_id', $produk_id)
            ->first();

        if ($cartItem) {
            // Jika produk sudah ada di keranjang, tambahkan jumlahnya
            if ($cartItem->quantity + 1 > $produk->stock) {
                return redirect()->back()->with('error', 'Jumlah produk melebihi stok tersedia.');
            }

            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Jika belum ada, tambahkan produk baru ke keranjang
            Cart::create([
                'user_id' => Auth::id(),
                'produk_id' => $produk_id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function updateQuantity(Request $request, $cartId)
    {
        // Validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Cari cart berdasarkan ID
        $cart = Cart::findOrFail($cartId);

        // Cek apakah stok mencukupi
        if ($request->quantity > $cart->produk->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah produk melebihi stok tersedia.',
            ], 400);
        }

        // Update kuantitas di cart
        $cart->quantity = $request->quantity;
        $cart->save();

        // Hitung harga untuk item ini
        $totalPrice = $cart->produk->price * $cart->quantity;

        // Hitung grand total untuk seluruh cart
        $grandTotal = Cart::where('user_id', auth()->id())
            ->join('produks', 'produks.id', '=', 'carts.produk_id')
            ->sum(DB::raw('produks.price * carts.quantity'));

        // Kirim response berupa JSON
        return response()->json([
            'success' => true,
            'totalPrice' => $totalPrice,
            'grandTotal' => $grandTotal
        ]);
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return redirect()->back()->with('error', 'Item tidak ditemukan.');
        }

        $cart->delete();

        return redirect()->route('user.cart')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
