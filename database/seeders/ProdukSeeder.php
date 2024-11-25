<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listProduk = [
            [
                'nama' => 'Milk Cleanser',
                'deskripsi' => 'Mengandung Mineral Oil yang digunakan untuk membersihkan kotoran dan sisa make-up pada wajah, menjadikan kulit wajah terasa bersih dan segar.',
                'harga' => 50000,
                'ukuran' => 100
            ],
            [
                'nama' => 'Skin Toner',
                'deskripsi' => 'Mengandung Milk Protein yang digunakan untuk membersihkan dan melembabkan pada bagian wajah dan leher.',
                'harga' => 50000,
                'ukuran' => 100
            ],
            [
                'nama' => 'Facial Wash',
                'deskripsi' => 'Diperkaya dengan Lactic Acid yang digunakan untuk membersihkan wajah dan menjadikan kulit tampak lebih bersih segar terawat dan tetap menjaga kelembaban kulit wajah.',
                'harga' => 60000,
                'ukuran' => 120
            ],
            [
                'nama' => 'CC Cream',
                'deskripsi' => 'Diperkaya dengan Vitamin E dan Peptida yang membantu menyamarkan noda hitam, bekas jerawat, serta kerutan seketika, seperti layaknya sebuah fondation, melembabkan kulit wajah dan membantu melindungi kulit wajah dari sinar matahari.',
                'harga' => 100000,
                'ukuran' => 60
            ],
            [
                'nama' => 'Bedak Tabur',
                'deskripsi' => 'Bedak tabur untuk kulit normal yang tidak ada dengan masalah kulit, membuat penampilan kulit lebih cerah.',
                'harga' => 125000,
                'ukuran' => 40
            ],
        ];

        foreach ($listProduk as &$produk) {
            $produk['stok'] = 20;
            $produk['created_at'] = now();
            $produk['updated_at'] = now();
        }

        Produk::insert($listProduk);
    }
}
