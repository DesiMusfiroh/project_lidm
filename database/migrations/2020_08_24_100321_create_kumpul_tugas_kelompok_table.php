<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKumpulTugasKelompokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kumpul_tugas_kelompok', function (Blueprint $table) {
            $table->id();
            $table->integer('tugas_kelompok_id');
            $table->integer('kelompok_id');
            $table->string('tugas')->nullable();
            $table->integer('nilai')->nullable();
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
        Schema::dropIfExists('kumpul_tugas_kelompok');
    }
}
