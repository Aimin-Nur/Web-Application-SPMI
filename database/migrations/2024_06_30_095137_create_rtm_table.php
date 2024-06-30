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
        Schema::create('RTM', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_lembaga');
            $table->string('tgl_rapat');
            $table->string('tempat');
            $table->string('status');
            $table->timestamps();

            // Foreign key constraint
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
        Schema::dropIfExists('rtm');
    }
};
