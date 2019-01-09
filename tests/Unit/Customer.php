<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Customer extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $customer = $this->create(\App\Customer::class);

        $this->assertEquals('/api/customers/' . $customer->id, $customer->path());
    }

    /** @test */
    public function it_belongs_to_an_organisation()
    {
        $customer = $this->create(\App\Customer::class);

        $this->assertInstanceOf(\App\Organisation::class, $customer->organisation);
    }



}
