<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipePaketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_paket', function (Blueprint $table) {
            $table->id();
            $table->integer('id_paket');
            $table->string('nama_tipe_paket');
            $table->integer('harga_tipe_paket');
            $table->text('deskripsi_tipe_paket');
            $table->integer('min_dp');
            $table->integer('jumlah_orang');
            $table->integer('jumlah_pose');
            $table->integer('jumlah_file');
            $table->string('foto_tipe_paket');
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
        Schema::dropIfExists('tipe_paket');
    }
}
