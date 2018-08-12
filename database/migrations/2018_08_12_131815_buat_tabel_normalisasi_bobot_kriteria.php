<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelNormalisasiBobotKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normalisasi_kriterias', function (Blueprint $table) {
            $table->increments('id');
            $table->double('nilai', 8, 4);
            $table->unsignedInteger('kriteria_id');
            $table->foreign('kriteria_id')->references('id')->on('kriterias')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('normalisasi_kriterias');
    }
}
