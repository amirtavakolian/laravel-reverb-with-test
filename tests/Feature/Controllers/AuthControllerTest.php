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
    }
}
