<?php

namespace Tests\Feature\Views;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PanelViewTest extends TestCase
{
    public function test_not_admin_users_cant_see_admin_menu()
    {
        $user = User::factory()->isUser()->create();

        $this->actingAs($user);

        $view = $this->view('panel');

        $view->assertDontSeeText('Site 👇');

        $view->assertDontSee('<button onclick="toggleMenu()">Site 👇</button>');
    }

    public function test_admin_users_can_see_admin_menu()
    {
        $user = User::factory()->isAdmin()->create();

        $this->actingAs($user);

        $view = $this->view('panel');

        $view->assertSeeText('Site 👇');

        $view->assertSee('<button onclick="toggleMenu()">Site 👇</button>', false);
    }
}
