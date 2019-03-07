<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;

class EmailTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function we_can_fetch_email_accounts()
    {
        $this->withoutExceptionHandling();
        $email = $this->create(\App\Email::class);

        $this->json('GET', '/api/emails')
            ->assertStatus(200)
            ->assertJsonFragment([
                "email_address" => $email->email_address,
            ]);
    }

    /** @test */
    public function we_can_fetch_a_particular_email_account()
    {
        $email = $this->create(\App\Email::class);

        $this->json('GET', $email->path())
            ->assertStatus(200)
            ->assertJsonFragment([
                "email_address" => $email->email_address,
            ]);
    }

    /** @test */
    public function we_can_create_a_new_email_account()
    {
        $data = $this->make(\App\Email::class);

        $response = $this->json('POST', '/api/emails', $data->toArray())
            ->assertStatus(201)
            ->assertJsonFragment(["email_address" => $data['email_address']]);
    }

    /** @test */
    public function it_validates_correctly_on_create()
    {
        $this->json('POST', '/api/emails')
            ->assertStatus(422)
            ->assertJsonFragment(["The email address field is required."]);
    }

    /** @test */
    public function we_can_update_an_email_accounts_email_address()
    {
        $new_email = $this->faker->safeEmail;
        $email = $this->create(\App\Email::class);

        $this->json('PATCH', $email->path(), ['email_address' => $new_email])
            ->assertStatus(200)
            ->assertJsonFragment([
                "email_address" => $new_email,
            ]);
    }

    /** @test */
    public function we_can_update_with_no_fields()
    {
        $email = $this->create(\App\Email::class);

        $this->json('PATCH', $email->path())
            ->assertStatus(200);
    }

    /** @test */
    public function we_can_soft_delete_an_email_account()
    {
        $email = $this->create(\App\Email::class);

        $this->json('DELETE', $email->path())
            ->assertStatus(200);

        $this->assertTrue($email->fresh()->trashed());
    }

    /** @test */
    public function an_email_accounts_password_is_encrypted()
    {
        $data = $this->make(\App\Email::class);

        $response = $this->json('POST', '/api/emails', $data->toArray())
            ->assertStatus(201)
            ->decodeResponseJson();
        
        $this->assertNotSame($data->password, $response['data']['password']);
    }
    

}
