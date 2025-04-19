<?php

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

//↓これがPest関連は絶対に必要..
uses(TestCase::class);

test('すべてのフィールドが有効な場合、バリデーションは通過する', function () {
    $data = [
        'profile_text' => 'これはプロフィールです。',
        'github_url' => 'https://github.com/example',
        'x_url' => 'https://twitter.com/example',
        'another_url' => 'https://example.com',
    ];

    $validator = Validator::make($data, (new UserRequest())->rules());

    expect($validator->fails())->toBeFalse();
});

test('profile_text が 100 文字を超えるとバリデーションエラーになる', function () {
    $data = [
        'profile_text' => str_repeat('あ', 101),
    ];

    $validator = Validator::make($data, (new UserRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('profile_text'))->toBeTrue();
});

test('github_url が無効なURLならエラーになる', function () {
    $data = ['github_url' => 'not-a-valid-url'];

    $validator = Validator::make($data, (new UserRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('github_url'))->toBeTrue();
});

test('x_url が無効なURLならエラーになる', function () {
    $data = ['x_url' => 'twitter'];

    $validator = Validator::make($data, (new UserRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('x_url'))->toBeTrue();
});

test('another_url が無効なURLならエラーになる', function () {
    $data = ['another_url' => 'ftp:/broken'];

    $validator = Validator::make($data, (new UserRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('another_url'))->toBeTrue();
});
