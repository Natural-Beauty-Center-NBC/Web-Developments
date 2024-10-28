<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ADMIN ROLE :
        DB::table('pegawais')->insert([
            'nama' => 'Administrator',
            'email' => 'nbc.admin@gmail.com',
            'alamat' => 'Yogyakarta',
            'no_telp' => '081804020990',
            'status' => 'Available',
            'password' => bcrypt('nbcadmin1234'),
            'role' => 'Admin'
        ]);

        // DOKTER ROLE :
        DB::table('pegawais')->insert([
            'nama' => 'Administrator',
            'email' => 'nbc.dokter@gmail.com',
            'alamat' => 'Yogyakarta',
            'no_telp' => '081804020991',
            'status' => 'Available',
            'password' => bcrypt('nbcdokter1234'),
            'role' => 'Dokter'
        ]);

        // KEPALA KLINIK ROLE :
        DB::table('pegawais')->insert([
            'nama' => 'KepalaKlinik',
            'email' => 'nbc.kepala@gmail.com',
            'alamat' => 'Yogyakarta',
            'no_telp' => '081804020991',
            'status' => 'Available',
            'password' => bcrypt('nbckepala1234'),
            'role' => 'Dokter'
        ]);
    }
}
