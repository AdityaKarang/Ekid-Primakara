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
        Schema::create('indikator_penilaians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("kriteria_penilaian_id")->unsigned();
            $table->text("indikator");
            $table->integer("bobot");
            $table->timestamps();

            $table->foreign('kriteria_penilaian_id')
            ->references('id')
            ->on('kriteria_penilaians')
            ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indikator_penilaians');
    }
};
