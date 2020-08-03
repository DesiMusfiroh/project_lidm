<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePilganJawabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilgan_jawab', function (Blueprint $table) {
          $table->id();
          $table->integer('siswa_id');
          $table->integer('peserta_ujian_id');
          $table->integer('pilgan_id');
          $table->string('jawab');
          $table->integer('score')->nullable();
          $table->string('status')->nullable();
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
        Schema::dropIfExists('pilgan_jawab');
    }
}
