<?php

use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

uses(TestCase::class);

test('タイトルが必須であること', function () {
    $data = [
        'title' => '',
        'priority' => 'high',
        'content' => '本文',
    ];

    $request = new ArticleRequest();
    $rules = $request->rules();

    $validator = Validator::make($data, $rules);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->toArray())->toHaveKey('title');
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
