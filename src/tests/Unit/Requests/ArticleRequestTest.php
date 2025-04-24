<?php

use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    $this->rules = (new ArticleRequest())->rules();
});

test('priorityが決まった値を取る', function () {
    $data = [
        'title' => 'タイトル',
        'priority' => 'invalid',
        'content' => '本文',
    ];

    $request = new ArticleRequest();
    $rules = $request->rules();

    $validator = Validator::make($data, $rules);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->toArray())->toHaveKey('priority');
});

test('バリデーションが失敗する場合', function (array $override, string $expectedErrorKey) {
    $valid = [
        'title' => 'タイトル',
        'priority' => 'high',
        'genres' => ['ジャンル1'],
        'content' => '本文',
        'links' => [
            ['title' => 'リンクタイトル', 'link_url' => 'https://example.com']
        ]
    ];

    $data = array_merge($valid, $override);

    $validator = Validator::make($data, $this->rules);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has($expectedErrorKey))->toBeTrue();
})->with([
    'タイトルが空' => [['title' => ''], 'title'],
    '優先度が不正' => [['priority' => 'invalid'], 'priority'],
    'ジャンルが多すぎる' => [['genres' => ['a', 'b', 'c', 'd']], 'genres'],
    'ジャンルの1つが長すぎる' => [['genres' => ['ジャンル1', str_repeat('a', 11)]], 'genres.1'],
    '本文が空' => [['content' => ''], 'content'],
    'リンクURLが不正' => [['links' => [['title' => 'リンク', 'link_url' => 'not-a-url']]], 'links.0.link_url'],
]);

test('リンクのtitleとlink_urlがセットであることを検証', function (array $links, string $expectedErrorKey) {
    $valid = [
        'title' => 'タイトル',
        'priority' => 'high',
        'genres' => ['ジャンル1'],
        'content' => '本文',
        'links' => $links,
    ];

    $request = new ArticleRequest();

    $validator = Validator::make($valid, $request->rules());

    // withValidator を手動で呼ぶ
    $request->setMethod('POST'); // ← ないとバグる場合がある
    $request->merge($valid);
    $request->withValidator($validator);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has($expectedErrorKey))->toBeTrue();
})->with([
    'titleだけ存在' => [[['title' => 'リンク']], 'links.0.link_url'],
    'link_urlだけ存在' => [[['link_url' => 'https://example.com']], 'links.0.title'],
]);
