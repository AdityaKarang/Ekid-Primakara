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
        Schema::table('publishcations', function (Blueprint $table) {
            $table->bigInteger("penelitian_id")->unsigned()->nullable()->change();
            $table->bigInteger("pengabdian_id")->unsigned()->nullable()->change();
            $table->bigInteger("user_id")->unsigned()->change();
            
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('penelitian_id')
            ->references('id')
            ->on('penelitians')
            ->onDelete('cascade');

            $table->foreign('pengabdian_id')
            ->references('id')
            ->on('pengabdians')
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
        //
    }
};
