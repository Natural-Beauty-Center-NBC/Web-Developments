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
        Schema::create('detail_perawatans', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_pembelian')->default(0);
            $table->integer('jumlah_tukar_point')->default(0);
            $table->bigInteger('sub_total')->default(0);
            $table->unsignedBigInteger('perawatan_id')->nullable(false);
            $table->unsignedBigInteger('transaksi_id')->nullable(false);
            $table->timestamps();

            // Relations
            $table->foreign('perawatan_id')->references('id')->on('perawatans')->onDelete('cascade');
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_perawatans');
    }
};
