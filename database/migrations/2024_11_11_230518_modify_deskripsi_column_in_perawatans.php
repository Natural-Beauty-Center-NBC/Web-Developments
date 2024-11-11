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
        Schema::table('perawatans', function (Blueprint $table) {
            $table->string('deskripsi', 500)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perawatans', function (Blueprint $table) {
            $table->string('deskripsi', 255)->change(); //panjang awal tipe data sebelumnya
        });
    }
};
