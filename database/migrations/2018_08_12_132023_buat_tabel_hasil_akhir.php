<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelHasilAkhir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_akhirs', function (Blueprint $table) {
            $table->increments('id');
            $table->double('nilai', 8, 4);
            $table->unsignedInteger('ranking');
            $table->unsignedInteger('alternatif_id');
            $table->foreign('alternatif_id')->references('id')->on('alternatifs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('hasil_akhirs');
    }
}
