<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_ibu');
            $table->string('nama_suami');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->integer('rt');
            $table->integer('rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('No_tlp')->nullable();
            $table->tinyInteger('agama');
            $table->string('NIK')->nullable();
            $table->string('No_KK')->nullable();
            $table->string('No_BPJS')->nullable();
            $table->tinyInteger('gakin')->nullable();
            $table->tinyInteger('jabatan')->default(0);
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('level')->default(0);
            $table->tinyInteger('user')->default(0);
            $table->string('api_token')->nullable();
            $table->string('expo_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
