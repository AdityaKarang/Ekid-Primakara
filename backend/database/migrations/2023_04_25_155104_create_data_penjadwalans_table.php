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
        Schema::create('data_penjadwalans', function (Blueprint $table) {
            $table->id();
            $table->string("tahun_akademik") -> nullable();
            $table->enum("jenis", ["penilaian", "penerimaan"]);
            $table->date("waktu_buka");
            $table->date("waktu_tutup");
            $table->enum("type", ["Proposal", "Laporan Kemajuan", "Monev", "Laporan Akhir"]);
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
        Schema::dropIfExists('data_penjadwalans');
    }
};
