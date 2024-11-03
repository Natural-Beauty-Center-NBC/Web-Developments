<?php

namespace Database\Seeders;

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
            'nama' => 'Dokter 1',
            'email' => 'nbc.dokter@gmail.com',
            'alamat' => 'Yogyakarta',
            'no_telp' => '081804020991',
            'status' => 'Available',
            'password' => bcrypt('nbcdokter1234'),
            'role' => 'Dokter'
        ]);

        DB::table('pegawais')->insert([
            'nama' => 'Dokter 4',
            'email' => 'nbc.dokter2@gmail.com',
            'alamat' => 'Yogyakarta',
            'no_telp' => '081804020991',
            'status' => 'Available',
            'password' => bcrypt('nbcdokter1234'),
            'role' => 'Dokter'
        ]);

        DB::table('pegawais')->insert([
            'nama' => 'Dokter 3',
            'email' => 'nbc.dokter3@gmail.com',
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
            'no_telp' => '081804020996',
            'status' => 'Available',
            'password' => bcrypt('nbckepala1234'),
            'role' => 'Kepala Klinik'
        ]);

        // CUSTOMER SERVICE ROLE :
        DB::table('pegawais')->insert([
            'nama' => 'CustomerService',
            'email' => 'nbc.cs@gmail.com',
            'alamat' => 'Yogyakarta',
            'no_telp' => '081804020997',
            'status' => 'Busy',
            'password' => bcrypt('nbcservice1234'),
            'role' => 'Customer Service'
        ]);

        // KASIR ROLE :
        DB::table('pegawais')->insert([
            'nama' => 'Kasir',
            'email' => 'nbc.kasir@gmail.com',
            'alamat' => 'Yogyakarta',
            'no_telp' => '081804020934',
            'status' => 'Busy',
            'password' => bcrypt('nbckasir1234'),
            'role' => 'Kasir'
        ]);

        // BEAUTICIAN ROLE :
        DB::table('pegawais')->insert([
            'nama' => 'Beautician 1',
            'email' => 'nbc.beautician@gmail.com',
            'alamat' => 'Yogyakarta',
            'no_telp' => '081804020935',
            'status' => 'Busy',
            'password' => bcrypt('nbcbeautician1234'),
            'role' => 'Beautician'
        ]);

        DB::table('pegawais')->insert([
            'nama' => 'Beautician 2',
            'email' => 'nbc.beautician2@gmail.com',
            'alamat' => 'Yogyakarta',
            'no_telp' => '081804020935',
            'status' => 'Busy',
            'password' => bcrypt('nbcbeautician1234'),
            'role' => 'Beautician'
        ]);

        DB::table('pegawais')->insert([
            'nama' => 'Beautician 3',
            'email' => 'nbc.beautician3@gmail.com',
            'alamat' => 'Yogyakarta',
            'no_telp' => '081804020935',
            'status' => 'Busy',
            'password' => bcrypt('nbcbeautician1234'),
            'role' => 'Beautician'
        ]);
    }
}
