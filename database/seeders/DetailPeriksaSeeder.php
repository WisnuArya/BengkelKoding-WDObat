<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailPeriksa;

class DetailPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_periksa' => '2',
                'id_obat' => '1',
                'jumlah' => 2,
                'subtotal' => 50000
            ],
            [
                'id_periksa' => '1',
                'id_obat' => '2',
                'jumlah' => 2,
                'subtotal' => 50000
            ],
        ];

        foreach ($data as $de) {
            DetailPeriksa::create([
                'id_periksa' => $de['id_periksa'],
                'id_obat' => $de['id_obat'],
                'jumlah' => $de['jumlah'],
                'subtotal' => $de['subtotal'],
            ]);
        }
    }
}
