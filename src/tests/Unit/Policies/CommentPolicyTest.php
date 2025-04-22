<?php

use App\Models\Comment;
use App\Models\User;
use App\Policies\CommentPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

//↓beforeEachを使っている場合は↓を書かないとエラーが出ます.
uses(TestCase::class);
uses(RefreshDatabase::class);

beforeEach(function () {
    $this->policy = new CommentPolicy();
});

test('コメントの投稿者は編集できる', function () {
    $user = User::factory()->create();
    $comment = Comment::factory()->for($user)->create();

    expect($this->policy->update($user, $comment))->toBeTrue();
});

test('他人はコメントを編集できない', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();
    $comment = Comment::factory()->for($user)->create();

    expect($this->policy->update($other, $comment))->toBeFalse();
});

test('コメントの投稿者は削除できる', function () {
    $user = User::factory()->create();
    $comment = Comment::factory()->for($user)->create();

    expect($this->policy->delete($user, $comment))->toBeTrue();
});

test('他人はコメントを削除できない', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();
    $comment = Comment::factory()->for($user)->create();

    expect($this->policy->delete($other, $comment))->toBeFalse();
});
