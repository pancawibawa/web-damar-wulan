<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke pengguna
            $table->decimal('total_price', 10, 2); // Total harga pesanan
            $table->enum('status', ['pending', 'menunggu_konfirmasi', 'berhasil', 'ditolak']); // Status pesanan
            $table->string('address'); // Alamat pengiriman
            $table->string('city');    // Kota
            $table->string('province'); // Provinsi
            $table->string('postal_code'); // Kode pos
            $table->string('phone');   // Nomor telepon
            $table->string('email');   // Email pengguna (untuk pesanan)
            $table->decimal('shipping_cost', 10, 2)->default(0); // Biaya pengiriman
            $table->string('payment_proof')->nullable(); // Menyimpan bukti pembayaran
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
