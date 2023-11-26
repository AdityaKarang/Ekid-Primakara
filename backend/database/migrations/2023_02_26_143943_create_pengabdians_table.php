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
        Schema::create('pengabdians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id");
            $table->string("tahun_akademik");
            $table->string("semester");
            $table->string("judul");
            $table->string("anggota_dosen_1");
            $table->string("anggota_dosen_2")->nullable();
            $table->string("mahasiswa_1");
            $table->string("mahasiswa_2");
            $table->string("bidang_fokus");
            $table->string("mitra");
            $table->string("bentuk_dana");
            $table->string("sumber_dana");
            $table->bigInteger("jumlah_dana");
            $table->string("kontrak")->nullable();
            $table->string("status");
            $table->string("proposal");
            $table->string("reviewer_1")->nullable();
            $table->string("reviewer_2")->nullable();
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
        Schema::dropIfExists('pengabdians');
    }
};
