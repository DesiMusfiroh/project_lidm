<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ujian', function (Blueprint $table) {
          $table->id();
          $table->integer('kelas_id');
          $table->integer('paket_soal_id');
          $table->string('nama_ujian');
          $table->timestamp('waktu_mulai');
          $table->integer('status');
          $table->boolean('isdelete')->default(false);
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
        Schema::dropIfExists('ujian');
    }
}
