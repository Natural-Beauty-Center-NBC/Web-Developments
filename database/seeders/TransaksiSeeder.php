<?php

namespace Database\Seeders;

use App\Models\DetailPerawatan;
use App\Models\DetailProduk;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create("id_ID");

        // Create 25 dummy Transaction (Perawatan) and it's DetailPerawatan Transaction -> with Doctor's Consultation
        for($i = 5; $i <= 30; $i++) {
            $date = $faker->dateTimeBetween('-1 year', 'now');
            $transaksi = Transaksi::create([
                'no_transaksi' => '261124-' . $i,
                'tanggal_transaksi' => $date,  // Output -> 2023 and 2024
                'status_pembayaran' => 'Paid',
                'jenis_transaksi' => 'Perawatan dengan Konsultasi',
                'diskon' => 0,
                'poin_earned' => $faker->numberBetween(50, 300),
                'total_harga' => $faker->numberBetween(200000, 800000),
                'customer_id' => $faker->numberBetween(2, 50),
                'dokter_id' => $faker->numberBetween(2, 4),
                'customer_service_id' => 6,
                'created_at' => $date,
                'updated_at' => $date
            ]);

            DetailPerawatan::create([
                'jumlah_pembelian' => $faker->numberBetween(1, 3),
                'jumlah_tukar_point' => 0,
                'sub_total' => $faker->numberBetween(200000, 900000),
                'perawatan_id' => $faker->numberBetween(1, 5),
                'transaksi_id' => $transaksi->id,
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }

        // Create 25 dummy Transaction (Produk) and it's DetailProduk Transaction -> with Doctor's consultation
        for($i = 31; $i <= 55; $i++) {
            $date = $faker->dateTimeBetween('-1 year', 'now'); // Output -> 2023 and 2024
            $transaksi = Transaksi::create([
                'no_transaksi' => '261124-' . $i,
                'tanggal_transaksi' => $date,  
                'status_pembayaran' => 'Paid',
                'jenis_transaksi' => 'Produk dengan Konsultasi',
                'diskon' => 0,
                'poin_earned' => $faker->numberBetween(50, 300),
                'total_harga' => $faker->numberBetween(100000, 400000),
                'customer_id' => $faker->numberBetween(2, 50),
                'dokter_id' => $faker->numberBetween(2, 4),
                'customer_service_id' => 6,
            ]);

            DetailProduk::create([
                'jumlah_pembelian' => $faker->numberBetween(1, 3),
                'sub_total' => $faker->numberBetween(50000, 400000),
                'produk_id' => $faker->numberBetween(1, 5),
                'transaksi_id' => $transaksi->id,
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }
    }
}
