<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mahasiswa')->insert([
            [
                'nim' => '1941720070',
                'nama' => 'I Made Genadi Dharma Slawa',
                'kelas' => 'TI-2D',
                'jurusan' => 'Teknologi Informasi',
                'no_handphone' => '085238831025'
            ],
            [
                'nim' => '1941720051',
                'nama' => 'Gisanda Aliya',
                'kelas' => 'TI-2B',
                'jurusan' => 'Teknologi Informasi',
                'no_handphone' => '081456743241'
            ],
            [
                'nim' => '1941720121',
                'nama' => 'Reynaldi Ramadhani',
                'kelas' => 'TI-2D',
                'jurusan' => 'Teknologi Informasi',
                'no_handphone' => '084378652341'
            ]
        ]);
    }
}
