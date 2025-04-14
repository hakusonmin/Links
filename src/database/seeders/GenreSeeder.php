<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            ['id' => '1', 'name' => 'Laravel', 'created_at' => '2021/01/01 11:11:11'],
            ['id' => '2', 'name' => 'Vue', 'created_at' => '2021/01/01 11:11:11'],
            ['id' => '3', 'name' => 'PHP', 'created_at' => '2021/01/01 11:11:11'],
          ]);
    }
}
