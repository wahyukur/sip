<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimbangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timbangs', function (Blueprint $table) {
            $table->increments('id_timbang');
            $table->unsignedInteger('id_anak');
            $table->integer('umur');
            $table->float('berat_badan');
            $table->float('tinggi_badan');
            $table->date('tgl_timbang');
            $table->string('status_gizi');
            $table->string('ket_timbang');
            $table->string('ind_naik');
            $table->tinyInteger('ind_t_lalu');
            $table->tinyInteger('ind_b_lalu');
            //gibur & gileb
            $table->string('gibur_klinis')->nullable();
            $table->string('st_gizi_bbtb')->nullable();
            $table->string('penanganan')->nullable();
            $table->string('penyebab_utama')->nullable();
            $table->string('alasan_gibur')->nullable();
            $table->string('tindakan')->nullable();
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
        Schema::dropIfExists('timbangs');
    }
}
