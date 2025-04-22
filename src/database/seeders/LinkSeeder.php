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
                'article_id' => 3,
                'title' => 'ルートモデルバインディング',
                'link_url' => 'https://readouble.com/laravel/11.x/ja/routing.html#route-model-binding',
                'comment' => '基本的にルーティングはこの形式を使ったほうが良いと思います。id で取得するスタイルもありますが、loadなどのメソッドもつかえるため基本的にこっちをおすすめします。'
            ],
            [
                'id' => 2,
                'article_id' => 3,
                'title' => 'ポリシー',
                'link_url' => 'https://readouble.com/laravel/11.x/ja/authorization.html',
                'comment' => '入門記事などで Controllerの先頭で権限チェックをしているものがありますが、フレームワーク推奨の方法を採用した方が簡潔です。また、テストも簡単になります。',
            ],
            [
                'id' => 3,
                'article_id' => 3,
                'title' => 'フォームリクエストバリデーション',
                'link_url' => 'https://readouble.com/laravel/11.x/ja/validation.html#form-request-validation',
                'comment' => 'バリデーションもいろんな手法がありますが、フォームリクエストバリデーションが一番良いと思っています。責務が分離されているのでテストも書きやすいです。←特にDBアクセスが必要なくなるのがよい。',
            ],
            [
                'id' => 4,
                'article_id' => 1,
                'title' => 'Pest公式ドキュメント',
                'link_url' => 'https://pestphp.com/',
                'comment' => '公式ドキュメントです。ホーム画面をスクロールしてもらうと大事なことがだいたい書いてあります。',
            ],
            [
                'id' => 5,
                'article_id' => 1,
                'title' => 'Pestによるlaravelでのテスト書き方',
                'link_url' => 'https://zenn.dev/nshiro/books/laravel-11-test',
                'comment' => '非常に素晴らしい記事です。まずこれを読んでください。',
            ],
            [
                'id' => 6,
                'article_id' => 1,
                'title' => 'LaravelでPest入門',
                'link_url' => 'https://zenn.dev/yum3/articles/t_entry_laravel_pest#validation-test',
                'comment' => 'この記事のようにバリデーションのテストが非常に簡潔になります。おすすめです。',
            ]
        ]);
    }
}
