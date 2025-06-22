<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function test_comments_belongs_to_post()
    {
        $comment = Comment::factory()->forPost()->count(4)->create();

        $this->assertInstanceOf(Post::class, $comment->first()->post->first());

        $this->assertDatabaseCount('comments', 4);
    }
}
