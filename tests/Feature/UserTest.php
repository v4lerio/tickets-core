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

}
