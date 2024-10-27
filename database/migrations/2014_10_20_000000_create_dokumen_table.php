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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul', 255);
            $table->string('tautan', 255);
            $table->string('status_pengisian', 255);
            $table->date('deadline');
            $table->uuid('id_lembaga');
            $table->string('status_docs', 255);
            $table->timestamps();
            $table->integer('score')->nullable();
            $table->date('tgl_pengumpulan')->nullable();

            $table->foreign('id_lembaga')->references('id')->on('lembaga')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen');
    }
};
