<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEssayJawabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essay_jawab', function (Blueprint $table) {
          $table->id();
          $table->integer('siswa_id');
          $table->integer('peserta_ujian_id');
          $table->integer('essay_id');
          $table->string('jawab')->nullable();
          $table->integer('score')->nullable();
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
        Schema::dropIfExists('essay_jawab');
    }
}
