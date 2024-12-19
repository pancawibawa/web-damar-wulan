<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Produk;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function home()
    {
        $produk = Produk::all();
        return view('user.home', compact('produk'));
    }
    public function produk()
    {
        $produk = Produk::all();
        return view('user.produk', compact('produk'));
    }

    public function cart()
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Ambil data keranjang berdasarkan user_id
        $carts = Cart::with('produk')->where('user_id', $user->id)->get();

        // Hitung total harga dan grand total
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->produk->price * $cart->quantity;
        }

        // Hitung grand total berdasarkan semua produk di keranjang
        $grandTotal = $totalPrice;  // Karena sudah dihitung berdasarkan totalPrice untuk saat ini

        // Kirim data ke view
        return view('user.cart.index', compact('carts', 'totalPrice', 'grandTotal'));
    }

    public function history()
    {
        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Ambil data pesanan beserta order items berdasarkan user_id
        $orders = Order::with('orderItems.produk') // Memuat order items beserta produk
            ->where('user_id', $user->id)
            ->get();

        // Mengirim data pesanan dan item pesanan ke view
        return view('user.history.index', compact('orders'));
    }


    public function profile()
    {
        return view('user.profile.index');
    }

    public function profileEdit()
    {
        return view('user.profile.edit');
    }

    public function profileUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data yang masuk
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1000', // Foto profil (optional)
        ]);

        // Jika ada foto baru, upload dan simpan path-nya
        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($user->image && Storage::exists('public/profile_images/' . $user->image)) {
                Storage::delete('public/profile_images/' . $user->image);
            }

            // Simpan foto baru ke folder storage/app/public/profile_images
            $gambar = $request->file('image')->store('public/profile_images');
            $validatedData['image'] = basename($gambar); // Hanya menyimpan nama file tanpa path lengkap
        }

        // Update data pengguna
        $user->update($validatedData);

        return redirect()->route('user.profile', $user->id)->with('success', 'Profil berhasil diperbarui');
    }




    // public function cekoutView()
    // {
    //     // Ambil API Key dari .env
    //     $apiKey = env('RAJAONGKIR_API_KEY');

    //     // Panggil API RajaOngkir untuk mendapatkan data provinsi
    //     $response = Http::withHeaders([
    //         'key' => $apiKey,
    //     ])->get('https://api.rajaongkir.com/starter/province');

    //     // Periksa apakah respons dari API berhasil
    //     if ($response->successful()) {
    //         // Ambil data provinsi dari hasil API
    //         $provinces = $response->json()['rajaongkir']['results'];

    //         // Ambil data keranjang dari session
    //         $cartItems = session('cart', []); // Mengambil data cart dari session (misalnya, sebuah array)

    //         // Hitung subtotal, pajak, dan ongkir
    //         $subtotal = 0;
    //         foreach ($cartItems as $item) {
    //             $subtotal += $item['price'] * $item['quantity'];
    //         }

    //         // Anggap pajak adalah 10% dari subtotal
    //         $tax = $subtotal * 0.1;

    //         // Ongkir (misalnya, dihitung berdasarkan provinsi atau jarak)
    //         $shippingCost = 5000; // Ongkir tetap (contoh)

    //         // Total keseluruhan
    //         $totalAmount = $subtotal + $tax + $shippingCost;

    //         // Kirimkan data ke view
    //         return view('user.cekout.index', compact('provinces', 'cartItems', 'subtotal', 'tax', 'shippingCost', 'totalAmount'));
    //     } else {
    //         // Jika API gagal, bisa menangani dengan menampilkan pesan error atau fallback
    //         return redirect()->back()->with('error', 'Gagal mengambil data provinsi dari API.');
    //     }
    // }


    public function cekoutView()
    {
        $user = auth()->user();

        // Ambil data keranjang pengguna yang sedang login
        $carts = Cart::where('user_id', Auth::id())->get();

        // Hitung subtotal dan total
        $subtotal = $carts->sum(function ($cart) {
            return $cart->produk->price * $cart->quantity;
        });

        // Misalkan pajak adalah 10% dari subtotal
        // $tax = $subtotal * 0.1;
        // $total = $subtotal + $tax;

        // Inisialisasi ongkir
        $ongkir = 10000;

        // Menghitung total dengan ongkir
        $grandTotal = $subtotal + $ongkir;

        // Mengirim data ke view
        return view('user.cekout.index', compact('carts', 'subtotal', 'ongkir', 'grandTotal', 'user'));
    }



    public function order(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
        ]);

        // Mendapatkan data keranjang dari pengguna yang login
        $carts = Cart::where('user_id', auth()->id())->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong!');
        }

        // Menghitung subtotal
        $subtotal = $carts->sum(function ($cart) {
            return $cart->produk->price * $cart->quantity;
        });

        // Menghitung ongkir berdasarkan provinsi
        $ongkir = ($validated['province'] == 'Jawa Tengah') ? 10000 : 15000;

        // Total keseluruhan
        $total = $subtotal + $ongkir;

        // Membuat order baru
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'address' => $validated['alamat'],
            'province' => $validated['province'],
            'city' => $validated['city'],
            'postal_code' => $validated['postcode'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'subtotal' => $subtotal,
            'shipping_cost' => $ongkir,
            'total_price' => $total,
            'status' => 'pending', // Status awal order
        ]);

        // Menambahkan item dari keranjang ke order
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'produk_id' => $cart->produk_id,
                'quantity' => $cart->quantity,
                'price' => $cart->produk->price,
                'total' => $cart->produk->price * $cart->quantity,
            ]);
        }

        // Menghapus keranjang setelah pesanan dibuat
        $carts->each->delete();

        // Mengalihkan ke halaman konfirmasi dengan pesan sukses
        return redirect()->route('user.history', ['order' => $order->id])
            ->with('success', 'Pesanan Anda telah berhasil dibuat!');
    }

}
