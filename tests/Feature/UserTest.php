<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function we_can_fetch_users()
    {
        $user = $this->create(\App\User::class);

        $this->json('GET', '/api/users')
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $user->name,
            ]);
    }

    /** @test */
    public function we_can_fetch_a_particular_user()
    {
        $user = $this->create(\App\User::class);

        $this->json('GET', $user->path())
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $user->name,
            ]);
    }

    /** @test */
    public function we_can_create_a_new_user()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'password' => 'secret!'
        ];

        $this->json('POST', '/api/users', $data)
            ->assertStatus(201)
            ->assertJsonFragment(['name' => $data['name']])
            ->assertJsonFragment(['email' => $data['email']]);
    }

    /** @test */
    public function it_validates_correctly_on_create()
    {
        $this->json('POST', '/api/users')
            ->assertStatus(422)
            ->assertJsonFragment(["The name field is required."])
            ->assertJsonFragment(["The email field is required."])
            ->assertJsonFragment(["The password field is required."]);
    }

    /** @test */
    public function it_validates_unique_email_addresses_on_create()
    {
        $user = $this->create(\App\User::class);

        $data = [
            'name' => $this->faker->name,
            'email' => $user->email,
            'password' => 'secret!'
        ];

        $this->json('POST', '/api/users', $data)
            ->assertStatus(422)
            ->assertJsonFragment(['The email has already been taken.']);
    }


    /** @test */
    public function we_can_update_a_users_name()
    {
        $this->withoutExceptionHandling();
        $user = $this->create(\App\User::class);
        $new_name = $this->faker->unique()->name;

        $this->json('PATCH', $user->path(), ['name' => $new_name])
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $new_name,
            ]);
    }

    /** @test */
    public function it_validates_unique_email_addresses_on_update()
    {
        $user = $this->create(\App\User::class);
        $user2 = $this->create(\App\User::class);

        $this->json('PATCH', $user2->path(), ['email' => $user->email])
            ->assertStatus(422)
            ->assertJsonFragment(['The email has already been taken.']);
    }


    /** @test */
    public function we_can_update_with_no_fields()
    {
        $user = $this->create(\App\User::class);

        $this->json('PATCH', $user->path())
            ->assertStatus(200);
    }


    /** @test */
    public function we_can_soft_delete_an_user()
    {
        $user = $this->create(\App\User::class);

        $this->json('DELETE', $user->path())
            ->assertStatus(200);

        $this->assertTrue($user->fresh()->trashed());
    }

    /** @test */
    public function a_newly_created_user_can_login()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'password' => 'secret!'
        ];

        $response = $this->json('POST', '/api/users', $data)
            ->assertStatus(201)
            ->assertJsonFragment(['name' => $data['name']])
            ->assertJsonFragment(['email' => $data['email']]);

        $response = $this->json('POST', 'api/login', [
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }


}
