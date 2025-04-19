<?php

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('マイページのダッシュボードが表示される', function () {
    $this->get(route('mypage.dashboard'))
        ->assertInertia(fn(Assert $page) =>
            $page->component('Member/MyPage/Dashboard')
                 ->where('user.id', $this->user->id)
        );
});

test('いいねした記事が取得できる', function () {
    $article = Article::factory()->create();
    $article->likes()->create(['user_id' => $this->user->id]);

    $this->get(route('mypage.liked-articles'))
        ->assertInertia(fn(Assert $page) =>
            $page->component('Member/MyPage/LikedArticles')
                 ->has('articles.data', 1)
                 ->where('filters.sort', 'latest')
        );
});

test('フォローしているユーザー一覧が取得できる', function () {
    $followed = User::factory()->create();
    $this->user->followings()->attach($followed);

    $this->get(route('mypage.followed-users'))
        ->assertInertia(fn(Assert $page) =>
            $page->component('Member/MyPage/FollowedUsers')
                 ->has('users.data', 1)
        );
});

test('プロフィール編集画面が表示される', function () {
    $this->get(route('mypage.profile.edit'))
        ->assertInertia(fn(Assert $page) =>
            $page->component('Member/MyPage/ProfileEdit')
                 ->where('user.id', $this->user->id)
        );
});

test('プロフィールを更新できる', function () {
    $response = $this->put(route('mypage.profile.update'), [
        'profile_text' => 'テストプロフィール',
        'github_url' => 'https://github.com/example',
        'x_url' => 'https://twitter.com/example',
        'another_url' => 'https://example.com',
    ]);

    $response->assertRedirect(route('users.articles.index', $this->user));
    $this->assertDatabaseHas('users', [
        'id' => $this->user->id,
        'profile_text' => 'テストプロフィール',
    ]);
});
