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
        Schema::table('promos', function (Blueprint $table) {
            $table->string('jenis_potongan'); 
            $table->decimal('nilai_potongan', 8, 2)->nullable(); // Diskon dalam bentuk persen atau nominal
            $table->string('periode')->nullable(); // Periode promo
            $table->enum('status', ['Aktif', 'Non-Aktif'])->default('Aktif'); // Status aktif atau tidak
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->dropColumn(['jenis_potongan', 'nilai_potongan','periode', 'status']);
        });
    }
};
