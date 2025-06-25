<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_index_method()
    {
        $response = $this->get(route('register-form'));

        $dom = new DOMDocument();
        $dom->loadHTML($response->getContent());
        $xpath = new DOMXPath($dom);

        $formElement = $xpath->query('//form[@method="POST"]');
        $passwordInputElement = $xpath->query('//input[@id="password"]');

        $this->assertTrue(boolval($formElement->count()));
        $this->assertTrue(boolval($passwordInputElement->count()));

        $response->assertStatus(200); // if the status is not 200, this test will show us

        $response->assertViewIs('register'); // if we change view name, this test will not pass
    }

    public function test_authenticated_user_cant_see_register_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('register-form'));

        $response->assertStatus(302);
    }

    public function test_login_view_method()
    {
        $response = $this->get(route('login-form'));

        $dom = new DOMDocument();
        $dom->loadHTML($response->getContent());
        $xpath = new DOMXPath($dom);

        $formElement = $xpath->query('//form[@method="POST"]');
        $passwordInputElement = $xpath->query('//input[@name="email"]');

        $response->assertStatus(200);
        $this->assertTrue(boolval($formElement->count()));
        $this->assertTrue(boolval($passwordInputElement->count()));
        $response->assertViewIs('login');
    }

    public function test_login_fails_with_invalid_username_or_password()
    {
        $user = User::factory()->create();

        $userCredential = [
            "email" => $user->email,
            "password" => "13444"
        ];

        $response = $this->post(route('login'), $userCredential);

        $response->assertSessionHas('login_fail');

        $response->assertRedirect();
    }
}
