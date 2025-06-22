<?php

namespace Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class  UserTest extends TestCase
{

    use RefreshDatabase;

    public function test_insert_data1(): void
    {
        $user = User::factory()->unverified()->make()->toArray();

        $user['password'] = Hash::make('password');

        $user = User::query()->create($user);

        $this->assertDatabaseHas('users', $user->toArray());

    }

    public function test1_insert_data2(): void
    {
        $user = User::factory()->unverified()->make()->toArray();

        $user['password'] = Hash::make('password');

        $user = User::query()->create($user);

        $this->assertDatabaseHas('users', $user->toArray());
    }

    public function test1_insert_data3(): void
    {
        $user = User::factory()->unverified()->create();

        $this->assertDatabaseHas('users', $user->toArray());
    }

    public function test_user_relationship_with_posts()
    {
        $user = User::factory()->has(Post::factory())->create();

        $this->assertModelExists($user->posts->first());

        $this->assertInstanceOf(Post::class, $user->posts->first());

        $this->assertDatabaseHas('posts', $user->posts->first()->toArray());

    }
}
