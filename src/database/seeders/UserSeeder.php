<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      [
        'id' => 1,
        'name' => 'hoge',
        'email' => 'hoge@gmail.com',
        'password' => Hash::make('hogehoge'),
        'is_admin' => true,
        'created_at' => '2021/01/01 11:11:11'
      ],
      [
        'id' => 2,
        'name' => 'fuga',
        'email' => 'fuga@gmail.com',
        'password' => Hash::make('fugafuga'),
        'is_admin' => false,
        'created_at' => '2021/01/01 11:11:11'
      ],
      [
        'id' => 3,
        'name' => 'fuga1',
        'email' => 'fuga1@gmail.com',
        'password' => Hash::make('fugafuga1'),
        'is_admin' => false,
        'created_at' => '2021/01/01 11:11:11'
      ],
    ]);
  }
}
