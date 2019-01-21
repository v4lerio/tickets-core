<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function we_can_fetch_customers()
    {
        $customer = $this->create(\App\Customer::class);

        $this->json('GET', '/api/customers')
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $customer->name,
            ]);
    }

    /** @test */
    public function we_can_fetch_a_particular_customer()
    {
        $customer = $this->create(\App\Customer::class);

        $this->json('GET', $customer->path())
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $customer->name,
            ]);
    }

    /** @test */
    public function we_can_create_a_new_customer()
    {
        $name = $this->faker->company;
        $this->json('POST', '/api/customers', ['name' => $name])
            ->assertStatus(201)
            ->assertJsonFragment(["name" => $name]);
    }

    /** @test */
    public function it_validates_correctly_on_create()
    {
        $this->json('POST', '/api/customers')
            ->assertStatus(422)
            ->assertJsonFragment(["The name field is required."]);
    }

    /** @test */
    public function we_can_update_an_customers_name()
    {
        $new_name = "Tom Harper";
        $customer = $this->create(\App\Customer::class);

        $this->json('PATCH', $customer->path(), ['name' => $new_name])
            ->assertStatus(200)
            ->assertJsonFragment([
                "name" => $new_name,
            ]);
    }

    /** @test */
    public function we_can_update_with_no_fields()
    {
        $organisation = $this->create(\App\Customer::class);

        $this->json('PATCH', $organisation->path())
            ->assertStatus(200);
    }


    /** @test */
    public function we_can_soft_delete_an_customer()
    {
        $customer = $this->create(\App\Customer::class);

        $this->json('DELETE', $customer->path())
            ->assertStatus(200);

        $this->assertTrue($customer->fresh()->trashed());
    }

    /** @test */
    public function we_can_fetch_deleted_customers()
    {
        $this->create(\App\Customer::class, [], 10);
        $customer = \App\Customer::first();
        $customer->delete();

        $this->json('GET', '/api/customers')
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $customer->id
            ]);
    }

}
