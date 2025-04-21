<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('links')->insert([
            [
                'id' => 1,
                'article_id' => 1,
                'title' => 'Laravel公式サイト',
                'link_url' => 'https://example.com/',
            ],
            [
                'id' => 2,
                'article_id' => 1,
                'title' => 'Laravel日本語ドキュメント',
                'link_url' => 'https://example.com/',
            ],
            [
                'id' => 3,
                'article_id' => 1,
                'title' => 'Laravel公式ドキュメントの読み方',
                'link_url' => 'https://example.com/',
            ],
            [
                'id' => 4,
                'article_id' => 2,
                'title' => 'Laravel公式サイト',
                'link_url' => 'https://example.com/',
            ],
            [
                'id' => 5,
                'article_id' => 2,
                'title' => 'Laravel日本語ドキュメント',
                'link_url' => 'https://example.com/',
            ],
            [
                'id' => 6,
                'article_id' => 2,
                'title' => 'Laravel公式ドキュメントの読み方',
                'link_url' => 'https://example.com/',
            ]
        ]);
    }
}
