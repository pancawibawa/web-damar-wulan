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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama produk
            $table->text('description'); // Deskripsi produk
            $table->decimal('price', 10, 2); // Harga produk
            $table->integer('stock'); // Stok produk
            $table->integer('size'); // Stok produk
            $table->string('image')->nullable(); // Gambar produk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
