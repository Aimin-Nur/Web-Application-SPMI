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
            $table->string('temuan');
            $table->string('rtk');
            $table->string('tautan_rtk')->unique();
            $table->string('tautan_temuan')->unique();
            $table->string('status');
            $table->integer('score');
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
        Schema::dropIfExists('evaluasi');
    }
};
