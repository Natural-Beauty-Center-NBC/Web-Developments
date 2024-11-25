<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PegawaiSeeder::class,
            HariSeeder::class,
            UserSeeder::class,
            PerawatanSeeder::class,
            ProdukSeeder::class,
            RuanganSeeder::class
        ]);
    }
}
