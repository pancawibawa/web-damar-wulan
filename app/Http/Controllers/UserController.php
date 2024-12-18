<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function produk()
    {
        return view('user.produk');
    }

    public function cart()
    {
        return view('user.cart.index');
    }

    public function cekoutView()
    {
        // Ambil API Key dari .env
        $apiKey = env('RAJAONGKIR_API_KEY');

        // Panggil API RajaOngkir
        $response = Http::withHeaders([
            'key' => $apiKey,
        ])->get('https://api.rajaongkir.com/starter/province');

        if ($response->successful()) {
            // Ambil data provinsi dari hasil API
            $provinces = $response->json()['rajaongkir']['results'];

            // Kirimkan data provinsi ke view
            return view('user.cekout.index', compact('provinces'));
        }
    }


    // public function getProvinces()
    // {
    //     // Ambil API Key dari .env
    //     $apiKey = env('RAJAONGKIR_API_KEY');

    //     // Panggil API RajaOngkir
    //     $response = Http::withHeaders([
    //         'key' => $apiKey,
    //     ])->get('https://api.rajaongkir.com/starter/province');

    //     if ($response->successful()) {
    //         // Ambil data provinsi dari hasil API
    //         $provinces = $response->json()['rajaongkir']['results'];

    //         // Kirimkan data provinsi ke view
    //         return view('user.cekout.index', compact('provinces'));
    //     }

    //     // Jika API gagal, kembalikan view dengan error
    //     return view('user.cekout.index')->with(['message' => 'Gagal mengambil data provinsi.']);
    // }
}
