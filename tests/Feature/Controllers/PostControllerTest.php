<?php

namespace Tests\Feature\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Database\Factories\PostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_single_method()
    {
        $user = User::factory()->create();

        $post = Post::factory()->has(
            Comment::factory()->for($user)->isApproved()->count(5)
        )->create();

        $response = $this->actingAs($user)->get(route('post.show', $post));

        $response->assertViewIs('panel.posts.show');

        $response->assertViewHasAll(['post' => $post]);

        $response->assertOk();
    }

    public function test_store_method()
    {
        $tags = Tag::factory()->count(5)->create()->pluck('id')->toArray();

        $post = Post::factory()->make()->toArray();

        $post['tags'] = $tags;

        $this->actingAs(User::factory()->create());

        $response = $this->post(route('post.store'), $post);

        $newPost = Post::query()->where([
            'title' => $post['title'],
            'description' => $post['description']
        ])->first();

        $response->assertStatus(302);

        $response->assertSessionHas('success');

        $this->assertInstanceOf(Tag::class, $newPost->tags[0]);

        $this->assertNotNull($newPost);
        
        $this->assertEqualsCanonicalizing($tags, $newPost->tags->pluck('id')->toArray());
    }

    public function test_upload_image_functionality_when_store_post()
    {
        $post = Post::factory()->addImage()->make()->toArray();

        $this->actingAs(User::factory()->create());

        $response = $this->post(route('post.store'), $post);

        $post = Post::query()->where([
            'title' => $post['title'],
            'description' => $post['description']
        ])->first();

        $this->assertFileExists(storage_path('app\\public\\' . $post->image));

        $response->assertSessionHas('success');
    }
}
