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
        'profile_text' => 'こんにちは田中太郎です。',
        'email' => 'hoge@gmail.com',
        'password' => Hash::make('hogehoge'),
        'is_admin' => true,
        'followers' => 0,
        'github_url' => 'https://example.com',
        'x_url' => 'https://example.com',
        'another_url' => 'https://example.com',
        'created_at' => '2021/01/01 11:11:11'
      ],
      [
        'id' => 2,
        'name' => 'fuga',
        'profile_text' => 'こんにちは田中太郎2です。',
        'email' => 'fuga@gmail.com',
        'password' => Hash::make('fugafuga'),
        'followers' => 0,
        'github_url' => 'https://example.com',
        'x_url' => 'https://example.com',
        'another_url' => 'https://example.com',
        'is_admin' => false,
        'created_at' => '2021/01/01 11:11:11'
      ],
      [
        'id' => 3,
        'name' => 'fuga1',
        'profile_text' => 'こんにちは田中太郎3です。',
        'email' => 'fuga1@gmail.com',
        'password' => Hash::make('fugafuga1'),
        'is_admin' => false,
        'followers' => 0,
        'github_url' => 'https://example.com',
        'x_url' => 'https://example.com',
        'another_url' => 'https://example.com',
        'created_at' => '2021/01/01 11:11:11'
      ],
    ]);
  }
}
