<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 10; $i++) {
            Ruangan::create([
                'no_ruangan' => 100 + $i,
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
