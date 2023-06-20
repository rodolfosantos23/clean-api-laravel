<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Factory\FakeUserFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_stores_user_data()
    {
        $response = $this->post('/api/user', FakeUserFactory::createUser());
        $response->assertStatus(201);
    }

    /** @test */
    public function it_should_fail_if_name_is_invalid()
    {
        $userData = [
            'name' => '',
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
        ];
        $response = $this->post('/api/user', FakeUserFactory::createUser(['name' => '']));
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function it_should_fail_if_email_is_invalid()
    {
        $response = $this->post('/api/user', FakeUserFactory::createUser(['email' => '']));
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_should_fail_if_password_has_less_than_6_characters()
    {
        $response = $this->post('/api/user', FakeUserFactory::createUser(['password' => '12345']));
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);
    }
}
