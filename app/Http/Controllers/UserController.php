<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Produk;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Display all products
    public function home()
    {
        $produk = Produk::all();
        return view('user.home', compact('produk'));
    }

    // Display product details
    public function produk()
    {
        $produk = Produk::all();
        return view('user.produk', compact('produk'));
    }

    // Display user's cart
    public function cart()
    {
        $user = auth()->user();
        $carts = Cart::with('produk')->where('user_id', $user->id)->get();

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->produk->price * $cart->quantity;
        });

        $grandTotal = $totalPrice;

        return view('user.cart.index', compact('carts', 'totalPrice', 'grandTotal'));
    }

    // Display order history
    public function history()
    {
        $user = auth()->user();
        $orders = Order::with('orderItems.produk')
            ->where('user_id', $user->id)
            ->get();

        return view('user.history.index', compact('orders'));
    }

    // Display profile page
    public function profile()
    {
        return view('user.profile.index');
    }

    // Display profile edit form
    public function profileEdit()
    {
        return view('user.profile.edit');
    }

    // Update user profile
    public function profileUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1000',
        ]);

        // Handle profile image upload
        if ($request->hasFile('image')) {
            if ($user->image && Storage::exists('public/profile_images/' . $user->image)) {
                Storage::delete('public/profile_images/' . $user->image);
            }

            $gambar = $request->file('image')->store('public/profile_images');
            $validatedData['image'] = basename($gambar);
        }

        // Update user data
        $user->update($validatedData);

        return redirect()->route('user.profile', $user->id)->with('success', 'Profil berhasil diperbarui');
    }

    // Display checkout page
    public function cekoutView()
    {
        $user = auth()->user();
        $carts = Cart::where('user_id', Auth::id())->get();

        $subtotal = $carts->sum(function ($cart) {
            return $cart->produk->price * $cart->quantity;
        });

        $ongkir = 0; // Default ongkir
        $grandTotal = $subtotal + $ongkir;

        return view('user.cekout.index', compact('carts', 'subtotal', 'ongkir', 'grandTotal', 'user'));
    }

    // Place an order
    public function order(Request $request)
    {
        // Validate order data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
        ]);

        $carts = Cart::where('user_id', auth()->id())->get();

        // Ensure the cart is not empty
        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong!');
        }

        $subtotal = $carts->sum(function ($cart) {
            return $cart->produk->price * $cart->quantity;
        });

        // Determine shipping cost based on the province
        $ongkir = match ($validated['province']) {
            'Aceh' => 25000,
            'Bali' => 20000,
            'Banten' => 15000,
            'Bengkulu' => 25000,
            'DI Yogyakarta' => 15000,
            'DKI Jakarta' => 15000,
            'Gorontalo' => 25000,
            'Jambi' => 25000,
            'Jawa Barat' => 15000,
            'Jawa Tengah' => 10000,
            'Jawa Timur' => 12000,
            'Kalimantan Barat' => 30000,
            'Kalimantan Selatan' => 30000,
            'Kalimantan Tengah' => 30000,
            'Kalimantan Timur' => 30000,
            'Kalimantan Utara' => 30000,
            'Kepulauan Bangka Belitung' => 25000,
            'Kepulauan Riau' => 25000,
            'Lampung' => 20000,
            'Maluku' => 35000,
            'Maluku Utara' => 35000,
            'Nusa Tenggara Barat' => 20000,
            'Nusa Tenggara Timur' => 20000,
            'Papua' => 40000,
            'Papua Barat' => 40000,
            'Riau' => 25000,
            'Sulawesi Barat' => 30000,
            'Sulawesi Selatan' => 30000,
            'Sulawesi Tengah' => 30000,
            'Sulawesi Tenggara' => 30000,
            'Sulawesi Utara' => 30000,
            'Sumatera Barat' => 25000,
            'Sumatera Selatan' => 25000,
            'Sumatera Utara' => 25000,
            'Banten' => 15000,
            default => 20000,  // For unknown or unlisted provinces
        };


        $total = $subtotal + $ongkir;

        // Create the order
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
            'status' => 'pending',
        ]);

        // Create order items for each product in the cart
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'produk_id' => $cart->produk_id,
                'quantity' => $cart->quantity,
                'price' => $cart->produk->price,
                'total' => $cart->produk->price * $cart->quantity,
            ]);
        }

        // Remove all items from the cart
        $carts->each->delete();

        return redirect()->route('user.history', ['order' => $order->id])
            ->with('success', 'Pesanan Anda telah berhasil dibuat!');
    }
}
