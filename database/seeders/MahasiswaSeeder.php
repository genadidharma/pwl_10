<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            DB::table('mahasiswa')->insert([
                [
                    'nim' => '194172' . $faker->randomNumber(4),
                    'nama' => $faker->name(),
                    'jurusan' => 'Teknologi Informasi',
                    'no_handphone' => '08' . $faker->randomNumber(8),
                    'email' => $faker->email,
                    'tanggal_lahir' => $faker->date(),
                    'kelas_id' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            ]);
        }
    }
}
