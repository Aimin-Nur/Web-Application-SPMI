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
        Schema::create('evaluasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_lembaga');
            $table->uuid('id_docs');
            $table->string('temuan', 255);
            $table->string('rtk', 255);
            $table->string('tautan_rtk', 255);
            $table->string('tautan_temuan', 255);
            $table->integer('score')->nullable();
            $table->timestamps();
            $table->string('status_pengisian', 255)->nullable();
            $table->string('status_docs', 255)->nullable();
            $table->date('deadline')->nullable();
            $table->date('tgl_pengumpulan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluasi');
    }
};
