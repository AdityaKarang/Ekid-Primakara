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
        Schema::create('data_penilaians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("penelitian_id")->nullable();
            $table->bigInteger("pengabdian_id")->nullable();
            $table->enum("jenis", ["Proposal", "Kemajuan", "Monev", "Akhir"]);
            $table->bigInteger("user_id");
            $table->bigInteger("total");
            $table->string("status");
            $table->string("catatan")->nullable();
            $table->timestamps();

            // $table->foreign('penelitian_id')
            // ->references('id')
            // ->on('penelitians')
            // ->onDelete('cascade');

            // $table->foreign('pengabdian_id')
            // ->references('id')
            // ->on('pengabdians')
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
        Schema::dropIfExists('data_penilaians');
    }
};
