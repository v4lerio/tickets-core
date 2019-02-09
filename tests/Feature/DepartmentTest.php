<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function we_can_fetch_departments()
    {
        $department = $this->create(\App\Department::class);

        $this->json('GET', '/api/departments')
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $department->name,
            ]);
    }

    /** @test */
    public function we_can_fetch_a_particular_department()
    {
        $department = $this->create(\App\Department::class);

        $this->json('GET', $department->path())
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $department->name,
            ]);
    }

    /** @test */
    public function we_can_create_a_new_department()
    {
        $name = $this->faker->company;
        $this->json('POST', '/api/departments', ['name' => $name])
            ->assertStatus(201)
            ->assertJsonFragment(["name" => $name]);
    }

    /** @test */
    public function it_validates_correctly_on_create()
    {
        $this->json('POST', '/api/departments')
            ->assertStatus(422)
            ->assertJsonFragment(["The name field is required."]);
    }

    /** @test */
    public function we_can_update_an_departments_name()
    {
        $new_name = "Tom Harper";
        $department = $this->create(\App\Department::class);

        $this->json('PATCH', $department->path(), ['name' => $new_name])
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $new_name,
            ]);
    }

    /** @test */
    public function we_can_update_with_no_fields()
    {
        $department = $this->create(\App\Department::class);

        $this->json('PATCH', $department->path())
            ->assertStatus(200);
    }

    /** @test */
    public function it_validates_manager_on_create()
    {
        $name = $this->faker->company;
        $this->json('POST', '/api/departments', ['name' => $name, 'manager_id' => 1])
            ->assertStatus(422)
            ->assertJsonFragment(["The selected manager id is invalid."]);
    }

    /** @test */
    public function it_validates_manager_on_update()
    {
        $department = $this->create(\App\Department::class);

        $this->json('PATCH', $department->path(), ['manager_id' => 1])
            ->assertStatus(422)
            ->assertJsonFragment(["The selected manager id is invalid."]);
    }

    /** @test */
    public function we_can_soft_delete_an_department()
    {
        $department = $this->create(\App\Department::class);

        $this->json('DELETE', $department->path())
            ->assertStatus(200);

        $this->assertTrue($department->fresh()->trashed());
    }

}
