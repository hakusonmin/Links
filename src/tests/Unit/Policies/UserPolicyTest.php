<?php

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

//↓beforeEachを使っている場合は↓を書かないとエラーが出ます.
uses(TestCase::class);
uses(RefreshDatabase::class);

beforeEach(function () {
    $this->policy = new UserPolicy();
});

test('ユーザー本人はプロフィールを更新できる', function () {
    $user = User::factory()->create();

    expect($this->policy->update($user, $user))->toBeTrue();
});

test('他人のプロフィールは更新できない', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();

    expect($this->policy->update($user, $other))->toBeFalse();
});
