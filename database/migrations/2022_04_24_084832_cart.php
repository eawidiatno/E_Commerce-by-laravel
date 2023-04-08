<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->bigIncrements('id_cart');
            $table->integer('user_id');
            $table->integer('produk_id');
            $table->integer('harga_satuan');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->string('kode');
            $table->date('tanggal');
            $table->string('status');// ada 2 cart(0) dan checkout(1)
            $table->string('status_pembayaran');// ada 2 sudah dan belum
            $table->string('status_pengiriman');// ada 2 yaitu belum dan kirim
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
        Schema::dropIfExists('cart');
    }
}
