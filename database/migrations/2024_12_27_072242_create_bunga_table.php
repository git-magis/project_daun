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
            
            // Foreign key to the 'jenisbungas' table
            $table->unsignedBigInteger('jenisb_id');
            $table->foreign('jenisb_id')->references('id')->on('jenisbungas')->onDelete('cascade');

            // Foreign key to the 'tamans' table
            $table->unsignedBigInteger('lokasib_id');
            $table->foreign('lokasib_id')->references('id')->on('tamans')->onDelete('cascade');

            $table->string('gambar_bunga')->nullable();
            $table->timestamps();
            
            $table->string('kode_unik')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bungas', function (Blueprint $table) {
            $table->dropForeign(['jenisb_id']);
            $table->dropForeign(['lokasib_id']);
        });

        Schema::dropIfExists('bungas');
    }
};
