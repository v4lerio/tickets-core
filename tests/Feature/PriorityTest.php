<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PriorityTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function we_can_fetch_priorities()
    {
        $priority = $this->create(\App\Priority::class);

        $this->json('GET', '/api/priorities')
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $priority->name,
            ]);
    }

    /** @test */
    public function we_can_fetch_a_particular_priority()
    {
        $this->withoutExceptionHandling();
        $priority = $this->create(\App\Priority::class);

        $this->json('GET', $priority->path())
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $priority->name,
                "colour" => $priority->colour,
                "urgency" => $priority->urgency
            ]);
    }

    /** @test */
    public function we_can_create_a_new_priority()
    {
        $data = [
            'name' => $this->faker->name,
            'colour' => $this->faker->hexcolor,
            'urgency' => $this->faker->randomDigit
        ];
        $this->json('POST', '/api/priorities', $data)
            ->assertStatus(201)
            ->assertJsonFragment($data);
    }

    /** @test */
    public function it_validates_correctly_on_create()
    {
        $this->json('POST', '/api/priorities')
            ->assertStatus(422)
            ->assertJsonFragment(["The name field is required."])
            ->assertJsonFragment(["The colour field is required."])
            ->assertJsonFragment(["The urgency field is required."]);
    }

    /** @test */
    public function test_it_validates_unique_colour_and_urgency() 
    {
        $priority = $this->create(\App\Priority::class);

        $response = $this->json('POST', '/api/priorities', $priority->toArray())
            ->assertStatus(422)
            ->assertJsonFragment(["The colour has already been taken."]);
    }

    /** @test */
    public function we_can_update_a_priorities_name()
    {
        $new_name = "CRITICAL";
        $priority = $this->create(\App\Priority::class);

        $this->json('PATCH', $priority->path(), ['name' => $new_name])
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $new_name,
            ]);
    }

    /** @test */
    public function we_can_update_with_no_fields()
    {
        $priority = $this->create(\App\Priority::class);

        $this->json('PATCH', $priority->path())
            ->assertStatus(200);
    }


    /** @test */
    public function we_can_soft_delete_an_priority()
    {
        $priority = $this->create(\App\Priority::class);

        $this->json('DELETE', $priority->path())
            ->assertStatus(200);

        $this->assertTrue($priority->fresh()->trashed());
    }

    /** @test */
    public function we_can_fetch_deleted_priorities()
    {
        $this->create(\App\Priority::class, [], 2);
        $org = \App\Priority::first();
        $org->delete();

        $this->json('GET', '/api/priorities')
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $org->id
            ]);
    }

}
