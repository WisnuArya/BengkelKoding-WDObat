<?php

namespace Database\Seeders;
use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'nama_poli' => 'Poli Gigi',
                'kode_poli' => 'PG',
                'spesialis' => 'Gigi dan Mulut',
            ],
            [
                'nama_poli' => 'Poli Jantung',
                'kode_poli' => 'PJ',
                'spesialis' => 'Jantung dan Pembuluh Darah',
            ],
            [
                'nama_poli' => 'Poli Ginjal',
                'kode_poli' => 'PGJL',
                'spesialis' => 'Ginjal',
            ],
        ];

        foreach ($data as $de) {
            Poli::create([
                'nama_poli' => $de['nama_poli'],
                'kode_poli' => $de['kode_poli'],
                'spesialis' => $de['spesialis'],

            ]);
        }
    }
}
