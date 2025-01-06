<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->insert([
            [
                'task_id' => 1,
                'user_id' => 2,
                'comment' => 'Database sudah selesai dibuat dan siap untuk diimplementasikan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'task_id' => 2,
                'user_id' => 1,
                'comment' => 'Desain awal halaman beranda sudah disetujui.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
