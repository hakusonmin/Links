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
        $sharedContent = <<< EOT
#### この記事はデモデータです....
#### はじめに
- Laravelは非常に多機能なフレームワークであるがゆえにどの機能を使うべきか迷ってしまいます。そのため今回は使ったほうが良い機能のリンク集をまとめました。
- 基本的に make -a  で出力される構成がベストプラクティスなのでそれに従えばいいとおもいます。
####  追記
- Inertia.js を利用するメリットもここにあり、上記のようなLaravelの資産を簡単に使うことができます。
EOT;

        $content1 = <<< EOT
####  Pestの概要
- Laravel12系がリリースされ、laravel new コマンドによってアプリケーションを作成するときのテストフレームワークのオプションにPHPestが追加されました。
- PestはPHPUnit+Jestのようなスタイルのテストフレームワークで関数形式でテストを書けます。
- また、PestのラッパーであるためPHPUnit形式のコードが完全に互換性があり導入も非常に簡単です。
#### 記法について
- 上記のリンク集でも述べられていますが、「チェーンを使った形で値を評価できる」「バリデーションのテストの際、データプロバイダーなどを使わず with で簡単にかける」などがあります。
#### 注釈
- 私のケースでは依存関係の問題でLaravel12系に導入出来なかったのでLaravel11系に下げて利用しております。
EOT;


        $content2 = <<< EOT
#### はじめに
- Laravelは非常に多機能なフレームワークであるがゆえにどの機能を使うべきか迷ってしまいます。そのため今回は使ったほうが良い機能のリンク集をまとめました。
- 基本的に make -a  で出力される構成がベストプラクティスなのでそれに従えばいいとおもいます。
####  追記
- Inertia.js を利用するメリットもここにあり、上記のようなLaravelの資産を簡単に使うことができます。
EOT;

$content3 = <<< EOT
#### はじめに
- Dockerは本番環境でのトラブルを減らせるので使えるようにしたほうがいいですが、コンテナ化によるトラブルも起こりやすいので一長一短あります。
#### 覚えてた方がいいこと
- 127.0.0.1 としておけば大概つながります。DBクライアントに接続するときもそうです
- docker compose build するときは --no-cache しないと永遠に変更がはんえいされません
- taskfileは便利なので使ってください
####  追記
- CertBotをホスト側で実行できるようにしたほうがいいです。compose.yaml自体がシンプルになります。
- DockerはLightsailの2GBメモリでもちゃんと動きます
EOT;

        $content4 = <<< 'EOT'
### 概要
- SpringはLaravelに比べて比較的変更が少なく安定していて勉強しやすいように感じます。(Laravelは11系よりスリム化と従来の構造の二種類が生まれたため)
- 3系では主にJakartaのimport変化ぐらいが入門者にとって影響のある変更でしょうか..
- Laravelと違いマイグレーション管理ライブラリが付いて来ないのでflywayを入れましょう
- あと大人しく「IntelliJ IDEA」を使ったほうが良いです。vscodeでやろうとするのは大変です。
EOT;

        DB::table('articles')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'title' => 'Pestを使って開発するときに参照した方が良いリンクまとめ',
                'content' => $content1,
                'priority' => 'high',
                'is_published' => true,
                'likes_count' => 1500,
                'created_at' => '2025/01/10 11:11:11',
                'updated_at' => '2025/01/10 11:11:11',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'title' => 'Dockerを使って開発するときに参照した方が良いリンクまとめ',
                'content' => $content2,
                'priority' => 'high',
                'is_published' => true,
                'likes_count' => 1000,
                'created_at' => '2025/01/02 11:11:11',
                'updated_at' => '2025/01/03 11:11:11',
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'title' => 'Laravel開発に役立つ公式ドキュメントのリンク集',
                'content' => $content3,
                'priority' => 'high',
                'is_published' => true,
                'likes_count' => 1400,
                'created_at' => '2025/01/03 11:11:11',
                'updated_at' => '2025/01/03 11:11:11',
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'title' => 'SpringBootを使って開発するときに参照した方が良いリンクまとめ',
                'content' => $content4,
                'priority' => 'low',
                'is_published' => true,
                'likes_count' => 110,
                'created_at' => '2021/01/04 11:11:11',
                'updated_at' => '2021/01/04 11:11:11',
            ],
            [
                'id' => 5,
                'user_id' => 2,
                'title' => 'Drupalを使って開発するときに参照した方が良いリンクまとめ',
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
                'title' => 'Reactを使って開発するときに参照した方が良いリンクまとめ',
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
                'title' => 'Vueを使って開発するときに参照した方が良いリンクまとめ',
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
                'title' => 'Jestを使って開発するときに参照した方が良いリンクまとめ',
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
                'title' => 'AWSを使って開発するときに参照した方が良いリンクまとめ',
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
                'title' => 'Flywayを使って開発するときに参照した方が良いリンクまとめ',
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
                'title' => 'WordPressを使って開発するときに参照した方が良いリンクまとめ',
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
                'title' => 'AWSを使って開発するときに参照した方が良いリンクまとめ',
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
