<?php

namespace Database\Seeders;
use App\Models\Dokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'user_id' => '2',
                'gelar' => 's1 Kedokteran',
                'id_poli' => '1',
            ],
            [
                'user_id' => '4',
                'gelar' => 's1 Kedokteran',
                'id_poli' => '2',
            ],
        ];

        foreach ($data as $de) {
            Dokter::create([
                'user_id' => $de['user_id'],
                'gelar' => $de['gelar'],
                'id_poli' => $de['id_poli'],
            ]);
        }
    }
}
