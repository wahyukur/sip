<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->increments('id_kegiatan');
            $table->unsignedInteger('id_agenda');
            $table->unsignedInteger('id_tamu');
            $table->unsignedInteger('id_ukm');
            $table->unsignedInteger('id_pkk');
            $table->string('gambar_kegiatan1')->nullable();
            $table->string('gambar_kegiatan2')->nullable();
            $table->string('pmt1')->nullable();
            $table->string('pmt2')->nullable();
            $table->timestamps();
            $table->foreign('id_agenda')->references('id_agenda')->on('agendas');
            $table->foreign('id_tamu')->references('id_tamu')->on('buku_tamus');
            $table->foreign('id_ukm')->references('id_ukm')->on('ukms');
            $table->foreign('id_pkk')->references('id_pkk')->on('pkks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatans');
    }
}
