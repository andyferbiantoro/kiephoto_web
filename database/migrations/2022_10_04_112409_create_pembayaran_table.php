<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pemesanan');
            $table->date('tanggal_bayar');
            $table->date('tanggal_konfirmasi');
            $table->string('nama_rekening');
            $table->string('no_rekening');
            $table->integer('jumlah_bayar')->nullable();
            $table->string('status_pembayaran');
            $table->string('jenis_pembayaran');
            $table->string('foto_bukti_bayar');
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
        Schema::dropIfExists('pembayaran');
    }
}
