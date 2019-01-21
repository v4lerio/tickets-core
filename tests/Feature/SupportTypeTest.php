<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupportTypeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function we_can_fetch_support_types()
    {
        $support_type = $this->create(\App\SupportType::class);

        $this->json('GET', '/api/support_types')
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $support_type->name,
            ]);
    }

    /** @test */
    public function we_can_fetch_a_particular_support_type()
    {
        $this->withoutExceptionHandling();
        $support_type = $this->create(\App\SupportType::class);

        $this->json('GET', $support_type->path())
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $support_type->name,
            ]);
    }

    /** @test */
    public function we_can_create_a_new_support_type()
    {
        $name = $this->faker->company;
        $this->json('POST', '/api/support_types', ['name' => $name])
            ->assertStatus(201)
            ->assertJsonFragment(["name" => $name]);
    }

    /** @test */
    public function it_validates_correctly_on_create()
    {
        $this->json('POST', '/api/support_types')
            ->assertStatus(422)
            ->assertJsonFragment(["The name field is required."]);
    }

    /** @test */
    public function we_can_update_a_support_types_name()
    {
        $new_name = "Toms Company";
        $support_type = $this->create(\App\SupportType::class);

        $this->json('PATCH', $support_type->path(), ['name' => $new_name])
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $new_name,
            ]);
    }

    /** @test */
    public function we_can_update_with_no_fields()
    {
        $support_type = $this->create(\App\SupportType::class);

        $this->json('PATCH', $support_type->path())
            ->assertStatus(200);
    }


    /** @test */
    public function we_can_soft_delete_an_support_type()
    {
        $support_type = $this->create(\App\SupportType::class);

        $this->json('DELETE', $support_type->path())
            ->assertStatus(200);
        
        $this->assertTrue($support_type->fresh()->trashed());
    }

    /** @test */
    public function we_can_fetch_deleted_support_types()
    {
        $this->create(\App\SupportType::class, [], 10);
        $org = \App\SupportType::first();
        $org->delete();

        $this->json('GET', '/api/support_types')
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $org->id
            ]);
    }
}
