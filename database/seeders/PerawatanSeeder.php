<?php

namespace Database\Seeders;

use App\Models\Perawatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerawatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listPerawatan = [
            [
                'nama' => 'Green Tea Facial',
                'deskripsi' => 'Green Tea Facial merupakan perawatan wajah dengan menggunakan cleanser, scrub, massage cream dan masker ekstrak green tea. Sesuai untuk kulit normal, berminyak, dan berjerawat.',
                'harga' => 70000,
                'tipe' => 'Non-Konsultasi',
                'jumlah_potongan_poin' => 70
            ],
            [
                'nama' => 'Strawberry Facial',
                'deskripsi' => 'Strawberry Facial dapat digunakan untuk jenis kulit normal, dan jenis kulit berminyak. Manfaat dan khasiat strawbery: Sangat bagus dalam proses pengangkatan sel kulit mati dan mengangkat kotoran yang terdapat pada kulit, Mengurangi bercak-bercak dan noda pada kulit, Membantu mengecilkan pori-pori, Mempercepat regenerasi sel kulit mati.',
                'harga' => 65000,
                'tipe' => 'Non-Konsultasi',
                'jumlah_potongan_poin' => 70
            ],
            [
                'nama' => 'Apple Facial',
                'deskripsi' => 'Apple Facial dapat digunakan untuk jenis kulit normal, dan jenis kulit berminyak. Manfaat dan khasiat buah apel: membantu dalam proses pencerahan kulit, Membersihkan kotoran yang terdapat pada kulit, melembutkan dan menghaluskan kulit, Menetralisasi minyak pada kulit.',
                'harga' => 65000,
                'tipe' => 'Non-Konsultasi',
                'jumlah_potongan_poin' => 70
            ],
            [
                'nama' => 'Botanical Mesotherapy',
                'deskripsi' => 'Perawatan menggunakan alat mesogun untuk memasukan serum botanical ke dalam kulit yang berfungsi untuk peremajaan, melembabkan,mencerahkan dan mengurangi noda hitam kulit.',
                'harga' => 350000,
                'tipe' => 'Konsultasi',
                'jumlah_potongan_poin' => 350
            ],
            [
                'nama' => 'Botanical Peeling',
                'deskripsi' => 'Peremajaan kulit dengan menggunakan formula botanical yang diolah dengan teknologi tinggi, efektif menghilangkan sel-sel mati di permukaan kulit, merangsang pembentukan kolagen, mencerahkan dan menghaluskan tekstur kulit.',
                'harga' => 200000,
                'tipe' => 'Konsultasi',
                'jumlah_potongan_poin' => 200
            ],
        ];

        foreach ($listPerawatan as &$perawatan) {
            $perawatan['created_at'] = now();
            $perawatan['updated_at'] = now();
        }

        Perawatan::insert($listPerawatan);
    }
}
