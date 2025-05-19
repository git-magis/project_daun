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
        Schema::create('jenisbungas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jenis_bunga');
            $table->string('jumlah')->nullable();
            $table->string('nama_ilmiah')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('gambar_bunga')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenisbungas');
    }
};
