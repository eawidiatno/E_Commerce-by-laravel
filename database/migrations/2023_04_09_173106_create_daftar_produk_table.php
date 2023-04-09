<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_produk');
            $table->integer('harga_satuan');
            $table->integer('stock');
            $table->string('kategori');
            $table->string('foto_produk');
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
        Schema::dropIfExists('daftar_produk');
    }
}
