<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bungas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bunga');
            $table->string('jenis_bunga');
            $table->string('lokasi_bunga');
            $table->string('gambar_bunga')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bungas');
    }
};
