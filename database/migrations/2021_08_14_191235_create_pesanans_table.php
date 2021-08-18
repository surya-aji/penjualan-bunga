<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('tanggal');
            $table->string('status');
            $table->integer('ongkos_kirim')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('resi')->unique()->nullable();
            $table->integer('total_pembayaran');
            $table->integer('barang_id')->nullable();
            $table->string('kurir')->nullable();
            $table->string('layanan')->nullable();
            $table->string('status_pembayaran')->default(0);
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
        Schema::dropIfExists('pesanans');
    }
}
