<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKehadiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->increments('id_kehadiran');
            $table->unsignedInteger('id_kegiatan');
            $table->unsignedInteger('id_anak');
            $table->string('alasan');
            $table->date('tgl_kunjungan');
            $table->string('ket_hadir')->nullable();
            $table->timestamps();
            $table->foreign('id_anak')->references('id_anak')->on('anaks');
            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kehadirans');
    }
}
