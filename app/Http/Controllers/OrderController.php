<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Menampilkan daftar orderan untuk admin
    public function adminIndex()
{
    // Memuat relasi user, orderItems, dan produk
    $order = Order::with(['user', 'orderItems.produk'])->get();

    return view('admin.order.index', compact('order'));
}

    // Menampilkan daftar orderan untuk pengguna
    public function index()
    {
        // Ambil data order untuk pengguna yang sedang login
        $orders = Order::where('user_id', Auth::id())->get();

        // Mengirim data ke view orders.index.blade.php
        return view('user.orders.index', compact('orders'));
    }

    public function uploadPaymentProof(Request $request, $orderId)
    {
        // Validasi file yang diunggah
        $request->validate([
            'payment_proof' => 'required|mimes:jpeg,png,jpg,pdf|max:2048', // Sesuaikan dengan jenis file yang diizinkan
        ]);

        $order = Order::findOrFail($orderId);

        // Jika file ada, simpan file ke direktori penyimpanan
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $fileName = 'payment_proof_' . time() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke storage/public
            $filePath = $file->storeAs('payment_proofs', $fileName, 'public');

            // Simpan path file di database
            $order->payment_proof = $filePath;

            // Update status menjadi 'menunggu_konfirmasi'
            $order->status = 'menunggu_konfirmasi';

            $order->save();
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->route('user.history')->with('success', 'Bukti transfer berhasil diunggah!');
    }


    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.produk'])->findOrFail($id);

        return view('admin.order.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Perbarui status pesanan berdasarkan input dari tombol
        if ($request->status == 'berhasil' || $request->status == 'ditolak') {
            $order->status = $request->status;
            $order->nomor_resi = $request->resi_number;
            $order->save();

            return redirect()->route('admin.order.show', $order->id)->with('success', 'Status pesanan telah diperbarui!');
        }

        return back()->with('error', 'Status tidak valid!');
    }



}
