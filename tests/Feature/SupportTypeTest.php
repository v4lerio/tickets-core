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
    public function we_can_create_a_support_type_with_parent() {
        $parent = $this->create(\App\SupportType::class);

        $response = $this->json('POST', '/api/support_types', [
            'parent_id' => $parent->id,
            'name' => $this->faker->name
        ])->assertStatus(201);

        $id = $response->decodeResponseJson()['data']['id'];

        // test we can fetch the child and reference the parent
        $child_support_type = $this->json('GET', '/api/support_types/' . $id)
            ->assertStatus(200)
            ->decodeResponseJson()['data'];

        $this->assertSame($child_support_type['parent']['id'], $parent->id);

        // test we can fetch the parent and reference the child
        $parent_support_type = $this->json('GET', $parent->path())
            ->assertStatus(200)
            ->decodeResponseJson()['data'];

        $this->assertCount(1, $parent_support_type['children']);
        $this->assertSame($child_support_type['name'], $parent_support_type['children'][0]['name']);
    }



}
