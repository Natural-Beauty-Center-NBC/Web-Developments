<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id_customer' => '0816160319821',
            'nama' => 'Customer 1',
            'tanggal_lahir' => today(),
            'jenis_kelamin' => 'Pria',
            'email' => 'nbc.cus@gmail.com',
            'alamat' => 'Jakarta',
            'alergi' => 'Tidak ada',
            'no_telp' => '087712341234',
            'password' => bcrypt('nbccus1234'),
        ]);
    }
}
