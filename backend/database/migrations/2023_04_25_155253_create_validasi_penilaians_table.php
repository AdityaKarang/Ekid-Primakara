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
        Schema::create('validasi_penilaians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("penelitians_id")->nullable();
            $table->bigInteger("pengabdians_id")->nullable();
            $table->string("tahun_akademik");
            $table->string("prodi");
            $table->string("nama");
            $table->string("judul");
            $table->string("bidang_fokus");
            $table->string("proposal")->nullable();
            $table->string("laporan_kemajuan")->nullable();
            $table->string("laporan_akhir")->nullable();
            $table->enum("type", ["proposal", "kemajuan", "monev", "akhir"]);
            $table->string("status");
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
        Schema::dropIfExists('validasi_penilaians');
    }
};
