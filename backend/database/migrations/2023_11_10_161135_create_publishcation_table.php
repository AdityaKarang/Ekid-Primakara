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
        Schema::create('publishcations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id");
            $table->bigInteger("penelitian_id")->nullable();
            $table->bigInteger("pengabdian_id")->nullable();
            $table->enum("jenis", ["jurnal", "buku", "media Massa", "forum ilmiah", "HKI"]);
            $table->string("tahun_publikasi");
            $table->string("jenis_publikasi_jurnal");
            $table->string("judul_publikasi");
            $table->string("nama_jurnal");
            $table->string("issn_jurnal")->nullable();
            $table->string("volume");
            $table->string("nomor");
            $table->string("halaman");
            $table->string("url");
            $table->string("status");
            $table->string("file_jurnal");
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
        Schema::dropIfExists('publishcation');
    }
};
