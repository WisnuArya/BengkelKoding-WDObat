<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Wisnu',
                'alamat' => 'Kudus',
                'no_hp' => '081111222333',
                'role' => 'dokter',
                'email' => 'wisnu@gmail.com',
                'password' => 'password',
            ],
            [
                'nama' => 'Ilham',
                'alamat' => 'Demak',
                'no_hp' => '082111333444',
                'role' => 'dokter',
                'email' => 'ilham@gmail.com',
                'password' => 'password',
            ],
            [
                'nama' => 'Rizal',
                'alamat' => 'Semarang',
                'no_hp' => '046048604686',
                'role' => 'pasien',
                'email' => 'rizal@gmail.com',
                'password' => 'password',
            ],
            [
                'nama' => 'Dhani',
                'alamat' => 'Kudus',
                'no_hp' => '039434873483',
                'role' => 'pasien',
                'email' => 'dhani@gmail.com',
                'password' => 'password',
            ]
            ];
        foreach($data as $d){
            User::create([
                'nama' => $d['nama'],
                'email' => $d['email'],
                'password' => $d['password'],
                'alamat' => $d['alamat'],
                'no_hp' => $d['no_hp'],
                'role' => $d['role'],
            ]);
        }
    }
}
