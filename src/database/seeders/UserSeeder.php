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
        'name' => 'Tanaka Taro',
        // ダブルクオートじゃないと\nがうごかないよ..
        'profile_text' => "こんにちは田中太郎です。\nLaravel + Vue.js をメインに利用しております。\nよろしくお願いします..",
        'email' => 'hoge@gmail.com',
        'password' => Hash::make('hogehoge'),
        'is_admin' => true,
        'followers_count' => 1000,
        'github_url' => 'https://example.com',
        'x_url' => 'https://example.com',
        'another_url' => 'https://example.com',
        'created_at' => '2021/01/01 11:11:11'
      ],
      [
        'id' => 2,
        'name' => 'Satou Ken',
        'profile_text' => "こんにちはSatou Kenです。\nLaravel + Vue.js をメインに利用しております。\nよろしくお願いします..",
        'email' => 'fuga@gmail.com',
        'password' => Hash::make('fugafuga'),
        'followers_count' => 11,
        'github_url' => 'https://example.com',
        'x_url' => 'https://example.com',
        'another_url' => 'https://example.com',
        'is_admin' => false,
        'created_at' => '2021/01/03 11:11:11'
      ],
      [
        'id' => 3,
        'name' => 'Kaneko Satosi',
        'profile_text' => "こんにちはKaneko Satosiです。\nLaravel + Vue.js をメインに利用しております。\nよろしくお願いします..",
        'email' => 'fuga1@gmail.com',
        'password' => Hash::make('fugafuga1'),
        'is_admin' => false,
        'followers_count' => 10,
        'github_url' => 'https://example.com',
        'x_url' => 'https://example.com',
        'another_url' => 'https://example.com',
        'created_at' => '2021/01/04 11:11:11'
      ],
      [
        'id' => 4,
        'name' => 'Hasimoto Kenji',
        'profile_text' => "こんにちはHasimoto Kenjiです。\nLaravel + Vue.js をメインに利用しております。\nよろしくお願いします..",
        'email' => 'fuga4@gmail.com',
        'password' => Hash::make('fugafuga4'),
        'is_admin' => false,
        'followers_count' => 19,
        'github_url' => 'https://example.com',
        'x_url' => 'https://example.com',
        'another_url' => 'https://example.com',
        'created_at' => '2020/01/04 11:11:11'
      ],
    ]);
  }
}
