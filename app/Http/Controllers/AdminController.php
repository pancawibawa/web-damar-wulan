<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $totalProduk = Produk::count(); // Menghitung total produk
    //     $totalOrder = Order::count(); // Menghitung total order
    //     $totalBerhasil = Order::where('status', 'berhasil')->count(); // Menghitung order berhasil

    //     // Ambil total penghasilan
    //     $totalIncome = Order::where('status', 'berhasil')
    //         ->join('order_items', 'orders.id', '=', 'order_items.order_id')
    //         ->sum(DB::raw('order_items.quantity * order_items.price'));

    //     // Ambil penghasilan per bulan
    //     $monthlyIncome = Order::where('status', 'berhasil')
    //         ->join('order_items', 'orders.id', '=', 'order_items.order_id')
    //         ->selectRaw('MONTH(orders.created_at) as month, SUM(order_items.quantity * order_items.price) as total')
    //         ->groupBy('month')
    //         ->orderBy('month')
    //         ->pluck('total', 'month');

    //     // Format data penghasilan bulanan
    //     $months = range(1, 12); // Bulan 1-12
    //     $incomeData = [];
    //     foreach ($months as $month) {
    //         $incomeData[] = $monthlyIncome[$month] ?? 0; // Isi 0 jika bulan tidak memiliki data
    //     }

    //     return view('admin.dashboard.index', compact('totalProduk', 'totalOrder', 'totalBerhasil', 'totalIncome', 'incomeData'));
    // }

    public function index()
    {
        $totalProduk = Produk::count(); // Menghitung total produk
        $totalOrder = Order::count(); // Menghitung total order
        $totalBerhasil = Order::where('status', 'berhasil')->count(); // Menghitung order berhasil

        // Ambil total penghasilan
        $totalIncome = Order::where('status', 'berhasil')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->sum(DB::raw('order_items.quantity * order_items.price'));

        // Ambil penghasilan per bulan
        $monthlyIncome = Order::where('status', 'berhasil')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->selectRaw('MONTH(orders.created_at) as month, SUM(order_items.quantity * order_items.price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Format data penghasilan bulanan
        $months = range(1, 12); // Bulan 1-12
        $incomeData = [];
        foreach ($months as $month) {
            $incomeData[] = $monthlyIncome[$month] ?? 0; // Isi 0 jika bulan tidak memiliki data
        }

        // Mendapatkan penghasilan bulan terakhir dan bulan sebelumnya
        $lastMonthIncome = $monthlyIncome[date('n') - 1] ?? 0; // Penghasilan bulan terakhir
        $previousMonthIncome = $monthlyIncome[date('n') - 2] ?? 0; // Penghasilan bulan sebelumnya

        // Menghitung persen kenaikan penghasilan
        $percentChange = 0;
        if ($previousMonthIncome > 0) {
            $percentChange = (($lastMonthIncome - $previousMonthIncome) / $previousMonthIncome) * 100;
        }

        // Kirim data ke view
        return view('admin.dashboard.index', compact('totalProduk', 'totalOrder', 'totalBerhasil', 'totalIncome', 'incomeData', 'percentChange'));
    }

}

