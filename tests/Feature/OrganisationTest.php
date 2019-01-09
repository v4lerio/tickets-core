<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganisationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function we_can_fetch_organisations()
    {
        $organisation = $this->create(\App\Organisation::class);

        $this->json('GET', 'api/organisations')
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $organisation->name,
            ]);
    }

    /** @test */
    public function we_can_fetch_a_particular_organisation()
    {
        $organisation = $this->create(\App\Organisation::class);

        $this->json('GET', $organisation->path())
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $organisation->name,
            ]);
    }

    /** @test */
    public function we_can_create_a_new_organisation()
    {
        $name = $this->faker->company;
        $this->json('POST', '/api/organisations', ['name' => $name])
            ->assertStatus(201)
            ->assertJsonFragment(["name" => $name]);
    }

    /** @test */
    public function it_validates_correctly_on_create()
    {
        $this->json('POST', '/api/organisations')
            ->assertStatus(422)
            ->assertJsonFragment(["The name field is required."]);
    }

    /** @test */
    public function we_can_update_an_organisations_name()
    {
        $new_name = "Toms Company";
        $organisation = $this->create(\App\Organisation::class);

        $this->json('PATCH', $organisation->path(), ['name' => $new_name])
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $new_name,
            ]);
    }

    /** @test */
    public function we_can_soft_delete_an_organisation()
    {
        $organisation = $this->create(\App\Organisation::class);

        $this->json('DELETE', $organisation->path())
            ->assertStatus(200);
    }

    /** @test */
    public function we_can_fetch_deleted_organisations()
    {
        $this->create(\App\Organisation::class, [], 10);
        $org = \App\Organisation::first();
        $org->delete();

        $this->json('GET', '/api/organisations')
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $org->id
            ]);
    }

}
