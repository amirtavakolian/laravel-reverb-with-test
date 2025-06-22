<?php

namespace Models;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertInstanceOf;

class TagTest extends TestCase
{

    use RefreshDatabase;

    public function test_insert_data1()
    {
        $tags = Tag::factory()->create();

        $this->assertDatabaseHas('tags', $tags->toArray());

        $this->assertInstanceOf(Tag::class, $tags);
    }

    public function test_post_tag_relationship1()
    {
        $post = Post::factory()->for(User::factory())->count(3);
        // instead of above code, you can give value to user_id in PostFactory
        // so there is no need to for() anymore.

        $tag = Tag::factory()->has($post)->create();

        $this->assertInstanceOf(Post::class, $tag->posts->first());

        $tagToArray = $tag->toArray();
        unset($tagToArray['posts']);

        $this->assertDatabaseHas('tags', $tagToArray);
    }

    public function test_post_tag_relationship2()
    {
        $post = Post::factory()->state([
            'user_id' => User::factory()
        ])->hasTags()->count(3)->create();

        $this->assertDatabaseHas('posts', $post->toArray()[0]);

        $this->assertCount(3, $post);

        $this->assertInstanceOf(Post::class, $post->first());

        $this->assertDatabaseCount('post_tag', 3);
    }
}
