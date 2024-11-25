<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id_customer' => '0816160319861',
            'nama' => 'Customer 1',
            'tanggal_lahir' => today(),
            'jenis_kelamin' => 'Pria',
            'email' => 'nbc.cus@gmail.com',
            'alamat' => 'Jakarta',
            'poin' => 200,
            'alergi' => 'Tidak ada',
            'no_telp' => '087712341234',
            'password' => bcrypt('nbccus1234'),
        ]);

        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 50; $i++) {
            $user = User::create([
                'id_customer' => '081616031982' . $i,
                'nama' => $faker->name(),
                'tanggal_lahir' => $faker->date(),
                'jenis_kelamin' => $faker->randomElement(['Pria', 'Wanita']),
                'email' => $faker->email(),
                'alamat' => $faker->address(),
                'poin' => $faker->numberBetween(0, 100),
                'alergi' => 'Tidak ada',
                'no_telp' => $faker->phoneNumber(),
                'password' => bcrypt('nbccus123' . $i)
            ]);
            $user->created_at = $faker->dateTimeBetween('-4 year', 'now');
            $user->updated_at = $faker->dateTimeBetween($user->created_at, 'now');
            $user->save();
        }
    }
}
