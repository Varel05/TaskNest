<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GroupMembersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('group_members')->insert([
            [
                'project_id' => 1,
                'user_id' => 1,
                'role' => 'leader',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 2,
                'user_id' => 2,
                'role' => 'member',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
