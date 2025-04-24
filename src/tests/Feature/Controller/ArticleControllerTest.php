<?php

namespace Tests\Feature\Controller;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Genre;
use Exception;
use Illuminate\Support\Carbon;
//↓これでControllerのテストが簡単にできる
use Inertia\Testing\AssertableInertia as Assert;
use App\Services\ArticleService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Mockery;


uses(RefreshDatabase::class);

beforeEach(function () {
    Carbon::setTestNow(now());
});

test('ホーム画面で過去1ヶ月間のいいね数順で記事が取得できる', function () {
    $user = User::factory()->create();

    // 記事A：いいね3件
    $articleA = Article::factory()->for($user)->hasLikes(3)->create([
        'title' => 'Article A',
        'created_at' => now()->subDays(5),
    ]);

    // 記事B：いいね5件1位になるべき）
    $articleB = Article::factory()->for($user)->hasLikes(5)->create([
        'title' => 'Article B',
        'created_at' => now()->subDays(3),
    ]);

    // 記事C：いいね1件
    $articleC = Article::factory()->for($user)->hasLikes(1)->create([
        'title' => 'Article C',
        'created_at' => now()->subDays(1),
    ]);

    $response = $this->get(route('home'));

    $response->assertInertia(
        fn(Assert $page) =>
        $page->component('Guest/Home')
            ->has('articles', 3)
            ->where('articles.0.title', 'Article B') // 1番目にArticle B
            ->where('articles.1.title', 'Article A') // 2番目にArticle A
            ->where('articles.2.title', 'Article C') // 3番目にArticle C
    );
});

test('検索画面でタイトル検索ができる', function () {

    $user = User::factory()->create();
    Article::factory()->for($user)->create(['title' => 'Laravel Testing']);

    $response = $this->get(route('articles.search', ['query' => 'Testing']));
    $response->assertStatus(200);

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

test('記事詳細が表示される', function () {
    $article = Article::factory()->create();

    $this->actingAs($article->user)
        ->get(route('articles.show', $article))
        ->assertInertia(
            fn(Assert $page) =>
            $page->component('Guest/Article/Show')
                ->where('article.id', $article->id)
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

test('記事作成画面が表示される', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('articles.create'))
        ->assertInertia(fn(Assert $page) =>
            $page->component('Member/Article/Create')
        );
});

test('記事を作成できる', function () {
    $this->withoutExceptionHandling();
    $user = User::factory()->create();

    $payload = [
        'title' => 'テストタイトル',
        'priority' => 'high',
        'content' => '本文',
        'genres' => ['Laravel', 'PHP'],
        'links' => [
            ['title' => 'Laravel公式', 'link_url' => 'https://laravel.com', 'comment' => '公式ドキュメント'],
        ],
    ];

    $this->actingAs($user)
        ->post(route('articles.store'), $payload)
        ->assertRedirect();

    $this->assertDatabaseHas('articles', ['title' => 'テストタイトル']);
    $this->assertDatabaseHas('genres', ['name' => 'Laravel']);
    $this->assertDatabaseHas('links', ['title' => 'Laravel公式']);
});


test('記事作成中に例外が発生した場合ロールバックされる', function () {
    $user = User::factory()->create();

    $payload = [
        'title' => 'テストロールバック',
        'priority' => 'high',
        'content' => 'テストコンテンツ',
        'genres' => ['Laravel'],
        'links' => [
            ['title' => '壊れるリンク', 'link_url' => 'https://example.com', 'comment' => 'コメント'],
        ],
    ];

    // ArticleService をモックして例外を投げる
    $mock = Mockery::mock(ArticleService::class);
    $mock->shouldReceive('createArticle')->andThrow(new Exception('故意の失敗'));
    App::instance(ArticleService::class, $mock);

    $this->actingAs($user)
        ->post(route('articles.store'), $payload);

    $this->assertDatabaseMissing('articles', ['title' => 'テストロールバック']);
});

test('記事編集画面が表示される', function () {
    $article = Article::factory()->create();

    $this->actingAs($article->user)
        ->get(route('articles.edit', $article))
        ->assertInertia(fn(Assert $page) =>
            $page->component('Member/Article/Edit')
                 ->where('article.id', $article->id)
        );
});

test('記事を更新できる', function () {
    $article = Article::factory()->create([
        'title' => '旧タイトル',
    ]);

    $this->actingAs($article->user)
        ->put(route('articles.update', $article), [
            'title' => '新タイトル',
            'priority' => 'middle',
            'content' => '更新内容',
            'genres' => ['新ジャンル'],
            'links' => [],
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('articles', ['title' => '新タイトル']);
    $this->assertDatabaseHas('genres', ['name' => '新ジャンル']);
});

test('記事更新中に例外が発生した場合ロールバックされる', function () {
    $article = Article::factory()->create(['title' => '元のタイトル']);
    $user = $article->user;

    $mock = Mockery::mock(ArticleService::class);
    $mock->shouldReceive('updateArticle')->andThrow(new \Exception('故意の例外'));
    app()->instance(ArticleService::class, $mock);

    $this->actingAs($user)
        ->put(route('articles.update', $article), [
            'title' => '失敗するタイトル',
            'priority' => 'high',
            'content' => '内容',
            'genres' => ['PHP'],
            'links' => [],
        ]);

    $this->assertDatabaseHas('articles', ['title' => '元のタイトル']); // 変更されてないことを確認
});

test('記事を削除できる', function () {
    $article = Article::factory()->create();

    $this->actingAs($article->user)
        ->delete(route('articles.destroy', $article))
        ->assertRedirect();

    $this->assertModelMissing($article);
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

test('ゲストユーザーはいいねできない', function () {
    $article = Article::factory()->create();

    $this->post(route('articles.like', $article))
        ->assertRedirect(route('login'));
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
