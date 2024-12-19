<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi massal
    protected $fillable = ['name', 'price', 'description', 'stock','size', 'image'];

    // Relasi dengan Cart
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Relasi dengan OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
