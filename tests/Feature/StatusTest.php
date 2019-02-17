<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function we_can_fetch_statuses()
    {
        $status = $this->create(\App\Status::class);

        $this->json('GET', '/api/statuses')
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $status->name,
            ]);
    }

    /** @test */
    public function we_can_fetch_a_particular_status()
    {
        $status = $this->create(\App\Status::class);

        $this->json('GET', $status->path())
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $status->name,
            ]);
    }

    /** @test */
    public function we_can_create_a_new_status()
    {
        $data = [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'state' => collect(['open','closed','archived'])->random()
        ];

        $this->json('POST', '/api/statuses', $data)
            ->assertStatus(201)
            ->assertJsonFragment(["name" => $data['name']])
            ->assertJsonFragment(["description" => $data['description']])
            ->assertJsonFragment(["state" => $data['state']]);
    }

    /** @test */
    public function it_validates_correctly_on_create()
    {
        $this->json('POST', '/api/statuses')
            ->assertStatus(422)
            ->assertJsonFragment(["The name field is required."])
            ->assertJsonFragment(["The description field is required."])
            ->assertJsonFragment(["The state field is required."]);
    }

    /** @test */
    public function it_validates_correct_state_on_create()
    {
        $this->json('POST', '/api/statuses', ['state' => 'WRONG'])
            ->assertStatus(422)
            ->assertJsonFragment(['The selected state is invalid.']);
    }


    /** @test */
    public function we_can_update_a_statuses_name()
    {
        $new_name = 'Waiting on Customer';
        $status = $this->create(\App\Status::class);

        $this->json('PATCH', $status->path(), ['name' => $new_name])
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $new_name,
            ]);
    }

    /** @test */
    public function we_can_update_with_no_fields()
    {
        $status = $this->create(\App\Status::class);

        $this->json('PATCH', $status->path())
            ->assertStatus(200);
    }


    /** @test */
    public function we_can_soft_delete_an_status()
    {
        $status = $this->create(\App\Status::class);

        $this->json('DELETE', $status->path())
            ->assertStatus(200);

        $this->assertTrue($status->fresh()->trashed());
    }


}
