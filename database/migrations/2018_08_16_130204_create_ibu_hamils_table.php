<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIbuHamilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibu_hamils', function (Blueprint $table) {
            $table->increments('id_bumil');
            $table->string('nama_bumil');
            $table->integer('umur');
            $table->string('nama_suami');
            $table->string('alamat');
            $table->integer('bb_sebelum_hamil');
            $table->integer('bb_sekarang');
            $table->integer('tb_bumil');
            $table->integer('hamil_ke');
            $table->integer('usia_kehamilan');
            $table->string('penyakit_penyerta');
            $table->integer('lila');
            $table->string('periksa_kehamilan');
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
        Schema::dropIfExists('ibu_hamils');
    }
}
