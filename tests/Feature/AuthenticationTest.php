<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $user = new User([
             'email'    => 'test@email.com',
             'name' => 'test account',
             'password' => '123456'
         ]);

        $user->save();
    }

    /** @test */
    public function it_will_register_a_user()
    {
        $response = $this->json('POST', 'api/register', [
            'email'    => 'test2@email.com',
            'name' => 'test account',
            'password' => '123456'
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /** @test */
    public function it_validates_registration_data() {
        $response = $this->json('POST', 'api/register', []);
        
        $response->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'email' => 
                        ['The email field is required.'],
                    'name' => 
                        ['The name field is required.'],
                    'password' => 
                        ['The password field is required.']
                ]
            ]);
    }

    /** @test */
    public function it_will_log_a_user_in()
    {
        $response = $this->json('POST', 'api/login', [
            'email'    => 'test@email.com',
            'name' => 'test account',
            'password' => '123456'
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
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
}