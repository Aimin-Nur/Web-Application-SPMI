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
        Schema::create('RTK', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_lembaga');
            $table->uuid('id_dokumen');
            $table->string('jadwal');
            $table->timestamps();

            $table->foreign('id_lembaga')->references('id')->on('lembaga')->onDelete('cascade');
            $table->foreign('id_dokumen')->references('id')->on('dokumen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RTK');
    }
};
