<?php

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

test('コメント作成画面が表示される', function () {
    $user = User::factory()->create();
    $article = Article::factory()->for($user)->create();

    $this->actingAs($user)
        ->get(route('comments.create', $article))
        ->assertInertia(fn(Assert $page) =>
            $page->component('Member/Comment/Create')
                ->where('article.id', $article->id)
        );
});

test('コメントを保存できる', function () {
    $user = User::factory()->create();
    $article = Article::factory()->for($user)->create();

    $this->actingAs($user)
        ->post(route('comments.store', $article), [
            'content' => 'これはテストコメントです。',
        ])
        ->assertRedirect(route('articles.show', $article));

    $this->assertDatabaseHas('comments', [
        'article_id' => $article->id,
        'user_id' => $user->id,
        'content' => 'これはテストコメントです。',
    ]);
});

test('コメント編集画面が表示される', function () {
    $user = User::factory()->create();
    $article = Article::factory()->for($user)->create();
    $comment = Comment::factory()->for($user)->for($article)->create();

    $this->actingAs($user)
        ->get(route('comments.edit', [$article, $comment]))
        ->assertInertia(fn(Assert $page) =>
            $page->component('Member/Comment/Edit')
                ->where('comment.id', $comment->id)
                ->where('article.id', $article->id)
        );
});

test('コメントを更新できる', function () {
    $user = User::factory()->create();
    $article = Article::factory()->for($user)->create();
    $comment = Comment::factory()->for($user)->for($article)->create([
        'content' => '元のコメント',
    ]);

    $this->actingAs($user)
        ->put(route('comments.update', [$article, $comment]), [
            'content' => '編集後のコメント',
        ])
        ->assertRedirect(route('articles.show', $article));

    $this->assertDatabaseHas('comments', [
        'id' => $comment->id,
        'content' => '編集後のコメント',
    ]);
});

test('コメントを削除できる', function () {
    $user = User::factory()->create();
    $article = Article::factory()->for($user)->create();
    $comment = Comment::factory()->for($user)->for($article)->create();

    $this->actingAs($user)
        ->delete(route('comments.destroy', [$article, $comment]))
        ->assertRedirect(route('articles.show', $article));

    $this->assertDatabaseMissing('comments', [
        'id' => $comment->id,
    ]);
});
