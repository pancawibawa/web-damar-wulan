<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalProduk = Produk::count(); // Menghitung total produk
        $totalOrder = Order::count(); // Menghitung total order
        $totalBerhasil = Order::where('status', 'berhasil')->count(); // Menghitung order berhasil

        return view('admin.dashboard.index', compact('totalProduk', 'totalOrder', 'totalBerhasil'));
    }
}

