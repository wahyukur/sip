<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anaks', function (Blueprint $table) {
            $table->increments('id_anak');
            $table->unsignedInteger('id_ibu');
            $table->string('nama_anak');
            $table->string('tempat_lhr');
            $table->date('tgl_lhr');
            $table->float('bb_lahir');
            $table->float('tb_lahir');
            $table->tinyInteger('jenis_kelamin');
            $table->integer('anak_ke');
            $table->string('jenis_persalinan');
            $table->string('tempat_persalinan');
            $table->string('dokter');
            $table->string('NIK_anak')->nullable();
            $table->string('BPJS_anak')->nullable();
            $table->tinyInteger('KMS')->default(0);
            $table->tinyInteger('state')->default(0);
            $table->timestamps();
            $table->foreign('id_ibu')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anaks');
    }
}
