<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landingpage()
    {
        $produk = Produk::all();
        $produklaris = Produk::orderBy('terjual', 'desc')->get();
        return view('landingpage.index',compact('produk','produklaris'));
    }
}
