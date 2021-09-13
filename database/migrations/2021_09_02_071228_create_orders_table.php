<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('tanggal');
            $table->string('status');
            $table->integer('ongkos_kirim');
            $table->text('alamat_lengkap');
            $table->string('resi')->unique();
            $table->string('kurir')->nullable();
            $table->string('layanan')->nullable();
            $table->string('status_pembayaran')->default(0);
            $table->integer('jumlah_berat');
            $table->integer('jumlah');
            $table->integer('jumlah_harga');
            $table->string('va_numbers');
            $table->string('bank');
            $table->string('transaction_time');
            $table->string('gross_amount');
            $table->string('order_id');
            $table->string('payment_type');
            $table->string('status_code');
            $table->string('transaction_status');
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
        Schema::dropIfExists('orders');
    }
}
