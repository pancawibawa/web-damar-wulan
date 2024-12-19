<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'produk_id', 'quantity'];

    // Relasi dengan User
    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Produk
    // Relasi dengan Produk
    public function produk() // Gunakan 'produk' agar konsisten dengan nama tabel
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id'); // Sesuaikan nama tabel dan kolom foreign key
    }
}
