<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    use HasFactory;

    // Kolom-kolom yang bisa diisi massal
    protected $fillable = ['order_id', 'produk_id', 'quantity', 'price'];

    // Relasi dengan Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi dengan Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
