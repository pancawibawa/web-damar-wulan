<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function produk()
    {
        return view('user.produk');
    }
}
