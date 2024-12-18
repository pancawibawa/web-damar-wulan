<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Kemana pengguna akan di-redirect setelah login.
     */
    protected function redirectTo()
    {
        if (Auth::user()->role === 'admin') {
            return '/admin/dashboard'; // Redirect admin ke dashboard
        } elseif (Auth::user()->role === 'user') {
            return '/produk'; // Redirect user ke halaman produk
        }

        return '/'; // Redirect default jika tidak memiliki role
    }

    /**
     * Membuat instance controller baru.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

