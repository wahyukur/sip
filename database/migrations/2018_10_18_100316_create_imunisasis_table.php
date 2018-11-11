<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImunisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imunisasis', function (Blueprint $table) {
            $table->increments('id_imun');
            $table->unsignedInteger('id_anak');
            $table->unsignedInteger('id_j_imun');
            $table->date('tgl_imun');
            $table->string('booster');
            $table->string('ket_imun')->nullable();
            $table->timestamps();
            $table->foreign('id_anak')->references('id_anak')->on('anaks');
            $table->foreign('id_j_imun')->references('id_j_imun')->on('jenis_imunisasis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imunisasis');
    }
}
