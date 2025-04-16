<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articles')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => <<< 'EOT'
## はじめに
あなたは今日至極ある意味通りについてののちを通じたない。依然として結果があ尋ね料ともややくあるぬ末なっうまでになさるておいなければ講演心得なるが、だんだんにも駆めたでしましない。かたがたれないのは単に場合がほとんどたた。
とにかく岩崎さんに話掛けじぶん学習にするた教師のの英語私が反抗というご相談をいただだでで、そんな日数はがたしかに重行って返されて、問題が人のどこの話と金とお尋ねてまつつう中途だと中々何気に差がらだんのがうれしいのですで、どうしたたでたかに関係を事まいながらはっきりと交渉は行っないませですて、またわざわざの事実としててのためがもしも申し上げるなけと分からなけれのて、大きくだってそうお金力知らぬ事ないないでしょう。
## まとめ
一番下ですかある人をするけれども、そういう婆さんは実現いっ派細いと行き届いたらのでも好かでです。強く時の時をしんし個人らしとやるけれども来てっ点ごとにせよ。まだあなたはせわさがみて困ららぬのんは恥ずかしい、明らかなくて考えありのなにしからあなたのかしの釣にそんな物をご注文しと出しますた。
EOT,
                'priority' => 'high',
                'likes' => 800,
                'created_at' => '2021/01/01 11:11:11',
                'updated_at' => '2021/01/01 11:11:11',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => 'この記事では公式ドキュメントの読み方を解説します。',
                'priority' => 'middle',
                'likes' => 600,
                'created_at' => '2021/01/02 11:11:11',
                'updated_at' => '2021/01/02 11:11:11',
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => 'この記事では公式ドキュメントの読み方を解説します。',
                'priority' => 'middle',
                'likes' => 160,
                'created_at' => '2021/01/03 11:11:11',
                'updated_at' => '2021/01/03 11:11:11',
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => 'この記事では公式ドキュメントの読み方を解説します。',
                'priority' => 'low',
                'likes' => 110,
                'created_at' => '2021/01/04 11:11:11',
                'updated_at' => '2021/01/04 11:11:11',
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => 'この記事では公式ドキュメントの読み方を解説します。',
                'priority' => 'low',
                'likes' => 900,
                'created_at' => '2021/01/05 11:11:11',
                'updated_at' => '2021/01/05 11:11:11',
            ],
            [
                'id' => 6,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'priority' => 'high',
                'likes' => 190,
                'created_at' => '2021/01/06 11:11:11',
                'updated_at' => '2021/01/06 11:11:11',
            ],
            [
                'id' => 7,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => 'この記事では公式ドキュメントの読み方を解説します。',
                'priority' => 'high',
                'likes' => 300,
                'created_at' => '2021/01/07 11:11:11',
                'updated_at' => '2021/01/07 11:11:11',
            ],
            [
                'id' => 8,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => 'この記事では公式ドキュメントの読み方を解説します。',
                'priority' => 'high',
                'likes' => 140,
                'created_at' => '2021/01/08 11:11:11',
                'updated_at' => '2021/01/08 11:11:11',
            ],
            [
                'id' => 9,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => 'この記事では公式ドキュメントの読み方を解説します。',
                'priority' => 'high',
                'likes' => 10,
                'created_at' => '2021/01/09 11:11:11',
                'updated_at' => '2021/01/09 11:11:11',
            ],
            [
                'id' => 10,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => 'この記事では公式ドキュメントの読み方を解説します。',
                'priority' => 'high',
                'likes' => 120,
                'created_at' => '2021/01/10 11:11:11',
                'updated_at' => '2021/01/10 11:11:11',
            ],
            [
                'id' => 11,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => 'この記事では公式ドキュメントの読み方を解説します。',
                'priority' => 'high',
                'likes' => 105,
                'created_at' => '2021/01/11 11:11:11',
                'updated_at' => '2021/01/11 11:11:11',
            ],
            [
                'id' => 12,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => 'この記事では公式ドキュメントの読み方を解説します。',
                'priority' => 'high',
                'likes' => 101,
                'created_at' => '2021/01/12 11:11:11',
                'updated_at' => '2021/01/12 11:11:11',
            ],
        ]);
    }
}
