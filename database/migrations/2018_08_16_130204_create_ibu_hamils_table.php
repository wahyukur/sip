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
            $table->float('bb_sebelum_hamil');
            $table->float('bb_sekarang');
            $table->integer('tb_bumil');
            $table->integer('hamil_ke');
            $table->integer('usia_kehamilan');
            $table->string('penyakit_penyerta')->nullable();
            $table->integer('lila');
            $table->string('periksa_kehamilan');
            $table->string('status')->nullable();
            $table->integer('umur_meninggal')->nullable();
            $table->string('tempat_meninggal')->nullable();
            $table->integer('umur_melahirkan')->nullable();
            $table->date('tgl_melahirkan')->nullable();
            $table->float('bb_anak')->nullable();
            $table->integer('tb_anak')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->string('jenis_persalinan')->nullable();
            $table->string('tempat_persalinan')->nullable();
            $table->string('dokter')->nullable();
            $table->string('nama_anak')->nullable();
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
