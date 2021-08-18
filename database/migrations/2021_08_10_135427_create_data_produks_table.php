<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->integer('harga_awal');
            $table->integer('harga_jual');
            $table->date('tanggal_pembelian');
            $table->integer('stok');
            $table->integer('berat');
            $table->string('gambar');
            $table->integer('kategori_id');
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
        Schema::dropIfExists('data_produks');
    }
}
