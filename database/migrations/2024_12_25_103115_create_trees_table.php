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
        Schema::create('pohons', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pohon');

            // Foreign key to the 'jenispohons' table
            $table->unsignedBigInteger('jenis_id');
            $table->foreign('jenis_id')->references('id')->on('jenispohons')->onDelete('cascade');

            // Foreign key to the 'tamans' table
            $table->unsignedBigInteger('lokasi_id');
            $table->foreign('lokasi_id')->references('id')->on('tamans')->onDelete('cascade');

            // Optional image for the tree
            $table->string('gambar_pohon')->nullable();

            // Timestamps for created_at and updated_at
            $table->timestamps();

            $table->string('kode_unik')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pohons', function (Blueprint $table) {
            $table->dropForeign(['jenis_id']);
            $table->dropForeign(['lokasi_id']);
        });
        
        Schema::drop('pohons');
    }
};
