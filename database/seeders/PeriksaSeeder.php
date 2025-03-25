<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Periksa;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_pasien' => '4',
                'id_dokter' => '1',
                'catatan' => 'periksa pertama',
                'biaya_periksa' => '50000',
            ],
            [
                'id_pasien' => '3',
                'id_dokter' => '2',
                'catatan' => 'periksa pertama',
                'biaya_periksa' => '50000',
            ],
            [
                'id_pasien' => '3',
                'id_dokter' => '1',
                'catatan' => 'periksa kedua',
                'biaya_periksa' => '50000',
            ],
            [
                'id_pasien' => '4',
                'id_dokter' => '2',
                'catatan' => 'periksa kedua',
                'biaya_periksa' => '50000',
            ]
        ];
        foreach($data as $d){
            Periksa::create([
                'id_pasien' => $d['id_pasien'],
                'id_dokter' => $d['id_dokter'],
                'catatan' => $d['catatan'],
                'biaya_periksa' => $d['biaya_periksa']
            ]);
        }
    }
}
