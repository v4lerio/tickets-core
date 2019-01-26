<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $response = $this->json('POST', $ticket->path() . '/internal_note', $data)
            ->assertStatus(201)
            ->assertJsonFragment(['subject' => $data['subject']])
            ->assertJsonFragment(['body' => $data['body']])
            ->assertJsonFragment(['ticket_id' => $ticket->id]);
    }

}
