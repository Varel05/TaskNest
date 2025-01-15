<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'anggota 1',
            'email' => 'anggota1@contoh.com',
            'password' => '11111111',
            'role' => 'member',
            ]);
        User::factory()->create([
            'name' => 'anggota 2',
            'email' => 'anggota2@contoh.com',
            'password' => '22222222',
            'role' => 'member',
            ]);
    }
}
