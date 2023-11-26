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
        Schema::create('laporan_kemajuans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("penelitian_id")->nullable();
            $table->bigInteger("pengabdian_id")->nullable();
            $table->string("laporan_kemajuan");
            $table->string("status");
            $table->string("catatan")->nullable();
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
        Schema::dropIfExists('laporan_kemajuans');
    }
};
