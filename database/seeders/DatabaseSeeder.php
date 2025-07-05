<?php

namespace Database\Seeders;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PeriksaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            PasienSeeder::class,
            PoliSeeder::class,
            DokterSeeder::class,
            JadwalPeriksaSeeder::class,
            DaftarPoliSeeder::class,
            PeriksaSeeder::class,
            ObatSeeder::class,
            DetailPeriksaSeeder::class,
        ]);
    }
}
