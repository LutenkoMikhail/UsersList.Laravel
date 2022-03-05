<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiUserTest extends TestCase
{

    /** @test */
    public function test_assert_status()
    {
        $response = $this->json('GET', route('api.all.users'));

        $response->assertStatus(200);
    }

    /** @test */
    public function test_get_user_all()
    {
        $response = $this->json('GET', route('api.all.users'));

        $response->assertJson(fn(AssertableJson $json) => $json->has('user'));

    }

    /** @test */
    public function test_post_user_all()
    {
        $response = $this->json('POST', route('api.all.users'));

        $response->assertJsonMissing(['user']);

    }

    /** @test */
    public function test_get_user_all_no_url()
    {
        $response = $this->json('GET', route('api.all.users') . 's');

        $response->assertNotFound();

    }

    /** @test */
    public function test_get_user_all_name_email()
    {
        $response = $this->json('GET', route('api.all.users'));

        $response->assertJsonStructure([
            'user' => [
                '*' => [
                    'name',
                    'email',
                ]
            ]
        ]);
    }

    /** @test */
    public function test_get_user_all_guest()
    {
        $response = $this->json('GET', route('api.all.users'));

        $this->assertGuest();
    }
}
