<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_details', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->integer('harga_awal');
            $table->integer('harga_jual');
            $table->date('tanggal_pembelian');
            $table->integer('stok');
            $table->string('gambar');
            $table->integer('kategori_id');
            $table->integer('supplier_id');
            $table->integer('resi_id');
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
        Schema::dropIfExists('produk_details');
    }
}
