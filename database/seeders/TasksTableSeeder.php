<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'project_id' => 1,
                'title' => 'Menentukan Struktur Database',
                'description' => 'Membuat struktur database untuk aplikasi mobile.',
                'assigned_to' => 1,
                'due_date' => '2024-01-20',
                'status' => 'pending',
                'priority' => 'high',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 2,
                'title' => 'Mendesain Halaman Beranda',
                'description' => 'Membuat desain halaman beranda untuk website perusahaan.',
                'assigned_to' => 2,
                'due_date' => '2024-02-15',
                'status' => 'in_progress',
                'priority' => 'medium',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
