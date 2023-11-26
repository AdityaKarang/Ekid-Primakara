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
        Schema::create('publikasis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("penelitians_id");
            $table->bigInteger("pengabdians_id");
            $table->bigInteger("user_id");
            $table->bigInteger("status");
            $table->enum("jenis_publikasi", ["Jurnal", "Buku", "Media Massa", "Forum Ilmiah", "HKI"]);
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
        Schema::dropIfExists('publikasis');
    }
};
