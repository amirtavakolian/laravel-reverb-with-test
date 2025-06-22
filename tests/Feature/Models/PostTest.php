<?php

namespace Models;

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
}
