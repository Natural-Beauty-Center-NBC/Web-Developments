<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerawatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // too run php artisan db:seed --class=PerawatanSeeder
        // migrate dulu, panjang tabel deskripsi aku ubah dari 255 ke 500, bira mudah dari NBC-Browsur
        //Sekalian semua yang ada di browsur Perawatan= Mempermudah Dummy Laporan.

        DB::table('perawatans')->insert([
            'nama' => 'Green Tea Facial',
            'deskripsi' => 'Green Tea Facial merupakan perawatan wajah dengan menggunakan cleanser, scrub, massage cream dan masker ekstrak green tea. Sesuai untuk kulit normal, berminyak, dan berjerawat',
            'harga' => '70000',
            'tipe' => 'Non-Konsultasi',
            'jumlah_potongan_poin' => '70',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Green Tea Facial',
            'deskripsi' => 'Strawberry Facial dapat digunakan untuk jenis kulit normal, dan jenis kulit berminyak. Manfaat dan khasiat strawbery: Sangat bagus dalam proses pengangkatan sel kulit mati dan mengangkat kotoran yang terdapat pada kulit, Mengurangi bercak-bercak dan noda pada kulit, Membantu mengecilkan pori- pori, Mempercepat regenerasi sel kulit mati',
            'harga' => '65000',
            'tipe' => 'Non-Konsultasi',
            'jumlah_potongan_poin' => '70',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Apple Facial',
            'deskripsi' => 'Apple Facial dapat digunakan untuk jenis kulit normal, dan jenis kulit berminyak. Manfaat dan khasiat buah apel: membantu dalam proses pencerahan kulit, Membersihkan kotoran yang terdapat pada kulit, melembutkan dan menghaluskan kulit, Menetralisasi minyak pada kulit',
            'harga' => '65000',
            'tipe' => 'Non-Konsultasi',
            'jumlah_potongan_poin' => '70',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Orange Facials',
            'deskripsi' => 'Orange Facial dapat digunakan untuk jenis kulit berminyak. Manfaat dan khasiat dari buah jeruk:Memperlambat produksi minyak yang berlebihan pada kulit, membersihkan noda-noda pada kulit dan mengangkat sel kulit mati, Mencerahkan kulit, Mengecilkan pori-pori, Menghaluskan kulit, Menjaga elastisitas kulit.',
            'harga' => '65000',
            'tipe' => 'Non-Konsultasi',
            'jumlah_potongan_poin' => '70',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Banana Facial',
            'deskripsi' => 'Banana Facial dapat digunakan untuk jenis kulit normal dan kulit kering. Manfaat dan khasiat dari buah pisang: menjaga kelembaban kulit, mencegah penuaan dini pada kulit, mencegah munculnya keriput, melembutkan dan menghaluskan kulit, membantu proses penyembuhan pada kulit yang rusak seperti pecah-pecah, luka bakar, dll.',
            'harga' => '65000',
            'tipe' => 'Non-Konsultasi',
            'jumlah_potongan_poin' => '70',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Botanical Mesotherapy',
            'deskripsi' => 'Perawatan menggunakan alat mesogun untuk memasukan serum botanical ke dalam kulit yang berfungsi untuk peremajaan, melembabkan,mencerahkan dan mengurangi noda hitam kuli.',
            'harga' => '350000',
            'tipe' => 'Konsultasi',
            'jumlah_potongan_poin' => '350',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Botanical Mesotherapy Modern',
            'deskripsi' => 'Perawatan mesotherapy menggunakan teknologi elektroporesis dan ultrasound untuk memasukkan serum botanical ke dalam kulit, tanpa rasa sakit dan tidak menimbulkan bekas. Berfungsi untuk peremajaan, melembabkan, mencerahkan dan mengurangi noda hitam kulit.',
            'harga' => '350000',
            'tipe' => 'Konsultasi',
            'jumlah_potongan_poin' => '350',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Botanical Peeling',
            'deskripsi' => 'Peremajaan kulit dengan menggunakan formula botanical yang diolah dengan teknologi tinggi, efektif menghilangkan sel-sel mati di permukaan kulit, merangsang pembentukan kolagen, mencerahkan dan menghaluskan tekstur kulit.',
            'harga' => '200000',
            'tipe' => 'Konsultasi',
            'jumlah_potongan_poin' => '200',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Botacinal Jet Peel',
            'deskripsi' => 'Perawatan kulit menggunakan serum botanical anti-aging dan tekanan tinggi oksigen dengan kecepatan aliran200m/detik. Kulit menjadi lebih sehat, segar bersih, kenyal dan bersinar.',
            'harga' => '200000',
            'tipe' => 'Konsultasi',
            'jumlah_potongan_poin' => '200',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Diamond Peel',
            'deskripsi' => 'Perawatan kulit denganmenggunakan kristal alumunium-dioksida steril. Berfungsi menghaluskan permukaan kulit, mengangkat sel kulit mati pada epidermis, dan merangsang pembentukan kolagen. Terutama digunakan untuk terapi scar/bopeng yang biasanya disebabkan oleh jerawat/cacar air, mengurangi keriput halus',
            'harga' => '350000',
            'tipe' => 'Konsultasi',
            'jumlah_potongan_poin' => '350',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Proionic Radiofrequency',
            'deskripsi' => 'Perawatan kulit dengan teknologi radio frekuensi 448Khz yang akan mengaktifkan mobilisasi ion-ion, meningkatkan aktifitas jaringan kulit, dan memperbaiki jaringan kulit yang berfungsi untuk mengencangkan, mengurangi kerutan, mengurangi kantung di bawah mata dan mengurangi shagging pada wajah.',
            'harga' => '200000',
            'tipe' => 'Konsultasi',
            'jumlah_potongan_poin' => '200',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Intense Pulse Light Plus',
            'deskripsi' => 'Pengembangan IPL dengan teknologi NOVA PLUS (Non Fractional Homogenous Infrared Broadband System), dengan perawatan program NOVA PLUS 3R ( Remodeling, Rejuvenation, Renewal) akan memberikan efek lifting(mengencangkan kulit) optimal dengan hasil nyata yang langsung terlihat setelah terapi selama 20 menit',
            'harga' => '200000',
            'tipe' => 'Konsultasi',
            'jumlah_potongan_poin' => '200',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('perawatans')->insert([
            'nama' => 'Laser CO2',
            'deskripsi' => 'Tindakan medis laser untukmenghilangkan nevus (tahi lalat), keratosis seboroik, skintag, dan lain-lain',
            'harga' => '300000',
            'tipe' => 'Non-Konsultasi',
            'jumlah_potongan_poin' => '300',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        
    }
}
