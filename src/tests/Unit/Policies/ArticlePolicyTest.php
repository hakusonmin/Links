<?php

namespace Tests\Unit\Policies;

use App\Models\Article;
use App\Models\User;
use App\Policies\ArticlePolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlePolicyTest extends TestCase
{
    use RefreshDatabase;

    protected ArticlePolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->policy = new ArticlePolicy();
    }

    /** @test */
    public function 投稿者本人は編集できる()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($this->policy->update($user, $article));
    }

    /** @test */
    public function 他人は編集できない()
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $user->id]);

        $this->assertFalse($this->policy->update($other, $article));
    }
}
