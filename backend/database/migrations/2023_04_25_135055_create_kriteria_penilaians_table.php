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
        Schema::create('kriteria_penilaians', function (Blueprint $table) {
            $table->id();
            $table->string("kriteria");
            $table->enum("type", ["proposal", "kemajuan", "monev", "akhir"]);
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
        Schema::dropIfExists('rubrik_penilaians');
    }
};
