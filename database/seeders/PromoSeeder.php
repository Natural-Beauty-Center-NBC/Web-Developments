<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromoSeeder extends Seeder
{   

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //php artisan migrate dulu, karena table migration promo ada yang di update/ubah.
        //lalu masukan seedernya php artisan db:seed --class=PromoSeeder
        //untuk dummy laporan

        DB::table('promos')->insert([
            'kode' => 'BDAY',
            'jenis' => 'Ulang tahun',
            'keterangan' => 'Bagi customer yang berulangtahun mendapat diskon sebesar 20%',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            'jenis_potongan' => 'Persen',
            'nilai_potongan' => '20',
            'periode' => '-',
            'status' => 'Aktif',
        ]);

        DB::table('promos')->insert([
            'kode' => 'MHS',
            'jenis' => 'Pelajar & Mahasiswa',
            'keterangan' => 'Bagi customer yang berusia di bawah 22 tahun mendapat diskon sebesar 10%',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            'jenis_potongan' => 'Persen',
            'nilai_potongan' => '10',
            'periode' => '-',
            'status' => 'Aktif',
        ]);

        DB::table('promos')->insert([
            'kode' => 'KART',
            'jenis' => 'Hari Kartini',
            'keterangan' => 'Pada tanggal 21 April, customer mendapat diskon sebesar 10%',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            'jenis_potongan' => 'Persen',
            'nilai_potongan' => '10',
            'periode' => '21 April',
            'status' => 'Aktif',
        ]);

        DB::table('promos')->insert([
            'kode' => '17AN',
            'jenis' => 'Hari Kemerdekaan',
            'keterangan' => 'Pada tanggal 17 Agustus, customer mendapat diskon sebesar 17%',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            'jenis_potongan' => 'Persen',
            'nilai_potongan' => '17',
            'periode' => '17 Agustus',
            'status' => 'Aktif',
        ]);

        DB::table('promos')->insert([
            'kode' => 'POIN',
            'jenis' => 'Poin customer',
            'keterangan' => 'Setiap transaksi kelipatan 50.000, customer akan mendapatkan 1 poin',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            'jenis_potongan' => 'Nominal',
            'nilai_potongan' => '0',
            'periode' => '-',
            'status' => 'Aktif',
        ]);

    }
}
