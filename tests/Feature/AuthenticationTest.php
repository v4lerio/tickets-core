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
            'name' => $user->name,
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
            'name' => 'test account',
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
            'name' => $user->name,
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
        $response = $this->json('POST', 'api/refresh', [], ['Authorization' => 'bearer ' . "invalidtoken.blah.foo"])->assertStatus(401);
    }
    
    
    
}