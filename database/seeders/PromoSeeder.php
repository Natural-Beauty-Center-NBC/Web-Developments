<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listPromo = [
            [
                'kode' => 'BDAY',
            'jenis' => 'Ulang Tahun',
            'keterangan' => 'Bagi customer yang berulangtahun mendapat diskon sebesar 20%'
            ],
            [
                'kode' => 'MHS',
                'jenis' => 'Pelajar & Mahasiswa',
                'keterangan' => 'Bagi customer yang berusia di bawah 22 tahun mendapat diskon sebesar 10%'
            ],
            [
                'kode' => 'KART',
                'jenis' => 'Hari Kartini',
                'keterangan' => 'Pada tanggal 21 April, customer mendapat diskon sebesar 10%'
            ],
            [
                'kode' => '17AN',
                'jenis' => 'Hari Kemerdekaan',
                'keterangan' => 'Pada tanggal 17 Agustus, customer mendapat diskon sebesar 17%'
            ],
            [
                'kode' => 'POIN',
                'jenis' => 'Poin Customer',
                'keterangan' => 'nsaksi kelipatan 50.000, customer akan mendapatkan 1 poin. Poin yang dikumpulkan, dapat ditukarkan dengan perawatan sesuai besar potongan poin masing-masing perawatan'
            ]
        ];

        Promo::insert($listPromo);
    }
}
