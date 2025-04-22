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
            ['id' => '1', 'name' => 'Pest', 'created_at' => '2021/01/01 11:11:11'],
            ['id' => '2', 'name' => 'PHPUnit', 'created_at' => '2021/01/01 11:11:11'],
            ['id' => '3', 'name' => 'テスト', 'created_at' => '2021/01/01 11:11:11'],
            ['id' => '4', 'name' => 'SpringBoot', 'created_at' => '2021/01/01 11:11:11'],
            ['id' => '5', 'name' => 'Docker', 'created_at' => '2021/01/01 11:11:11'],
            ['id' => '6', 'name' => 'Laravel', 'created_at' => '2021/01/01 11:11:11'],
            ['id' => '7', 'name' => '環境構築', 'created_at' => '2021/01/01 11:11:11'],
            ['id' => '8', 'name' => 'PHP', 'created_at' => '2021/01/01 11:11:11'],
          ]);
    }
}
