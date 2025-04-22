<?php

use App\Models\Article;
use App\Models\User;
use App\Policies\ArticlePolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

//↓beforeEachを使っている場合は↓を書かないとエラーが出ます.
uses(TestCase::class);
uses(RefreshDatabase::class);

// Policy を共通で使いたい場合は beforeEach を使う
beforeEach(function () {
    $this->policy = new ArticlePolicy();
});

test('投稿者本人は編集できる', function () {
    $user = User::factory()->create();
    $article = Article::factory()->create(['user_id' => $user->id]);

    expect($this->policy->update($user, $article))->toBeTrue();
});

test('他人は編集できない', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();
    $article = Article::factory()->create(['user_id' => $user->id]);

    expect($this->policy->update($other, $article))->toBeFalse();
});
