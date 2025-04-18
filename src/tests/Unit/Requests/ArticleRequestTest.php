<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ArticleRequestTest extends TestCase
{
    /** @test */
    public function タイトルが必須であること()
    {
        $data = [
            'title' => '',
            'priority' => 'high',
            'content' => '本文',
        ];

        $request = new ArticleRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('title', $validator->errors()->toArray());
    }

    /** @test */
    public function priorityが決まった値を取る()
    {
        $data = [
            'title' => 'タイトル',
            'priority' => 'invalid',
            'content' => '本文',
        ];

        $request = new ArticleRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('priority', $validator->errors()->toArray());
    }
}
