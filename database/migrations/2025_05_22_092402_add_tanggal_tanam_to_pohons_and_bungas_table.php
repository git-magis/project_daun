<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pohons', function (Blueprint $table) {
            $table->date('tanggal_tanam')->nullable()->after('updated_at');
        });

        Schema::table('bungas', function (Blueprint $table) {
            $table->date('tanggal_tanam')->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pohons', function (Blueprint $table) {
            $table->dropColumn('tanggal_tanam');
        });

        Schema::table('bungas', function (Blueprint $table) {
            $table->dropColumn('tanggal_tanam');
        });
    }
};
