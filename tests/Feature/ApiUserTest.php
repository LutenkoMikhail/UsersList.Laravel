<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_assert_status()
    {
        $response = $this->json('GET', '/api/v1/user/all');

        $response->assertStatus(200);
    }

    public function test_get_user_all()
    {
        $response = $this->json('GET', '/api/v1/user/all');

        $response->assertJson(fn(AssertableJson $json) => $json->has('user'));

    }


    public function test_post_user_all()
    {
        $response = $this->json('POST', '/api/v1/user/all');

        $response->assertJsonMissing(['user']);

    }

    public function test_get_user_all_no_url()
    {
        $response = $this->json('GET', '/api/v1/users/all');

        $response->assertNotFound();

    }

    public function test_get_user_all_name_email()
    {
        $response = $this->json('GET', '/api/v1/user/all');

        $response->assertJsonStructure([
            'user' => [
                '*' => [
                    'name',
                    'email',
                ]
            ]
        ]);
    }
    public function test_get_user_all_guest()
    {
        $response = $this->json('GET', '/api/v1/user/all');

        $this->assertGuest();
    }
}
