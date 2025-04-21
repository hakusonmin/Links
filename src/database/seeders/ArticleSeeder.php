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
        $sharedContent = <<< 'EOT'
### はじめに
あなたは今日至極ある意味通りについてののちを通じたない。依然として結果があ尋ね料ともややくあるぬ末なっうまでになさるておいなければ講演心得なるが、だんだんにも駆めたでしましない。かたがたれないのは単に場合がほとんどたた。
とにかく岩崎さんに話掛けじぶん学習にするた教師のの英語私が反抗というご相談をいただだでで、そんな日数はがたしかに重行って返されて、問題が人のどこの話と金とお尋ねてまつつう中途だと中々何気に差がらだんのがうれしいのですで、どうしたたでたかに関係を事まいながらはっきりと交渉は行っないませですて、またわざわざの事実としててのためがもしも申し上げるなけと分からなけれのて、大きくだってそうお金力知らぬ事ないないでしょう。
### ポイント
あなたは今日至極ある意味通りについてののちを通じたない。依然として結果があ尋ね料ともややくあるぬ末なっうまでになさるておいなければ講演心得なるが、だんだんにも駆めたでしましない。かたがたれないのは単に場合がほとんどたた。
とにかく岩崎さんに話掛けじぶん学習にするた教師のの英語私が反抗というご相談をいただだでで、そんな日数はがたしかに重行って返されて、問題が人のどこの話と金とお尋ねてまつつう中途だと中々何気に差がらだんのがうれしいのですで、どうしたたでたかに関係を事まいながらはっきりと交渉は行っないませですて、またわざわざの事実としててのためがもしも申し上げるなけと分からなけれのて、大きくだってそうお金力知らぬ事ないないでしょう。
### まとめ
一番下ですかある人をするけれども、そういう婆さんは実現いっ派細いと行き届いたらのでも好かでです。強く時の時をしんし個人らしとやるけれども来てっ点ごとにせよ。まだあなたはせわさがみて困ららぬのんは恥ずかしい、明らかなくて考えありのなにしからあなたのかしの釣にそんな物をご注文しと出しますた。
EOT;

        DB::table('articles')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!',
                'content' => $sharedContent,
                'priority' => 'high',
                'is_published' => true,
                'likes_count' => 1500,
                'created_at' => '2025/01/10 11:11:11',
                'updated_at' => '2025/01/10 11:11:11',
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!2',
                'content' => $sharedContent,
                'priority' => 'high',
                'is_published' => true,
                'likes_count' => 1400,
                'created_at' => '2025/01/02 11:11:11',
                'updated_at' => '2025/01/03 11:11:11',
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'title' => 'Dockerの公式ドキュメントの読み方について完全解説します!3',
                'content' => $sharedContent,
                'priority' => 'middle',
                'is_published' => true,
                'likes_count' => 160,
                'created_at' => '2021/01/03 11:11:11',
                'updated_at' => '2021/01/03 11:11:11',
            ],
            [
                'id' => 4,
                'user_id' => 2,
                'title' => 'SpringBootの公式ドキュメントの読み方について完全解説します!4',
                'content' => $sharedContent,
                'priority' => 'low',
                'is_published' => true,
                'likes_count' => 110,
                'created_at' => '2021/01/04 11:11:11',
                'updated_at' => '2021/01/04 11:11:11',
            ],
            [
                'id' => 5,
                'user_id' => 2,
                'title' => 'Drupalの公式ドキュメントの読み方について完全解説します!5',
                'content' => $sharedContent,
                'priority' => 'low',
                'is_published' => true,
                'likes_count' => 900,
                'created_at' => '2021/01/05 11:11:11',
                'updated_at' => '2021/01/05 11:11:11',
            ],
            [
                'id' => 6,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!6',
                'content' => $sharedContent,
                'priority' => 'high',
                'is_published' => false,
                'likes_count' => 190,
                'created_at' => '2021/01/06 11:11:11',
                'updated_at' => '2021/01/06 11:11:11',
            ],
            [
                'id' => 7,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!7',
                'content' => $sharedContent,
                'priority' => 'middle',
                'is_published' => true,
                'likes_count' => 300,
                'created_at' => '2021/01/07 11:11:11',
                'updated_at' => '2021/01/07 11:11:11',
            ],
            [
                'id' => 8,
                'user_id' => 1,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!8',
                'content' => $sharedContent,
                'priority' => 'high',
                'is_published' => true,
                'likes_count' => 140,
                'created_at' => '2021/01/08 11:11:11',
                'updated_at' => '2021/01/08 11:11:11',
            ],
            [
                'id' => 9,
                'user_id' => 4,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!9',
                'content' => $sharedContent,
                'priority' => 'high',
                'is_published' => true,
                'likes_count' => 10,
                'created_at' => '2021/01/09 11:11:11',
                'updated_at' => '2021/01/09 11:11:11',
            ],
            [
                'id' => 10,
                'user_id' => 2,
                'title' => 'Laravelの公式ドキュメントの読み方について完全解説します!10',
                'content' => $sharedContent,
                'priority' => 'high',
                'is_published' => true,
                'likes_count' => 120,
                'created_at' => '2021/01/10 11:11:11',
                'updated_at' => '2021/01/10 11:11:11',
            ],
            [
                'id' => 11,
                'user_id' => 2,
                'title' => 'Reactの公式ドキュメントの読み方について完全解説します!11',
                'content' => $sharedContent,
                'priority' => 'high',
                'is_published' => true,
                'likes_count' => 105,
                'created_at' => '2021/01/11 11:11:11',
                'updated_at' => '2021/01/11 11:11:11',
            ],
            [
                'id' => 12,
                'user_id' => 2,
                'title' => 'Dockerの公式ドキュメントの読み方について完全解説します!12',
                'content' => $sharedContent,
                'priority' => 'high',
                'is_published' => false,
                'likes_count' => 101,
                'created_at' => '2021/01/12 11:11:11',
                'updated_at' => '2021/01/12 11:11:11',
            ],
        ]);
    }
}
