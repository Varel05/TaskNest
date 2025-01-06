<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('projects')->insert([
            [
                'name' => 'Proyek Aplikasi Mobile',
                'description' => 'Pengembangan aplikasi mobile untuk manajemen tugas.',
                'start_date' => '2024-01-10',
                'end_date' => '2024-06-30',
                'status' => 'ongoing',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Proyek Website Perusahaan',
                'description' => 'Pembuatan website profil perusahaan.',
                'start_date' => '2024-02-01',
                'end_date' => '2024-07-15',
                'status' => 'ongoing',
                'created_by' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
