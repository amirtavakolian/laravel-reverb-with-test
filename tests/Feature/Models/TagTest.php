<?php

namespace Models;

use App\Models\Tag;
use App\Models\User;
use Tests\TestCase;

class TagTest extends TestCase
{

    public function test_insert_data1()
    {
        $tags = Tag::factory()->create();

        $this->assertDatabaseHas('tags', $tags->toArray());

        $this->assertInstanceOf(Tag::class, $tags);
    }
}
