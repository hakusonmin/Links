<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('novels')->insert([
            [
                'id' => 1,
                'title' => 'hoge',
                'user_id' => 1,
            ],
            [
                'id' => 2,
                'title' => 'fuga',
                'user_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'fuga2',
                'user_id' => 1,
            ],
        ]);
    }
}
