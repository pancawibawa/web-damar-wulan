<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'product_id',
        'quantity',
        'total_price',
        'address',
        'city',
        'province',
        'postal_code',
        'phone',
        'email',
        'shipping_cost',
    ];

    // Relasi dengan model OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relasi dengan model Produk (jika Order mengarah ke Produk secara langsung)
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    // Relasi dengan model User (user yang membuat order)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
