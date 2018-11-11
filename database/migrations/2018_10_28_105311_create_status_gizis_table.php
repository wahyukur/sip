<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusGizisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_gizis', function (Blueprint $table) {
            $table->increments('id_status');
            $table->unsignedInteger('id_anak');
            $table->string('deskripsi');
            $table->float('bb_t');
            $table->integer('tb_t');
            $table->date('tgl_t');
            //gibur
            $table->string('gibur_klinis')->nullable();
            $table->string('st_gizi_bbtb')->nullable();
            $table->string('penanganan')->nullable();
            $table->string('penyebab_utama')->nullable();
            $table->string('alasan_gibur')->nullable();
            $table->string('tindakan')->nullable();
            //bgm
            $table->string('balita2T')->nullable();
            $table->string('balitaBGM')->nullable();
            //gileb
            $table->timestamps();
            $table->foreign('id_anak')->references('id_anak')->on('anaks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_gizis');
    }
}
