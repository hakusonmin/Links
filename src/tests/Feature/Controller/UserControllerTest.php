<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

test('ユーザー検索ができる', function () {
    User::factory()->create(['name' => '山田太郎']);
    User::factory()->create(['name' => '田中花子']);

    $this->get(route('users.search', ['query' => '山田']))
        ->assertInertia(fn(Assert $page) =>
            $page->component('Guest/User/Search')
                 ->where('filters.query', '山田')
                 ->has('users.data', 1)
        );
});

test('フォローできる', function () {
    $user = User::factory()->create();
    $target = User::factory()->create(['followers_count' => 0]);

    $this->actingAs($user)
        ->post(route('follow', $target))
        ->assertRedirect();

    expect($user->followings()->where('follow_id', $target->id)->exists())->toBeTrue();
    expect($target->fresh()->followers_count)->toBe(1);
});

test('アンフォローできる', function () {
    $user = User::factory()->create();
    $target = User::factory()->create(['followers_count' => 1]);

    $user->followings()->attach($target->id);

    $this->actingAs($user)
        ->delete(route('unfollow', $target))
        ->assertRedirect();

    expect($user->followings()->where('follow_id', $target->id)->exists())->toBeFalse();
    expect($target->fresh()->followers_count)->toBe(0);
});
