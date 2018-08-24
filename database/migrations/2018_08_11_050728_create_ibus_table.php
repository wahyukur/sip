<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIbusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibus', function (Blueprint $table) {
            $table->increments('id_ibu');
            $table->string('nama_ibu');
            $table->string('nama_suami');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->integer('rt');
            $table->integer('rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('agama');
            $table->integer('NIK');
            $table->integer('No_KK');
            $table->integer('No_BPJS');
            $table->integer('No_tlp');
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
        Schema::dropIfExists('ibus');
    }
}
