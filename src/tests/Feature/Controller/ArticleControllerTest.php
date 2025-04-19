<?php

namespace Tests\Feature\Controller;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Genre;
use Illuminate\Support\Carbon;
//↓これでControllerのテストが簡単にできる
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

beforeEach(function () {
    Carbon::setTestNow(now());
});

test('ホーム画面で過去1ヶ月間のいいね順で記事が取得できる', function () {
    $user = User::factory()->create();
    Article::factory()->for($user)->hasLikes(3)->create([
        'created_at' => now()->subDays(10),
    ]);

    $this->get(route('home'))
        ->assertInertia(
            fn(Assert $page) =>
            $page->component('Guest/Home')
                ->has('articles', 1)
        );
});

test('検索画面でタイトル検索ができる', function () {

    $user = User::factory()->create();
    Article::factory()->for($user)->create(['title' => 'Laravel Testing']);

    $this->get(route('articles.search', ['query' => 'Testing']))
        ->assertInertia(
            fn(Assert $page) =>
            $page->component('Guest/Article/Search')
                ->where('filters.query', 'Testing')
                //↓ここに .dataをつけたら通りました！！
                ->has('articles.data', 1)
        );
});

test('ジャンルごとの記事一覧を取得できる', function () {
    $genre = Genre::factory()->create();
    Article::factory()->hasAttached($genre)->create(['is_published' => true]);

    $this->get(route('articles.genre', $genre))
        ->assertInertia(
            fn(Assert $page) =>
            $page->component('Guest/Article/Genre')
                ->where('genre.id', $genre->id)
                ->has('articles.data', 1)
        );
});

test('記事詳細ページが表示され、MarkdownがHTMLに変換されている', function () {
    $user = User::factory()->create();
    $this->be($user);

    $article = Article::factory()->for($user)->create([
        'content' => '# Heading',
    ]);

    $this->get(route('articles.show', [$user, $article]))
        ->assertInertia(
            fn(Assert $page) =>
            $page->component('Guest/Article/Show')
                ->where('article.html_content', fn($html) => str_contains($html, '<h1>Heading</h1>'))
        );
});

test('記事にいいねできる', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $article = Article::factory()->create();

    //likes_countを初期化
    $article = Article::factory()->create(['likes_count' => 0]);

    $this->post(route('articles.like', $article))
        ->assertRedirect();

    expect($article->likes()->where('user_id', $user->id)->exists())->toBeTrue();
    expect($article->fresh()->likes_count)->toBe(1);
});

test('記事のいいねを解除できる', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $article = Article::factory()->create(['likes_count' => 1]);
    $article->likes()->create(['user_id' => $user->id]);

    $this->delete(route('articles.unlike', $article))
        ->assertRedirect();

    expect($article->likes()->where('user_id', $user->id)->exists())->toBeFalse();
    expect($article->fresh()->likes_count)->toBe(0);
});

test('記事の公開状態を切り替えられる', function () {
    $user = User::factory()->create();
    $article = Article::factory()->for($user)->create(['is_published' => true]);

    $this->actingAs($user)->put(route('articles.togglePublish', $article))
        ->assertRedirect();

    expect($article->fresh()->is_published)->toBeFalsy();
});

test('他人の記事の公開状態は変更できない', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $article = Article::factory()->for($otherUser)->create();

    $this->actingAs($user)->put(route('articles.togglePublish', $article))
        ->assertForbidden();
});

test('ゲストユーザーはいいねできない', function () {
    $article = Article::factory()->create();

    $this->post(route('articles.like', $article))
        ->assertRedirect(route('login'));
});
