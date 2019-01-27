<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class ArticleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function we_can_create_a_new_internal_note() {
        $ticket = $this->create(\App\Ticket::class);
        $data = [
            'subject' => $this->faker->sentence,
            'body' => $this->faker->paragraph 
        ];
        $this->json('POST', $ticket->path() . '/internal_note', $data)
            ->assertStatus(201)
            ->assertJsonFragment(['type' => 'internal_note'])
            ->assertJsonFragment(['subject' => $data['subject']])
            ->assertJsonFragment(['body' => $data['body']])
            ->assertJsonFragment(['ticket_id' => $ticket->id]);
    }

    /** @test */
    public function we_can_create_a_new_outbound_email() {
        $ticket = $this->create(\App\Ticket::class);
        $data = [
            'from' => $this->faker->email,
            'to' => $this->faker->email,
            'subject' => $ticket->subject,
            'body' => $this->faker->paragraph
        ];
        $response = $this->json('POST', $ticket->path() . '/outbound_email', $data)
            ->assertStatus(201)
            ->assertJsonFragment(['type' => 'outbound_email'])
            ->assertJsonFragment(['subject' => $data['subject']])
            ->assertJsonFragment(['body' => $data['body']])
            ->assertJsonFragment(['ticket_id' => $ticket->id]);
    }

    /** @test */
    public function an_outbound_email_gets_queued_on_the_mail_system() {
        Mail::fake();
        $ticket = $this->create(\App\Ticket::class);
        $data = [
            'from' => $this->faker->email,
            'to' => $this->faker->email,
            'subject' => $ticket->subject,
            'body' => $this->faker->paragraph
        ];
        $response = $this->json('POST', $ticket->path() . '/outbound_email', $data)
            ->assertStatus(201);
        Mail::assertQueued(\App\Mail\ArticleOutboundEmail::class, 1);
    }

}
