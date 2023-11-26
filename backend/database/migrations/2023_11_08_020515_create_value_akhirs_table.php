<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('value_akhirs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kriteria_penilaian_id');
            $table->string('kriteria');
            $table->string('indikator');
            $table->integer('bobot');
            $table->bigInteger('data_penilaian_id');
            // $table->bigInteger('data_penilaian_id')->unsigned();
            $table->integer('value');
            $table->timestamps();
    

            // $table->foreign('data_penilaian_id')
            // ->references('id')
            // ->on('data_penilaians')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('value_akhirs');
    }
};
