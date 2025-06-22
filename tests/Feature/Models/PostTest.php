<?php

namespace Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{

    use RefreshDatabase;

    public function test_insert_post(): void
    {
        $post = Post::factory()->for(User::factory())->create();

        $this->assertDatabaseHas('posts', $post->toArray());

        $this->assertModelExists($post->user);

        $this->assertInstanceOf(User::class, $post->user);
    }

    public function test_post_belongs_to_user1()
    {
        $user = User::factory()->create();

        $post = Post::factory()->state([
            'user_id' => $user->id
        ])->create();

        $this->assertEquals($user->id, $post->id);
    }

    public function test_post_belongs_to_user2()
    {
        $user = User::factory()->create();

        $post = Post::factory()->for($user)->create();

        $this->assertEquals($user->id, $post->id);
    }

    public function test_post_has_many_comments()
    {
        $post = Post::factory()->hasComments(5)->create();

        $this->assertDatabaseCount('comments', 5);

        $this->assertInstanceOf(Comment::class, $post->comments->first());
    }
}
