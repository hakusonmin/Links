<?php

use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

//↓これがPest関連は絶対に必要..
uses(TestCase::class);

test('contentは必須である', function () {
    $data = ['content' => ''];

    $validator = Validator::make($data, (new CommentRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('content'))->toBeTrue();
});

test('contentが500文字を超えるとエラーになる', function () {
    $data = ['content' => str_repeat('あ', 501)];

    $validator = Validator::make($data, (new CommentRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('content'))->toBeTrue();
});

test('contentが500文字以内であれば通る', function () {
    $data = ['content' => str_repeat('あ', 500)];

    $validator = Validator::make($data, (new CommentRequest())->rules());

    expect($validator->fails())->toBeFalse();
});
