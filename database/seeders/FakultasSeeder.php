<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fakultas::insert([
            [
                'id' => 1,
                'nama' => 'Matematika dan Pengetahuan Alam',
                'kode' => '11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Prodi::insert([
            [
                'id' => 1,
                'nama' => 'S1 Ilmu Komputer',
                'kode' => '016',
                'created_at' => now(),
                'updated_at' => now(),
                'id_fakultas' => 1,
            ],
            [
                'id' => 2,
                'nama' => 'S1 Matematika',
                'kode' => '017',
                'created_at' => now(),
                'updated_at' => now(),
                'id_fakultas' => 1,
            ],
        ]);
    }
}
