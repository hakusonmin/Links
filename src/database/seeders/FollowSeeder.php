<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('follows')->insert([
            [
                'id' => 1,
                'follow_id' => 1,
                'follower_id' => 2,
            ]
        ]);
    }
}
