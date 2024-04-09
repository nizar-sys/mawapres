<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('warna_id')->constrained('product_colors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('stok_minimum');
            $table->integer('stok_awal')->default(0);
            $table->integer('stok')->default(0);
            $table->enum('status', ['restock', 'stock_ok']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stok_produks');
    }
};
