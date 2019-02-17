<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_will_log_a_user_in()
    {
        $user = $this->createUser(['password' => '123456']);

        $response = $this->json('POST', 'api/login', [
            'email'    => $user->email,
            'password' => '123456'
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /** @test */
    public function it_validates_login_data()
    {
        $this->json('POST', 'api/login')->assertStatus(422);
    }


    /** @test */
    public function it_will_not_log_an_invalid_user_in()
    {
        $response = $this->json('POST', 'api/login', [
            'email'    => 'test@email.com',
            'password' => 'notlegitpassword'
        ]);

        $response->assertJsonStructure([
            'error',
        ]);
    }

    /** @test */
    public function it_can_refresh_a_token()
    {
        $user = $this->createUser(['password' => '123456']);

        $response = $this->json('POST', 'api/login', [
            'email' => $user->email,
            'password' => '123456'
        ]);

        $token = $response->decodeResponseJson()['access_token'];

        $response = $this->json('POST', 'api/refresh', [], ['Authorization' => 'bearer ' . $token]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);

        $this->assertNotSame($token, $response->decodeResponseJson()['access_token']);
    }

    /** @test */
    public function can_only_refresh_a_token_when_signed_in()
    {
        $this->json('POST', 'api/refresh')->assertStatus(401);
    }

    /** @test */
    public function can_only_refresh_a_valid_token()
    {
        $this->json('POST', 'api/refresh', [], ['Authorization' => 'bearer ' . "invalidtoken.blah.foo"])
            ->assertStatus(401);
    }

    /** @test */
    public function we_can_fetch_our_own_user()
    {
        $user = $this->create(\App\User::class);

        $this->signIn($user);

        $this->json('GET', 'api/current_user')
            ->assertJsonFragment(['name' => $user->name])
            ->assertJsonFragment(['email' => $user->email]);

    }

    /** @test */
    public function we_have_to_be_signed_in_to_fetch_our_own_user()
    {
        $this->json('GET', 'api/current_user')
            ->assertStatus(401)
            ->assertJsonFragment(['Unauthenticated.']);
    }




}