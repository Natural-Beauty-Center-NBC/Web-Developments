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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->char('no_transaksi', 12)->unique();
            $table->enum('status_pembayaran', ['Paid', 'Pending'])->default('Pending');
            $table->enum('jenis_transaksi', ['Perawatan dengan Konsultasi',  'Produk dengan Konsultasi', 'Perawatan tanpa Konsultasi']);
            $table->integer('total_harga')->default(0);
            $table->integer('diskon')->default(0);
            $table->integer('poin_earned')->default(0);
            $table->dateTime('tanggal_transaksi');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('dokter_id')->nullable();
            $table->unsignedBigInteger('customer_service_id')->nullable();
            $table->unsignedBigInteger('beautician_id')->nullable();
            $table->unsignedBigInteger('kasir_id')->nullable();
            $table->unsignedBigInteger('ruangan_id')->nullable();
            $table->unsignedBigInteger('promo_id')->nullable();
            $table->timestamps();

            // Relations
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dokter_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('customer_service_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('beautician_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('kasir_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('ruangan_id')->references('id')->on('ruangans')->onDelete('cascade');
            $table->foreign('promo_id')->references('id')->on('promos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
