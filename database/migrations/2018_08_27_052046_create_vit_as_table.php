<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitAsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vit_as', function (Blueprint $table) {
            $table->increments('id_vitA');
            $table->unsignedInteger('id_anak');
            $table->date('tgl_vitA');
            $table->string('keterangan');
            $table->timestamps();
            $table->foreign('id_anak')->references('id_anak')->on('anaks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vit_as');
    }
}
