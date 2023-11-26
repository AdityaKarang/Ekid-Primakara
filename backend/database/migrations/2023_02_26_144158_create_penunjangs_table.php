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
        Schema::create('penunjangs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id");
            $table->string("tahun_akademik");
            $table->string("nama_kegiatan");
            $table->string("peran");
            $table->string("nilai");
            $table->string("bukti_kegiatan");
            $table->string("keterangan");
            $table->string("status");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penunjangs');
    }
};
